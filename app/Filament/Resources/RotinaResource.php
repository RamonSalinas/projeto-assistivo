<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RotinaResource\Pages;
use App\Filament\Resources\RotinaResource\RelationManagers;
use App\Models\Rotina;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;


class RotinaResource extends Resource
{
    protected static ?string $model = Rotina::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nome')->required()->label('Nome da Rotina'),
        ]);
    }


    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                ->label('Nome da Rotina') // Define o rótulo da coluna
                ->sortable() // Permite ordenar pela coluna
                ->searchable(), // Permite buscar pela coluna
        ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListRotinas::route('/'),
            'create' => Pages\CreateRotina::route('/create'),
            'edit' => Pages\EditRotina::route('/{record}/edit'),
        ];
    }
}
