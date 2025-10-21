<?php

namespace App\Enum;

enum PermissionsEnum: string
{
    case BuyProduct = 'BuyProduct';
    case SaleProduct = 'SaleProduct';
    case ApproveVender = 'ApproveVender';
}
