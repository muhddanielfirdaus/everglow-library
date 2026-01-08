@extends('user.layouts.main')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* ==================== PAGE BACKGROUND ==================== */
.login-bg{
    min-height:90vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:40px 20px;

    background:
        linear-gradient(rgba(0,0,0,0.50), rgba(0,0,0,0.50)),
        url('{{ asset("images/background1.png") }}');
    background-size:cover;
    background-position:center;
}

/* ==================== LOGIN CARD ==================== */
.login-card{
    width:420px;
    background:rgba(255,255,255,0.92);
    backdrop-filter:blur(6px);
    border-radius:25px;
    padding:50px 45px;
    text-align:center;
    box-shadow:0 25px 45px rgba(0,0,0,0.45);
    animation:fadeUp 0.9s ease;
}

/* Soft entry animation */
@keyframes fadeUp{
    from{opacity:0;transform:translateY(30px);}
    to{opacity:1;transform:translateY(0);}
}

/* ==================== HEADER ==================== */
.login-card img{
    width:95px;
    margin-bottom:10px;
}

.login-card h2{
    font-size:30px;
    font-weight:800;
    color:#5a3e1d;
    margin-bottom:3px;
}

.login-card p{
    font-size:15px;
    margin-bottom:25px;
    color:#6b543d;
}

/* ==================== FORM INPUTS ==================== */
.input-box{
    position:relative;
    margin-bottom:18px;
}

.input-box i{
    position:absolute;
    top:50%;
    left:15px;
    transform:translateY(-50%);
    color:#9a8a7a;
}

.input-box input{
    width:100%;
    padding:13px 15px 13px 42px;
    border-radius:12px;
    border:1px solid #d4c1ac;
    font-size:15px;
    background:#fffdf9;
}

.input-box input:focus{
    outline:none;
    border-color:#c49a6c;
    box-shadow:0 0 0 2px rgba(196,154,108,0.35);
}

/* ==================== BUTTON ==================== */
.login-btn{
    width:100%;
    padding:14px;
    background:#d9a87d;
    border:none;
    border-radius:14px;
    font-size:17px;
    font-weight:bold;
    color:white;
    margin-top:5px;
    cursor:pointer;
    transition:.35s;
}
.login-btn:hover{
    background:#c49068;
    transform:scale(1.03);
}

/* ==================== ALERT BOXES ==================== */
.alert-box{
    padding:10px;
    border-radius:8px;
    font-size:14px;
    margin-bottom:15px;
    text-align:center;
    font-weight:600;
}

.success{ background:#d7ffe5;border-left:6px solid #28a745;color:#236b36; }
.error{ background:#ffe0e0;border-left:6px solid #d9534f;color:#A70000; }

/* ==================== FOOTER LINK ==================== */
.bottom-text{
    margin-top:18px;
    font-size:15px;
    color:#5a3e1d;
}

.bottom-text a{
    color:#b06b3c;
    font-weight:bold;
    text-decoration:none;
}
.bottom-text a:hover{ text-decoration:underline; }
</style>


<div class="login-bg">
<div class="login-card">

    <img src="{{ asset('images/user.png') }}" alt="User">
    <h2>Welcome Back</h2>
    <p>Login to Everglow Academy Library !!</p>

    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))
    <div class="alert-box success">{{ session('success') }}</div>
    @endif

    {{-- ERROR MESSAGE --}}
    @if ($errors->any())
    <div class="alert-box error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="input-box">
            <i class="fa fa-envelope"></i>
            <input type="email" name="email" placeholder="Email Address" required>
        </div>

        <div class="input-box">
            <i class="fa fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button class="login-btn">LOGIN</button>
    </form>

    <div class="bottom-text">
        New to Everglow? <a href="{{ route('register') }}">Create Account</a>
    </div>

</div>
</div>

@endsection
