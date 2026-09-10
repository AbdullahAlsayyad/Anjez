<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioItem;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioItemController extends Controller
{
    public function index(Request $request)
    {
        $query = PortfolioItem::with('service');

        if ($request->filled('service_id')) {
            $query->where('service_id', $request->service_id);
        }

        $items = $query->orderBy('order', 'asc')->paginate(12);
        $services = Service::orderBy('order', 'asc')->get();

        return view('admin.portfolio.index', compact('items', 'services'));
    }

    public function create()
    {
        $services = Service::orderBy('order', 'asc')->get();
        return view('admin.portfolio.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id'  => 'required|exists:services,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_featured' => 'nullable|boolean',
            'order'       => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('samples', 'public');
            $validated['image_path'] = 'storage/' . $path;
        }

        $validated['is_featured'] = $request->has('is_featured');
        unset($validated['image']);

        PortfolioItem::create($validated);

        return redirect()->route('admin.portfolio.index')->with('success', 'تم إضافة نموذج العمل بنجاح.');
    }

    public function edit(PortfolioItem $portfolio)
    {
        $services = Service::orderBy('order', 'asc')->get();
        return view('admin.portfolio.edit', compact('portfolio', 'services'));
    }

    public function update(Request $request, PortfolioItem $portfolio)
    {
        $validated = $request->validate([
            'service_id'  => 'required|exists:services,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_featured' => 'nullable|boolean',
            'order'       => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('samples', 'public');
            $validated['image_path'] = 'storage/' . $path;
        }

        $validated['is_featured'] = $request->has('is_featured');
        unset($validated['image']);

        $portfolio->update($validated);

        return redirect()->route('admin.portfolio.index')->with('success', 'تم تحديث بيانات النموذج بنجاح.');
    }

    public function destroy(PortfolioItem $portfolio)
    {
        $portfolio->delete();
        return redirect()->route('admin.portfolio.index')->with('success', 'تم حذف النموذج بنجاح.');
    }

    public function toggleFeatured(PortfolioItem $portfolio)
    {
        $portfolio->is_featured = !$portfolio->is_featured;
        $portfolio->save();

        return response()->json([
            'success'     => true,
            'is_featured' => $portfolio->is_featured,
            'message'     => $portfolio->is_featured ? 'تم تمييز النموذج' : 'تم إلغاء التمييز'
        ]);
    }
}
