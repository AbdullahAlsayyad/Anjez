<?php

use App\Models\PortfolioItem;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - Anjez Platform
|--------------------------------------------------------------------------
*/

Route::get('/services', function () {
    return response()->json([
        'success' => true,
        'data'    => Service::active()->ordered()->with('portfolioItems')->get(),
    ]);
});

Route::get('/portfolio', function (Request $request) {
    $query = PortfolioItem::with('service')->whereHas('service', function ($q) {
        $q->where('is_active', true);
    });

    if ($request->filled('service_id')) {
        $query->where('service_id', $request->service_id);
    }

    if ($request->boolean('featured')) {
        $query->featured();
    }

    return response()->json([
        'success' => true,
        'data'    => $query->ordered()->get(),
    ]);
});

Route::get('/settings', function () {
    return response()->json([
        'success' => true,
        'data'    => [
            'whatsapp_number'  => Setting::get('whatsapp_number'),
            'hero_headline'    => Setting::get('hero_headline'),
            'hero_subheadline' => Setting::get('hero_subheadline'),
            'about_text'       => Setting::get('about_text'),
        ],
    ]);
});
