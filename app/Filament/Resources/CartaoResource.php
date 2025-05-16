<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CartaoResource\Pages;
use App\Filament\Resources\CartaoResource\RelationManagers;
use App\Models\Cartao;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;




class CartaoResource extends Resource
{
    protected static ?string $model = Cartao::class;
    

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('titulo')->required(),
            Textarea::make('descricao')->rows(2),
            FileUpload::make('imagem')
                ->image()
                ->directory('cartaos')
                ->imagePreviewHeight('100'),
            Select::make('categoria')
                ->options([
                    'alimentacao' => 'Alimentação',
                    'banheiro' => 'Banheiro',
                    'escola' => 'Escola',
                    'emocao' => 'Emoções',
                ])
                ->label('Categoria'),
        ]);
    }
    
    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            ImageColumn::make('imagem')->height(80),
            TextColumn::make('titulo')->searchable(),
            TextColumn::make('categoria'),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCartaos::route('/'),
            'create' => Pages\CreateCartao::route('/create'),
            'edit' => Pages\EditCartao::route('/{record}/edit'),
        ];
    }



}
