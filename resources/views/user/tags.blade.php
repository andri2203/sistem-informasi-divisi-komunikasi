@extends($extends)

@section($section)
<h3 class="fw-bold text-center">Pengumuman</h3>
<hr class="mb-4">

<div id="news" class="row justify-content-center">
    @foreach($news as $berita)
    <div class="col-sm-10 p-0 bg-white shadow-sm h-auto mb-3">
        <div class="row">
            <div class="col-sm-3">
                <img src="/files/{{ $berita->image }}" alt="{{ $berita->header }}" class="img-fluid" style="background-size: auto;">
            </div>
            <div class="col-sm-9 py-2">
                <h6 class="fw-bolder mb-1">{{ $berita->header }}</h6>
                <p class="fst-italic mb-0 text-small">{{ date('d-M-Y, H:i:s', strtotime($berita->created_at)) }}</p>
                <p>{{ \Illuminate\Support\Str::limit(strip_tags($berita->body), 75) }}</p>
                <a href="/berita/baca/{{ $berita->slug }}" class="btn btn-sm btn-outline-primary" target="_blank">Selengkapnya</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="d-flex justify-content-center">
    <div id="pagination" class="pagination">
    </div>
</div>
@endsection

@section("dashboard-script")
<script>
    const pagination = document.getElementById('pagination');
    const news = document.getElementById('news');

    var data = [...news.children];
    var dataLength = data.length;
    var page_size = 5;
    var pages_number = Math.trunc(dataLength / page_size) + 1;
    var page_number = 1;

    news.replaceChildren(...[...data.slice(0, 5)])

    // Render Pagination Button
    function renderPagination(name) {
        var li = document.createElement('li');
        li.classList.add('page-item')

        var a = document.createElement('a');
        a.classList.add('page-link')
        a.id = name;
        if (name == 1) {
            a.classList.add('active')
        }
        a.setAttribute('href', "#")
        a.setAttribute('type', "button")
        a.innerText = name;

        li.appendChild(a)
        pagination.appendChild(li)
    }

    renderPagination('Pertama')
    for (let i = 1; i <= pages_number; i++) {
        renderPagination(i)
    }
    renderPagination('Terakhir')

    // Show the data per page
    const pages = document.getElementsByClassName('page-link');
    const active = document.getElementsByClassName('active');
    const pertama = document.getElementById('Pertama');
    const terakhir = document.getElementById('Terakhir');

    pertama.addEventListener('click', function(e) {
        e.preventDefault();
        page_number = 1;
        const page = document.getElementById(page_number);
        active.item(0).classList.remove('active')
        page.classList.add('active');

        news.replaceChildren(...[...data.slice((page_number - 1) * page_size, (page_number * page_size))]);
    })

    terakhir.addEventListener('click', function(e) {
        e.preventDefault();
        page_number = pages.length - 2;
        const page = document.getElementById(page_number);
        active.item(0).classList.remove('active')
        page.classList.add('active');

        news.replaceChildren(...[...data.slice((page_number - 1) * page_size, (page_number * page_size))]);
    })

    for (let i = 1; i < pages.length - 1; i++) {
        const page = pages[i];
        page.addEventListener('click', function(e) {
            e.preventDefault();
            page_number = i;
            active.item(0).classList.remove('active')
            page.classList.add('active');

            news.replaceChildren(...[...data.slice((page_number - 1) * page_size, (page_number * page_size))]);
        });
    }
</script>
@endsection