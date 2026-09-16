<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>User Management</title>
</head>

<body>

<h1>User Management</h1>

@if(session('success'))

    <p style="color: green;">
        {{ session('success') }}
    </p>

@endif

@if(session('error'))

    <p style="color: red;">
        {{ session('error') }}
    </p>

@endif

<a href="{{ route('admin.users.create') }}">
    + Tambah User
</a>

<br>
<br>

<table border="1" cellpadding="10">

    <thead>

        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>

    </thead>

    <tbody>

        @foreach($users as $user)

            <tr>

                <td>
                    {{ $user->id }}
                </td>

                <td>
                    {{ $user->name }}
                </td>

                <td>
                    {{ $user->email }}
                </td>

                <td>
                    {{ $user->role }}
                </td>

                <td>

                    @if($user->id !== auth()->id())

                        <form
                            method="POST"
                            action="{{ route(
                                'admin.users.destroy',
                                $user
                            ) }}"
                        >

                            @csrf
                            @method('DELETE')

                            <button type="submit">
                                Hapus
                            </button>

                        </form>

                    @else

                        Akun sendiri

                    @endif

                </td>

            </tr>

        @endforeach

    </tbody>

</table>

</body>

</html>