<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use App\Filament\Resources\AppointmentResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class AppointmentsRelationManager extends RelationManager
{
  protected static string $relationship = 'appointments';

  public function form(Form $form): Form
  {
    return $form
      ->schema([
          Forms\Components\Select::make('treatment_id')
              ->relationship('treatment', 'description')
              ->required(),
          Forms\Components\DateTimePicker::make('appointment_date')
              ->required(),
          Forms\Components\Textarea::make('notes')
              ->nullable(),
      ]);
  }

  public function table(Table $table): Table
  {
    return $table
          ->columns([
              Tables\Columns\TextColumn::make('treatment.description')
                  ->label('Treatment Description'),
              Tables\Columns\TextColumn::make('appointment_date')
                  ->dateTime(),
              Tables\Columns\TextColumn::make('notes')
          ])
          ->actions([
              Tables\Actions\EditAction::make()
                // ->url(AppointmentResource::getUrl('{record}.edit')),
          ])
          ->bulkActions([
              Tables\Actions\DeleteBulkAction::make(),
          ]);
  }
  
}

