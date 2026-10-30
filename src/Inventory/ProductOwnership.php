<?php
declare(strict_types=1);

namespace LaFactoria\Inventory;

enum ProductOwnership: string
{
    case LaFactoria = 'la_factoria';
    case Collaborator = 'collaborator';
}
