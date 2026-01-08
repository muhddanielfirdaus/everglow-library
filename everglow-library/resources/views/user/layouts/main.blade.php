<!DOCTYPE html>
<html lang="en">
<head>
    <title>Everglow Library System</title>
</head>

<body class="{{ Auth::check() ? 'auth-bg' : 'guest-bg' }}">

@include('user.partials.header')

<main style="flex:1;">
    @yield('content')
</main>

@include('user.partials.footer')

</body>
</html>
