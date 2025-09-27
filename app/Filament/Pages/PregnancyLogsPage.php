<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class PregnancyLogsPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Catatan Ibu Hamil'; 
    protected static ?string $slug = 'pregnancy-logs';
    protected static string $view = 'filament.pages.pregnancy-logs';

    
}
