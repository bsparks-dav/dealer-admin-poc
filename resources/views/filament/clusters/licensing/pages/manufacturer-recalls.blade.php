<x-filament-panels::page>
    <div class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6 rounded-lg shadow-md">
            @foreach ($this->recalls as $recall)
            <!-- Row 2, Column 1 -->
            <div style="border: thin solid #007bff;" class="p-4 rounded-lg shadow dark:bg-gray-800 bg-gray-200">

                <div class="truncate text-gray-600 dark:text-gray-400 " title="{{$recall['name']}}">
                    {{ $recall['name'] }}
                </div>

                <div class="pt-4 w-1/2 mx-auto flex justify-center">
                    <x-filament::button
                        style="background-color: #007bff; opacity: .6;"
                        class="w-72"
                        href="{{ $recall['link'] }}"
                        tag="a"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        DOWNLOAD
                    </x-filament::button>
                </div>
            </div>
            @endforeach
        </div>
        <br><br>
    </div>
</x-filament-panels::page>
