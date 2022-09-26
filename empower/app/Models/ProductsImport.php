<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductStock;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;
use Auth;
use Log;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Storage;

//class ProductsImport implements ToModel, WithHeadingRow, WithValidation
class ProductsImport implements ToCollection, WithHeadingRow, WithValidation, ToModel, WithCalculatedFormulas, WithMultipleSheets, WithStrictNullComparison
{
    private $rows = 0;
    public function sheets(): array
    {
        return [
            0 => $this,
        ];
    }

    public function collection(Collection $rows) {

        Log::info(json_encode($rows));
        $canImport = true;
        if (addon_is_activated('seller_subscription')){
            if(Auth::user()->user_type == 'seller' && Auth::user()->seller->seller_package && (count($rows) + Auth::user()->seller->user->products()->count()) > Auth::user()->seller->seller_package->product_upload_limit) {
                $canImport = false;
                flash(translate('Upload limit has been reached. Please upgrade your package.'))->warning();
            }
        }

        if($canImport) {
            foreach ($rows as $row) {

                if($row->filter()->isNotEmpty()){
                    Log::info("vis -----------====>".$row['name']);

                    $photos = [];
                    $images = explode(", ", $row['photos']);
                    foreach($images as $img) {
                        $im = $this->downloadThumbnail($img);
                        if(!empty($im)) {
                            array_push($photos, $im);
                        }
                    }

                    $productId = Product::create([
                                'name' => $row['name'],
                                'added_by' => Auth::user()->user_type == 'seller' ? 'seller' : 'admin',
                                'user_id' => $row['user_id'],
                                'category_id' => $row['category_id'],
                                'brand_id' => $row['brand_id'],
                                'thumbnail_img' => $this->downloadThumbnail($row['thumbnail_img']),
                                'photos' => implode(",", $photos),
                                'video_provider' => $row['video_provider'],
                                'video_link' => $row['video_link'],
                                'tags' => $row['tags'],
                                'description' => $row['description'],
                                'unit_price' => $row['unit_price'],
                                'purchase_price' => $row['purchase_price'] == null ? $row['unit_price'] : $row['purchase_price'],
                                /**
                                 * leave for now
                                 */
                                // 'variant_products' => [],
                                // 'attributes' => [],
                                // 'choice_options' => [],
                                // 'colors' => [],
                                // 'variations' => [],
                                'colors' => json_encode(array()),
                                'choice_options' => json_encode(array()),
                                'variations' => json_encode(array()),

                                'published' => $row['published'] == 'TRUE' ? true: false,
                                'approved' => $row['approved'] == 'TRUE' ? true: false,
                                'stock_visibility_state' => $row['stock_visibility_state'] == 'TRUE' ? true: false,
                                'cash_on_delivery' => $row['cash_on_delivery'] == 'TRUE' ? true: false,
                                'featured' => $row['featured'] == 'TRUE' ? true: false,
                                'seller_featured' => $row['seller_featured'] == 'TRUE' ? true: false,

                                'current_stock' => $row['current_stock'],
                                'unit' => $row['unit'],
                                'min_qty' => $row['min_qty'],
                                'low_stock_quantity' => $row['low_stock_qty'],

                                /**
                                 * discount not important for now
                                 */
                                // 'discount' =>null,
                                // 'discount_start_date' =>null,
                                // 'discount_end_date' =>null,
                                // 'colors' =>null,

                                'shipping_type' => $row['shipping_type'],
                                'shipping_cost' => $row['shipping_cost'],
                                'is_quantity_multiplied' => $row['is_quality_multipled'] == 'TRUE' ? true: false,
                                'est_shipping_days' => $row['est_shipping_days'],

                                'meta_title' => $row['meta_title'],
                                'meta_description' => $row['meta_description'],
                                'pdf' => !empty($row['pdf']) ? $this->downloadThumbnail($row['pdf']) : null,
                                'slug' => preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($row['slug']))) . '-' . Str::random(5),

                                'refundable' => $row['refundable'] == 'TRUE' ? true: false,
                                'digital' => $row['digital'] == 'TRUE' ? true: false,
                                'auction_product' => $row['auction_product'] == 'TRUE' ? true: false,
                                'external_link' => $row['external_link'],
                                'external_link_btn' => $row['external_link_btn'],
                                'wholesale_product' => $row['wholesale_product'] == 'TRUE' ? true: false,
                    ]);

                    ProductTax::create([ 'product_id' => $productId->id, 'tax_id' => 3 , 'tax_type' => $row['tax_type'], 'tax' => $row['tax'] ]);

                    ProductStock::create([
                        'product_id' => $productId->id,
                        'qty' => $row['current_stock'],
                        'price' => $row['unit_price'],
                        'variant' => '',
                    ]);
                }
            }

            flash(translate('Products imported successfully'))->success();
        }


    }

    public function model(array $row)
    {
        ++$this->rows;
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }

    public function rules(): array
    {
        return [
             // Can also use callback validation rules
             'unit_price' => function($attribute, $value, $onFailure) {
                  if (!is_numeric($value) && !empty($value)) {
                       $onFailure('Unit price is not numeric');
                  }
              }
        ];
    }

    public function headingRow(): int {
        return 1;
    }

    public function downloadThumbnail($url){
        try {
            $extension = pathinfo($url, PATHINFO_EXTENSION);
            $filename = 'uploads/all/'.Str::random(5).'.'.$extension;
            $fullpath = 'public/'.$filename;
            $file = file_get_contents($url);
            file_put_contents($fullpath, $file);

            $upload = new Upload;
            $upload->extension = strtolower($extension);

            $upload->file_original_name = $filename;
            $upload->file_name = $filename;
            $upload->user_id = Auth::user()->id;
            $upload->type = "image";
            $upload->file_size = filesize(base_path($fullpath));
            $upload->save();

            if(env('FILESYSTEM_DRIVER') == 's3'){
                $s3 = Storage::disk('s3');
                $s3->put($filename, file_get_contents(base_path($fullpath)));
                unlink(base_path($fullpath));
            }

            return $upload->id;
        } catch (\Exception $e) {
            Log::info("vis download thub nail --> ".json_encode($e));
            // dd($e);
        }
        return null;
    }
}
