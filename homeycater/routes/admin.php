<?php

use Illuminate\Support\Facades\Route;

Route::group([ 'prefix' => 'control/admin/', 'as' => 'admin.' ], function () {
    Route::get('login', \App\Http\Livewire\Admin\Auth\Login::class)->name('login');
   // Route::view('login', 'layouts.empty-layout');
    Route::get('logout', function ()
    {   auth()->logout();
        Session()->flush();
        return Redirect::to('/control/admin/login');
    })->name('logout');

    Route::group([ 'middleware' => ['auth','admin'] ], function () {
        Route::get('dashboard', \App\Http\Livewire\Admin\Dashboard::class)->name('dashboard');
        Route::get('ads-setting', \App\Http\Livewire\Admin\Setting::class)->name('ads.setting');

        // food category
        Route::group(['prefix' => 'food-category/', 'as' => 'food.category.'], function () {
            Route::get('lists', \App\Http\Livewire\Admin\FoodCategory\FoodCategoryList::class)->name('lists');
            Route::get('add', \App\Http\Livewire\Admin\FoodCategory\FoodCategoryAdd::class)->name('add');
            Route::get('update/{foodCategory}', \App\Http\Livewire\Admin\FoodCategory\FoodCategoryUpdate::class)->name('update');
        });

        // food dishes
        Route::group(['prefix' => 'food-dishes/', 'as' => 'food.dishes.'], function () {
            Route::get('lists', \App\Http\Livewire\Admin\FoodDish\FoodDishLists::class)->name('lists');
            Route::get('add', \App\Http\Livewire\Admin\FoodDish\FoodDishAdd::class)->name('add');
            Route::get('update/{foodDish}', \App\Http\Livewire\Admin\FoodDish\FoodDishUpdate::class)->name('update');
        });

        Route::group([ 'prefix' => 'ads/', 'as' => 'ads.' ], function() {
            Route::get('lists', \App\Http\Livewire\Admin\Ad\AdList::class)->name('lists');
            Route::get('add', \App\Http\Livewire\Admin\Ad\AdCreate::class)->name('add');
            Route::get('update/{ad}', \App\Http\Livewire\Admin\Ad\AdUpdate::class)->name('update');
            Route::get('view/{id}', \App\Http\Livewire\Admin\Ad\AdView::class)->name('view');
        });

        Route::group([ 'prefix' => 'caters/', 'as' => 'caters.' ], function() {
            Route::get('lists', \App\Http\Livewire\Admin\Cater\CaterList::class)->name('lists');
            Route::get('add', \App\Http\Livewire\Admin\Cater\CaterAdd::class)->name('add');
            Route::get('view/{id}', \App\Http\Livewire\Admin\Cater\CaterView::class)->name('view');
            Route::get('update/{id}', \App\Http\Livewire\Admin\Cater\CaterUpdate::class)->name('update');
        });

        Route::group([ 'prefix' => 'contact/', 'as' => 'contact.' ], function() {
            Route::get('lists', App\Http\Livewire\Admin\Contact\ContactList::class)->name('lists');
            Route::get('view/{id}', \App\Http\Livewire\Admin\Contact\ContactView::class)->name('view');
        });
    });
});
