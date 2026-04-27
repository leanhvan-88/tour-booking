@extends('admin.layouts.app')

@section('title', 'Quản lý Tour')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="glass-card">

        {{-- Toast --}}
        @if(session('success'))
            <div class="toast success">✅ {{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="toast error">❌ {{ $errors->first() }}</div>
        @endif

        <!-- HEADER -->
        <div class="page-header">
            <div>
                <h2>Quản lý Tour</h2>
                <p class="text-slate-400 mt-1">Tổng cộng {{ $tours->total() ?? $tours->count() }} chuyến du lịch</p>
            </div>

            <button onclick="openModal()" class="btn-primary">
                <i class="ri-add-line"></i> Thêm Tour Mới
            </button>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tên Tour</th>
                        <th>Giá</th>
                        <th>Thời gian</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tours as $tour)
                    <tr>
                        <td><strong>#{{ $tour->id }}</strong></td>
                        <td>
                            <img src="{{ $tour->image }}" alt="{{ $tour->name }}" class="img-thumb">
                        </td>
                        <td>
                            <div style="font-weight: 500;">{{ $tour->name }}</div>
                            <small style="color: #94a3b8;">{{ $tour->departure }} → {{ $tour->destination }}</small>
                        </td>
                        <td class="text-emerald-400 font-semibold">
                            {{ number_format($tour->price) }}đ
                        </td>
                        <td>{{ $tour->duration }} ngày</td>
                        <td>
                            <button onclick='editTour({{ json_encode($tour) }})' class="btn-action btn-edit">
                                Sửa
                            </button>
                          
                            <form method="POST" action="{{ route('admin.tours.destroy', $tour->id) }}" 
                                  style="display:inline;" 
                                  onsubmit="return confirm('Bạn chắc chắn muốn xóa tour này không?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 80px 20px; color: #94a3b8;">
                            Chưa có tour nào. Hãy thêm tour mới!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div style="margin-top: 30px; text-align: center;">
            {{ $tours->links() }}
        </div>

    </div>
</div>

<!-- ==================== MODAL ==================== -->
<div id="tourModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Thêm Tour Mới</h3>
            <button onclick="closeModal()">✕</button>
        </div>

        <form id="tourForm" method="POST" class="form-content">
            @csrf
            <input type="hidden" name="_method" id="formMethod">

            <div class="grid grid-cols-2 gap-4">
                <input type="text" name="name" id="name" placeholder="Tên tour *" required>
                <input type="number" name="price" id="price" placeholder="Giá tour (VNĐ) *" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <input type="number" name="duration" id="duration" placeholder="Số ngày *" required>
                <input type="text" name="image" id="image" placeholder="Link ảnh đại diện">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <input type="text" name="departure" id="departure" placeholder="Điểm khởi hành *" required>
                <input type="text" name="destination" id="destination" placeholder="Điểm đến *" required>
            </div>

            <textarea name="description" id="description" rows="3" placeholder="Mô tả ngắn về tour..."></textarea>

            <textarea name="itinerary" id="itinerary" rows="6" 
                placeholder="Lịch trình chi tiết (mỗi dòng một hoạt động)..."></textarea>

            <button type="submit" class="btn-save" id="submitBtn">Lưu Tour</button>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openModal() {
    document.getElementById('tourModal').style.display = 'flex';
    document.getElementById('tourForm').reset();
    document.getElementById('formMethod').value = '';
    document.getElementById('tourForm').action = "{{ route('admin.tours.store') }}";
    document.getElementById('modalTitle').textContent = 'Thêm Tour Mới';
    document.getElementById('submitBtn').textContent = 'Lưu Tour';
}

function closeModal() {
    document.getElementById('tourModal').style.display = 'none';
}

function editTour(tour) {
    openModal();
    
    document.getElementById('tourForm').action = `{{ url('/admin/tours') }}/${tour.id}`;
    document.getElementById('formMethod').value = 'PUT';
    document.getElementById('modalTitle').textContent = 'Chỉnh sửa Tour';
    document.getElementById('submitBtn').textContent = 'Cập nhật Tour';

    document.getElementById('name').value = tour.name || '';
    document.getElementById('price').value = tour.price || '';
    document.getElementById('duration').value = tour.duration || '';
    document.getElementById('image').value = tour.image || '';
    document.getElementById('departure').value = tour.departure || '';
    document.getElementById('destination').value = tour.destination || '';
    document.getElementById('description').value = tour.description || '';
    document.getElementById('itinerary').value = tour.itinerary || '';
}

function viewTour(id) {
    window.location.href = `{{ url('/admin/tours') }}/${id}`;
}

// Auto hide toast
setTimeout(() => {
    document.querySelectorAll('.toast').forEach(t => t.remove());
}, 4000);
</script>
@endpush