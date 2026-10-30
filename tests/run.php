<?php
declare(strict_types=1);

require __DIR__ . '/../src/Payments/PaymentProvider.php';
require __DIR__ . '/../src/Payments/PaymentRequest.php';
require __DIR__ . '/../src/Payments/PaymentResult.php';
require __DIR__ . '/../src/Payments/MockTuuProvider.php';
require __DIR__ . '/../src/Inventory/ProductOwnership.php';
require __DIR__ . '/../src/Inventory/ProductOwner.php';

use LaFactoria\Inventory\ProductOwner;
use LaFactoria\Inventory\ProductOwnership;
use LaFactoria\Payments\MockTuuProvider;
use LaFactoria\Payments\PaymentRequest;

$checks = 0;
$assert = static function (bool $condition, string $message) use (&$checks): void {
    $checks++;
    if (!$condition) {
        throw new RuntimeException($message);
    }
};

$owner = new ProductOwner(ProductOwnership::Collaborator, 'andrea');
$assert($owner->collaboratorId === 'andrea', 'Collaborator product should retain its owner.');
$assert((new ProductOwner(ProductOwnership::LaFactoria))->collaboratorId === null, 'House products must not carry a collaborator ID.');

$invalidOwnerRejected = false;
try {
    new ProductOwner(ProductOwnership::Collaborator);
} catch (InvalidArgumentException) {
    $invalidOwnerRejected = true;
}
$assert($invalidOwnerRejected, 'Collaborator ownership without an owner must fail.');

$provider = new MockTuuProvider();
$request = new PaymentRequest('idem-001', 'sale-001', 12990);
$first = $provider->initiate($request);
$again = $provider->initiate($request);
$assert($first === $again, 'Repeated idempotency key must return the original result.');
$assert($first->status === 'pending' && $first->mode === 'mock', 'Mock payment must stay pending and marked mock.');
$assert($provider->status($first->providerReference) === $first, 'Status lookup must return the same mock attempt.');

fwrite(STDOUT, "OK: {$checks} assertions\n");
