@extends('admin.layouts.app')

@section('title', 'Chi tiết Tour')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="glass-card">

        <div class="page-header">
            <div>
                <h2>Chi tiết tour</h2>
                <p class="text-slate-400 mt-1">Tour #{{ $tour->id }}</p>
            </div>

            <div>
                <a href="{{ route('admin.tours.edit', $tour) }}" class="btn-primary" style="text-decoration:none;">Sửa</a>
            </div>
        </div>

        <div class="card" style="margin-bottom: 16px;">
            <div style="display:grid; grid-template-columns: 180px 1fr; gap: 18px; align-items:start;">
                <div>
                    <img src="{{ $tour->image }}" alt="{{ $tour->name }}" style="width: 180px; height: 120px; object-fit: cover; border-radius: 12px;">
                </div>
                <div>
                    <div style="font-size: 22px; font-weight: 700; color: white;">{{ $tour->name }}</div>
                    <div style="color:#94a3b8; margin-top: 4px;">{{ $tour->departure }} → {{ $tour->destination }}</div>
                    <div style="margin-top: 10px;"><strong>Giá:</strong> {{ number_format($tour->price) }}đ</div>
                    <div><strong>Thời gian:</strong> {{ $tour->duration }} ngày</div>
                    <div style="margin-top: 10px;"><strong>Danh mục:</strong>
                        @if($tour->categories->count())
                            {{ $tour->categories->pluck('name')->join(', ') }}
                        @else
                            <span style="color:#94a3b8;">(chưa gán)</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="margin-bottom: 16px;">
            <div style="font-weight: 700; margin-bottom: 10px;">Mô tả</div>
            <div style="color:#cbd5e1; white-space: pre-wrap;">{{ $tour->description }}</div>
        </div>

        <div class="card">
            <div style="font-weight: 700; margin-bottom: 10px;">Lịch trình</div>
            @php
                $days = [];
                $currentDay = null;

                if ($tour->itinerary) {
                    $lines = preg_split('/\r\n|\r|\n/', $tour->itinerary);

                    foreach ($lines as $line) {
                        $line = trim($line);
                        if ($line === '') continue;

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
            @endphp

            @if(count($days))
                @foreach($days as $day => $items)
                    <div style="margin-bottom: 10px; font-weight: 700;">{{ $day }}</div>
                    <div style="margin-bottom: 16px;">
                        @foreach($items as $item)
                            <div style="color:#cbd5e1; margin-bottom: 6px;">{{ $item }}</div>
                        @endforeach
                    </div>
                @endforeach
            @else
                <div style="color:#94a3b8;">Chưa có lịch trình</div>
            @endif
        </div>

    </div>
</div>
@endsection
