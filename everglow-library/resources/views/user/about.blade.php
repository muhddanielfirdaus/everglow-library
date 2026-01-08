@extends('user.layouts.main')

@section('content')

<style>
/* 🔥 Background + Page Layout */
.about-container{
    min-height: calc(100vh - 120px);
    padding: 70px 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: url('{{ asset("images/library-bg.jpg") }}') center/cover fixed;
}

/* 🌟 Glass UI Box */
.about-box{
    max-width: 950px;
    width: 100%;
    text-align: center;
    padding: 55px 45px;
    border-radius: 28px;
    background: rgba(0,0,0,0.60);
    backdrop-filter: blur(15px);
    color: #fff;
    box-shadow: 0 0 40px rgba(0,0,0,0.7);
    animation: fadeIn 1.2s ease;
}

/* Title */
.about-box h1{
    font-size: 48px;
    font-weight: 800;
    margin-bottom: 15px;
    color: #fff8e6;
    text-shadow: 0 0 10px rgba(255,255,255,0.4);
}

/* Subtitles */
.about-box h2{
    font-size: 28px;
    margin-top: 40px;
    color: #ffe6b5;
    font-weight: 700;
}

/* Paragraph */
.about-box p{
    font-size: 17px;
    line-height: 1.8;
    width: 88%;
    margin: auto;
    opacity: 0.92;
}

/* VALUES GRID */
.about-values{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px,1fr));
    gap: 28px;
    margin-top: 45px;
}

/* Cards */
.value-card{
    background: rgba(255,255,255,0.97);
    padding: 30px 20px;
    border-radius: 18px;
    color: #3b2f2f;
    box-shadow: 0 12px 32px rgba(0,0,0,0.35);
    transition: .35s ease;
}

.value-card:hover{
    transform: translateY(-10px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.50);
    background:#fffef8;
}

/* Card Titles */
.value-card h3{
    font-size: 22px;
    margin-bottom: 10px;
    font-weight: 750;
}

.value-card p{
    font-size: 15px;
}

/* Fade animation */
@keyframes fadeIn{
    from{opacity:0; transform:translateY(30px);}
    to{opacity:1; transform:translateY(0);}
}
</style>


<div class="about-container">

    <div class="about-box">

        <h1>About Everglow Academy</h1>
        <p>
            Everglow Academy is a research-driven institution dedicated to academic excellence,
            innovation, and secure knowledge access. Our digital library supports efficient,
            transparent, and reliable academic resource distribution.
        </p>
        <h2>Our Mission</h2>
        <p>
            To empower students & staff with secure learning accessibility through responsible data handling,
            authentication controls, and software security culture.
        </p>
        <h2>Security-First Development</h2>
        <p>
            Built using Secure Software Development principles — applying authentication, authorization,
            input validation, logging & protection of user actions.
        </p>

        <div class="about-values">

            <div class="value-card">
                <h3>Knowledge</h3>
                <p>Centralized academic materials & structured digital repository.</p>
            </div>

            <div class="value-card">
                <h3>Security</h3>
                <p>Authentication-based access & protected user interactions.</p>
            </div>

            <div class="value-card">
                <h3>Reliability</h3>
                <p>Stable system with role-based usage & controlled privileges.</p>
            </div>

        </div>

    </div>

</div>

@endsection
