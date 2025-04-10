<?php

namespace App\Livewire;

use App\Models\SoapInvoice;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class SoapInvoiceTable extends Component
{
    use WithPagination;

    // Properties for search, sorting, and filtering
    public $search = '';

    public $sortField = 'inv_date_entered';

    public $sortDirection = 'desc';

    public $page = 1;

    public $perPage = 10;

    // Raw SOAP data
    protected $invoiceData = [];

    public function mount(): void
    {
        $this->refreshData();
    }

    #[On('refresh-invoices')]
    public function refreshData(): void
    {
        $this->invoiceData = SoapInvoice::getSoapInvoices();
        // temporary hack to give me some paginatable data...
        $tempArray = $this->invoiceData;
        $tempArray2 = $this->invoiceData;
        $tempArray3 = $this->invoiceData;
        $tempAll = array_merge($tempArray, $tempArray2, $tempArray3);
        $this->invoiceData = $tempAll;

        $this->resetPage();
    }

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            // If already sorting by this field, toggle direction
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // New sort field, default to ascending
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function getLoadingStateProperty(): array
    {
        return [
            'search' => 'updatedSearch',
            'sortBy' => 'sortBy',
            'refreshData' => 'refreshData',
            'nextPage' => 'nextPage',
            'previousPage' => 'previousPage',
        ];
    }

    public function getProcessedDataProperty()
    {
        $collection = collect($this->invoiceData);

        // Apply search if not empty
        if (! empty($this->search)) {
            $collection = $collection->filter(function ($item) {
                // Search across multiple fields
                return str_contains(strtolower($item['inv_no'] ?? ''), strtolower($this->search)) ||
                    str_contains(strtolower($item['cust_po'] ?? ''), strtolower($this->search));
            });
        }

        // Apply sorting
        if ($this->sortField) {
            $collection = $collection->sortBy($this->sortField, SORT_REGULAR, $this->sortDirection === 'desc');
        }

        return $collection;
    }

    public function getPaginatedDataProperty()
    {
        $data = $this->processedData;
        $page = $this->page;

        // Manual pagination
        return $data->forPage($page, $this->perPage);
    }

    public function viewInvoice($invoiceNumber)
    {
        // Redirect to invoice detail page
        return redirect()->route('filament.admin.resources.invoices.view', ['record' => $invoiceNumber]);
    }

    public function render()
    {
        return view('livewire.soap-invoice-table', [
            'invoices' => $this->paginatedData,
            'totalResults' => $this->processedData->count(),
        ]);
    }

    public function nextPage(): void
    {
        $this->page++;
    }

    public function previousPage(): void
    {
        if ($this->page > 1) {
            $this->page--;
        }
    }

}
