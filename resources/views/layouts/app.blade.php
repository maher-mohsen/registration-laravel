<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title') - My Laravel App</title>
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <header>
        @include('includes.header')  <!-- Assuming you have a header.blade.php -->
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        @include('includes.footer')  <!-- Assuming you have a footer.blade.php -->
    </footer>

  
    @stack('scripts')
</body>
</html>
