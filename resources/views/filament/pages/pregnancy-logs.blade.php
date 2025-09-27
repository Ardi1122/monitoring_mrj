<x-filament::page>
    <x-filament::grid>
        <x-filament::card>
            @livewire(\App\Filament\Widgets\StatsOverview::class)
        </x-filament::card>

        <x-filament::card>
            @livewire(\App\Filament\Widgets\RecentPregnancyLogs::class)
        </x-filament::card>
    </x-filament::grid>
</x-filament::page>
