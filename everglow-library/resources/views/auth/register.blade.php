@extends('user.layouts.main')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* ===================== BACKGROUND ===================== */
.register-bg{
    min-height:90vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:40px 20px;

    background:
        linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.45)),
        url('{{ asset("images/background1.png") }}');
    background-size:cover;
    background-position:center;
}

/* ===================== CARD ===================== */
.register-card{
    width:480px;
    background:rgba(255,255,255,0.93);
    backdrop-filter:blur(6px);
    padding:50px 45px;
    border-radius:25px;
    box-shadow:0 25px 55px rgba(0,0,0,0.48);
    text-align:center;
    animation:fadeUp .9s ease;
}

@keyframes fadeUp{
    from{opacity:0;transform:translateY(30px);}
    to{opacity:1;transform:translateY(0);}
}

/* ===================== HEADER ===================== */
.register-card img{
    width:95px;
    margin-bottom:12px;
}

.register-card h2{
    font-size:30px;
    font-weight:800;
    color:#5a3e1d;
}
.register-card p{
    font-size:15px;
    opacity:.8;
    margin-bottom:25px;
    color:#6c4d30;
}

/* ===================== FORM ===================== */
.input-box{
    position:relative;
    margin-bottom:20px;
}

.input-box i{
    position:absolute;
    top:50%;
    left:15px;
    transform:translateY(-50%);
    color:#9c8a7b;
    font-size:15px;
}

.input-box input{
    width:100%;
    padding:13px 15px 13px 43px;
    border-radius:14px;
    border:1px solid #d3c1ac;
    background:#fffdf8;
    font-size:15px;
    transition:.25s;
}

.input-box input:focus{
    outline:none;
    border-color:#cfa37b;
    box-shadow:0 0 0 2px rgba(207,163,123,0.35);
}

/* ===================== BUTTON ===================== */
.register-btn{
    width:100%;
    padding:14px;
    margin-top:6px;
    background:#d9a87d;
    border:none;
    border-radius:15px;
    font-size:17px;
    font-weight:bold;
    color:white;
    cursor:pointer;
    transition:.35s;
}
.register-btn:hover{
    background:#c38f64;
    transform:scale(1.03);
}

/* ===================== ALERT BOXES ===================== */
.alert-box{
    width:100%;
    padding:12px;
    border-radius:10px;
    margin-bottom:15px;
    font-weight:600;
    font-size:14px;
    text-align:left;
}
.error-box{ background:#ffe1e1;border-left:6px solid #d9534f;color:#9b0000; }
.success-box{ background:#d7ffe5;border-left:6px solid #28a745;color:#235f3b; }

/* ===================== FOOT NOTE ===================== */
.bottom-text{
    margin-top:18px;
    font-size:14.5px;
}
.bottom-text a{
    color:#b06b3c;
    font-weight:bold;
    text-decoration:none;
}
.bottom-text a:hover{ text-decoration:underline; }
</style>


<div class="register-bg">
<div class="register-card">

    <img src="{{ asset('images/user.png') }}" alt="User">
    <h2>Create Account</h2>
    <p>Join Everglow Academy Library !!! </p>

    {{-- ❌ Validation Error List --}}
    @if($errors->any())
        <div class="alert-box error-box">
            <ul style="margin:0;padding-left:18px;">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ✔ Success after register --}}
    @if(session('success'))
    <div class="alert-box success-box">{{ session('success') }}</div>
    @endif


<form method="POST" action="{{ route('register') }}">
@csrf

    <div class="input-box">
        <i class="fa fa-user"></i>
        <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
    </div>

    <div class="input-box">
        <i class="fa fa-envelope"></i>
        <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
    </div>

    <div class="input-box">
        <i class="fa fa-lock"></i>
        <input type="password" name="password" placeholder="Password" required>
    </div>

    <div class="input-box">
        <i class="fa fa-lock"></i>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
    </div>

    <button class="register-btn">REGISTER</button>
</form>

    <div class="bottom-text">
        Already have an account?
        <a href="{{ route('login') }}">Login here</a>
    </div>

</div>
</div>

@endsection
