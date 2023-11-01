<aside>
    <div class="container-fluid tw-min-h-screen  tw-grid tw-grid-cols-1 lg:tw-grid-cols-[1fr_3fr] tw-py-3">
        
        
        {{-- Colonna Filtri Ricerca  LargeScreen--}}
        <div class=" p-3   main-color tw-min-h-screen d-none d-lg-flex flex-col tw-rounded">
            <form wire:submit.prevent='search' class="tw-flex tw-flex-col  ">
                <h4 class="tw-text-white tw-text-center">Filtri Ricerca</h4>
                <input type="text" class="form-control" id="floatingInput" placeholder="Ricerca" wire:model='search'>
                <h5 class="mt-2 tw-text-white">Categorie</h5>
                <select class="form-select mt-2" aria-label="Default select example" wire:model="category">
                    <option {{($brand==0) ? 'selected' : ''}}  value=0>Tutte le Categorie</option>
                    @foreach ($categories as $category)
                    <option  type="checkbox" id="{{$category->name}}"   value={{$category->id}}>{{$category->name}}</option>
                    @endforeach
                </select>
                <h5 class="mt-2 tw-text-white ">Brand</h5>
                <select class="form-select mt-2" aria-label="Default select example" wire:model="brand">
                    <option {{($brand==0) ? 'selected' : ''}} value=0 >Tutti i Brand</option>
                    @foreach ($brands as $brand)
                    <option  type="checkbox" id="{{$brand->name}}" value={{$brand->id}}>{{$brand->name}}</option>
                    @endforeach
                </select>
                <h5 class="mt-2 tw-text-white ">Occasioni</h5>
                <select class="form-select mt-2" aria-label="Default select example" wire:model="occurence">
                    <option {{($occurence==0) ? 'selected' : ''}} value=0 >Tutte le Occasioni</option>
                    @foreach ($occurences as $occurence)
                    <option  type="checkbox" id="{{$occurence->name}}" value={{$occurence->id}}>{{$occurence->name}}</option>
                    @endforeach
                </select>
                <div class="tw-border-solid tw-border-white rounded  tw-p-3 tw-mt-3">
                    <h5 class=" tw-text-white tw-text-xl">Prezzo</h5>
                    <div class="price-input">
                        <div class="field">
                            <span>Min</span>
                            <input type="number" class="input-min"  wire:model='min_price'>
                            <span class="tw-p-1">&euro;</span>
                        </div>
                        <div class="separator tw-text-white">-</div>
                        <div class="field">
                            <span>Max</span>
                            <input type="number" class="input-max"  wire:model='max_price' >
                            <span class="tw-p-1">&euro;</span>
                        </div>
                    </div>
                    <div class="slider">
                        <div class="progress"></div>
                    </div>
                    <div class="range-input">
                        <input type="range" class="range-min" min="0" max={{$products_max_price}} step="1" wire:model='min_price'>
                        <input type="range" class="range-max" min="0" max={{$products_max_price}}  step="1" wire:model='max_price'>
                    </div>
                </div>
                <button class="acc-bg tw-border-none  text-white w-100  mt-2 tw-text-xl tw-rounded tw-p-2 ">Cerca</button>
            </form>
        </div>
        
        
        {{-- Info Ricerca --}}
        <div  class="  tw-px-5  ">
            <div class="row  justify-content-center  ">
                <button class="lg:tw-hidden tw-border-none acc-bg tw-rounded tw-p-2 w-100 tw-text-white " type="button" data-bs-toggle="offcanvas" data-bs-target="#MobileFilters" aria-controls="offcanvasBottom">Filtri Ricerca</button>
                <div class="col-12 tw-flex tw-justify-between main-color tw-rounded tw-flex-col tw-p-2 tw-mt-2 lg:tw-mt-0 ">
                    <div class="row tw-p-2 tw-justify-center">
                        <h6 class="tw-text-white tw-text-center col-12 tw-whitespace-nowrap col-12 tw-font-semibold">Ricerca attuale: </h6>
                        <p class="text-center  lg:tw-rounded  tw-bg-white tw-p-1 m-1 col-4 ">{{ $brand_searched }}</p>
                        <p class="text-center  lg:tw-rounded  tw-bg-white tw-p-1 m-1 col-4 ">{{ $category_searched }}</p>
                        <p class="text-center  lg:tw-rounded  tw-bg-white tw-p-1 m-1 col-4 ">{{ $occurence_searched }}</p>
                        <p class="text-center  lg:tw-rounded  tw-bg-white tw-p-1 m-1 col-4 ">{{ $searched }}</p>
                        <p class="text-center  lg:tw-rounded  tw-bg-white tw-p-1 m-1 col-4  tw-whitespace-nowrap ">Range: {{ $range_min_searched}} - {{$range_max_searched}} &euro;</p>
                        <p class="text-center  lg:tw-rounded tw-text-white tw-p-1 m-1 col-12 tw-text-xl tw-font-bold">{{ (count($products))==1 ?  count($products) . ' Risultato' : count($products) . ' Risultati' }}</p>
                    </div>
                </div>
                
                
                
                {{-- OffCanvas Filter --}}
                <div class="tw-grid tw-grid-col-1 tw-mt-3 lg:tw-hidden ">
                    <div wire:ignore.self class="offcanvas offcanvas-mobile offcanvas-bottom d-lg-block" tabindex="-1" id="MobileFilters" aria-labelledby="MobileFilters" data-bs-scroll="true">
                        <div class="offcanvas-header ">
                            <h5 class="offcanvas-title" id="MobileFiltersLabel">Filtri Ricerca</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body " >
                            <form wire:submit.prevent='search'>
                                <input type="text" class="form-control" id="floatingInput" placeholder="Ricerca" wire:model='search'>
                                <h5 class="mt-2 ">Categorie</h5>
                                <select class="form-select mt-2" aria-label="Default select example" wire:model="category">
                                    <option {{($brand->id == 0) ? 'selected' : ''}}  value=0>Tutte le Categorie</option>
                                    @foreach ($categories as $category)
                                    <option  type="checkbox" id="{{$category->name}}"   value={{$category->id}}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <h5 class="mt-2  ">Brand</h5>
                                <select class="form-select mt-2" aria-label="Default select example" wire:model="brand">
                                    <option {{($brand->id == 0) ? 'selected' : ''}} value=0 >Tutti i Brand</option>
                                    @foreach ($brands as $brand)
                                    <option  type="checkbox" id="{{$brand->name}}" value={{$brand->id}}>{{$brand->name}}</option>
                                    @endforeach
                                </select>
                                <h5 class="mt-2">Occasioni</h5>
                                <select class="form-select mt-2" aria-label="Default select example" wire:model="occurence">
                                    <option {{($occurence->id ==0) ? 'selected' : ''}} value=0 >Tutte le Occasioni</option>
                                    @foreach ($occurences as $occurence)
                                    <option  type="checkbox" id="{{$occurence->name}}" value={{$occurence->id}}>{{$occurence->name}}</option>
                                    @endforeach
                                </select>
                                <div class="tw-border-solid tw-border-white rounded  tw-p-3 tw-mt-3">
                                    <h5 class="  tw-text-xl">Prezzo</h5>
                                    <div class="price-input">
                                        <div class="field">
                                            <span class='text-black'> Min </span>
                                            <input type="number" class="input-min"  wire:model='min_price'>
                                            <span class="tw-p-2 text-black">&euro;</span>
                                        </div>
                                        <div class="separator text-black ">-</div>
                                        <div class="field">
                                            <span class='text-black'> Max </span>
                                            <input type="number" class="input-max"  wire:model='max_price' >
                                            <span class="tw-p-2 text-black">&euro;</span>
                                        </div>
                                    </div>
                                    <div class="slider">
                                        <div class="progress"></div>
                                    </div>
                                    <div class="range-input">
                                        <input type="range" class="range-min" min="0" max="{{$products_max_price}}" step="1" wire:model='min_price'>
                                        <input type="range" class="range-max" min="0" max="{{$products_max_price}}"  step="1" wire:model='max_price'>
                                    </div>
                                </div>
                                <button class="acc-bg tw-border-solid tw-border-2 tw-border-white w-100   tw-p-2 text-white" >Cerca</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                {{-- Prodotti --}}
                @forelse ($products->paginate(9) as $product )
                <div class="col-12 mb-3 main-color rounded mt-2">
                    <div class="row  d-lg-flex tw-h-full p-2  tw-my-2">
                        <div class=" col-6 col-lg-4 tw-text-center tw-flex tw-flex-col  tw-justify-evenly tw-content-center  ">
                            <h6 class=" tw-whitespace-break-spaces tw-break-all tw-text-center  tw-font-bold t  lg:tw-hidden">{{$product->title}}</h6 >
                                <img src="{{Storage::url($product->images[0]->url)}}" class='img-fluid object-fit-contain main-color tw-max-h-[30vh] '>
                            </div>
                            
                            <div class=" col-0 col-lg-4  tw-flex-col d-none d-lg-flex tw-justify-between md:tw-justify-end tw-items-center tw-mt-7 md:tw-mt-0 ">
                                <div class="row tw-grid tw-grid-row-2 tw-items-center tw-justify-center tw-text-center tw-h-full">
                                    <h4 class=" tw-whitespace-pre-wrap tw-break-all tw-text-center  tw-font-bold">{{$product->title}}</h4 >
                                    <div class="tw-flex tw-flex-col tw-items-center">
                                        @foreach ( $product->categories as $category )
                                        <p class="rounded acc-bg p-1  tw-text-white col-9  tw-text-center tw-h-fit">{{$category->name}}</p>
                                        @endforeach
                                        @foreach ( $product->brands as $brand )
                                        <p class="rounded acc-bg p-1  tw-text-white col-9  tw-text-center tw-h-fit" >{{$brand->name}}</p>
                                        @endforeach
                                        @if(count($product->occurences)>1)
                                        <p class="rounded acc-bg p-1   tw-text-center   tw-text-white col-9  tw-h-fit tw-flex tw-justify-center tw-items-center " >{{count($product->occurences)}} occasioni  
                                            <button type="button" class=" tw-ms-1 tw-text-white acc-bg tw-border-solid tw-rounded-full tw-flex tw-items-center tw-border-1 tw-border-white  tw-h-[20px] tw-w-[20px] " data-bs-toggle="popover" data-bs-title="Occasioni" 
                                            data-bs-content="
                                            @foreach($product->occurences as $key=>$occurence) 
                                                {{$product->occurences[$key]->name}}
                                            @endforeach
                                            ">i
                                            </button>
                                        </p>
                                        @else
                                            <p class="rounded acc-bg p-1  tw-text-white col-9  tw-text-center tw-h-fit" >{{$product->occurences->first()->name}}</p> 
                                        @endif
                                    </div>
                                </div>
                                </div>
                                <div class=" col-6 col-lg-4 tw-flex tw-flex-col tw-items-center tw-content-center tw-justify-center">
                                    <p class="card-price tw-font-bold">{{$product->price}}&euro;</p>
                                    <div class="tw-flex tw-items-center tw-align-middle">
                                        <div  id='supply' class= {{($product->quantity>0)? "tw-bg-green-500" : "tw-bg-red-500"}}>
                                        </div>
                                        @if($product->quantity>0)
                                        <h6 class="tw-flex tw-align-middle mt-2 ms-1 p-2 tw-font-bold">Disponibile</h6>
                                        @else
                                        <h6 class="tw-flex tw-align-middle mt-2 ms-1 p-2 tw-font-bold">Non Disponibile</h6>
                                        @endif
                                    </div>
                                    <div class="row tw-justify-center ">
                                        <a href="{{route('product_detail',compact('product'))}}" class=" col-10 bg-light tw-p-2 rounded text-black  tw-no-underline my-1 tw-cursor-pointer tw-border-2 tw-border-white tw-border-solid tw-text-center hover:tw-border-black tw-transition tw-ease-in-out tw-delay-150 hover:tw-translate-y-1 hover:tw-scale-105 tw-duration-300">
                                            Dettaglio
                                        </a>
                                        <a wire:click='AddtoFav(@js($product->id))' class=" col-10 bg-light tw-p-2 rounded text-black  tw-no-underline my-1 tw-cursor-pointer tw-border-2 tw-border-white tw-border-solid tw-text-center hover:tw-border-black tw-transition tw-ease-in-out tw-delay-150 hover:tw-translate-y-1 hover:tw-scale-105 tw-duration-300  tw-whitespace-nowrap">
                                            Aggiungi ai preferiti <i class="fa-solid fa-heart fa-md" style="color: #eb0505;"></i>
                                        </a>
                                        <a {{$product->quantity<1 ? 'disabled' : ''}} wire:click='AddToCart(@js($product->id))'class="col-10 bg-light  tw-p-2 rounded text-black  tw-no-underline my-1 tw-cursor-pointer tw-border-2 tw-border-white tw-border-solid tw-text-center hover:tw-border-black tw-transition tw-ease-in-out tw-delay-150 hover:tw-translate-y-1 hover:tw-scale-105 tw-duration-300">
                                            Aggiungi al carrello
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class=" tw-flex tw-flex-col tw-justify-center tw-mt-32">
                            <h3 class="text-center acc-color tw-p-2">Nessun Prodotto Trovato</h3>
                            <h3 class="text-center acc-color tw-p-2">Prova a cambiare la tua ricerca</h3>
                        </div>
                    </div>
                    @endforelse
                    <div class="d-flex justify-content-center mt-3">
                        {{$products->paginate(9)->links()}}
                    </div>
                </div>
            </div>
        </aside>
        