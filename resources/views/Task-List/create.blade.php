<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create List - JARA</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
        }

        textarea {
            min-height: 120px;
        }

        button {
            background: #4f46e5;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
        }

        .error {
            color: #dc2626;
            margin-bottom: 15px;
        }

        a {
            color: #555;
            text-decoration: none;
            margin-left: 10px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Create New List</h1>

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('task-lists.store') }}" method="POST">

        @csrf

        <label>
            List Name
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name') }}"
            placeholder="Contoh: Project JARA"
            required
        >

        <label>
            Description
        </label>

        <textarea
            name="description"
            placeholder="Deskripsi list..."
        >{{ old('description') }}</textarea>

        <button type="submit">
            Create List
        </button>

        <a href="{{ route('task-lists.index') }}">
            Cancel
        </a>

    </form>

</div>

</body>
</html>