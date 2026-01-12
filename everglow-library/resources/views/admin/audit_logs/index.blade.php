@include('admin.includes.headerAD')

<div style="
    padding:40px;
    background:#f7efe5;
    min-height:100vh;
">

    <h2 style="
        margin-bottom:25px;
        color:#6b4f3f;
        font-weight:600;
    ">
        System Audit Logs
    </h2>

    <div style="
        background:#fffaf3;
        padding:25px;
        border-radius:14px;
        box-shadow:0 6px 18px rgba(107,79,63,0.15);
        border:1px solid #e6d8c3;
    ">

        {{-- ================= TABLE ================= --}}
        <table style="
            width:100%;
            border-collapse:collapse;
            font-size:14px;
        ">

            <thead>
                <tr style="
                    background:#d8b58a;
                    color:#3b2a20;
                    text-transform:uppercase;
                    font-size:13px;
                ">
                    <th style="padding:14px;">ID</th>
                    <th style="padding:14px;">Action</th>
                    <th style="padding:14px;">Description</th>
                    <th style="padding:14px;">Role</th>
                    <th style="padding:14px;">IP Address</th>
                    <th style="padding:14px;">Date & Time</th>
                </tr>
            </thead>

            <tbody>
                @forelse($logs as $log)
                <tr style="
                    border-bottom:1px solid #eadfce;
                "
                onmouseover="this.style.background='#f4eadb'"
                onmouseout="this.style.background='transparent'"
                >
                    <td style="padding:12px;">{{ $log->id }}</td>
                    <td style="padding:12px; font-weight:600; color:#8a5a2b;">
                        {{ $log->action }}
                    </td>
                    <td style="padding:12px;">{{ $log->description ?? '-' }}</td>
                    <td style="padding:12px;">{{ ucfirst($log->role) }}</td>
                    <td style="padding:12px;">{{ $log->ip_address }}</td>
                    <td style="padding:12px; font-size:13px;">
                        {{ $log->created_at }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="
                        padding:25px;
                        text-align:center;
                        color:#9b8b7a;
                        font-style:italic;
                    ">
                        No audit logs available.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- ================= PAGINATION INFO ================= --}}
        <div style="
            margin-top:20px;
            text-align:center;
            color:#7a6653;
            font-size:13px;
        ">
            Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }} of {{ $logs->total() }} results
        </div>

        {{-- ================= PAGINATION BUTTONS ================= --}}
        <div style="
            margin-top:15px;
            display:flex;
            justify-content:center;
            gap:6px;
            flex-wrap:wrap;
        ">
            @if ($logs->onFirstPage())
                <span style="padding:6px 12px; color:#aaa;">« Previous</span>
            @else
                <a href="{{ $logs->previousPageUrl() }}"
                   style="
                        padding:6px 12px;
                        background:#d8b58a;
                        color:#3b2a20;
                        border-radius:6px;
                        text-decoration:none;
                   ">
                   « Previous
                </a>
            @endif

            @foreach ($logs->getUrlRange(1, $logs->lastPage()) as $page => $url)
                @if ($page == $logs->currentPage())
                    <span style="
                        padding:6px 12px;
                        background:#8a5a2b;
                        color:white;
                        border-radius:6px;
                    ">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}"
                       style="
                            padding:6px 12px;
                            background:#f4eadb;
                            color:#3b2a20;
                            border-radius:6px;
                            text-decoration:none;
                       ">
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            @if ($logs->hasMorePages())
                <a href="{{ $logs->nextPageUrl() }}"
                   style="
                        padding:6px 12px;
                        background:#6b4f3f;
                        color:white;
                        border-radius:6px;
                        text-decoration:none;
                   ">
                   Next »
                </a>
            @else
                <span style="padding:6px 12px; color:#aaa;">Next »</span>
            @endif
        </div>

    </div>
</div>

@include('admin.includes.footer')

