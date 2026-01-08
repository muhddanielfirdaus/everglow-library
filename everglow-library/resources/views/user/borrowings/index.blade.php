@extends('user.layouts.main')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
.page-title{
    font-size:36px;
    color:white;
    font-weight:bold;
    margin-bottom:25px;
}

/* New clean table container */
.borrow-wrapper{
    width:90%;
    margin:auto;
    background:rgba(255,255,255,0.97);
    border-radius:15px;
    padding:30px;
    box-shadow:0 10px 30px rgba(0,0,0,0.30);
}

/* Table */
table{
    width:100%;
    border-collapse:collapse;
}

table th, table td{
    padding:14px;
    text-align:center;
}

table th{
    background:#E5C39B;
    font-size:18px;
    font-weight:bold;
}

table tr:nth-child(even){
    background:#faf6ef;
}

.return-btn{
    background:#C94A4A;
    border:none;
    color:white;
    padding:6px 16px;
    border-radius:8px;
    cursor:pointer;
    font-weight:bold;
    transition:.3s;
}

.return-btn:hover{
    background:#8b2f2f;
}

/* Status colors */
.status-returned{ color:green; font-weight:bold; }
.status-not{ color:red; font-weight:bold; }
</style>


<div style="padding:80px 0; text-align:center; background-size:cover; background-image:url('{{ asset('images/bg2.jpg') }}')">

    <h1 class="page-title">My Borrowings</h1>

    @if(session('success'))
        <div style="background:#d4f8d4;width:60%;margin:auto;padding:12px;border-radius:8px;color:#207f20;font-weight:bold;">
            {{ session('success') }}
        </div><br>
    @endif


    <div class="borrow-wrapper">

        <table>
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Borrowed Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
            @foreach ($borrowings as $borrow)
                <tr>
                    <td>{{ $borrow->title }}</td>
                    <td>{{ $borrow->author }}</td>
                    <td>{{ \Carbon\Carbon::parse($borrow->borrowed_at)->format('d M Y') }}</td>
                    <td>
                    <form action="{{ route('borrowings.return', $borrow->id) }}" 
      method="POST" 
      onsubmit="return confirm('Return this book?')" 
      style="display:inline-block">
    @csrf
    @method('DELETE')
    <button type="submit" class="return-btn">Return</button>
</form>




                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
</div>

@endsection
