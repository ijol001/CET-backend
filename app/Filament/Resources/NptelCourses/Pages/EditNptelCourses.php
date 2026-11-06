<?php

namespace App\Filament\Resources\NptelCourses\Pages;

use App\Filament\Resources\NptelCourses\NptelCoursesResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditNptelCourses extends EditRecord
{
    protected static string $resource = NptelCoursesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
