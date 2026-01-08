<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Times New Roman';
}

/* ===== PAGE BACKGROUNDS ===== */
body.guest-bg {
    background:
        linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
        url("{{ asset('images/background1.png') }}");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

body.auth-bg {
    background:
        linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)),
        url("{{ asset('images/slide1.png') }}");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

/* ===== NAVBAR ===== */
nav {
    width: 100%;
    padding: 15px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.nav-guest {
    background-color: #FFE4B5;
}

.nav-auth {
    background-color: #DEB887;
}

.logo {
    display: flex;
    align-items: center;
    font-size: 26px;
    font-weight: bold;
}

.logo img {
    margin-right: 15px;
}

nav ul {
    list-style: none;
    display: flex;
    gap: 30px;
    font-size: 20px;
}

nav ul li a {
    text-decoration: none;
    color: black;
    font-weight: 700;
}

/* LOGOUT BUTTON */
.nav-link-btn {
    background: none;
    border: none;
    font-size: 20px;
    font-weight: 700;
    cursor: pointer;
}
.nav-link-btn:hover,
nav ul li a:hover {
    text-decoration: underline;
}
/* ===== MOVING WELCOME TEXT ===== */
.moving-wrapper {
    width: 100%;
    overflow: hidden;
    white-space: nowrap;
    margin: 40px 0;
}

.moving-text {
    display: inline-block;
    font-size: 48px;
    font-weight: bold;
    color: #ffee2dff;
    animation: moveText 30s linear infinite;
}

@keyframes moveText {
    0% {
        transform: translateX(100%);
    }
    100% {
        transform: translateX(-100%);
    }
}
</style>

<nav class="{{ Auth::check() ? 'nav-auth' : 'nav-guest' }}">
    <div class="logo">
        <img src="{{ asset('images/buku.png') }}" width="65">
        EVERGLOW ACADEMY SYSTEM
    </div>

    <ul>
    
    @guest
        <li><a href="{{ url('/') }}">HOME</a></li>
        <li><a href="{{ route('about') }}">ABOUT US</a></li>
        <li><a href="{{ route('login') }}">LOGIN</a></li>
    @endguest

        @auth
            <li><a href="{{ route('dashboard') }}">DASHBOARD</a></li>
            <li><a href="{{ route('books.index') }}">BOOKS</a></li>
            <li><a href="{{ route('borrowings.index') }}">MY BORROWINGS</a></li>
            <li><a href="{{ route('profile.edit') }}">PROFILE</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="nav-link-btn">LOGOUT</button>
                </form>
            </li>
        @endauth
    </ul>
</nav>
