<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 15);

        $query = Review::query()->with(['tour', 'user'])->orderByDesc('id');

        if ($request->filled('tour_id')) {
            $query->where('tour_id', $request->query('tour_id'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->query('status'));
        }

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tour_id' => ['required', 'integer', 'exists:tours,id'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'full_name' => ['nullable', 'string', 'max:255'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string'],
            'status' => ['nullable', Rule::in(['pending', 'approved', 'rejected'])],
        ]);

        $review = Review::create($data);

        return response()->json($review->load(['tour', 'user']), 201);
    }

    public function show(Review $review)
    {
        return response()->json($review->load(['tour', 'user']));
    }

    public function update(Request $request, Review $review)
    {
        $data = $request->validate([
            'tour_id' => ['sometimes', 'required', 'integer', 'exists:tours,id'],
            'user_id' => ['sometimes', 'nullable', 'integer', 'exists:users,id'],
            'full_name' => ['sometimes', 'nullable', 'string', 'max:255'],
            'rating' => ['sometimes', 'required', 'integer', 'min:1', 'max:5'],
            'comment' => ['sometimes', 'nullable', 'string'],
            'status' => ['sometimes', 'required', Rule::in(['pending', 'approved', 'rejected'])],
        ]);

        $review->update($data);

        return response()->json($review->load(['tour', 'user']));
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return response()->json(null, 204);
    }
}
