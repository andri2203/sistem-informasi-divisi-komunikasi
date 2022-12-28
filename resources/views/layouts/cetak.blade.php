<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
    <style type="text/css" media="print">
        @page {
            size: auto;
            /* auto is the initial value */
            margin: 0mm;
            /* this affects the margin in the printer settings */
        }
    </style>
</head>

<body>
    <main class="d-flex flex-column align-items-center pt-4 px-5 pb-3">
        <div class="d-flex align-items-center gap-3">
            <img src="/images/PUSHUB_AD.png" alt="Logo" class="img-fluid" width="75">
            <h4 class="text-center m-0">PERHUBUNGAN KODAM ISKANDAR MUDA <br> DIVISI KOMUNIKASI</h4>
            <div width="75"></div>
        </div>
        <hr class="border border-dark w-100 border-1 my-4">
        <h5 class="text-center mb-4">{{ $title }}</h5>
        <section class="w-100">@yield("adminCetak")</section>
        <section class="d-flex flex-column w-25 ms-auto mb-2">
            <span>Banda Aceh, {{ date("d F Y") }}</span>
            <span class="fw-bolder" style="padding-bottom: 60px;">Kapala Divisi Hubdam IM</span>
            @if($pimpinan != null)
            <span class="fw-bolder">{{ $pimpinan->nama }}</span>
            <span>NIP. {{ $pimpinan->nip }}</span>
            @else
            <span class="fw-bolder">(..................................)</span>
            <span>NIP.</span>
            @endif
        </section>
        <section class="w-100"><span class="fw-bolder">Divisi Komunikasi Hubdam IM</span></section>
    </main>
    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('load', function() {
            window.print();
        });
    </script>
</body>

</html>