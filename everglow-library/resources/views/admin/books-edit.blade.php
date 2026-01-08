@extends('admin.includes.headerAD')

@section('content')

<style>
.edit-wrapper{
    min-height:90vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:30px;
    background:#f8eecf;
}

.edit-card{
    background:rgba(255,255,255,0.95);
    width:500px;
    padding:40px 45px;
    border-radius:18px;
    text-align:center;
    box-shadow:0 20px 45px rgba(0,0,0,0.25);
    animation:fadeUp .7s ease;
}

@keyframes fadeUp{
    from{opacity:0;transform:translateY(25px);}
    to{opacity:1;transform:translateY(0);}
}

.edit-card img{ width:110px; margin-bottom:8px; }
.edit-card h1{ font-size:30px;font-weight:800;margin-bottom:25px;color:#5a3e1d;}

.edit-card label{
    font-weight:600;color:#4b3823;text-align:left;display:block;margin-top:15px;margin-bottom:6px;
}

.edit-card input,
.edit-card select{
    width:100%;padding:12px;border-radius:12px;border:1px solid #c7b59d;font-size:15px;background:white;
}

.edit-card input:focus,
.edit-card select:focus{
    border-color:#d4a574;box-shadow:0 0 0 2px rgba(212,165,116,.4);outline:none;
}

.update-btn{
    width:100%;margin-top:22px;padding:13px;background:#d9a87d;border:none;border-radius:14px;
    font-size:17px;color:#fff;font-weight:bold;cursor:pointer;transition:.3s;
}

.update-btn:hover{ background:#c38f64;transform:scale(1.03); }
</style>

<div class="edit-wrapper">
<div class="edit-card">

    <img src="{{ asset('images/edit.png') }}" alt="Edit">
    <h1>Edit Book</h1>

@if(session('success'))
<div style="background:#d4f8d4;padding:10px;border-radius:8px;color:#207f20;margin-bottom:15px;">
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div style="background:#ffdddd;padding:10px;border-radius:8px;color:#b30000;margin-bottom:15px;">
    {{ $errors->first() }}
</div>
@endif

<form method="POST" action="{{ route('admin.books.update',$book->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Title</label>
    <input type="text" name="title" value="{{ $book->title }}" required>

    <label>Author</label>
    <input type="text" name="author" value="{{ $book->author }}" required>

    <label>Quantity</label> {{-- 🔥 REQUIRED FIELD FIX --}}
    <input type="number" name="quantity" min="1" value="{{ $book->quantity }}" required>

    <label>Category</label>
    <select name="category" required>
        <option value="Programming" {{ $book->category=='Programming'?'selected':'' }}>Programming</option>
        <option value="Animation" {{ $book->category=='Animation'?'selected':'' }}>Animation</option>
        <option value="English Novel" {{ $book->category=='English Novel'?'selected':'' }}>English Novel</option>
        <option value="Malay Novel" {{ $book->category=='Malay Novel'?'selected':'' }}>Malay Novel</option>
    </select>

    <label>Status</label>
    <select name="status" required>
        <option value="Active" {{ $book->status=='Active'?'selected':'' }}>Active</option>
        <option value="Inactive" {{ $book->status=='Inactive'?'selected':'' }}>Inactive</option>
    </select>

    <button class="update-btn" type="submit">UPDATE</button>
</form>

</div>
</div>

@endsection
