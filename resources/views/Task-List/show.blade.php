<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $taskList->name }} - JARA</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .back {
            color: #555;
            text-decoration: none;
        }

        .button {
            background: #4f46e5;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 8px;
        }

        .task {
            background: white;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
        }

        .task h3 {
            margin-top: 0;
        }

        .priority {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            background: #eee;
            font-size: 13px;
        }

        .empty {
            background: white;
            padding: 40px;
            text-align: center;
            border-radius: 10px;
            color: #777;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">

        <div>
            <a href="{{ route('task-lists.index') }}" class="back">
                ← Back to Lists
            </a>

            <h1>{{ $taskList->name }}</h1>

            @if($taskList->description)
                <p>{{ $taskList->description }}</p>
            @endif
        </div>

        <a href="{{ route('tasks.create', ['list_id' => $taskList->id]) }}"
           class="button">
            + Add Task
        </a>

    </div>


    @forelse($tasks as $task)

        <div class="task">

            <h3>{{ $task->title }}</h3>

            @if($task->description)
                <p>{{ $task->description }}</p>
            @endif

            <span class="priority">
                Priority: {{ ucfirst($task->priority) }}
            </span>

            @if($task->due_date)
                <p>
                    Due:
                    {{ $task->due_date->format('d M Y') }}
                </p>
            @endif

        </div>

    @empty

        <div class="empty">
            <h3>No tasks yet</h3>

            <p>
                Belum ada task di dalam list ini.
            </p>

            <a href="{{ route('tasks.create', ['list_id' => $taskList->id]) }}"
               class="button">
                Create First Task
            </a>
        </div>

    @endforelse

</div>

</body>
</html>