@include('admin.includes.headerAD')

<style>
.page-bg{
    padding:60px 0;
    background:#fff7e3;
    min-height:calc(100vh - 140px);
    text-align:center;
}

/* WELCOME BANNER OUTSIDE BOX */
.banner-img{
    width:690px;
    display:block;
    margin:0 auto 25px;
    border-radius:12px;
}

/* FORM CONTAINER CARD */
.book-card{
    background:#ffffff;
    width:45%;
    padding:35px 45px;
    border-radius:15px;
    box-shadow:0 8px 22px rgba(0,0,0,0.15);
    margin:0 auto;
    animation:fadeIn .5s;
}

/* TITLE */
.book-card h2{
    font-size:30px;
    font-weight:700;
    color:#5A3E1D;
    margin-bottom:25px;
}

/* FORM INPUT & SELECT */
.form-group{
    margin-bottom:18px;
    text-align:left;
}

.form-group label{
    font-size:18px;
    font-weight:bold;
}

.form-group input,
.form-group select{
    width:100%;
    padding:12px;
    font-size:16px;
    border:1px solid #c2b08d;
    border-radius:8px;
    margin-top:6px;
    background:#fffdf4;
}

/* RADIO STATUS */
.radio-box{
    margin-top:8px;
    display:flex;
    gap:25px;
}

.radio-box label{
    font-size:17px;
}

/* SUBMIT BUTTON */
.submit-btn{
    margin-top:15px;
    width:200px;
    padding:12px;
    background:#C08026;
    color:white;
    font-size:18px;
    font-weight:bold;
    border:none;
    border-radius:8px;
    cursor:pointer;
    transition:.3s;
}
.submit-btn:hover{
    background:#8b5e19;
    transform:scale(1.05);
}

/* Success & Error */
.success-msg{color:green;font-weight:bold;margin-bottom:8px;}
.error-box{
    background:#ffebeb;color:#a20000;padding:10px;border-radius:7px;margin-bottom:10px;
}

@keyframes fadeIn{from{opacity:0;transform:translateY(12px);}to{opacity:1;}}
</style>

<div class="page-bg">

    <!-- 🟡 Image now OUTSIDE the card + bigger -->
    <img src="{{ asset('images/3.png') }}" class="banner-img">

    <div class="book-card">

        <h2>ADD NEW BOOKS !!</h2>

        {{-- Success --}}
        @if(session('success'))
            <p class="success-msg">{{ session('success') }}</p>
        @endif

        {{-- Errors --}}
        @if($errors->any())
            <div class="error-box">
                @foreach ($errors->all() as $error) {{ $error }} <br> @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Book Title</label>
                <input type="text" name="title" required>
            </div>

            <div class="form-group">
                <label>Author Name</label>
                <input type="text" name="author" required>
            </div>

            <div class="form-group">
                <label>Category</label>
                <select name="category" required>
                    <option disabled selected>-- Select Category --</option>
                    <option>Programming</option>
                    <option>Animation</option>
                    <option>English Novels</option>
                    <option>Malay Novels</option>
                </select>
            </div>

            <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" min="1" required>
            </div>

            <div class="form-group">
                <label>Status</label>
                <div class="radio-box">
                    <label><input type="radio" name="status" value="Active" required> Active</label>
                    <label><input type="radio" name="status" value="Inactive" required> Inactive</label>
                </div>
            </div>

            <div class="form-group">
                <label>Book Cover Image</label>
                <input type="file" name="image">
            </div>

            <button class="submit-btn">Add Book</button>
        </form>

    </div>
</div>

@include('admin.includes.footer')
