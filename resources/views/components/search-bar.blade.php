<div class="container d-flex flex-column justify-content-center search">
    <div class="caption text-center">
        <h1 class="text-white">LOREM IPSUM BHOOTEL</h1>
        <p class="text-white mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam quisquam dolores asperiores dolorem eveniet repellat placeat suscipit? Eveniet, aperiam quod. Consectetur nulla aliquam magnam a error laborum eum? Soluta, in?</p>
    </div>

    <form class="form mt-2 mt-md-0" action="{{route('search.show')}}" method="post">
        @csrf
        @method('POST')
        <input class="form-control mr-sm-2 p-4" name='search_field' type="text">
        <div class="button text-center">
            <button class="btn btn-success my-2 my-sm-0 search abs-50-50" type="submit"> Cerca </button>
        </div>
    </form>
</div>
