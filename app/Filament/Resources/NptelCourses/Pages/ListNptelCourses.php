<?php

namespace App\Filament\Resources\NptelCourses\Pages;

use App\Filament\Resources\NptelCourses\NptelCoursesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNptelCourses extends ListRecords
{
    protected static string $resource = NptelCoursesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
