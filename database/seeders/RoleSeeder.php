<?php

namespace Database\Seeders;

use App\Enum\PermissionsEnum;
use App\Enum\RolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRole = Role::create(['name'=> RolesEnum::User->value]);
        $venderRole = Role::create(['name'=> RolesEnum::Vender->value]);
        $adminRole = Role::create(['name'=> RolesEnum::Admin->value]);

        $buyProductPermission = Permission::create(['name'=> PermissionsEnum::BuyProduct->value]);
        $saleProductPermission = Permission::create(['name'=> PermissionsEnum::SaleProduct->value]);
        $approveVenderPermission = Permission::create(['name'=> PermissionsEnum::ApproveVender->value]);

        $userRole->syncPermissions(([$buyProductPermission]));
        $venderRole->syncPermissions(([$buyProductPermission, $saleProductPermission]));
        $adminRole->syncPermissions(([$buyProductPermission, $saleProductPermission, $approveVenderPermission]));
    }
}
