<?php
declare(strict_types=1);

namespace LaFactoria\Payments;

final readonly class PaymentResult
{
    public function __construct(
        public string $providerReference,
        public string $saleReference,
        public int $amountClp,
        public string $status,
        public string $mode,
    ) {}
}
