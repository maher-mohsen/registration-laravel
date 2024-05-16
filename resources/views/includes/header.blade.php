<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    @push('styles')
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
    @endpush
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">@lang('titles.Registration Page')</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">@lang('titles.Home')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">@lang('titles.About')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">@lang('titles.Contact')</a>
                        </li>

                        <li class="nav-item"><a class="nav-link" href="{{ url('/locale/en') }}">English</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/locale/es') }}">Español</a></li>
                        
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Include Bootstrap's JavaScript bundle -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
