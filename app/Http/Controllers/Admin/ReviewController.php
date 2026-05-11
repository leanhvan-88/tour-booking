<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::query()->with(['tour', 'user'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->query('status'));
        }

        $reviews = $query->paginate(10)->withQueryString();

        return view('admin.reviews.index', compact('reviews'));
    }

    public function show(Review $review)
    {
        $review->load(['tour', 'user']);

        return view('admin.reviews.show', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])],
        ]);

        $review->update($data);

        return back()->with('success', 'Cập nhật trạng thái đánh giá thành công');
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return back()->with('success', 'Xóa đánh giá thành công');
    }
}
