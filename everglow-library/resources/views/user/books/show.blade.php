@extends('user.layouts.main')

@section('content')

<style>
.book-details{
    min-height: calc(100vh - 120px);
    padding: 80px;
    display: flex;
    gap: 50px;
    color: white;
}

.book-cover img{
    width: 280px;
    border-radius: 18px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.5);
}

.book-info h1{
    font-size: 38px;
    margin-bottom: 15px;
}

.book-info p{
    font-size: 18px;
    margin-bottom: 10px;
}

.back-link{
    display: inline-block;
    margin-top: 25px;
    color: #ffd;
    font-weight: bold;
}
</style>

<div class="book-details">

    <div class="book-cover">

        {{-- FIXED IMAGE DISPLAY using storage --}}
        @if($book->image)
            <img src="{{ asset('storage/' . $book->image) }}" alt="Book Cover">
        @else
            <img src="{{ asset('images/book-default.png') }}" alt="No Cover">
        @endif

    </div>

    <div class="book-info">
        <h1>{{ e($book->title) }}</h1>
        <p><strong>Author:</strong> {{ e($book->author) }}</p>
        <p><strong>Quantity:</strong> {{ e($book->quantity) }}</p>
        <p><strong>Status:</strong> {{ $book->quantity > 0 ? 'Available' : 'Unavailable' }}</p>

        <a href="{{ route('books.index') }}" class="back-link">
            ← Back to Books
        </a>
    </div>

</div>

@endsection
