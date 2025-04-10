<div class="flex flex-wrap items-end space-x-4">
    {{-- From Date --}}
    <div>
        <x-filament::input.label>
            From
        </x-filament::input.label>

        <div class="mt-1">
            <x-filament::input.date
                wire:model.defer="tableFilters.date_range.from"
                placeholder="{{ \Carbon\Carbon::now()->subDays(60)->format('M d, Y') }}"
                format="Y-m-d"
                display-format="M d, Y"
            />
        </div>
    </div>

    {{-- To Date --}}
    <div>
        <x-filament::input.label>
            To
        </x-filament::input.label>

        <div class="mt-1">
            <x-filament::input.date
                wire:model.defer="tableFilters.date_range.to"
                placeholder="{{ \Carbon\Carbon::now()->format('M d, Y') }}"
                format="Y-m-d"
                display-format="M d, Y"
            />
        </div>
    </div>

    {{-- Submit Button --}}
    <div>
        <x-filament::button
            wire:click="$refresh"
            type="button"
        >
            Submit
        </x-filament::button>
    </div>
</div>
