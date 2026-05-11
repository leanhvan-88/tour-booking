<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTourRequest;
use App\Http\Requests\Admin\UpdateTourRequest;
use App\Models\Category;
use App\Models\Tour;

class TourController extends Controller
{
    /**
     * Danh sách tour
     */
    public function index()
    {
        $tours = Tour::with('categories')->latest()->paginate(10);

        return view('admin.tours.index', compact('tours'));
    }

    public function create()
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('admin.tours.create', compact('categories'));
    }

    public function show(Tour $tour)
    {
        $tour->load('categories');

        return view('admin.tours.show', compact('tour'));
    }

    public function edit(Tour $tour)
    {
        $tour->load('categories');
        $categories = Category::query()->orderBy('name')->get();

        return view('admin.tours.edit', compact('tour', 'categories'));
    }

    /**
     * Tạo tour
     */
    public function store(StoreTourRequest $request)
    {
        $data = $request->validated();

        $tour = Tour::create([
            'name' => $data['name'],
            'duration' => $data['duration'],
            'departure' => $data['departure'],
            'destination' => $data['destination'],
            'price' => $data['price'] ?? null,
            'image' => $data['image'] ?? null,
            'description' => $data['description'] ?? null,
            'itinerary' => $data['itinerary'] ?? null,
        ]);

        $tour->categories()->sync(isset($data['category_id']) ? [$data['category_id']] : []);

        return redirect()
            ->route('admin.tours.index')
            ->with('success', 'Thêm tour thành công');
    }

    /**
     * Cập nhật tour
     */
    public function update(UpdateTourRequest $request, Tour $tour)
    {
        $data = $request->validated();

        $tour->update([
            'name' => $data['name'],
            'duration' => $data['duration'],
            'departure' => $data['departure'],
            'destination' => $data['destination'],
            'price' => $data['price'] ?? null,
            'image' => $data['image'] ?? null,
            'description' => $data['description'] ?? null,
            'itinerary' => $data['itinerary'] ?? null,
        ]);

        $tour->categories()->sync(isset($data['category_id']) ? [$data['category_id']] : []);

        return redirect()
            ->route('admin.tours.index')
            ->with('success', 'Cập nhật thành công');
    }

    /**
     * Xóa tour
     */
    public function destroy(Tour $tour)
    {
        $tour->delete();

        return redirect()
            ->route('admin.tours.index')
            ->with('success', 'Xóa thành công');
    }

    private function parseItinerary(?string $raw): ?array
    {
        if ($raw === null) {
            return null;
        }

        $raw = trim($raw);
        if ($raw === '') {
            return null;
        }

        $lines = preg_split("/\\r\\n|\\r|\\n/", $raw);
        $items = array_values(array_filter(array_map('trim', $lines), fn ($v) => $v !== ''));

        return $items === [] ? null : $items;
    }
}