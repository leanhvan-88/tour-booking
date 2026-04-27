<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - Travel')</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        :root {
            --primary: #0ea5e9;
            --dark: #0f172a;
            --darker: #020617;
            --card: #1e293b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: #0a0f1c;
            color: #e2e8f0;
            line-height: 1.6;
        }

        .app {
            display: flex;
            min-height: 100vh;
        }

        /* ==================== SIDEBAR ==================== */
        .sidebar {
            width: 260px;
            background: var(--darker);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 1000;
            border-right: 1px solid #1e293b;
        }

        .sidebar.collapsed {
            width: 78px;
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid #1e293b;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-header .logo {
            font-size: 26px;
            font-weight: 700;
            color: white;
        }

        .sidebar-header .logo span {
            color: var(--primary);
        }

        .sidebar-header .brand {
            font-size: 15px;
            color: #64748b;
            margin-left: auto;
        }

        .menu {
            padding: 20px 12px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 4px;
            transition: all 0.2s;
            font-weight: 500;
        }

        .menu-item:hover,
        .menu-item.active {
            background: #1e293b;
            color: white;
        }

        .menu-item i {
            font-size: 21px;
            width: 24px;
        }

        .menu-item span {
            transition: all 0.3s;
        }

        .sidebar.collapsed .menu-item span {
            display: none;
        }

        /* ==================== MAIN CONTENT ==================== */
        .main-content {
            flex: 1;
            margin-left: 260px;
            transition: margin-left 0.3s ease;
            padding: 24px;
        }

        .sidebar.collapsed + .main-content {
            margin-left: 78px;
        }

        /* Header */
        .header {
            background: var(--card);
            padding: 16px 28px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .toggle-btn {
            font-size: 26px;
            cursor: pointer;
            color: #94a3b8;
            padding: 6px 10px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .toggle-btn:hover {
            background: #334155;
            color: white;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-avatar {
            width: 38px;
            height: 38px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 16px;
        }

        /* Card */
        .card {
            background: var(--card);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        /* Toast */
        #toast {
            position: fixed;
            top: 24px;
            right: 24px;
            background: #22c55e;
            color: white;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            z-index: 9999;
            display: none;
            animation: slideIn 0.4s ease;
        }

        @keyframes slideIn {
            from { transform: translateX(120%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        /* ==================== TOUR MANAGEMENT PAGE ==================== */
.glass-card {
    background: rgba(30, 41, 59, 0.95);
    backdrop-filter: blur(12px);
    padding: 28px;
    border-radius: 20px;
    border: 1px solid rgba(148, 163, 184, 0.1);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
}

.page-header h2 {
    font-size: 28px;
    font-weight: 700;
    color: white;
}

.page-header p {
    color: #94a3b8;
    margin-top: 4px;
}

.btn-primary {
    background: var(--primary);
    color: white;
    padding: 12px 24px;
    border-radius: 9999px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s;
}

.btn-primary:hover {
    background: #0284c8;
    transform: translateY(-2px);
}

/* Table */
.table-modern {
    width: 100%;
    border-collapse: collapse;
    background: #1e293b;
    border-radius: 16px;
    overflow: hidden;
}

.table-modern thead {
    background: #334155;
}

.table-modern th {
    padding: 16px 20px;
    text-align: left;
    font-weight: 600;
    color: #e2e8f0;
    font-size: 14px;
}

.table-modern td {
    padding: 16px 20px;
    border-top: 1px solid #334155;
}

.table-modern tr:hover {
    background: #2a3749;
}

.img-thumb {
    width: 70px;
    height: 50px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #1e293b;
}

.btn-action {
    padding: 6px 14px;
    border-radius: 9999px;
    font-size: 14px;
    font-weight: 500;
    margin-right: 8px;
    transition: all 0.2s;
}

.btn-edit {
    background: #3b82f6;
    color: white;
}

.btn-edit:hover {
    background: #2563eb;
}

.btn-delete {
    background: #ef4444;
    color: white;
}

.btn-delete:hover {
    background: #dc2626;
}

.btn-view {
    background: #64748b;
    color: white;
}

/* Modal */
.modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.7);
    align-items: center;
    justify-content: center;
    z-index: 2000;
}

.modal-content {
    background: #1e293b;
    width: 100%;
    max-width: 680px;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
}

.modal-header {
    padding: 20px 28px;
    background: #0f172a;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h3 {
    font-size: 20px;
    font-weight: 600;
}

.modal-header button {
    background: none;
    border: none;
    font-size: 28px;
    color: #94a3b8;
    cursor: pointer;
}

.form-content {
    padding: 28px;
}

.form-content input,
.form-content textarea {
    width: 100%;
    padding: 14px 18px;
    background: #334155;
    border: 1px solid #475569;
    border-radius: 12px;
    color: white;
    margin-bottom: 16px;
    font-size: 15px;
}

.form-content input:focus,
.form-content textarea:focus {
    outline: none;
    border-color: var(--primary);
}

.form-content .grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.form-content textarea {
    min-height: 100px;
    resize: vertical;
}

.btn-save {
    width: 100%;
    background: #22c55e;
    color: white;
    padding: 16px;
    border: none;
    border-radius: 9999px;
    font-size: 16px;
    font-weight: 600;
    margin-top: 10px;
    cursor: pointer;
}

.btn-save:hover {
    background: #16a34a;
}
/* ==================== BOOKING MANAGEMENT ==================== */
.status-select {
    padding: 8px 12px;
    border-radius: 9999px;
    border: 1px solid #475569;
    background: #334155;
    color: white;
    font-size: 14px;
    cursor: pointer;
}

.status-select:focus {
    outline: none;
    border-color: var(--primary);
}

/* Status colors (tùy chọn) */
option[value="pending"]   { color: #fbbf24; }
option[value="contacted"] { color: #60a5fa; }
option[value="confirmed"] { color: #34d399; }
option[value="done"]      { color: #22c55e; }
option[value="cancelled"] { color: #ef4444; }
    </style>

    @stack('styles')
</head>
<body>

<div class="app">

    <!-- SIDEBAR -->
    @include('admin.partials.sidebar')

    <!-- MAIN -->
    <div class="main-content">
        
        <!-- HEADER -->
        @include('admin.partials.header')

        <!-- CONTENT -->
        @yield('content')

    </div>
</div>

<!-- TOAST -->
@if(session('success'))
<div id="toast">
    ✓ {{ session('success') }}
</div>
@endif

<script>
    // Toggle Sidebar
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('collapsed');
    }

    // Auto hide toast
    setTimeout(() => {
        const toast = document.getElementById('toast');
        if (toast) {
            toast.style.transition = 'all 0.4s ease';
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 500);
        }
    }, 4000);

    // Active menu hiện tại
    document.querySelectorAll('.menu-item').forEach(item => {
        if (item.getAttribute('href') === window.location.pathname) {
            item.classList.add('active');
        }
    });
</script>

@stack('scripts')

</body>
</html>