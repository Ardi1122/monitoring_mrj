<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LogBookResource\Pages;
use App\Filament\Resources\LogBookResource\RelationManagers;
use App\Models\LogBook;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LogBookResource extends Resource
{
    protected static ?string $model = LogBook::class;
    protected static ?string $navigationIcon = 'heroicon-o-heart';
    protected static ?string $navigationGroup = 'Manajemen';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('pengelola_id')
                ->label('Pengelola (Kader)')
                ->relationship(
                    name: 'pengelola',
                    titleAttribute: 'name',
                    modifyQueryUsing: fn($query, $search) => $query
                        ->where('name', 'like', "%{$search}%")
                        ->orWhereHas(
                            'identitas',
                            fn($q) =>
                            $q->where('nik', 'like', "%{$search}%")
                        )
                )
                ->getOptionLabelFromRecordUsing(fn($record) => $record->nik_nama)
                ->required(),

            Forms\Components\Select::make('ibu_hamil_id')
                ->label('Ibu Hamil')
                ->relationship(
                    name: 'ibuHamil',
                    titleAttribute: 'name',
                    modifyQueryUsing: fn($query, $search) => $query
                        ->where('name', 'like', "%{$search}%")
                        ->orWhereHas(
                            'identitas',
                            fn($q) =>
                            $q->where('nik', 'like', "%{$search}%")
                        )
                )
                ->getOptionLabelFromRecordUsing(fn($record) => $record->nik_nama)
                ->required(),

            Forms\Components\DatePicker::make('tanggal')
                ->required(),

            Forms\Components\TextInput::make('topik')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('hasil_diskusi')
                ->rows(5),

            Forms\Components\Textarea::make('tindak_lanjut')
                ->rows(5),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pengelola.nik_nama')
                    ->label('Pengelola')
                    ->sortable()
                    ->searchable(query: function ($query, $search) {
                        $query->whereHas('pengelola', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%")
                                ->orWhereHas(
                                    'identitas',
                                    fn($qq) =>
                                    $qq->where('nik', 'like', "%{$search}%")
                                );
                        });
                    }),


                Tables\Columns\TextColumn::make('ibuHamil.nik_nama')
                    ->label('Ibu Hamil')
                    ->sortable()
                    ->searchable(query: function ($query, $search) {
                        $query->whereHas('ibuHamil', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%")
                                ->orWhereHas(
                                    'identitas',
                                    fn($qq) =>
                                    $qq->where('nik', 'like', "%{$search}%")
                                );
                        });
                    }),
                    
                Tables\Columns\TextColumn::make('tanggal')->date(),
                Tables\Columns\TextColumn::make('topik'),
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
            'index' => Pages\ListLogBooks::route('/'),
            'create' => Pages\CreateLogBook::route('/create'),
            'edit' => Pages\EditLogBook::route('/{record}/edit'),
        ];
    }
}
