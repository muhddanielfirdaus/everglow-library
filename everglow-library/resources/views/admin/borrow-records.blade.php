@extends('admin.includes.headerAD')

@section('content')

<style>
.borrow-container{
    width:90%;
    margin:40px auto;
    text-align:center;
    font-family:"Times New Roman";
}

.borrow-container h1{
    font-size:40px;
    margin-bottom:25px;
    color:#5A3E1D;
}

/* Table */
.borrow-table{
    width:100%;
    border-collapse:collapse;
    background:white;
    box-shadow:0 10px 26px rgba(0,0,0,0.20);
    border-radius:12px;
    overflow:hidden;
    font-size:18px;
}

.borrow-table th{
    background:#D2B48C;
    padding:15px;
    font-size:19px;
    color:#3B2F2F;
}

.borrow-table td{
    padding:14px;
    border-bottom:1px solid #ddd;
}

.borrow-table tr:hover{
    background:#f6e7c5;
    transition:0.3s;
}

/* Status Badges */
.status-returned{
    background:#3a8b3a;
    color:white;
    padding:5px 10px;
    font-weight:bold;
    border-radius:6px;
}
.status-borrowed{
    background:#b14c4c;
    color:white;
    padding:5px 10px;
    font-weight:bold;
    border-radius:6px;
}

/* Button Return */
.btn-return{
    background:#7B4F2A;
    color:white;
    border:none;
    padding:8px 15px;
    border-radius:6px;
    cursor:pointer;
    transition:.3s;
}
.btn-return:hover{
    background:#4c2f17;
    transform:scale(1.05);
}
</style>


<div class="borrow-container">

    <h1>Borrow Records</h1>

    <table class="borrow-table">
        <tr>
            <th>User Name</th>
            <th>Book Title</th>
            <th>Borrowed Date</th>
            <th>Return Date</th>
            <th>Status</th>
        </tr>

        @forelse($records as $row)
        <tr>
            <td>{{ $row->username }}</td>
            <td>{{ $row->booktitle }}</td>
            <td>{{ $row->borrowed_at }}</td>
            <td>{{ $row->returned_at }}</td>

            <td>
                @if($row->status == 'Returned')
                    <span class="status-returned">Returned</span>
                @else
                    <span class="status-borrowed">Borrowed</span>
                @endif
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="6" style="color:#B22222; padding:20px;">
                <b>No borrow records found.</b>
            </td>
        </tr>
        @endforelse
    </table>

</div>

@include('admin.includes.footer')

@endsection
