<!DOCTYPE html>
<html lang="en">
<head>
    <title>Everglow Library System</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:"Times New Roman";
        }

        body{
            background:#FFF8DC;
            min-height:100vh;
            display:flex;
            flex-direction:column;
        }

        /* ================================
           🌟 MODERN NAVBAR STYLING
        ================================= */
        .navbar{
            width:100%;
            height:80px;
            background:#D2B48C;
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:0 35px;
            box-shadow:0 4px 12px rgba(0,0,0,0.20);
            position:sticky;
            top:0;
            z-index:999;
        }

        /* LOGO + SYSTEM NAME */
        .nav-left{
            display:flex;
            align-items:center;
            gap:12px;
        }

        .nav-logo{
            width:45px;
            height:45px;
        }

        .nav-title{
            font-size:26px;
            font-weight:bold;
            letter-spacing:1px;
        }

        /* NAVIGATION MENU */
        .nav-menu{
            list-style:none;
            display:flex;
            gap:35px;
        }

        .nav-menu li a{
            text-decoration:none;
            font-size:19px;
            font-weight:bold;
            color:black;
            transition:0.3s;
        }

        .nav-menu li a:hover{
            color:#5A3E1D;
            text-shadow:0 0 5px rgba(90,62,29,0.4);
        }

        /* LOGOUT BUTTON */
        .logout-btn{
            background:#8B4A4A;
            border:none;
            padding:8px 18px;
            border-radius:8px;
            color:white;
            font-size:17px;
            font-weight:bold;
            cursor:pointer;
            transition:0.3s;
            margin-left:20px;
        }

        .logout-btn:hover{
            background:#5E1F1F;
            transform:scale(1.05);
        }

        /* ================================
              FOOTER DESIGN
        ================================= */
        footer{
            background:#D2B48C;
            text-align:center;
            padding:20px 0;
            margin-top:auto;
            font-size:20px;
            font-weight:bold;
            color:#3B2F2F;
            border-top:4px solid rgba(0,0,0,0.1);
        }

        footer:hover{
            background:#C9A676;
            transition:0.4s;
        }

        footer span{
            font-size:16px;
            opacity:0.8;
        }

    </style>
</head>

<body>

<!-- ============================
        NAVBAR
============================ -->
<nav class="navbar">

    <div class="nav-left">
        <img src="{{ asset('images/logo.png') }}" class="nav-logo" alt="logo">
        <span class="nav-title">EVERGLOW ACADEMY SYSTEM</span>
    </div>

    <ul class="nav-menu">
        <li><a href="{{ route('admin.dashboard') }}">DASHBOARD</a></li>
        <li><a href="{{ route('admin.books.create') }}">ADD BOOKS</a></li>
        <li><a href="{{ route('admin.books.list') }}">BOOKS INFO</a></li>
        <li><a href="{{ route('admin.users') }}">USERS</a></li>
        <li><a href="{{ route('admin.borrow.records') }}">BORROW RECORDS</a></li>
    </ul>

    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button class="logout-btn">LOGOUT</button>
    </form>

</nav>

<!-- ============================
        PAGE CONTENT GOES HERE
============================ -->
<main style="flex:1;">
    @yield('content')
</main>



</body>
</html>
