<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use App\Filament\Resources\TreatmentResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class TreatmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'treatments';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
                    ->relationship('patient', 'name')
                    ->required()
                    ->hiddenOn('edit'),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan('full'),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(65535)
                    ->columnSpan('full'),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->prefix('$')
                    ->maxValue(42949672.95),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->columns([
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('price')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->url(TreatmentResource::getUrl('create'))
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    // ->url(fn ($record) => TreatmentResource::getUrl("{$record->getKey()}/edit")),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
