<?php
declare(strict_types=1);

namespace LaFactoria\Payments;

interface PaymentProvider
{
    public function initiate(PaymentRequest $request): PaymentResult;

    public function status(string $providerReference): PaymentResult;
}
