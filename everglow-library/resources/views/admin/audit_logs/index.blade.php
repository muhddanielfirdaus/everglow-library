@include('admin.includes.headerAD')

<div style="padding:40px">

<h2>📝 System Audit Logs</h2>

<table border="1" cellpadding="10" style="width:100%;background:white;">
    <tr>
        <th>ID</th>
        <th>Action</th>
        <th>Details</th>
        <th>Admin</th>
        <th>Date</th>
    </tr>

    @foreach($logs as $log)
    <tr>
        <td>{{ $log->id }}</td>
        <td>{{ $log->action }}</td>
        <td>{{ $log->details }}</td>
        <td>{{ $log->username }}</td>
        <td>{{ $log->created_at }}</td>
    </tr>
    @endforeach
</table>

</div>

@include('admin.includes.footer')
