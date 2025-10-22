<?php

namespace App\Filament\Admin\Resources\Products;

use App\Enum\ProductStatusEnum;
use App\Enum\RolesEnum;
use App\Filament\Admin\Resources\Products\Pages\CreateProduct;
use App\Filament\Admin\Resources\Products\Pages\EditProduct;
use App\Filament\Admin\Resources\Products\Pages\ListProducts;
use App\Filament\Admin\Resources\Products\Schemas\ProductForm;
use App\Filament\Admin\Resources\Products\Tables\ProductsTable;
use App\Models\Product;
use BackedEnum;
use Dom\Text;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\Contracts\Editable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ProductForm::configure($schema)->schema([
            TextInput::make('title')
                ->label('Product Title')
                ->required()
                ->maxLength(2000)
                ->live('onBlur')
                ->afterStateUpdated(fn (callable $set, ?string $state) => $set('slug', Str::slug($state))),
            TextInput::make('slug')->required()->maxLength(2000),
            Select::make('department_id')
                ->relationship('department', 'name')
                ->label('Department')
                ->preload()
                ->searchable()
                ->required()
                ->afterStateUpdated(fn (callable $set,) => $set('category_id', null)),
            Select::make('category_id')
                ->relationship(name: 'category', titleAttribute: 'name', modifyQueryUsing: function ( $query, callable $get) {
                    $departmentId = $get('department_id');
                    if ($departmentId) {
                        $query->where('department_id', $departmentId);
                    }
                    return $query;
                })
                ->label('Category')
                ->preload()
                ->searchable()
                ->required(),
            RichEditor::make('description')->label('Product Description')->columnSpan(2)->nullable(),
            TextInput::make('price')->label('Price')->numeric()->required()->columnSpan(1),
            TextInput::make('stock_quantity')->label('Stock Quantity')->integer()->required()->default(0)->columnSpan(1),
            Select::make('status')
                ->label('Status')
                ->options(ProductStatusEnum::labels())
                ->required()
                ->default(ProductStatusEnum::DRAFT->value), 
        ]);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table)->columns([
            TextColumn::make('title')->label('Product Title')->searchable()->sortable(),
            TextColumn::make('status')->colors(
                ProductStatusEnum::colors()
            )->sortable(),
            TextColumn::make('department.name')->label('Department')->sortable()->searchable(),
            TextColumn::make('category.name')->label('Category')->sortable()->searchable(),
            TextColumn::make('price')->label('Price')->money('usd', true)->sortable(),
            TextColumn::make('stock_quantity')->label('Stock Quantity')->sortable(),
            TextColumn::make('created_at')->label('Created At')->dateTime()->sortable(),
        ])->defaultSort('created_at', 'desc')->filters([
            SelectFilter::make('status')
                ->label('Status')
                ->options(ProductStatusEnum::labels()),
            SelectFilter::make('department')->relationship('department', 'name')->label('Department'),
        ])->recordActions([
            EditAction::make(),
            DeleteAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        $user = Filament::auth()->user();
        return $user && $user->hasRole(RolesEnum::Vender);
    }
}
