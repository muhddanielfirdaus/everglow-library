@extends('user.layouts.main')

@section('content')

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* ===== DASHBOARD BACKGROUND ===== */
.dashboard-bg{
    min-height: calc(100vh - 120px); /* FIX footer cut */
    padding:50px 80px;
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
}

/* ===== WELCOME ===== */
.dashboard-header{
    color:#fff;
    margin-bottom:35px;
}
.dashboard-header h1{
    font-size:34px;
    margin-bottom:5px;
}
.dashboard-header p{
    font-size:16px;
    opacity:0.9;
}

/* ===== CARDS ===== */
.dashboard-cards{
    display:grid;
    grid-template-columns:repeat(3, 1fr);
    gap:25px;
    margin-bottom:40px;
}

.card-box{
    background:rgba(255,255,255,0.95);
    border-radius:18px;
    padding:30px;
    text-align:center;
    box-shadow:0 20px 45px rgba(0,0,0,0.35);
    transition:0.3s;
}

.card-box:hover{
    transform:translateY(-6px);
}

.card-box i{
    font-size:36px;
    margin-bottom:12px;
    color:#c97c44;
}

.card-box h2{
    font-size:32px;
    margin:0;
}

.card-box p{
    font-size:15px;
    margin-top:5px;
    color:#666;
}

/* ===== TABLE ===== */
.table-box{
    background:rgba(255,255,255,0.97);
    border-radius:20px;
    padding:30px;
    box-shadow:0 20px 45px rgba(0,0,0,0.35);
}

.table-box h3{
    margin-bottom:15px;
    font-size:22px;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th,
table td{
    padding:12px;
    text-align:left;
    border-bottom:1px solid #ddd;
}

table th{
    background:#f8e1c8;
    font-weight:bold;
}

.status-returned{
    color:green;
    font-weight:bold;
}

.status-not{
    color:red;
    font-weight:bold;
}

/* ===== RESPONSIVE ===== */
@media(max-width:1000px){
    .dashboard-cards{
        grid-template-columns:1fr;
    }

    .dashboard-bg{
        padding:30px 20px;
    }
}
</style>

<div class="dashboard-bg">

    <!-- ===== WELCOME ===== -->
    <div class="dashboard-header">
        <h1>Welcome, {{ Auth::user()->name }} >< !!</h1>
        <p>Your Everglow Academy Library Dashboard</p>
    </div>

    <!-- ===== SUMMARY CARDS ===== -->
    <div class="dashboard-cards">

        <div class="card-box">
            <i class="fa fa-book"></i>
            <h2>{{ $totalBooks }}</h2>
            <p>Total Books</p>
        </div>

        <div class="card-box">
            <i class="fa fa-book-reader"></i>
            <h2>{{ $borrowedBooks }}</h2>
            <p>Books Borrowed</p>
        </div>

        <div class="card-box">
            <i class="fa fa-rotate-left"></i>
            <h2>{{ $returnedBooks }}</h2>
            <p>Books Returned</p>
        </div>

    </div>

<!-- ===== BORROWING HISTORY ===== -->
<div class="table-box">
    <h3>Your Borrowing History</h3>

    <table>
        <thead>
            <tr>
                <th>Book Title</th>
                <th>Borrowed Date</th>
                <th>Returned Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

        @forelse ($borrowings as $borrow)
            <tr>
                <td>{{ $borrow->title }}</td>
                <td>{{ \Carbon\Carbon::parse($borrow->borrowed_at)->format('d M Y') }}</td>
                <td>
                    {{ $borrow->returned_at 
                        ? \Carbon\Carbon::parse($borrow->returned_at)->format('d M Y') 
                        : '-' 
                    }}
                </td>
                <td>
                    @if($borrow->status === 'Returned')
                        <span class="status-returned">Returned</span>
                    @else
                        <span class="status-not">Not Returned</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No borrowing record found.</td>
            </tr>
        @endforelse

        </tbody>
    </table>
</div>


@endsection
