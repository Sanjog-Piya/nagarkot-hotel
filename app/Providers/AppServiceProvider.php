<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
      Schema::defaultStringLength(191);
      Paginator::useBootstrap();

            view()->composer('frontend.partials.modal', function ($view) {
        $view->with('maxPrice', Product::max('unit_price'));
    });

                       view()->composer('frontend.inc.nav', function ($view) {
        $view->with('brands', Brand::all());
    });


                       view()->composer('frontend.inc.footer', function ($view) {
        $view->with('categories', Category::where('parent_id',0)->get());
    });


  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }
}
