<nav class="navbar navbar-expand-lg w-100  ">
    <div class="container-fluid ">
        <div class="col-12 tw-flex tw-justify-center    ">
            <div class="row align-items-center justify-content-center w-100  ">
                <div class="col-4 d-none d-lg-flex">

                </div>

                <div class=" col-6 col-lg-4 tw-flex tw-justify-start lg:tw-justify-center tw-my-3">
                    <img src={{Storage::url('public/media/logo2.svg')}} alt="" class="logo tw-p-2 ">
                </div>
                <div class="col-6 col-md-4 tw-flex tw-justify-end tw-my-3">
                    @auth
                        @if(!Auth::user()->is_admin)
                            <div class="dropdown tw-flex  tw-justify-between tw-items-center " >
                                <div class="tw-mx-3">
                                    <button class="tw-border-none tw-rounded acc-bg  fw-bold d-flex align-items-center " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        @if(substr(Auth::user()->name, -1) == 'o')
                                            <p class='fw-semi-bol d m-1 tw-text-white'>Benvenuto, {{$user}}</p>
                                        @else
                                            <p class='fw-semi-bold m-1  tw-text-white'>Benvenuta, {{$user}}</p>
                                        @endif
                                        <i class="fa-solid fa-caret-down" style="color: #ffffff;"></i>
                                    </button>
                                    <ul class="dropdown-menu  tw-ms-8">
                                        <li><a class="dropdown-item fw-bold" href="{{route('profile')}}">Profilo</a></li>
                                        <form id="logoutForm" method="POST" action="{{route('logout')}}">
                                            @csrf
                                            <a id="logout" class="dropdown-item fw-bold ">Logout</a>
                                        </form>
                                    </ul>
                                </div>
                                <div>
                                    <a href="{{route('wishlist')}}" class=" tw-p-3 tw-flex  tw-no-underline tw-items-center acc-bg tw-rounded  col-1 tw-w-fit"><i class="fa-solid fa-heart" style="color: #eb0505;"></i></a>
                                </div>

                            </div>

                        @else
                            <div class="dropdown  tw-flex justify-content-between tw-text-white ">
                                <button class="tw-border-none tw-rounded acc-bg   fw-bold d-flex align-items-center " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if(substr(Auth::user()->name, -1) == 'o')
                                        <p class='fw-semi-bold m-1 tw-text-white'>Benvenuto, {{$user}}</p>
                                    @else
                                        <p class='fw-semi-bold m-1 tw-text-white'>Benvenuta, {{$user}}</p>
                                    @endif
                                    <i class="fa-solid fa-caret-down" style="color: #ffffff;"></i>
                                </button>
                                <ul class="dropdown-menu p-2 ">
                                    <li><a class="dropdown-item fw-bold " href="{{route('dashboard')}}">Dashboard</a></li>
                                    <li><a class="dropdown-item fw-bold " href="{{route('orders')}}">Ordini</a></li>
                                    <li><a class="dropdown-item fw-bold " href="{{route('create')}}">Aggiungi Prodotto</a></li>

                                    <form id="logoutForm" method="POST" action="{{route('logout')}}">
                                        @csrf
                                        <a id="logout" class="dropdown-item fw-bold ">Logout</a>
                                    </form>
                                </ul>
                                <a href="{{route('wishlist')}}" class=" tw-p-3 ms-1 acc-bg tw-rounded  col-1 tw-w-fit"><i class="fa-solid fa-heart" style="color: #eb0505;"></i></a>
                            </div>
                        @endif
                        @else
                            <div class="dropdown tw-flex ">
                                <button class="tw-border-none tw-rounded acc-bg  ms-auto fw-bold tw-flex tw-items-center py-1 " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <p class='fw-semi-bold m-1 text-white text-center'>Benvenuto, utente</p class='fw-bold'>
                                    <i class="fa-solid fa-caret-down" style="color: #ffffff;"></i>
                                </button>
                                <ul class="dropdown-menu  tw-p-2 ">
                                    <li><a class="dropdown-item fw-bold acc-color" href="{{route('login')}}">Login</a></li>
                                    <li><a class="dropdown-item fw-bold acc-color" href="{{route('register')}}">Registrati</a></li>
                                </ul>
                            </div>
                    @endauth
                </div>




                {{-- Seconda riga navbar --}}
                <button class="navbar-toggler  acc-bg col-12  " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span>
                        <img src={{Storage::url('icons/hamburger.svg')}} alt="IconaNavMobile" class="tw-h-[20px] tw-w-[20px]">
                    </span>
                </button>
                <div class="collapse navbar-collapse acc-bg tw-rounded   lg:tw-mt-0  tw-w-full tw-my-3" id="navbarSupportedContent">
                    <ul class="navbar-nav    tw-w-full lg:tw-text-center">
                        <li class="nav-item">
                            <a class="nav-link fw-bold " href="{{route('welcome')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold " href="{{route('product_index')}}">Store</a>
                        </li>
                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Brand
                            </a>
                            <div class="dropdown-menu dropdown-logo  tw-w-[90vw] lg:tw-w-[34vw]">
                                <ul class="row  list align-items-center ">
                                    <li class=" col-3" >
                                        <a value='0' class="dropdown-item nav-drop-item  d-flex align-items-center  justify-content-center p-3"  wire:click='search_brand({{0}})'>
                                            Tutti i brand
                                        </a>
                                    </li>
                                    @foreach ($brands as $brand )
                                    <li  class=" col-3 brandname position-relative d-flex justify-content-center">
                                        <a class="dropdown-item nav-drop-item  " wire:click='search_brand({{$brand->id}})'  >
                                            <img src={{asset('media/logo/logo'. $brand->id . '.webp')}} alt="" class="logo-nav brand-img " >
                                            <div class="brand-text d-none w-100 ">
                                                <h5 class="text-center text-dark">{{$brand->name}}</h5>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item dropdown  ">
                            <a class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categorie
                            </a>
                            <ul class="dropdown-menu lists p-2 lg:tw-w-full  tw-w-[90vw] ">
                                <li><a value='0' class="dropdown-item"  wire:click='search_category({{0}})'>Tutte le categorie</a></li>
                                @foreach ($categories as $category )
                                <li><a class="dropdown-item"  wire:click='search_category({{$category->id}})'>{{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="">Chi siamo</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
