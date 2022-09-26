<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class Product extends Model {

    protected $fillable = [
        'name', 'added_by', 'user_id', 'category_id', 'brand_id',  'thumbnail_img', 'photos', 'video_provider', 'video_link', 'tags',  'description',
         'unit_price', 'purchase_price', 'colors', 'choice_options', 'variations', 'published', 'approved',  'stock_visibility_state','cash_on_delivery',
        'featured', 'seller_featured', 'current_stock', 'unit', 'min_qty', 'low_stock_quantity', 'discount', 'discount_start_date', 'discount_end_date',
        'colors', 'shipping_type', 'shipping_cost', 'is_quantity_multiplied', 'est_shipping_days', 'meta_title', 'meta_description', 'pdf', 'slug',
        'refundable', 'digital' , 'auction_product', 'external_link', 'external_link_btn', 'wholesale_product'
    ];

    protected $with = ['product_translations', 'taxes'];

    public function getTranslation($field = '', $lang = false) {
        $lang = $lang == false ? App::getLocale() : $lang;
        $product_translations = $this->product_translations->where('lang', $lang)->first();
        return $product_translations != null ? $product_translations->$field : $this->$field;
    }

    public function product_translations() {
        return $this->hasMany(ProductTranslation::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orderDetails() {
        return $this->hasMany(OrderDetail::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class)->where('status', 1);
    }

    public function wishlists() {
        return $this->hasMany(Wishlist::class);
    }

    public function stocks() {
        return $this->hasMany(ProductStock::class);
    }

    public function taxes() {
        return $this->hasMany(ProductTax::class);
    }

    public function flash_deal_product() {
        return $this->hasOne(FlashDealProduct::class);
    }

    public function bids() {
        return $this->hasMany(AuctionProductBid::class);
    }

}
