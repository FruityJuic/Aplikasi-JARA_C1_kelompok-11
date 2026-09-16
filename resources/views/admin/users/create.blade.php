<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
</head>

<body>

<h1>Tambah User</h1>

@if($errors->any())

    <ul style="color: red;">

        @foreach($errors->all() as $error)

            <li>
                {{ $error }}
            </li>

        @endforeach

    </ul>

@endif

<form
    method="POST"
    action="{{ route('admin.users.store') }}"
>

    @csrf

    <div>

        <label>
            Nama
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name') }}"
            required
        >

    </div>

    <br>

    <div>

        <label>
            Email
        </label>

        <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            required
        >

    </div>

    <br>

    <div>

        <label>
            Password
        </label>

        <input
            type="password"
            name="password"
            required
        >

    </div>

    <br>

    <div>

        <label>
            Konfirmasi Password
        </label>

        <input
            type="password"
            name="password_confirmation"
            required
        >

    </div>

    <br>

    <div>

        <label>
            Role
        </label>

        <select name="role">

            <option value="user">
                User
            </option>

            <option value="admin">
                Admin
            </option>

        </select>

    </div>

    <br>

    <button type="submit">
        Simpan
    </button>

</form>

</body>

</html>