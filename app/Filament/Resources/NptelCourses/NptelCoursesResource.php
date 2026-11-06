<?php

namespace App\Filament\Resources\NptelCourses;

use App\Filament\Resources\NptelCourses\Pages\CreateNptelCourses;
use App\Filament\Resources\NptelCourses\Pages\EditNptelCourses;
use App\Filament\Resources\NptelCourses\Pages\ListNptelCourses;
use App\Filament\Resources\NptelCourses\Schemas\NptelCoursesForm;
use App\Filament\Resources\NptelCourses\Tables\NptelCoursesTable;
use App\Models\NptelCourse;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class NptelCoursesResource extends Resource
{
    protected static ?string $model = NptelCourse::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'NptelCourse';

    public static function form(Schema $schema): Schema
    {
        return NptelCoursesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NptelCoursesTable::configure($table);
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
            'index' => ListNptelCourses::route('/'),
            'create' => CreateNptelCourses::route('/create'),
            'edit' => EditNptelCourses::route('/{record}/edit'),
        ];
    }
}
