<!DOCTYPE html>
<html>
<head>
    <title>Tambah Tugas - Jara</title>
</head>

<body>

<h1>Tambah Tugas</h1>

@if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form action="{{ route('tasks.store') }}" method="POST">

    @csrf

    <div>
        <label>Nama Tugas</label>

        <input
            type="text"
            name="title"
            value="{{ old('title') }}"
            required
        >
    </div>

    <br>

    <div>
        <label>Deskripsi</label>

        <textarea name="description">{{ old('description') }}</textarea>
    </div>

    <br>

    <div>
        <label>List</label>

        <select name="list_id" required>

            <option value="">
                Pilih List
            </option>

            @foreach ($lists as $list)

                <option value="{{ $list->id }}">
                    {{ $list->name }}
                </option>

            @endforeach

        </select>
    </div>

    <br>

    <div>
        <label>Prioritas</label>

        <select name="priority">

            <option value="low">
                Rendah
            </option>

            <option value="medium" selected>
                Sedang
            </option>

            <option value="high">
                Tinggi
            </option>

        </select>
    </div>

    <br>

    <div>
        <label>Deadline</label>

        <input
            type="date"
            name="due_date"
            value="{{ old('due_date') }}"
        >
    </div>

    <br>

    <button type="submit">
        Tambah Tugas
    </button>

</form>

</body>
</html>