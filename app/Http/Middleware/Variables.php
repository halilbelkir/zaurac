<?php

namespace App\Http\Middleware;

use App\Models\Pages;
use Closure;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Products;
use Illuminate\Support\Facades\View;

class Variables
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $settings  = Settings::find(1);
        $trainings = Pages::find(1);
        $online    = Pages::find(2);

        View::share([
            'settings'  => $settings,
            'trainings' => $trainings,
            'online'    => $online,
        ]);
        return $next($request);
    }
}
