<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MrjTrackerResource\Pages;
use App\Filament\Resources\MrjTrackerResource\RelationManagers;
use App\Models\MrjTracker;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MrjTrackerResource extends Resource
{
    protected static ?string $model = MrjTracker::class;
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationGroup = 'Kesehatan';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kader_id')
                ->relationship('kader', 'name')
                ->label('Kader')
                ->required(),

            Forms\Components\DatePicker::make('tanggal')
                ->required(),

            Forms\Components\TextInput::make('jumlah_produksi')
                ->numeric()
                ->default(0),

            Forms\Components\TextInput::make('jumlah_distribusi')
                ->numeric()
                ->default(0),

            Forms\Components\TextInput::make('stok_sisa')
                ->numeric()
                ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kader.name')->label('Kader'),
                Tables\Columns\TextColumn::make('tanggal')->date(),
                Tables\Columns\TextColumn::make('jumlah_produksi'),
                Tables\Columns\TextColumn::make('jumlah_distribusi'),
                Tables\Columns\TextColumn::make('stok_sisa'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Dibuat'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListMrjTrackers::route('/'),
            'create' => Pages\CreateMrjTracker::route('/create'),
            'edit' => Pages\EditMrjTracker::route('/{record}/edit'),
        ];
    }
}
