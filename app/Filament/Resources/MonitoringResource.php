<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MonitoringResource\Pages;
use App\Filament\Resources\MonitoringResource\RelationManagers;
use App\Models\Monitoring;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MonitoringResource extends Resource
{
    protected static ?string $model = Monitoring::class;
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'Kesehatan';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Pilih pengelola (kader posyandu)
            Forms\Components\Select::make('pengelola_id')
                ->relationship('pengelola', 'name')
                ->label('Pengelola')
                ->searchable()
                ->required(),

            // Pilih ibu hamil
            Forms\Components\Select::make('ibu_hamil_id')
                ->relationship('ibuHamil', 'name')
                ->label('Ibu Hamil')
                ->searchable()
                ->required(),

            Forms\Components\DatePicker::make('tanggal')->required(),
            Forms\Components\TextInput::make('usia_kehamilan')->numeric()->required(),
            Forms\Components\TextInput::make('lila')->numeric()->label('LILA (cm)'),
            Forms\Components\TextInput::make('berat_badan')->numeric()->label('BB (kg)'),
            Forms\Components\TextInput::make('hb')->numeric()->label('HB (g/dL)'),
            Forms\Components\TextInput::make('tinggi_badan')
                ->numeric()
                ->label('Tinggi Badan (cm)'),

            Forms\Components\TextInput::make('tekanan_darah_sistolik')
                ->numeric()
                ->label('Tekanan Darah Sistolik (mmHg)')
                ->required(),
            Forms\Components\TextInput::make('tekanan_darah_diastolik')
                ->numeric()
                ->label('Tekanan Darah Diastolik (mmHg)')
                ->required(),

            Forms\Components\TextInput::make('nadi')
                ->numeric()
                ->label('Nadi (x/menit)'),

            Forms\Components\TextInput::make('respirasi')
                ->numeric()
                ->label('Respirasi (x/menit)'),

            Forms\Components\TextInput::make('paritas')
                ->label('Paritas')
                ->placeholder('G2P1A0'),
            Forms\Components\Toggle::make('konsumsi_mrj')->label('Konsumsi MRJ'),
            Forms\Components\Toggle::make('konsumsi_penambah_darah')->label('Konsumsi Jely'),

        ]);
    }


    public static function table(Table $table): Table
    {
        return
            $table->columns([
                Tables\Columns\TextColumn::make('pengelola.name')
                    ->label('Pengelola')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('ibuHamil.name')
                    ->label('Ibu Hamil')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('tanggal')
                    ->date()
                    ->label('Tanggal'),

                Tables\Columns\TextColumn::make('usia_kehamilan')
                    ->label('Usia (minggu)')
                    ->sortable(),

                Tables\Columns\TextColumn::make('lila')
                    ->label('LILA (cm)'),

                Tables\Columns\TextColumn::make('berat_badan')
                    ->label('BB (kg)'),

                Tables\Columns\TextColumn::make('tinggi_badan')
                    ->label('TB (cm)'),

                Tables\Columns\TextColumn::make('tekanan_darah_sistolik')
                    ->label('TD Sistolik (mmHg)'),
                Tables\Columns\TextColumn::make('tekanan_darah_diastolik')
                    ->label('TD Diastolik (mmHg)'),

                Tables\Columns\TextColumn::make('nadi')
                    ->label('Nadi (/menit)'),

                Tables\Columns\TextColumn::make('respirasi')
                    ->label('Respirasi (/menit)'),

                Tables\Columns\TextColumn::make('paritas')
                    ->label('Paritas'),

                Tables\Columns\TextColumn::make('hb')
                    ->label('HB (g/dL)'),

                Tables\Columns\IconColumn::make('konsumsi_mrj')
                    ->boolean()
                    ->label('MRJ?'),

                Tables\Columns\IconColumn::make('konsumsi_penambah_darah')
                    ->boolean()
                    ->label('Penambah Darah?'),
            ])
            ->filters([
                Tables\Filters\Filter::make('tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('from'),
                        Forms\Components\DatePicker::make('until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn($q) => $q->whereDate('tanggal', '>=', $data['from']))
                            ->when($data['until'], fn($q) => $q->whereDate('tanggal', '<=', $data['until']));
                    }),
            ])
            ->defaultSort('tanggal', 'desc')
            
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
            'index' => Pages\ListMonitorings::route('/'),
            'create' => Pages\CreateMonitoring::route('/create'),
            'edit' => Pages\EditMonitoring::route('/{record}/edit'),
        ];
    }
}
