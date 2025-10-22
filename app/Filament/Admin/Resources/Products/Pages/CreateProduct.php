<?php

namespace App\Filament\Admin\Resources\Products\Pages;

use App\Filament\Admin\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    public function mutateFormDataBeforeCreate(array $data): array
    {
        // You can set created_by and updated_by fields here if needed
        $userId = auth()->id();
        $data['created_by'] = $userId;
        $data['updated_by'] = $userId;

        return $data;
    }
}
