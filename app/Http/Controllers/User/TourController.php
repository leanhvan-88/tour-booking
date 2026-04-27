<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tour;

class TourController extends Controller
{
    /**
     * Danh sách tất cả tour
     */
    public function index()
    {
        $tours = Tour::latest()->paginate(9);

        return view('user.tours.index', compact('tours'));
    }

    /**
     * Chi tiết tour
     */
    public function show($id)
    {
        $tour = Tour::findOrFail($id);

        $days = [];
        $currentDay = null;

        if ($tour->itinerary) {
            $lines = preg_split('/\r\n|\r|\n/', $tour->itinerary);

            foreach ($lines as $line) {
                $line = trim($line);

                if ($line === '') continue;

                // 🔥 detect NGÀY
                if (preg_match('/^NGÀY/i', $line)) {
                    $currentDay = $line;
                    $days[$currentDay] = [];
                } else {
                    if ($currentDay) {
                        $days[$currentDay][] = $line;
                    }
                }
            }
        }

        return view('user.tours.show', compact('tour', 'days'));
    }
    
}