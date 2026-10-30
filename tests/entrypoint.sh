#!/bin/sh
set -eu

factoria_entrypoint="$(cd "$(dirname "$0")/.." && pwd)/docker/php/entrypoint.sh"
factoria_fixture="$(mktemp -d)"
cleanup() {
  rm -f "$factoria_fixture/.env" "$factoria_fixture/.env.example" "$factoria_fixture/storage/app/factoria/app-key"
  rmdir "$factoria_fixture/storage/app/factoria" "$factoria_fixture/storage/app" "$factoria_fixture/storage" "$factoria_fixture"
}
trap cleanup EXIT
printf 'APP_KEY=\n' > "$factoria_fixture/.env.example"

effective_key() {
  APP_KEY="$1" FACTORIA_APP_ROOT="$factoria_fixture" sh "$factoria_entrypoint" sh -c 'printf "%s" "$APP_KEY"'
}

# Reproduce Compose's empty APP_KEY override and inspect the child process.
factoria_first="$(effective_key '')"
case "$factoria_first" in base64:*) ;; *) echo 'Missing generated APP_KEY' >&2; exit 1 ;; esac
test "$(printf '%s' "${factoria_first#base64:}" | base64 -d | wc -c | tr -d ' ')" = 32
test -f "$factoria_fixture/.env"
test "$(stat -c '%a' "$factoria_fixture/storage/app/factoria/app-key")" = 600

# A new process with the same storage volume must reuse the key.
test "$(effective_key '')" = "$factoria_first"

# An explicitly configured key must reach the process without changing storage.
factoria_explicit='base64:explicit-test-key'
test "$(effective_key "$factoria_explicit")" = "$factoria_explicit"
test "$(cat "$factoria_fixture/storage/app/factoria/app-key")" = "$factoria_first"

echo 'OK: APP_KEY generation, child environment, persistence and explicit override'
