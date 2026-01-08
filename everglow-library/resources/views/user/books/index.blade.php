@extends('user.layouts.main')


@section('content')

<style>
.books-container{
    min-height: calc(100vh - 120px);
    padding: 60px 80px;
}

.books-header{
    color: white;
    margin-bottom: 30px;
}

.books-grid{
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 30px;
}

.book-card{
    background: rgba(255,255,255,0.95);
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0,0,0,0.35);
}

.book-img{
    height: 220px;
    overflow: hidden;
}

.book-img img{
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.book-content{
    padding: 18px;
}

.badge{
    padding: 5px 10px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: bold;
}

.badge-active{
    background: #d4edda;
    color: #155724;
}

.badge-inactive{
    background: #f8d7da;
    color: #721c24;
}

.book-actions{
    margin-top: 15px;
    display: flex;
    gap: 10px;
}

.btn{
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 14px;
    border: none;
    cursor: pointer;
}

.btn-details{
    background: #6c757d;
    color: white;
}

.btn-borrow{
    background: #28a745;
    color: white;
}

.btn-disabled{
    background: #adb5bd;
    cursor: not-allowed;
}
</style>

<div class="books-container">

    <div class="books-header">
        <h1>Library Books</h1>
        <p>Select a book to view details or borrow</p>
    </div>

    <div class="books-grid">

        @foreach($books as $book)
        <div class="book-card">

            <div class="book-img">
               <img src="{{ asset('storage/' . $book->image) }}" style="width:100%;height:300px;object-fit:cover;">

            </div>

            <div class="book-content">
                <h3>{{ $book->title }}</h3>
                <p>Author: {{ $book->author }}</p>
                <p>Quantity: {{ $book->quantity }}</p>

                @if($book->quantity > 0)
                    <span class="badge badge-active">Available</span>
                @else
                    <span class="badge badge-inactive">Unavailable</span>
                @endif

                <div class="book-actions">
                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-details">
                        Details
                    </a>

                    @if($book->quantity > 0)
                        <form method="POST" action="{{ route('borrowings.store', $book->id) }}">
                            @csrf
                            <button class="btn btn-borrow">Borrow</button>
                        </form>
                    @else
                        <button class="btn btn-disabled">Borrow</button>
                    @endif
                </div>
            </div>

        </div>
        @endforeach

    </div>

</div>

@endsection
