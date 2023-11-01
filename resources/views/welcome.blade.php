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
                        <img src={{asset("media/home/home1.jpg")}} class="d-block w-100 tw-object-contain " alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <div class="tw-text-white tw-p-2">
                                <h5>Zucche decorative , Lene Bjerre</h5>
                                <a class="tw-text-white" href={{route('product_index')}}>Visualizza sul catalogo</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset("media/home/home2.jpg")}}" class="d-block w-100 tw-object-contain " alt="...">
                        <div class="carousel-caption d-none d-md-block">
                        <h5>Ragazza con palloncini, Tono su Tono</h5>
                        <a class="tw-text-white" href={{route('product_index')}}>Visualizza sul catalogo</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset("media/home/home3.jpg")}}" class="d-block w-100 tw-object-contain" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                        <h5>Mamma con bambino, Palais Royal</h5>
                        <a class="tw-text-white" href={{route('product_index')}}>Visualizza sul catalogo</a>
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

            <div class="row  justify-content-center  my-5">
                <div class="col-12 col-md-6  lg:tw-h-screen  order-md-2 my-2 my-md-0 text-center  ">
                    <img src="{{asset("media/home/home4.jpg")}}" class="img-home   object-fit-cover tw-object-center tw-max-h[70%]" >
                </div>
                <div class="col-12 col-md-6 vh-md-100  d-flex flex-column justify-content-center align-items-center  order-md-1 my-2 my-md-0 ">
                    <h2 class="title fs-1 fw-bold ">Il Nostro Catalogo</h2>
                    <p class="desc fs-5">Scopri il nostro catalogo</p>
                    <a href="{{route('product_index')}}" class="main-color link-home p-4">Scopri di più</a>
                </div>


                <div class="col-12 col-md-6 order-md-3 my-4">
                    <img src="{{asset("media/home/home5.jpg")}}" class="img-home tw-max-h[70%]" >
                </div>
                <div class="col-12 col-md-6 vh-md-100  d-flex flex-column justify-content-center align-items-center order-md-4 my-2 my-md-0">
                    <h2 class="title fs-1 fw-bold ">Chi Siamo </h2>
                    <p class="desc fs-5">Qualcosa su di noi</p>
                    <a href="{{route('about_us')}}" class="main-color link-home p-4">Scopri di più</a>
                </div>
            </div>
        </div>
    </div>
    </div>





</x-layout>
