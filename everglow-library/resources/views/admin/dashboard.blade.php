@include('admin.includes.headerAD')

<style>

/* ================= PAGE BACKGROUND ================= */
.dashboard-wrap{
    min-height:calc(100vh - 140px);
    background:#fff7e3;
    text-align:center;
    padding-top:60px;
    font-family:"Times New Roman", serif;
}

/* ================= TITLES ================= */
.dashboard-title{
    font-size:42px;
    font-weight:800;
    color:#5a3e1d;
}

.sub-welcome{
    font-size:19px;
    margin-top:5px;
    color:#7a6044;
}


/* ================= ADMIN IMAGE (NO CIRCLE + BIGGER) ================= */
.admin-img{
    width:340px;          /* bigger image */
    height:auto;          /* keeps original shape */
    border-radius:0;      /* remove round border */
    border:none;
    box-shadow:none;
    margin:30px auto 55px;
    transition:.35s ease-in-out;
    display:block;
}

.admin-img:hover{
    transform:scale(1.07); /* soft zoom */
}


/* ================= STATS CARD SECTION ================= */
.stat-grid{
    display:flex;
    justify-content:center;
    gap:40px;
    flex-wrap:wrap;
    margin-top:-10px;
    padding-bottom:50px;
}

/* card container */
.stat-card{
    width:320px;
    background:#ffffff;
    border-radius:18px;
    padding:35px 0;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
    transition:.4s ease;
}

.stat-card:hover{
    transform:translateY(-8px);
    box-shadow:0 18px 35px rgba(0,0,0,.30);
}

/* numbers inside cards */
.stat-card h2{
    font-size:42px;
    font-weight:800;
    color:#523217;
    margin-bottom:5px;
}

.stat-card p{
    font-size:19px;
    color:#7a552f;
}

/* icon on top */
.icon{
    font-size:40px;
    margin-bottom:5px;
}

/* SCREEN RESPONSIVE */
@media(max-width:768px){
    .admin-img{
        width:260px;
    }
    .stat-card{
        width:90%;
    }
}

</style>


<!-- ==================== HTML STRUCTURE ==================== -->
<div class="dashboard-wrap">

    <h1 class="dashboard-title">Welcome Back, {{ $username }} !! </h1>
    <p class="sub-welcome">Manage library records with ease & control.</p>

    @if(isset($picture) && $picture)
        <img src="{{ asset($picture) }}" class="admin-img">
    @else
        <img src="{{ asset('images/default-admin.png') }}" class="admin-img">
    @endif

    <div class="stat-grid">

        <div class="stat-card">
            <div class="icon"></div>
            <h2>{{ $bookCount }}</h2>
            <p>Total Books</p>
        </div>

        <div class="stat-card">
            <div class="icon"></div>
            <h2>{{ $userCount }}</h2>
            <p>Registered Users</p>
        </div>

        <div class="stat-card">
            <div class="icon"></div>
            <h2>{{ $borrowCount }}</h2>
            <p>Borrow Records</p>
        </div>

    </div>
</div>

@include('admin.includes.footer')
