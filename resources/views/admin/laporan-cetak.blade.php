@extends("layouts.cetak")

@section("adminCetak")

@php
$head = $data['head'];
$body = $data['body'];
@endphp
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            @for($i = 0; $i < count($head); $i++) <th scope="col">{{ $head[$i] }}</th> @endfor
        </tr>
    </thead>
    <tbody>
        @php $index = 1 @endphp
        @for($i = 0; $i < count($body); $i++) <tr>
            <th scope="row">{{ $i + 1 }}</th>
            @for($j = 0; $j < count($head); $j++) <td>{{ $body[$i][$j] }}</td> @endfor
                </tr> @endfor
    </tbody>
</table>
@endSection