<?php

namespace App\Exports;

use App\Models\Category;
use Auth;
use Log;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\BeforeWriting;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ProductSampleExport implements FromArray, WithHeadings, WithTitle, ShouldAutoSize, WithColumnFormatting, WithEvents
{
    // protected $rows;

    // public function __construct(array $rows)
    // {
    //     $this->rows = $rows;
    // }

    // public function map($row): array
    // {
    //     return [
    //         $row['name'],
    //         $row['impressions'],
    //         $row['clicks'],
    //         $row['ctr']
    //     ];
    // }

    public function headings(): array
    {
        return [
            'Category Picker',
            'Brand Picker',
            'User Picker',
            'name',
            'user_id',
            'category_id',
            'brand_id',
            'thumbnail_img',
            'photos',
            'video_provider',
            'video_link',
            'tags',
            'description',
            'unit_price',
            'purchase_price',
            'variant_products',
            'attributes',
            'choice_options',
            'colors',
            'variations',
            'published',
            'approved',
            'stock_visibility_state',
            'cash_on_delivery',
            'featured',
            'seller_featured',
            'current_stock',
            'unit',
            'min_qty',
            'low_stock_qty',
            'discount',
            'discount_start_date',
            'discount_end_date',
            'tax',
            'tax_type',
            'shipping_type',
            'shipping_cost',
            'is_quality_multipled',
            'est_shipping_days',
            'num_of_sales',
            'meta_title',
            'meta_description',
            'meta_img',
            'pdf',
            'slug',
            'refundable',
            'rating',
            'barcode',
            'digital',
            'auction_product',
            'file_name',
            'file_path',
            'external_link',
            'external_link_btn',
            'wholesale_product',
        ];
    }

    public function array(): array
    {

        if (Auth::user()->user_type == 'seller') {
            return [
                ['Arts & Crafts',
                'Aust Pharmacy',
                Auth::user()->name,
                'AAAA',
                Auth::user()->id,
                'category_id',
                'brand_id',
                'https://on-desktop.com/wps/2017Food___Cakes_and_Sweet_Pie_with_fresh_raspberries_and_blueberries_113555_.jpg',
                'https://img3.goodfon.ru/original/1280x720/e/3c/iron-man-tony-stark-suit.jpg, https://www.drunktiki.com/wp-content/uploads/sites/40/2019/08/iron-man-with-rockets.jpg',
                'youtube',
                '',
                'tag1,tag2',
                'description',
                '55',
                '59',
                '',
                '',
                '',
                '',
                '',
                'TRUE',
                'FALSE',
                'FALSE',
                'FALSE',
                'FALSE',
                'FALSE',
                '10',
                'pc',
                '1',
                '',
                '',
                '',
                '',
                '10',
                'amount',
                'free',
                '0',
                'FALSE',
                '',
                '',
                '',
                '',
                '',
                '',
                'demo-product-22',
                'TRUE',
                '',
                '',
                'FALSE',
                'FALSE',
                '',
                '',
                '',
                '',
                'FALSE',]
            ];
        } else {


        return [
            ['Arts & Crafts',
            'Aust Pharmacy',
            'Inspired Mobility',
            'AAAA',
            'user_id',
            'category_id',
            'brand_id',
            'https://on-desktop.com/wps/2017Food___Cakes_and_Sweet_Pie_with_fresh_raspberries_and_blueberries_113555_.jpg',
            'https://img3.goodfon.ru/original/1280x720/e/3c/iron-man-tony-stark-suit.jpg, https://www.drunktiki.com/wp-content/uploads/sites/40/2019/08/iron-man-with-rockets.jpg',
            'youtube',
            '',
            'tag1,tag2',
            'description',
            '55',
            '59',
            '',
            '',
            '',
            '',
            '',
            'TRUE',
            'FALSE',
            'FALSE',
            'FALSE',
            'FALSE',
            'FALSE',
            '10',
            'pc',
            '1',
            '',
            '',
            '',
            '',
            '10',
            'amount',
            'free',
            '0',
            'FALSE',
            '',
            '',
            '',
            '',
            '',
            '',
            'demo-product-22',
            'TRUE',
            '',
            '',
            'FALSE',
            'FALSE',
            '',
            '',
            '',
            '',
            'FALSE',]
        ];

        }
    }

    public function title(): string
    {
        return 'Products';
    }

    public function columnFormats(): array
    {
        return [
            'B' => '#,##0',
            'C' => '#,##0',
            'D' => NumberFormat::FORMAT_PERCENTAGE_00
        ];
    }


    public function registerEvents(): array
    {

        //$event = $this->getEvent();
        Log::info("vishal");
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

                // name color
                $event->sheet->styleCells('D1', [
                    'font' => [
                        'bold'      =>  true,
                    ],
                ]);
                // user_id color
                $event->sheet->styleCells('E1', [
                    'font' => [
                        'bold'      =>  true,
                        'color' => ['rgb' => '70AD47'],
                    ],
                ]);

                $event->sheet->styleCells('F1:H1', [
                    'font' => [
                        'bold'      =>  true,
                    ],
                ]);

                // user_id color
                $event->sheet->styleCells('I1', [
                    'font' => [
                        'bold'      =>  true,
                        'color' => ['rgb' => '70AD47'],
                    ],
                ]);

                $event->sheet->styleCells('J1:K1', [
                    'font' => [
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->styleCells('L1', [
                    'font' => [
                        'bold'      =>  true,
                        'color' => ['rgb' => 'FF0000'],
                    ],
                ]);

                $event->sheet->styleCells('M1:O1', [
                    'font' => [
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->styleCells('P1:T1', [
                    'font' => [
                        'bold'      =>  true,
                        'color' => ['rgb' => '0070C0'],
                    ],
                ]);

                $event->sheet->styleCells('U1:Z1', [
                    'font' => [
                        'bold'      =>  true,
                        'color' => ['rgb' => '00B050'],
                    ],
                ]);

                $event->sheet->styleCells('AA1:AB1', [
                    'font' => [
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->styleCells('AC1:AD1', [
                    'font' => [
                        'bold'      =>  true,
                        'color' => ['rgb' => '70AD47'],
                    ],
                ]);

                $event->sheet->styleCells('AE1:AG1', [
                    'font' => [
                        'bold'      =>  true,
                        'color' => ['rgb' => 'FFC000'],
                    ],
                ]);

                $event->sheet->styleCells('AH1:AM1', [
                    'font' => [
                        'bold'      =>  true,
                        'color' => ['rgb' => '00B050'],
                    ],
                ]);

                $event->sheet->styleCells('AN1', [
                    'font' => [
                        'bold'      =>  true,
                        'color' => ['rgb' => 'FF0000'],
                    ],
                ]);

                $event->sheet->styleCells('AO1:AP1', [
                    'font' => [
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->styleCells('AQ1', [
                    'font' => [
                        'bold'      =>  true,
                        'color' => ['rgb' => 'FF0000'],
                    ],
                ]);

                $event->sheet->styleCells('AR1', [
                    'font' => [
                        'bold'      =>  true,
                        'color' => ['rgb' => '0070C0'],
                    ],
                ]);

                $event->sheet->styleCells('AS1', [
                    'font' => [
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->styleCells('AT1', [
                    'font' => [
                        'bold'      =>  true,
                        'color' => ['rgb' => '00B050'],
                    ],
                ]);

                $event->sheet->styleCells('AU1:AV1', [
                    'font' => [
                        'bold'      =>  true,
                        'color' => ['rgb' => 'FF0000'],
                    ],
                ]);

                $event->sheet->styleCells('AW1:AX1', [
                    'font' => [
                        'bold'      =>  true,
                        'color' => ['rgb' => '00B050'],
                    ],
                ]);

                $event->sheet->styleCells('AY1:AZ1', [
                    'font' => [
                        'bold'      =>  true,
                        'color' => ['rgb' => 'FF0000'],
                    ],
                ]);

                $event->sheet->styleCells('BA1:BC1', [
                    'font' => [
                        'bold'      =>  true,
                        'color' => ['rgb' => '00B050'],
                    ],
                ]);

                /** @var Sheet $sheet */
                $sheet = $event->sheet;

                // Category Picker
                // set dropdown column
                $category = 'A';
                // set dropdown list for first data row
                $categoryPicker = $sheet->getCell("{$category}2")->getDataValidation();
                $categoryPicker->setType(DataValidation::TYPE_LIST);
                $categoryPicker->setErrorStyle(DataValidation::STYLE_INFORMATION);
                $categoryPicker->setAllowBlank(false);
                $categoryPicker->setShowInputMessage(true);
                $categoryPicker->setShowErrorMessage(true);
                $categoryPicker->setShowDropDown(true);
                $categoryPicker->setErrorTitle('Input error');
                $categoryPicker->setError('Value is not in list.');
                $categoryPicker->setPromptTitle('Pick from list');
                $categoryPicker->setPrompt('Please pick a value from the drop-down list.');

                $options = "Categories!\$A:\$A";
                $categoryPicker->setFormula1($options);
                $sheet->setCellValue('F2', "=VLOOKUP({$category}2,Categories!A:B,2,0)");


                // Brand Picker

                $brands = 'B';
                // set dropdown list for first data row
                $brandsPicker = $sheet->getCell("{$brands}2")->getDataValidation();
                $brandsPicker->setType(DataValidation::TYPE_LIST);
                $brandsPicker->setErrorStyle(DataValidation::STYLE_INFORMATION);
                $brandsPicker->setAllowBlank(false);
                $brandsPicker->setShowInputMessage(true);
                $brandsPicker->setShowErrorMessage(true);
                $brandsPicker->setShowDropDown(true);
                $brandsPicker->setErrorTitle('Input error');
                $brandsPicker->setError('Value is not in list.');
                $brandsPicker->setPromptTitle('Pick from list');
                $brandsPicker->setPrompt('Please pick a value from the drop-down list.');

                $options = "Brands!\$A:\$A";
                $brandsPicker->setFormula1($options);
                $sheet->setCellValue('G2', "=VLOOKUP({$brands}2,Brands!A:B,2,0)");


                // Seller Picker

                $sellers = 'C';
                // set dropdown list for first data row
                $sellersPicker = $sheet->getCell("{$sellers}2")->getDataValidation();
                $sellersPicker->setType(DataValidation::TYPE_LIST);
                $sellersPicker->setErrorStyle(DataValidation::STYLE_INFORMATION);
                $sellersPicker->setAllowBlank(false);
                $sellersPicker->setShowInputMessage(true);
                $sellersPicker->setShowErrorMessage(true);
                $sellersPicker->setShowDropDown(true);
                $sellersPicker->setErrorTitle('Input error');
                $sellersPicker->setError('Value is not in list.');
                $sellersPicker->setPromptTitle('Pick from list');
                $sellersPicker->setPrompt('Please pick a value from the drop-down list.');

                $options = "Sellers!\$A:\$A";
                $sellersPicker->setFormula1($options);
                $sheet->setCellValue('E2', "=VLOOKUP({$sellers}2,Sellers!A:B,2,0)");

                // shipping type

                $shippingType = 'AJ';
                // set dropdown list for first data row
                $shippingTypePicker = $sheet->getCell("{$shippingType}2")->getDataValidation();
                $shippingTypePicker->setType(DataValidation::TYPE_LIST);
                $shippingTypePicker->setErrorStyle(DataValidation::STYLE_INFORMATION);
                $shippingTypePicker->setAllowBlank(false);
                $shippingTypePicker->setShowInputMessage(true);
                $shippingTypePicker->setShowErrorMessage(true);
                $shippingTypePicker->setShowDropDown(true);
                $shippingTypePicker->setErrorTitle('Input error');
                $shippingTypePicker->setError('Value is not in list.');
                $shippingTypePicker->setPromptTitle('Pick from list');
                $shippingTypePicker->setPrompt('Please pick a value from the drop-down list.');

                $options = "ShippingType!\$A:\$A";
                $shippingTypePicker->setFormula1($options);

                // shipping type

                $taxType = 'AI';
                // set dropdown list for first data row
                $taxTypePicker = $sheet->getCell("{$taxType}2")->getDataValidation();
                $taxTypePicker->setType(DataValidation::TYPE_LIST);
                $taxTypePicker->setErrorStyle(DataValidation::STYLE_INFORMATION);
                $taxTypePicker->setAllowBlank(false);
                $taxTypePicker->setShowInputMessage(true);
                $taxTypePicker->setShowErrorMessage(true);
                $taxTypePicker->setShowDropDown(true);
                $taxTypePicker->setErrorTitle('Input error');
                $taxTypePicker->setError('Value is not in list.');
                $taxTypePicker->setPromptTitle('Pick from list');
                $taxTypePicker->setPrompt('Please pick a value from the drop-down list.');

                $options = "TaxType!\$A:\$A";
                $taxTypePicker->setFormula1($options);


                for ($i = 3; $i <= 4; $i++) {
                    $sheet->getCell("{$category}{$i}")->setDataValidation(clone $categoryPicker);
                    $sheet->setCellValue("F{$i}", "=IF({$category}{$i} <> \"\", VLOOKUP({$category}{$i},Categories!A:B,2,0), 0) ");

                    $sheet->getCell("{$brands}{$i}")->setDataValidation(clone $brandsPicker);
                    $sheet->setCellValue("G{$i}", "=IF({$brands}{$i} <> \"\", VLOOKUP({$brands}{$i},Brands!A:B,2,0), 0) ");

                    $sheet->getCell("{$sellers}{$i}")->setDataValidation(clone $sellersPicker);
                    $sheet->setCellValue("E{$i}", "=IF({$sellers}{$i} <> \"\", VLOOKUP({$sellers}{$i},Sellers!A:B,2,0), 0) ");

                    $sheet->getCell("{$shippingType}{$i}")->setDataValidation(clone $shippingTypePicker);
                    $sheet->getCell("{$taxType}{$i}")->setDataValidation(clone $taxTypePicker);
                }
            }
        ];
    }
}
