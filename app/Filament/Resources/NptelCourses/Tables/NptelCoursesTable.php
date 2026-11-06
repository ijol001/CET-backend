<?php

namespace App\Filament\Resources\NptelCourses\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class NptelCoursesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                TextColumn::make('department')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('course_type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),

                TextColumn::make('phase')
                    ->formatStateUsing(fn (string $state): string => 'Phase ' . $state)
                    ->sortable(),

                TextColumn::make('developers')
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        'archived' => 'gray',
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('phase')
                    ->options([
                        'I' => 'Phase I',
                        'II' => 'Phase II',
                    ]),

                SelectFilter::make('course_type')
                    ->options([
                        'web' => 'Web',
                        'video' => 'Video',
                    ]),

                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
