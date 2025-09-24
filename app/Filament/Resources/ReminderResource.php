<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Reminder;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ReminderResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ReminderResource\RelationManagers;

class ReminderResource extends Resource
{
    protected static ?string $model = Reminder::class;
    protected static ?string $navigationIcon = 'heroicon-o-bell';
    protected static ?string $navigationGroup = 'Manajemen Ibu Hamil';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('ibu_hamil_id')
                ->relationship('ibuHamil', 'name')
                ->label('Ibu Hamil')
                ->required(),

            // created_by tidak perlu ditampilkan di form, biar otomatis
            Forms\Components\Hidden::make('created_by')
                ->default(fn () => Auth::id()),

            Forms\Components\TextInput::make('judul')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('deskripsi')
                ->rows(3),

            Forms\Components\DateTimePicker::make('tanggal')
                ->label('Tanggal Reminder')
                ->required(),

            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'done'    => 'Selesai',
                ])
                ->default('pending')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ibuHamil.name')->label('Ibu Hamil'),
                Tables\Columns\TextColumn::make('creator.name')->label('Dibuat Oleh'),
                Tables\Columns\TextColumn::make('judul')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('tanggal')->dateTime()->label('Tanggal Reminder'),
                Tables\Columns\TextColumn::make('status')
                ->badge()
                ->colors([
                    'warning' => 'pending',
                    'success' => 'done',
                ]),
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
            'index' => Pages\ListReminders::route('/'),
            'create' => Pages\CreateReminder::route('/create'),
            'edit' => Pages\EditReminder::route('/{record}/edit'),
        ];
    }
}
