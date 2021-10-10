<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Services;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));
        view()->composer('*',function($view)
        {
            $settings    = Settings::find(1);
            $title       = $settings->title;
            $keywords    = $settings->tag;
            $description = $settings->description;
            $ogImage     = asset('front/images/zaurac.jpg');

            if (request()->is('hakkımızda'))
            {
                $title = 'Hakkımızda | '.$title;
            }

            if (request()->is('hizmetlerimiz'))
            {
                $title = 'Hizmetlerimiz | '.$title;
            }
            elseif (request()->is('hizmetlerimiz*'))
            {
                $service     = Services::where('seflink',request()->segment(2))->first();
                $title       = $service->title.' | '.$title;
                $keywords    = $service->tag.','.$keywords;
                $description = $service->description;
                $ogImage     = asset(json_decode($service->images,true)[0]['image']);
            }

            if (request()->is('referanslarimiz'))
            {
                $title = 'Referanslarımız | '.$title;
            }

            if (request()->is('zauracblog'))
            {
                $title = 'ZauracBlog | '.$title;
            }
            elseif (request()->is('zauracblog*'))
            {
                $blog        = Blog::where('seflink',request()->segment(2))->first();
                $title       = $blog->title.' | '.$title;
                $keywords    = $blog->tag.','.$keywords;
                $description = $blog->description;
                $ogImage     = asset(json_decode($blog->images,true)[0]['image']);
            }

            if (request()->is('iletisim'))
            {
                $title = 'İletisim | '.$title;
            }

            $view->with('metaTitle', $title);
            $view->with('keywords', $keywords);
            $view->with('description', $description);
            $view->with('ogImage', $ogImage);
        });
    }
}
