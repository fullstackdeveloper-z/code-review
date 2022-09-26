<?php

namespace App\Exports;

use Illuminate\Support\Facades\Log as FacadesLog;
use Log;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\BeforeWriting;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;


class ProductSampleWithSheetExport implements FromArray, WithMultipleSheets, WithEvents
{
    use Exportable, RegistersEventListeners;

    public function array(): array
    {
        return [];
    }

    public function sheets(): array
    {
        Log::info("sheetss s a writing ----- ");
        $sheets = [
            new ProductSampleExport(),
            new CategoryExport(),
            new BrandExport(),
            new SellerExport(),
            new ShippingTypeExport(),
            new TaxTypeExport(),

        ];
        return $sheets;
    }


    public function registerEvents(): array
    {

        //$event = $this->getEvent();
        FacadesLog::info("vishal");
        return [
            BeforeExport::class => function (BeforeExport $event) {
                Log::info("BeforeExport ----- " . json_encode($event));
            },
            BeforeWriting::class => function (BeforeWriting $event) {
                Log::info("BeforeWriting ----- " . json_encode($event));
            },
            BeforeSheet::class => function (BeforeSheet $event) {
                Log::info("BeforeSheet ----- " . json_encode($event));
            },
            AfterSheet::class => function (AfterSheet $event) {

                /** @var Sheet $sheet */
                $sheet = $event->sheet;
                Log::info("AfterSheet ----- " . json_encode($sheet));

                /**
                 * validation for bulkuploadsheet
                 */

                $sheet->setCellValue('B', "SELECT ITEM");
                $configs = "DUS800, DUG900+3xRRUS, DUW2100, 2xMU, SIU, DUS800+3xRRUS, DUG900+3xRRUS, DUW2100";
                $objValidation = $sheet->getCell('B5')->getDataValidation();
                $objValidation->setType(DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setErrorTitle('Input error');
                $objValidation->setError('Value is not in list.');
                $objValidation->setPromptTitle('Pick from list');
                $objValidation->setPrompt('Please pick a value from the drop-down list.');
                $objValidation->setFormula1('"' . $configs . '"');
            }
        ];
    }

    // public static function beforeExport(BeforeExport $event)
    // {
    //     Log::info("before writing ----- ".json_encode($event));
    // }

    // public static function beforeWriting(BeforeWriting $event)
    // {
    //     Log::info("after writing ----- ".json_encode($event));
    // }

    // public static function beforeSheet(BeforeSheet $event)
    // {
    //     Log::info("before sheet ----- ".json_encode($event));
    // }

    public static function afterSheet(AfterSheet $event)
    {
        Log::info("after sheet ----- " . json_encode($event));
    }
}
