<x-filament::page>
    <div class="bg-gray-200 p-6 rounded-lg shadow-md dark:bg-gray-800">
        <div class="gap-4 p-6 rounded-lg shadow-md">
            <table class="w-full border-separate border border-gray-400 bg-white text-sm dark:border-gray-500 dark:bg-gray-800">
                <caption style="color: #008b8b;" class="caption-top text-2xl pb-4">
                    My Invoices
                </caption>
                <thead class="bg-gray-50 dark:bg-gray-700">
                <tr style="border: thin solid #008b8b;">
                    <th class="border border-gray-300 p-4 text-left font-semibold text-gray-900 dark:border-gray-600 dark:text-gray-200">Invoice #</th>
                    <th class="border border-gray-300 p-4 text-left font-semibold text-gray-900 dark:border-gray-600 dark:text-gray-200">Name</th>
                    <th class="border border-gray-300 p-4 text-left font-semibold text-gray-900 dark:border-gray-600 dark:text-gray-200">Address</th>
                    <th class="border border-gray-300 p-4 text-left font-semibold text-gray-900 dark:border-gray-600 dark:text-gray-200">State</th>
                    <th class="border border-gray-300 p-4 text-left font-semibold text-gray-900 dark:border-gray-600 dark:text-gray-200">Zip</th>
                    <th class="border border-gray-300 p-4 text-left font-semibold text-gray-900 dark:border-gray-600 dark:text-gray-200">Entered</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($soap_invoices->items() as $invoice)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 even:bg-gray-100 odd:bg-white">
                        <td class="border border-gray-300 p-4 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ $invoice['inv_no'] }}</td>
                        <td class="border border-gray-300 p-4 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ $invoice['inv_bill_to_name'] ?? '' }}</td>
                        <td class="border border-gray-300 p-4 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ $invoice['inv_bill_to_addr_1'] ?? '' }}</td>
                        <td class="border border-gray-300 p-4 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ $invoice['inv_bill_to_st'] }}</td>
                        <td class="border border-gray-300 p-4 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ $invoice['inv_bill_to_zipcd'] }}</td>
                        <td class="border border-gray-300 p-4 text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ date('F j, Y', strtotime($invoice['inv_date_entered'])) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {!! $soap_invoices->links('pagination::tailwind') !!}
            </div>


        </div>
    </div>
    <br><br>
</x-filament::page>
