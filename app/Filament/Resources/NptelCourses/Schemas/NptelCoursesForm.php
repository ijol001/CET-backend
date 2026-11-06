<?php

namespace App\Filament\Resources\NptelCourses\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class NptelCoursesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                TextInput::make('department')
                    ->maxLength(255),

                Select::make('course_type')
                    ->options([
                        'web' => 'Web',
                        'video' => 'Video',
                    ])
                    ->required(),

                Select::make('phase')
                    ->options([
                        'I' => 'Phase I',
                        'II' => 'Phase II',
                    ])
                    ->required(),

                Textarea::make('developers')
                    ->rows(3)
                    ->columnSpanFull(),

                TextInput::make('course_url')
                    ->label('Course URL')
                    ->url()
                    ->maxLength(2048)
                    ->columnSpanFull(),

                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ])
                    ->default('draft')
                    ->required(),
            ]);
    }
}
