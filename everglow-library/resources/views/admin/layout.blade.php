<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Everglow Academy System</title>

    <style>
        /* ===== GLOBAL LAYOUT FIX ===== */
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            background-color: #FFF8DC;
            font-family: "Times New Roman", serif;
        }

        main {
            flex: 1; /* keeps footer bottom */
        }

        /* ===== HEADER ===== */
        header {
            background-color: #D2B48C;
            padding: 25px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
        }

        header h1 {
            margin: 0;
        }

        nav a {
            margin-left: 20px;
            text-decoration: none;
            color: black;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        /* ===== FOOTER ===== */
        footer {
            background-color: #D2B48C;
            padding: 25px;
            text-align: center;
            font-weight: bold;
            margin-top: auto;
        }

    </style>
</head>
<body>

<header>
    <h1>EVERGLOW ACADEMY SYSTEM</h1>

    <nav>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.books.list') }}">Books</a>
        <a href="{{ route('admin.users') }}">Users</a> {{-- added user menu --}}
        <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
            @csrf
            <button style="background:none;border:none;font-weight:bold;cursor:pointer;">Logout</button>
        </form>
    </nav>
</header>


<main>
    @yield('content')
</main>


<footer>
    © Copyright Reserved by EVERGLOW ACADEMY
</footer>

</body>
</html>
