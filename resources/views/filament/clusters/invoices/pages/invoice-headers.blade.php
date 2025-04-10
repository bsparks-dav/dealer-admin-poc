<x-filament-panels::page>
    <x-filament::section>
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">
                Invoice History
            </h2>
            <x-filament::button wire:click="refreshData">
                Refresh Data
            </x-filament::button>
        </div>

        {{ $this->table }}
    </x-filament::section>
</x-filament-panels::page>
