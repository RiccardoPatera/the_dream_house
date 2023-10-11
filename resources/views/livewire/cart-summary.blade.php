<div class="col-12 col-lg-8  justify-content-center  ">
        <h5 class=" fw-semibold my-3 text-center acc-color">{{count($cartitems)}} prodott{{(count($cartitems))== 1 ? 'o' :'i' }} nel carrello</h5>
        <div class="row m-2   ">
            @forelse($cartitems as $cartitem)
            <div class="col-12 acc-bg  my-4 tw-border-white tw-border-solid p-3 tw-rounded  tw-relative">
                <div class="row">
                    <div class="col-12 tw-flex tw-justify-center ">
                        <a wire:click="cart_redirect({{$cartitem->product->id}})" class="tw-cursor-pointer text-decoration-none ">
                            <h4 class="text-white">{{ $cartitem->product->title }}</h4>
                        </a>
                    </div>
                    <div class="col-6 mt-2 tw-flex tw-items-center tw-justify-center ">
                            <img src="{{Storage::url( $cartitem->product->images->first()->url ) }}" class=" img-fluid object-fit-contain main-color tw-max-h-[30vh] " />
                    </div>
                    <div class=" col-6 mt-2 d-flex flex-column justify-content-between p-2">
                        <h6 class=" text-white  text-center">Prezzo Unitario
                            <div class="tw-rounded tw-p-2 tw-bg-white tw-text-black mt-1">
                                {{ $cartitem->product->price }}&euro; cad.
                            </div>
                        </h6>
                        <h6 class=" text-white  text-center">Totale parziale
                            <div class="tw-rounded tw-p-2 tw-bg-white tw-text-black mt-1">
                                {{ $cartitem->product->price *$cartitem->quantity }} &euro;
                            </div>
                        </h6>
                        <label for="cart_quantity " class="text-white tw-p-0 tw-m-0">
                            <h6 class=" text-white  text-center">Quantità</h6>
                        </label>
                        <div class="col-12 tw-p-0 tw-m-0">
                            <div class="tw-grid tw-grid-cols-[50px_1fr_50px] gap-2 tw-items-center tw-p-0 ">
                                <button  class='tw-px-3 tw-rounded bg-white tw-text-black tw-font-bold tw-border-white' wire:click='remove_qt(@js($cartitem->id))'>-</button>
                                <input readonly="readonly" class="form-control tw-appearance-none text-center tw-font-bold  tw-m-0 " input='number' value={{$cartitem->quantity}}  id="quantity" max={{$cartitem->product->quantity}}>
                                <button class='tw-px-3 tw-rounded bg-white tw-text-black tw-font-bold tw-border-white' wire:click='add_qt(@js($cartitem->id))'>+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="cart-delete  " wire:click='remove( @js($cartitem->id) )' data-bs-dismiss="offcanvas" aria-label="Close" >
                    <img src={{asset('media/icon/delete.svg')}}  class='img-fluid cart-delete ' alt="">
                </button>
            </div>



            @empty
            <div class="col-12  tw-h-full text-light tw-flex tw-justify-center tw-mt-[10%]">
                <div class="d-flex justify-content-center align-items-center flex-column acc-bg tw-p-10 rounded ">
                    <h5 class="text-center"> Nessun Prodotto nel carrello!</h5>
                    <h5 class="text-center"> Visualizza il nostro catalogo per aggiungere prodotti al tuo carrello </h5>
                    <a  class=' ms-1 p-2 bg-light acc-color rounded text-decoration-none d-flex align-items-center tw-mt-5' href="{{route('product_index')}}">Catalogo</a>
                </div>
            </div>
            @endforelse
            @if(count($cartitems)>0)
                <div class="col-lg-12 col-sm-12 col-12 total-section text-right d-flex  mt-5 justify-content-between ">
                    <h4 class="ms-2 acc-color fw-bold ">Totale:{{ $total }}&euro;</h4>
                    {{-- <a class='text-decoration-none acc-bg acc-color p-2 rounded tw-border tw-border-white text-white' href="{{route('stripe')}}">Procedi all'acquisto</a> --}}
                    <button wire:click='checkout' class="acc-bg acc-color p-2 rounded tw-border-none text-white">Procedi all'acquisto</button>
                </div>
            @endif
        </div>
</div>

