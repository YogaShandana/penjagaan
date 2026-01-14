<?php

namespace App\Filament\Penjaga\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            // Remove default widgets for cleaner look
        ];
    }
    
    public function getColumns(): int | string | array
    {
        return 2;
    }
    
    protected static ?string $navigationIcon = 'heroicon-o-home';
    
    protected static string $view = 'filament.penjaga.pages.dashboard';
}