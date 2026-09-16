<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Task Management</title>

    <link rel="stylesheet" href="{{ asset('tasks.css') }}">
</head>

<body>

    <!-- Sidebar -->
    <aside class="sidebar">

        <div class="logo">
            TaskFlow
        </div>

        <nav class="menu">

            <a href="{{ route('tasks.index') }}" class="menu-item active">
                Dashboard
            </a>

            <a href="#" class="menu-item">
                Tugas Saya
            </a>

            <a href="#" class="menu-item">
                Tugas Tim
            </a>

            <a href="#" class="menu-item">
                Kategori
            </a>

        </nav>

        <div class="sidebar-bottom">

            <a href="#" class="menu-item">
                Pengaturan
            </a>

            <a href="#" class="menu-item">
                Keluar
            </a>

        </div>

    </aside>


    <!-- Main Content -->
    <main class="main-content">

        <!-- Header -->
        <header class="header">

            <div>
                <h1>Dashboard</h1>
                <p>Kelola tugas pribadi dan tim kamu.</p>
            </div>

            <div class="user-profile">
                <span class="avatar">RA</span>
                <span>Rahmat</span>
            </div>

        </header>


        <!-- Pesan Berhasil -->
        @if (session('success'))

            <div class="success-message">
                {{ session('success') }}
            </div>

        @endif


        <!-- Pesan Error -->
        @if ($errors->any())

            <div class="error-message">

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <!-- Statistik -->
        <section class="statistics">

            <div class="stat-card">

                <p>Total Tugas</p>

                <h2>{{ $totalTasks }}</h2>

            </div>


            <div class="stat-card">

                <p>Tugas Selesai</p>

                <h2>{{ $completedTasks }}</h2>

            </div>


            <div class="stat-card">

                <p>Dalam Proses</p>

                <h2>{{ $progressTasks }}</h2>

            </div>


            <div class="stat-card">

                <p>Tugas Tim</p>

                <h2>{{ $teamTasks }}</h2>

            </div>

        </section>


        <!-- Area Tugas -->
        <section class="task-section">

            <div class="section-header">

                <div>

                    <h2>Daftar Tugas</h2>

                    <p>Kelola dan kelompokkan tugas kamu.</p>

                </div>


                <button
                    class="btn-primary"
                    onclick="openTaskModal()">

                    + Buat Tugas

                </button>

            </div>


            <!-- Filter -->
            <form
                action="{{ route('tasks.index') }}"
                method="GET"
                class="filter-area">

                <input
                    type="text"
                    name="search"
                    placeholder="Cari tugas..."
                    class="search-input"
                    value="{{ request('search') }}"
                >


                <select
                    name="type"
                    class="filter-select">

                    <option value="">
                        Semua Jenis
                    </option>

                    <option
                        value="personal"
                        {{ request('type') == 'personal' ? 'selected' : '' }}>

                        Pribadi

                    </option>

                    <option
                        value="team"
                        {{ request('type') == 'team' ? 'selected' : '' }}>

                        Tim

                    </option>

                </select>


                <button
                    type="submit"
                    class="btn-primary">

                    Filter

                </button>

            </form>


            <!-- Daftar Tugas -->
            <div class="task-list">

                @forelse ($tasks as $task)

                    <div class="task-card">

                        <div class="task-info">

                            <span class="task-category {{ $task->category }}">

                                {{ ucfirst($task->category) }}

                            </span>


                            <h3>

                                {{ $task->title }}

                            </h3>


                            <p>

                                {{ $task->description ?? 'Tidak ada deskripsi.' }}

                            </p>


                            <div class="task-meta">

                                <span>

                                    {{ $task->type == 'personal' ? 'Pribadi' : 'Tim' }}

                                </span>


                                <span>

                                    Deadline:

                                    {{ $task->deadline
                                        ? \Carbon\Carbon::parse($task->deadline)->format('d M Y')
                                        : 'Tidak ditentukan'
                                    }}

                                </span>

                            </div>

                        </div>


                        <span class="status {{ $task->status }}">

                            @if ($task->status == 'pending')

                                Belum Mulai

                            @elseif ($task->status == 'progress')

                                Dalam Proses

                            @elseif ($task->status == 'completed')

                                Selesai

                            @endif

                        </span>

                    </div>


                @empty

                    <p>

                        Belum ada tugas. Silakan buat tugas baru.

                    </p>

                @endforelse

            </div>

        </section>

    </main>


    <!-- Modal Buat Tugas -->
    <div
        class="modal-overlay"
        id="taskModal">

        <div class="modal">

            <div class="modal-header">

                <h2>Buat Tugas Baru</h2>


                <button
                    class="close-btn"
                    onclick="closeTaskModal()">

                    &times;

                </button>

            </div>


            <!-- Form Create Task -->
            <form
                action="{{ route('tasks.store') }}"
                method="POST">

                @csrf


                <div class="form-group">

                    <label for="taskName">
                        Nama Tugas
                    </label>


                    <input
                        type="text"
                        id="taskName"
                        name="title"
                        placeholder="Masukkan nama tugas"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="description">
                        Deskripsi
                    </label>


                    <textarea
                        id="description"
                        name="description"
                        placeholder="Deskripsi tugas"
                        rows="4"
                    ></textarea>

                </div>


                <div class="form-group">

                    <label for="taskType">
                        Jenis Tugas
                    </label>


                    <select
                        id="taskType"
                        name="type"
                        required>

                        <option value="">
                            Pilih jenis tugas
                        </option>


                        <option value="personal">
                            Pribadi
                        </option>


                        <option value="team">
                            Tim
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label for="category">
                        Kategori
                    </label>


                    <select
                        id="category"
                        name="category"
                        required>

                        <option value="">
                            Pilih kategori
                        </option>


                        <option value="kuliah">
                            Kuliah
                        </option>


                        <option value="project">
                            Project
                        </option>


                        <option value="organisasi">
                            Organisasi
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label for="deadline">
                        Deadline
                    </label>


                    <input
                        type="date"
                        id="deadline"
                        name="deadline"
                    >

                </div>


                <div class="modal-actions">

                    <button
                        type="button"
                        class="btn-secondary"
                        onclick="closeTaskModal()">

                        Batal

                    </button>


                    <button
                        type="submit"
                        class="btn-primary">

                        Simpan Tugas

                    </button>

                </div>

            </form>

        </div>

    </div>


    <!-- JavaScript Modal -->
    <script>

        function openTaskModal() {

            document
                .getElementById("taskModal")
                .classList.add("show");

        }


        function closeTaskModal() {

            document
                .getElementById("taskModal")
                .classList.remove("show");

        }

    </script>

</body>

</html>