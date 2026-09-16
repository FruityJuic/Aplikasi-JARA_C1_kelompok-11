<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manage Members</title>
</head>

<body>

<h1>Kelola Anggota</h1>

<h2>{{ $taskList->name }}</h2>

@if(session('success'))
    <p style="color: green;">
        {{ session('success') }}
    </p>
@endif

@if($errors->any())
    <ul style="color: red;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<h3>Tambah Pengguna</h3>

<form
    method="POST"
    action="{{ route('lists.members.store', $taskList) }}"
>
    @csrf

    <select name="user_id" required>

        <option value="">
            -- Pilih Pengguna --
        </option>

        @foreach($availableUsers as $user)

            <option value="{{ $user->id }}">
                {{ $user->name }} - {{ $user->email }}
            </option>

        @endforeach

    </select>

    <button type="submit">
        Tambahkan
    </button>

</form>


<h3>Anggota Saat Ini</h3>

<table border="1" cellpadding="10">

    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

        @forelse($members as $member)

            <tr>

                <td>
                    {{ $member->name }}
                </td>

                <td>
                    {{ $member->email }}
                </td>

                <td>

                    <form
                        method="POST"
                        action="{{ route(
                            'lists.members.destroy',
                            [$taskList, $member]
                        ) }}"
                    >

                        @csrf
                        @method('DELETE')

                        <button type="submit">
                            Hapus
                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="3">
                    Belum ada anggota.
                </td>
            </tr>

        @endforelse

    </tbody>

</table>

</body>
</html>