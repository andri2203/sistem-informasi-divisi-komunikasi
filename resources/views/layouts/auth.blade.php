<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
</head>

<body class="d-flex flex-column min-vh-100 justify-content-center align-items-center bg-light">
    <form action="{{ $action }}" method="POST" style="min-width: 30vw;">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @csrf
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-column justify-content-center align-items-center mb-3">
                    <img src="/images/PUSHUB_AD.png" alt="logo" class="img-fluid mb-4" style="width: 105px;">
                    <span class="fw-bold h5 card-title">{{ $title }}</span>
                </div>
                @yield("auth")
                <div class="d-flex justify-content-between">
                    <a href="/" class="btn btn-danger">Kembali</a>
                    <button class="btn btn-primary">{{ $btn_title }}</button>
                </div>
            </div>
        </div>
    </form>
    @yield("authLink")
    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>