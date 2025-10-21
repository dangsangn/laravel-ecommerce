<?php

namespace App\Filament\Admin\Resources\Departments;

use App\Enum\RolesEnum;
use App\Filament\Admin\Resources\Departments\Pages\CreateDepartment;
use App\Filament\Admin\Resources\Departments\Pages\EditDepartment;
use App\Filament\Admin\Resources\Departments\Pages\ListDepartments;
use App\Filament\Admin\Resources\Departments\RelationManagers\CategoriesRelationManager;
use App\Filament\Admin\Resources\Departments\Schemas\DepartmentForm;
use App\Filament\Admin\Resources\Departments\Tables\DepartmentsTable;
use App\Models\Department;
use Illuminate\Support\Str;
use BackedEnum;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Facades\Filament;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return DepartmentForm::configure($schema)->schema(
            [
                TextInput::make('name')
                    ->label('Department Name')
                    ->required()
                    ->maxLength(255)
                    ->live('onBlur')
                    ->afterStateUpdated(fn (callable $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')->required()->maxLength(255),
                Checkbox::make('is_active')->label('Is Active')->default(true),
            ]
        );
    }

    public static function table(Table $table): Table
    {
        return DepartmentsTable::configure($table)->columns(
            [
                TextColumn::make('name')->label('Department Name')->searchable()->sortable(),
            ]
        )->defaultSort('created_at', 'desc')->filters(
            []
        )->recordActions(
            [
                EditAction::make(),
                DeleteAction::make(),
            ]
        );
    }

    public static function getRelations(): array
    {
        return [
            CategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDepartments::route('/'),
            'create' => CreateDepartment::route('/create'),
            'edit' => EditDepartment::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        $user = Filament::auth()->user();
        return $user && $user->hasRole(RolesEnum::Admin);
    }
}
