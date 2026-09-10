<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioItem;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_services'    => Service::count(),
            'active_services'   => Service::active()->count(),
            'total_samples'     => PortfolioItem::count(),
            'featured_samples'  => PortfolioItem::featured()->count(),
            'whatsapp_number'   => Setting::get('whatsapp_number', '+967770000000'),
        ];

        $recentServices = Service::withCount('portfolioItems')->orderBy('order', 'asc')->take(6)->get();
        $recentSamples = PortfolioItem::with('service')->latest()->take(6)->get();

        return view('admin.dashboard', compact('stats', 'recentServices', 'recentSamples'));
    }
}
