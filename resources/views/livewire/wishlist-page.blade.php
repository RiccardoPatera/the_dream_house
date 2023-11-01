<div>
    <div class="container-fluid">
        <h1 class="text-center  my-2 acc-color">La tua Wishlist</h1>
        <div class="row my-5">
            @forelse ($products->paginate(12) as $product )
                <div class="col-12 col-md-6 col-lg-3 my-3">
                    <div class="card-container">
                        <div class="card">
                            <div class="front-content z-n1">
                                <img src="{{Storage::url($product->images[0]->url)}}" class='img-box'>
                            </div>
                            <div class="content z-5">
                                <h6 class="  tw-whitespace-break-spaces tw-break-all text-white ">{{$product->title}}</h6>
                                <a href='{{route('product_detail',compact('product'))}}'class=" bg-light tw-font-bold tw-p-2 rounded text-black  tw-no-underline my-1 tw-cursor-pointer tw-border-2 tw-border-white tw-border-solid tw-text-center hover:tw-border-black tw-transition tw-ease-in-out tw-delay-150 hover:tw-translate-y-1 hover:tw-scale-110 tw-duration-300 col-8 tw-w-full">
                                Dettaglio</a>
                                <button wire:click='AddToCart(@js($product->id))'class="  bg-light tw-font-bold tw-p-2 rounded text-black  tw-no-underline my-1 tw-cursor-pointer tw-border-2 tw-border-white tw-border-solid tw-text-center hover:tw-border-black tw-transition tw-ease-in-out tw-delay-150 hover:tw-translate-y-1 hover:tw-scale-110 tw-duration-300 col-8 tw-w-full">
                                    Aggiungi al carrello
                                </button>
                                <button wire:click='favoriteRemove(@js($product->id))' class=" tw-bg-red-500 tw-font-bold tw-p-2 rounded text-black  tw-no-underline my-1 tw-cursor-pointer tw-border-2 tw-border-white tw-border-solid tw-text-center hover:tw-border-black tw-transition tw-ease-in-out tw-delay-150 hover:tw-translate-y-1 hover:tw-scale-110 tw-duration-300 tw-w-full">Rimuovi</button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <h3 class="text-center acc-color mt-2">Nessun Prodotto aggiunto ai Preferiti</h3>
                @endforelse
                <div class="tw-flex tw-justify-center tw-my-2">
                    {{$products->paginate(12)->links()}}
                </div>
        </div>
    </div>
</div>







