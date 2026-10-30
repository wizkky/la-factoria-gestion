<?php
declare(strict_types=1);

namespace LaFactoria\Payments;

final readonly class PaymentRequest
{
    public function __construct(
        public string $idempotencyKey,
        public string $saleReference,
        public int $amountClp,
        public string $currency = 'CLP',
        public string $terminalId = 'mock-terminal',
    ) {
        if ($idempotencyKey === '' || $saleReference === '') {
            throw new \InvalidArgumentException('Payment and sale references are required.');
        }
        if ($amountClp < 1 || $currency !== 'CLP') {
            throw new \InvalidArgumentException('A positive amount in CLP is required.');
        }
    }
}
