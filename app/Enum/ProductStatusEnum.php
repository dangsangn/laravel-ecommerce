<?php

namespace App\Enum;

enum ProductStatusEnum:string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';

    public static function labels(): array
    {
        return [
            self::DRAFT->value => 'Draft',
            self::PUBLISHED->value => 'Published',
        ];
    }

    public static function colors(): array
    {
        return [
            self::DRAFT->value => ['bg' => 'bg-gray-100', 'text' => 'text-gray-800'],
            self::PUBLISHED->value => ['bg' => 'bg-green-100', 'text' => 'text-green-800'],
        ];
    }
}
