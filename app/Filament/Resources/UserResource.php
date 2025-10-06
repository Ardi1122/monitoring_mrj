<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Pengguna';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('User Information')
                    ->tabs([
                        // Tab 1: Data User
                        Forms\Components\Tabs\Tab::make('Data Akun')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Lengkap')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('password')
                                    ->label('Password')
                                    ->password()
                                    ->required(fn(string $operation): bool => $operation === 'create')
                                    ->minLength(8)
                                    ->maxLength(255)
                                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                                    ->dehydrated(fn($state) => filled($state))
                                    ->helperText('Kosongkan jika tidak ingin mengubah password'),

                                Forms\Components\Select::make('role')
                                    ->label('Role')
                                    ->options([
                                        'dosen' => 'Admin',
                                        'pengelola' => 'Pengelola',
                                        'ibu_hamil' => 'Ibu Hamil',
                                    ])
                                    ->required()
                                    ->native(false),
                            ]),

                        // Tab 2: Data Identitas
                        Forms\Components\Tabs\Tab::make('Data Identitas')
                            ->schema([
                                Forms\Components\TextInput::make('identitas.nik')
                                    ->label('NIK')
                                    ->maxLength(16)
                                    ->minLength(16)
                                    ->numeric()
                                    ->required()
                                    ->rules([
                                        function ($record) {
                                            return function (string $attribute, $value, $fail) use ($record) {
                                                $query = \App\Models\Identitas::where('nik', $value);

                                                // Kalo lagi edit, exclude identitas yang sedang diedit
                                                if ($record && $record->identitas) {
                                                    $query->where('id', '!=', $record->identitas->id);
                                                }

                                                if ($query->exists()) {
                                                    $fail('NIK sudah digunakan.');
                                                }
                                            };
                                        }
                                    ]),

                                Forms\Components\TextInput::make('identitas.nomor_telepon')
                                    ->label('Nomor Telepon')
                                    ->tel()
                                    ->required()
                                    ->maxLength(15),

                                Forms\Components\Textarea::make('identitas.alamat')
                                    ->label('Alamat')
                                    ->required()
                                    ->rows(3)
                                    ->maxLength(500),

                                Forms\Components\DatePicker::make('identitas.tanggal_lahir')
                                    ->label('Tanggal Lahir')
                                    ->nullable()
                                    ->native(false)
                                    ->required()
                                    ->displayFormat('d/m/Y')
                                    ->maxDate(now()),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nik_nama')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(query: function ($query, $search) {
                        $query->where('name', 'like', "%{$search}%")
                            ->orWhereHas(
                                'identitas',
                                fn($q) =>
                                $q->where('nik', 'like', "%{$search}%")
                            );
                    }),
                Tables\Columns\TextColumn::make('identitas.nomor_telepon')
                    ->label('No. Telepon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->badge()
                    ->colors([
                        'success' => 'dosen',
                        'warning' => 'pengelola',
                        'info' => 'ibu_hamil',
                    ]),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
    public static function canViewAny(): bool
    {
        return Auth::user()?->role === 'dosen';
    }
}
