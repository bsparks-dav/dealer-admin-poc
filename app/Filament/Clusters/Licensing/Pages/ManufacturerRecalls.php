<?php

namespace App\Filament\Clusters\Licensing\Pages;

use App\Filament\Clusters\Licensing;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Infolist;
use Filament\Pages\Page;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Actions\Action;

class ManufacturerRecalls extends Page
{
    use InteractsWithForms;
    use InteractsWithInfolists;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-refund';

    protected static string $view = 'filament.clusters.licensing.pages.manufacturer-recalls';

    protected static ?string $cluster = Licensing::class;

    public ?array $recalls;

    public $info_list;

    public $state;

    public static function infolist(): Infolist
    {
        $infolist = new Infolist;

        return $infolist
            ->schema([
                Section::make()
                    ->icon('heroicon-o-document-text')
                    ->heading('Federal Firearms License Information')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('recall')
                            ->columnSpanFull()
                            ->label('Glock Recall')
                            ->weight(FontWeight::Bold)
                            ->color('gray'),
                        //                        Action::make('download')
                        //                            ->label('Download File')
                        //                            ->url('https://example.com/file.zip')
                        //                            ->button(),
                    ]),
            ]);
    }

    public function getState()
    {
        return $this->state; // Send this to the Blade template
    }

    public function mount(): void
    {
        $url = 'https://www.davidsonsinc.com';

        $this->recalls = [
            [
                'name' => 'Barnes 45 Colt Product Recall Notice',
                'link' => $url.'/media/customer_documents/mfgrecall/Barnes.pdf',
            ],
            [
                'name' => 'Beretta Neos Pistols Safety Recall',
                'link' => $url.'/media/customer_documents/mfgrecall/beretta_neos.pdf',
            ],
            [
                'name' => 'Browning 9MM Luger Product Warning and Recall',
                'link' => $url.'/media/customer_documents/mfgrecall/Browning_9.pdf',
            ],
            [
                'name' => 'Colt MSR Safety Recall Notice',
                'link' => $url.'/media/customer_documents/mfgrecall/FINAL RECALL NOTICE 11.3.21.pdf',
            ],
            [
                'name' => 'CZ 600 Safety Recall',
                'link' => $url.'/media/customer_documents/mfgrecall/cz600-recall.pdf',
            ],
            [
                'name' => 'CZ-USA Safety Recall for CZ All American Single Trap Shotguns',
                'link' => $url.'/media/customer_documents/mfgrecall/cz-recall-8-4-2023.pdf',
            ],
            [
                'name' => 'FN 502 Safety Recall',
                'link' => $url.'/media/customer_documents/mfgrecall/502.pdf',
            ],
            [
                'name' => 'Holosun HE507K-GR X2 Recall Notice',
                'link' => $url.'/media/customer_documents/mfgrecall/HE507K-GR X2 Notice_20210726.pdf',
            ],
            [
                'name' => 'Holosun Product Recall',
                'link' => $url.'/media/customer_documents/mfgrecall/HOLOSUN Product Recall Reseller-Distributor Notice.pdf',
            ],
            [
                'name' => 'IWI Carmel Recall',
                'link' => $url.'/media/customer_documents/mfgrecall/Safety Recall Notice-CARMEL.pdf',
            ],
            [
                'name' => 'Nosler Recall Notice',
                'link' => $url.'/media/customer_documents/mfgrecall/Nosler_Recall.pdf',
            ],
            [
                'name' => 'Recall Notice for Certain Henry Lever Action 45-70 Rifles Manufactured After November 2022',
                'link' => $url.'/media/customer_documents/mfgrecall/henry45-70recall.pdf',
            ],
            [
                'name' => 'Rossi Safety Warning',
                'link' => $url.'/media/customer_documents/mfgrecall/rossi.pdf',
            ],
            [
                'name' => 'Ruger-57 Product Safety Bulletin',
                'link' => $url.'/media/customer_documents/mfgrecall/ruger57.pdf',
            ],
            [
                'name' => 'Smith & Wesson Safety Recall Notice',
                'link' => $url.'/media/customer_documents/mfgrecall/sw1.pdf',
            ],
            [
                'name' => 'SR22 Pistol Product Safety Bulletin',
                'link' => $url.'/media/customer_documents/mfgrecall/SR22_Safety_Bulletin-ed32ea0560f9714.pdf',
            ],
            [
                'name' => 'Taurus GX4 Safety Notice',
                'link' => $url.'/media/customer_documents/mfgrecall/GX4.pdf',
            ],
            [
                'name' => 'Winchester 9MM Luger Product Warning and Recall',
                'link' => $url.'/media/customer_documents/mfgrecall/Winchester_9.pdf',
            ],
            [
                'name' => 'Winchester Super-X 17HMR Product Warning and Recall Notice',
                'link' => $url.'/media/customer_documents/mfgrecall/x17hmr1.pdf',
            ],
        ];

    }
}
