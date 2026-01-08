@extends('admin.includes.headerAD')

@section('content')
<style>
/* PAGE CONTAINER */
.container {
    width: 90%;
    margin: 40px auto;
}

/* TITLE */
.container h1 {
    font-size: 46px;
    margin-bottom: 20px;
}

/* ADD BUTTON */
.add-btn {
    background-color: green;
    color: white;
    padding: 8px 14px;
    text-decoration: none;
    font-weight: bold;
    border-radius: 4px;
    display: inline-block;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #F0F8FF;
}

/* TABLE HEADERS & CELLS */
th, td {
    border: 1px solid black;
    padding: 12px;
    text-align: center;
}

/* TABLE HEADER */
th {
    background-color: #B0C4DE;
    font-size: 18px;
}

/* BOOK IMAGE */
.book-image {
    max-width: 95px;
    height: auto;
}

/* STATUS */
.status-active {
    background-color: green;
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
}

.status-inactive {
    background-color: red;
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
}

/* ACTION BUTTONS */
.edit-btn {
    background-color: blue;
    color: white;
    padding: 6px 10px;
    text-decoration: none;
    border-radius: 3px;
    margin-right: 5px;
}

.delete-btn {
    background-color: red;
    color: white;
    padding: 6px 10px;
    border: none;
    cursor: pointer;
    border-radius: 3px;
}
</style>

<div class="main-content">
    <div class="container">

        <h1>Books Management</h1>

        <a href="{{ route('admin.books.create') }}" class="add-btn">Add New Book</a>

        <table>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

            @forelse($books as $book)
            <tr>
                <td>
                   @if ($book->image)
    <img src="{{ asset('storage/' . $book->image) }}" width="80" height="130" style="object-fit:cover;">
@else
    <span>No Image</span>
@endif

                </td>

                <td>{{ e($book->title) }}</td>
                <td>{{ e($book->author) }}</td>
                <td>{{ e($book->category) }}</td>
                <td>{{ e($book->quantity) }}</td>

                <td>
                    <span class="{{ $book->status=='Active' ? 'status-active' : 'status-inactive' }}">
                        {{ e($book->status) }}
                    </span>
                </td>

                <td>
                    <a href="{{ route('admin.books.edit',$book->id) }}" class="edit-btn">Edit</a>

                    <form action="{{ route('admin.books.delete',$book->id) }}"
                          method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="delete-btn"
                                onclick="return confirm('Delete this book?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
                <tr><td colspan="7">No books found</td></tr>
            @endforelse
        </table>

    </div>
</div>

@endsection
