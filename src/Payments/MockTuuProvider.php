<?php
declare(strict_types=1);

namespace LaFactoria\Payments;

/** Safe local simulator. It has no HTTP client and cannot contact TUU. */
final class MockTuuProvider implements PaymentProvider
{
    /** @var array<string, PaymentResult> */
    private array $byIdempotencyKey = [];

    public function initiate(PaymentRequest $request): PaymentResult
    {
        if (isset($this->byIdempotencyKey[$request->idempotencyKey])) {
            return $this->byIdempotencyKey[$request->idempotencyKey];
        }

        return $this->byIdempotencyKey[$request->idempotencyKey] = new PaymentResult(
            providerReference: 'mock-' . hash('sha256', $request->idempotencyKey),
            saleReference: $request->saleReference,
            amountClp: $request->amountClp,
            status: 'pending',
            mode: 'mock',
        );
    }

    public function status(string $providerReference): PaymentResult
    {
        foreach ($this->byIdempotencyKey as $result) {
            if ($result->providerReference === $providerReference) {
                return $result;
            }
        }

        throw new \OutOfBoundsException('Unknown mock payment reference.');
    }
}
