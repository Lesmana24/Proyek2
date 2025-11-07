<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" ...>
    <link rel="shortcut icon" href="{{ asset('image/logo.png') }} "type="image/x-icon">
    @stack('page-styles')

</head>
<body>
    <div class="container">
    @yield('content')
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" ...></script>
    @stack('page-scripts')
</body>
</html>