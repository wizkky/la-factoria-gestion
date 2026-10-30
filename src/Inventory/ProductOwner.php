<?php
declare(strict_types=1);

namespace LaFactoria\Inventory;

final readonly class ProductOwner
{
    public function __construct(
        public ProductOwnership $ownership,
        public ?string $collaboratorId = null,
    ) {
        if (($ownership === ProductOwnership::Collaborator) !== ($collaboratorId !== null && $collaboratorId !== '')) {
            throw new \InvalidArgumentException('Collaborator-owned products require one collaborator ID; La Factoría products must not have one.');
        }
    }
}
