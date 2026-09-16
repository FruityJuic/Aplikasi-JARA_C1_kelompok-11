<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Lists - JARA</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h1 {
            margin: 0;
        }

        .button {
            background: #4f46e5;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 8px;
        }

        .lists {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        }

        .card h3 {
            margin-top: 0;
        }

        .count {
            color: #666;
            margin-bottom: 15px;
        }

        .delete {
            background: #dc2626;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>My Lists</h1>

        <a href="{{ route('task-lists.create') }}" class="button">
            + Create List
        </a>
    </div>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="lists">

        @forelse($lists as $list)

            <div class="card">

                <h3>{{ $list->name }}</h3>

                <p>
                    {{ $list->description ?? 'No description' }}
                </p>

                <div class="count">
                    {{ $list->tasks_count }} task(s)
                </div>

                <form
                    action="{{ route('task-lists.destroy', $list) }}"
                    method="POST"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="delete"
                        onclick="return confirm('Hapus list ini?')"
                    >
                        Delete
                    </button>
                </form>

            </div>

        @empty

            <p>
                Belum ada list. Silakan buat list pertama kamu.
            </p>

        @endforelse

    </div>

</div>

</body>
</html>