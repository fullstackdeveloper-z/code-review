<?php

namespace App\Http\Controllers;

use App\Exports\BrandExport;
use App\Exports\CategoryExport;
use App\Exports\ProductSampleWithSheetExport;
use App\Exports\SellerExport;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;
use App\Models\User;
use Auth;
use App\Models\ProductsImport;
use App\Models\ProductsExport;
use PDF;
use Excel;
use Illuminate\Support\Str;
use Throwable;

class ProductBulkUploadController extends Controller
{
    public function index()
    {
        if (Auth::user()->user_type == 'seller') {
            return view('frontend.user.seller.product_bulk_upload.index');
        }
        elseif (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff') {
            return view('backend.product.bulk_upload.index');
        }
    }

    public function export(){
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function pdf_download_category()
    {
        $categories = Category::all();

        return PDF::loadView('backend.downloads.category',[
            'categories' => $categories,
        ], [], [])->download('category.pdf');
    }

    public function excel_download_category()
    {
        return Excel::download(new CategoryExport, 'categories.xlsx');

    }

    public function pdf_download_brand()
    {
        $brands = Brand::all();

        return PDF::loadView('backend.downloads.brand',[
            'brands' => $brands,
        ], [], [])->download('brands.pdf');
    }

    public function excel_download_brand()
    {
        return Excel::download(new BrandExport, 'brands.xlsx');
    }

    public function pdf_download_seller()
    {
        $users = User::where('user_type','seller')->get();

        return PDF::loadView('backend.downloads.user',[
            'users' => $users,
        ], [], [])->download('user.pdf');

    }

    public function excel_download_seller()
    {
        return Excel::download(new SellerExport, 'sellers.xlsx');
    }

    public function excel_download_products()
    {
        return Excel::download(new ProductSampleWithSheetExport, 'products.xlsx');
    }

    public function bulk_upload(Request $request)
    {
        if($request->hasFile('bulk_file')){
            $import = new ProductsImport;
            try {
                Excel::import($import, request()->file('bulk_file'));
            }
            catch(Throwable $e) {
                dd($e);
            }

        }

        return back();
    }

}
