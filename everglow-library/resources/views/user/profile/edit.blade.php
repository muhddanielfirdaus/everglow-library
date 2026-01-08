@extends('user.layouts.main')

@section('content')

<style>
.profile-box{
    max-width:700px;
    margin:60px auto;
    background:white;
    padding:40px;
    border-radius:20px;
    box-shadow:0 25px 50px rgba(0,0,0,0.35);
}

.profile-header{
    text-align:center;
    margin-bottom:30px;
}

.profile-header img{
    width:140px;
    height:140px;
    border-radius:50%;
    object-fit:cover;
    border:5px solid #f3caa6;
    background:#f5f5f5;
}

.profile-form label{
    font-weight:bold;
    margin-top:15px;
    display:block;
}

.profile-form input{
    width:100%;
    padding:12px;
    border-radius:10px;
    border:1px solid #ccc;
    margin-top:6px;
}

.profile-btn{
    margin-top:25px;
    width:100%;
    padding:14px;
    border:none;
    border-radius:14px;
    background:#FFDAB9;
    font-weight:bold;
    cursor:pointer;
}

.profile-btn:hover{
    background:#f2c7a3;
}
</style>

<div class="profile-box">

    <div class="profile-header">
        <img src="{{ Auth::user()->profile_image 
            ? asset('storage/'.Auth::user()->profile_image) 
            : asset('images/user.png') }}" 
        alt="Profile Image">

        <h2>{{ e(Auth::user()->name) }}</h2> {{-- prevent XSS --}}
        <p>{{ e(Auth::user()->email) }}</p>
    </div>

    {{-- SUCCESS MESSAGE FEEDBACK --}}
    @if(session('success'))
        <div style="background:#d4edda;padding:10px;border-radius:8px;margin-bottom:15px;color:#155724;">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR FEEDBACK --}}
    @if($errors->any())
        <div style="background:#f8d7da;padding:10px;border-radius:8px;margin-bottom:15px;color:#721c24;">
            <strong>Fix the following errors:</strong>
            <ul style="margin-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="profile-form">
        @csrf
        @method('PATCH')

        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required>

        <label>Email</label>
        <input type="email" value="{{ Auth::user()->email }}" disabled>

        <label>Change Profile Image</label>
        <input type="file" name="profile_image" accept="image/*">

        <button class="profile-btn">Update Profile</button>
    </form>
</div>

@endsection
