<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Progress</title>
</head>

<body>

<h1>Progress Anggota</h1>

<h2>{{ $taskList->name }}</h2>

<table border="1" cellpadding="10">

    <thead>

        <tr>
            <th>Nama</th>
            <th>Total Task</th>
            <th>Task Selesai</th>
            <th>Progress</th>
        </tr>

    </thead>

    <tbody>

        @forelse($progress as $item)

            <tr>

                <td>
                    {{ $item['user']->name }}
                </td>

                <td>
                    {{ $item['total_tasks'] }}
                </td>

                <td>
                    {{ $item['completed_tasks'] }}
                </td>

                <td>

                    {{ $item['percentage'] }}%

                    <progress
                        value="{{ $item['percentage'] }}"
                        max="100"
                    ></progress>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="4">
                    Belum ada anggota.
                </td>

            </tr>

        @endforelse

    </tbody>

</table>

</body>

</html>