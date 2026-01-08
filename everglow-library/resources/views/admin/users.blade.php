@extends('admin.includes.headerAD')

@section('content')

<style>
.container-user{
    width:90%;
    margin:50px auto;
}
.container-user h1{
    text-align:center;
    font-size:42px;
    margin-bottom:25px;
}
.user-table{
    width:100%;
    border-collapse:collapse;
    background:#F5F5F5;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0px 5px 18px rgba(0,0,0,0.15);
}
.user-table th, .user-table td{
    padding:14px;
    text-align:center;
    border-bottom:1px solid #ddd;
}
.user-table th{
    background:#D2B48C;
    font-size:20px;
}
.user-table tr:hover{
    background:#f9e9c9;
    transition:0.3s;
}
.role-badge{
    padding:5px 12px;
    color:white;
    font-weight:bold;
    border-radius:8px;
}
.badge-admin{ background:#4b0082; }
.badge-user{ background:#228b22; }

.btn-sm{
    padding:6px 12px;
    font-size:14px;
    font-weight:bold;
    border:none;
    border-radius:6px;
    cursor:pointer;
}
.btn-edit{ background:#4682B4; color:white; }
.btn-reset{ background:#DAA520; color:white; }
.btn-delete{ background:#B22222; color:white; }

.btn-reset:hover{ background:#8a6407; }
.btn-delete:hover{ background:#721212; }
.btn-edit:hover{ background:#315f7a; }
</style>


<div class="container-user">

<h1>User Management Panel</h1>

<table class="user-table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>

@foreach($users as $user)
<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>

    <td>
        <span class="role-badge {{ $user->role=='admin'?'badge-admin':'badge-user' }}">
            {{ ucfirst($user->role) }}
        </span>
    </td>

    <td style="display:flex;gap:8px;justify-content:center;">

        <!-- 🔥 Update Role (Fixed values lowercase to match DB) -->
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" style="display:inline-block;">
            @csrf
            <select name="role" onchange="this.form.submit()" style="padding:5px;">
                <option value="user"  {{ $user->role=='user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role=='admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </form>

        <!-- 🔥 Reset password working -->
        <form action="{{ route('admin.users.resetpw', $user->id) }}" method="POST" style="display:inline-block;">
            @csrf
            <button class="btn-reset btn-sm">Reset Password</button>
        </form>

        <!-- 🔥 Delete user still working -->
        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button class="btn-delete btn-sm">Delete</button>
        </form>

    </td>
</tr>
@endforeach
</table>

</div>

@include('admin.includes.footer')

@endsection
