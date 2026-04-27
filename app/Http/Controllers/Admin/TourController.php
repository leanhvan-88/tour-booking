<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    /**
     * Danh sách tour
     */
    public function index()
    {
        $tours = Tour::latest()->paginate(10);

        return view('admin.tours.index', compact('tours'));
    }

    /**
     * Tạo tour
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'departure' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|url',
            'description' => 'nullable|string',

            // ✅ TEXT chứ không phải array nữa
            'itinerary' => 'nullable|string',
        ]);

        Tour::create($data);

        return redirect()
            ->route('admin.tours.index')
            ->with('success', 'Thêm tour thành công');
    }

    /**
     * Cập nhật tour
     */
    public function update(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'departure' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|url',
            'description' => 'nullable|string',

            // ✅ TEXT
            'itinerary' => 'nullable|string',
        ]);

        $tour->update($data);

        return redirect()
            ->route('admin.tours.index')
            ->with('success', 'Cập nhật thành công');
    }

    /**
     * Xóa tour
     */
    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);
        $tour->delete();

        return redirect()
            ->route('admin.tours.index')
            ->with('success', 'Xóa thành công');
    }
}