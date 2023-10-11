<x-layout>
    @if(session('message'))
        <div class="alert alert-success">
            <h6 class="text-center">{{session('message')}}</h6>
        </div>
    @endif
    <div class="container-fluid mt-3">
        <div class="row justify-content-center">
            <div class="col-12 col-md-11">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{Storage::url('public/media/letto.jpg')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Scopri tutti i nostri prodotti</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{Storage::url('public/media/tavolo.jpg')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{Storage::url('public/media/tavolo2.jpg')}}" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
                        </div>
                    </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                    </button>
                </div>

            <div class="row  justify-content-center vh-100 my-5">
                <div class="col-12 col-md-6  lg:tw-h-screen  order-md-2 my-2 my-md-0 text-center  ">
                    <img src="{{Storage::url('public/media/4.jpg')}}" class="img-home  lg:tw-max-h-full object-fit-cover tw-object-center" >
                </div>
                <div class="col-12 col-md-6 vh-md-100  d-flex flex-column justify-content-center align-items-center  order-md-1 my-2 my-md-0 ">
                    <h2 class="title fs-1 fw-bold ">Il Nostro Catalogo</h2>
                    <p class="desc fs-5">Scopri il nostro catalogo</p>
                    <a href="{{route('product_index')}}" class="main-color link-home p-4">Scopri di più</a>
                </div>


                <div class="col-12 col-md-6 order-md-3 my-4">
                    <img src="{{Storage::url('public/media/2.jpg')}}" class="img-home " >
                </div>
                <div class="col-12 col-md-6 vh-md-100  d-flex flex-column justify-content-center align-items-center order-md-4 my-2 my-md-0">
                    <h2 class="title fs-1 fw-bold ">Le nostre collezioni </h2>
                    <p class="desc fs-5">Scopri le nostre collezioni</p>
                    <a href="" class="main-color link-home p-4">Scopri di più</a>
                </div>
            </div>
        </div>
    </div>
    </div>





</x-layout>
