<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator | Login</title>

    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/css/layouts/admin.css">
</head>

<body>
    <main class="min-vh-100 d-flex justify-content-center align-items-center bg-light">
        <section class="login d-flex flex-column align-items-center border shadow-sm py-4 px-4 bg-white">
            <header class="d-flex flex-column align-items-center mb-4">
                <img src="/images/PUSHUB_AD.png" alt="Logo Pushub AD" class="mb-3">
                <h3 class="h4 fw-bold">Administrator Login</h3>
            </header>
            @if(session()->has('loginError'))
            <div class="w-100 alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <form class="w-100" action="/admin/login" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" autofocus required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </section>
    </main>
    <script src="/js/bootstrap/bootstrap.min.js"></script>
</body>

</html>