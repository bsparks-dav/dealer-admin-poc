<div style="width: 95%;" class="bg-gray-200 p-6 rounded-lg shadow-md dark:bg-gray-800">
    <div class="gap-4 p-6 rounded-lg shadow-md">
        <!-- Header with search -->
        <div class="filament-tables-header-container p-2 flex text-center justify-between gap-2">
            <!-- Search input -->
            <div class="w-full max-w-md">
                <div class="relative">
                    <div class="absolute inset-x-4 inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <x-heroicon-o-magnifying-glass class="h-5 w-5 text-gray-400 dark:text-gray-500" />
                    </div>
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="        Search invoices..."
                        class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-400 dark:focus:border-primary-500"
                    >
                </div>




{{--                <div class="relative flex rounded-md shadow-sm">--}}
{{--                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-400 bg-gray-50 dark:bg-gray-700  text-gray-500 dark:border-gray-600 dark:text-gray-400">--}}
{{--                        <div wire:loading.delay.class="hidden">--}}
{{--                            <x-heroicon-o-magnifying-glass class="h-5 w-5" />--}}
{{--                        </div>--}}
{{--                        <div wire:loading.delay>--}}
{{--                            <x-heroicon-o-arrow-path class="h-5 w-5 animate-spin" />--}}
{{--                        </div>--}}
{{--                    </span>--}}
{{--                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search invoices..." class="focus:ring-primary-500 focus:border-primary-500 flex-1 block w-full rounded-r-md sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-200 dark:focus:border-primary-500">--}}
{{--                </div>--}}


            </div>
            <!-- Per page selector -->
            <div>
                <select wire:model.live="perPage" class="block w-full pl-3 pr-10 py-2 text-base focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-200 dark:focus:border-primary-500">
                    <option value="10">10 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                    <option value="100">100 per page</option>
                </select>
            </div>
            <!-- Refresh button -->
            <button wire:click="refreshData" class="filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset text-sm px-4 text-white bg-primary-600 border-primary-600 hover:bg-primary-500 hover:border-primary-500 focus:ring-primary-500 dark:bg-primary-500 dark:hover:bg-primary-400 dark:focus:ring-primary-400">
                <x-heroicon-o-arrow-path class="h-5 w-5" />
                Refresh
            </button>
        </div>

        <!-- Table -->
        <div class="filament-tables-table-container overflow-x-auto relative">
            <table class="filament-tables-table text-start divide-y table-auto w-full border-separate border border-gray-400 bg-white text-sm dark:border-gray-500 dark:bg-gray-800">
                <thead class="bg-gray-50 dark:bg-gray-700">
                <tr style="border: thin solid #008b8b;">
                    <!-- Invoice # -->
                    <th class="filament-tables-header-cell w-1 p-4 text-left font-semibold">
                        <button type="button" wire:click="sortBy('inv_no')" class="flex items-center gap-x-1 text-sm font-medium  whitespace-nowrap text-gray-600 dark:text-gray-200">
                            <span>Invoice #</span>
                            @if($sortField === 'inv_no')
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    @if($sortDirection === 'asc')
                                        <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    @else
                                        <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    @endif
                                </svg>
                            @endif
                        </button>
                    </th>

                    <!-- PO Number -->
                    <th class="filament-tables-header-cell p-4 text-left font-semibold">
                        <button type="button" wire:click="sortBy('inv_bill_to_name')" class="flex items-center gap-x-1 text-sm font-medium text-gray-600 dark:text-gray-200 whitespace-nowrap">
                            <span>Customer Name</span>
                            @if($sortField === 'inv_bill_to_name')
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    @if($sortDirection === 'asc')
                                        <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    @else
                                        <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    @endif
                                </svg>
                            @endif
                        </button>
                    </th>

                    <!-- Amount Due -->
                    <th class="filament-tables-header-cell p-2">
                        <button type="button" wire:click="sortBy('inv_bill_to_addr_1')" class="flex items-center gap-x-1 text-sm font-medium text-gray-600 dark:text-gray-200 whitespace-nowrap">
                            <span>Address</span>
                            @if($sortField === 'inv_bill_to_addr_1')
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    @if($sortDirection === 'asc')
                                        <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    @else
                                        <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    @endif
                                </svg>
                            @endif
                        </button>
                    </th>

                    <!-- State -->
                    <th class="filament-tables-header-cell p-2">
                        <button type="button" wire:click="sortBy('inv_bill_to_st')" class="flex items-center gap-x-1 text-sm font-medium text-gray-600 dark:text-gray-200 whitespace-nowrap">
                            <span>State</span>
                            @if($sortField === 'inv_bill_to_st')
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    @if($sortDirection === 'asc')
                                        <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    @else
                                        <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    @endif
                                </svg>
                            @endif
                        </button>
                    </th>

                    <!-- Date -->
                    <th class="filament-tables-header-cell p-2">
                        <button type="button" wire:click="sortBy('inv_date_entered')" class="flex items-center gap-x-1 text-sm font-medium text-gray-600 dark:text-gray-200 whitespace-nowrap">
                            <span>Inv. Date</span>
                            @if($sortField === 'inv_date_entered')
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    @if($sortDirection === 'asc')
                                        <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    @else
                                        <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    @endif
                                </svg>
                            @endif
                        </button>
                    </th>

                    <!-- Actions -->
                    <th class="filament-tables-header-cell p-2">
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-200">Actions</span>
                    </th>
                </tr>
                </thead>

                <tbody class="divide-y">
                @forelse($invoices as $invoice)
                    <tr class="filament-tables-row transition bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 even:bg-gray-100 odd:bg-white">
                        <td class="filament-tables-cell p-2 whitespace-nowrap border border-gray-300 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ $invoice['inv_no'] }}</td>
                        <td class="filament-tables-cell p-2 border border-gray-300 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ $invoice['inv_bill_to_name'] }}</td>
                        <td class="filament-tables-cell p-2 border border-gray-300 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ $invoice['inv_bill_to_addr_1'] }}</td>
                        <td class="filament-tables-cell p-2 border border-gray-300 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ $invoice['inv_bill_to_st'] }}</td>
                        <td class="filament-tables-cell p-2 border border-gray-300 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ \Carbon\Carbon::parse($invoice['inv_date_entered'])->format('M d, Y') }}</td>
                        <td class="filament-tables-cell p-2 border border-gray-300 text-gray-500 dark:border-gray-700 dark:text-gray-400 text-center">
                            <x-filament::button wire:click="viewInvoice('{{ $invoice['inv_no'] }}')" color="gray" size="sm" icon="heroicon-o-eye">
                                View
                            </x-filament::button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="filament-tables-cell p-4 text-center text-gray-500 dark:text-gray-400">
                            No invoices found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="filament-tables-pagination-container p-2 border-t">
            <div class="flex items-center justify-between">
                <!-- Results info -->
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Showing
                    <span class="font-medium">{{ $invoices->count() ? (($page - 1) * $perPage) + 1 : 0 }}</span>
                    to
                    <span class="font-medium">{{ min(($page * $perPage), $totalResults) }}</span>
                    of
                    <span class="font-medium">{{ $totalResults }}</span>
                    results
                </div>

                <!-- Pagination buttons -->
                <div class="flex items-center space-x-2">
                    <button
                        wire:click="previousPage"
                        @if($page <= 1) disabled @endif
                        class="filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset text-xs px-3 border-gray-300 text-gray-500 dark:border-gray-700 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 hover:bg-gray-50 focus:ring-primary-500 disabled:opacity-50 disabled:cursor-not-allowed">
                        Previous
                    </button>

                    <button
                        wire:click="nextPage"
                        @if($page >= ceil($totalResults / $perPage)) disabled @endif
                        class="filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset text-xs px-3 border-gray-300 text-gray-500 dark:border-gray-700 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 hover:bg-gray-50 focus:ring-primary-500 disabled:opacity-50 disabled:cursor-not-allowed">
                        Next
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>
