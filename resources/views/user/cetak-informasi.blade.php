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
            orientation: landscape;
            /* auto is the initial value */
            margin: 0mm;
            /* this affects the margin in the printer settings */
        }
    </style>
</head>

<body>
    <main class="d-flex flex-column align-items-center pt-4 px-5 pb-3 mw-100">
        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th scope="col" width="30">#</th>
                    @foreach($data['head'] as $head)
                    <th scope="col" class="text-center align-middle">{{ $head }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1;
                @endphp
                @if(count($data['body']) == 0)
                <td colspan="{{ count($data['head']) + 1 }}" class="text-center fw-bolder">Belum Ada Data Di Periode {{ date('F Y', strtotime($periode)) }}</td>
                @else
                @foreach($data['body'] as $body)
                <tr>
                    <th scope="row">{{ $i++ }}</th>
                    @for($j = 0; $j < count($data['head']); $j++) <td>{{ $body[$i][$j] }}</td>
                        @endfor
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </main>
    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('load', function() {
            window.print();
        });
    </script>
</body>

</html>