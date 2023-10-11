 <div wire:ignore.self class="offcanvas offcanvas-end tw-h-screen " tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel" aria-labelledby="offcanvasRightLabel" data-bs-backdrop="static"">
    <div class="offcanvas-header ">
      <h5 class="offcanvas-title acc-color fw-bold" id="offcanvasRightLabel">Carrello</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" ></button>
    </div>
    <div class="offcanvas-body tw-h-screen ">
      @if (Auth::user())
          @if(Auth::user()->cartitems)
              <h5 class="acc-color fw-semibold my-3 text-center ">{{count(Auth::user()->cartitems)}} prodott{{(count(($cartitems))==1? 'o' :'i')}} nel carrello</h5>
                @foreach($cartitems as $cartitem)

                <div class="row cart-card p-1  acc-bg flex  mt-2 tw-relative ">
                  <div class="col-12 d-flex justify-content-center">
                      <h6 class="text-white">{{$cartitem->product->title}}</h6>
                  </div>
                  <div class="col-12 d-flex align-items-center ">
                      <a class="pe-auto d-flex w-100 tw-cursor-pointer" wire:click="cart_redirect({{$cartitem->product->id}})">
                          <img src="{{Storage::url($cartitem->product->images()->first()->url) }}" class=" img-fluid tw-max-h-32 tw-w-full tw-object-contain" />
                      </a>
                  </div>
                  <div class="col-12 tw-flex tw-flex-col  tw p-1">
                      <div class="row">
                          <div class="col-6">
                              <h6 class=" text-white ">Prezzo Unitario:
                                  <div class="tw-rounded tw-font-bold text-center tw-p-2 tw-bg-white tw-text-black mt-1">
                                      {{ $cartitem->product->price }}&euro; cad.
                                  </div>
                              </h6>
                          </div>
                          <div class="col-6">
                              <h6 class=" text-white ">Totale parziale:
                                  <div class="tw-rounded tw-font-bold text-center tw-p-2 tw-bg-white tw-text-black mt-1">
                                      {{ $cartitem->product->price * $cartitem->quantity}} &euro;
                                  </div>
                              </h6>
                          </div>
                          <div class="col-12">
                              <div class="tw-grid tw-grid-cols-[50px_1fr_50px] gap-2 tw-items-center ">
                                  <button  class='tw-px-3 tw-rounded bg-white tw-text-black tw-font-bold  tw-border-white' wire:click='remove_qt(@js($cartitem->id))'>-</button>
                                  <input readonly="readonly" class="form-control tw-appearance-none tw-text-center tw-font-bold" input='number' value={{$cartitem->quantity}}  id="quantity" max={{$cartitem->product->quantity}}>
                                  <button class='tw-px-3 tw-rounded bg-white tw-text-black tw-font-bold  tw-border-white' wire:click='add_qt(@js($cartitem->id))'>+</button>
                              </div>
                              <button class="cart-delete" wire:click='remove( @js($cartitem->id) )' data-bs-dismiss="offcanvas" aria-label="Close" >
                                  <img src={{asset('media/icon/delete.svg')}}  class='img-fluid cart-delete' alt="">
                              </button>
                          </div>
                      </div>
                  </div>
            </div>
              @endforeach
              @if (count($cartitems)>0)
                  <div class="tw-grid tw-grid-cols-2 tw-justify-between tw-items-center  tw-w-full  tw-my-5 tw-px-5  ">
                          <h4 class=" acc-color fw-bold tw-flex tw-items-center tw-me-auto">Totale: {{ $total }}&euro;</h4>
                          <a  class='text-decoration-none tw-ms-auto  acc-bg text-white rounded tw-w-fit tw-p-3  tw-flex tw-items-center' href="{{route('cartsummary')}}">Checkout</a>
                  </div>
              @endif
          @else
          <h6  class="acc-color fw-bold">Non hai ancora aggiunto nessun prodotto al tuo carrello</h6>
              @if(!Route::is('product_index'))
                  <div class="tw-flex tw-flex-col mt-5">
                      <h6  class="acc-color fw-bold d-flex align-items-center">Per aggiungere un prodotto consulta il nostro
                      </h6>
                      <a href="{{route('product_index')}}" class="acc-bg tw-rounded tw-p-2 tw-no-underline tw-text-white  tw-w-full tw-text-center">
                          Catalogo
                      </a>
                  </div>
              @endif
          @endif
          @else
          <div class="tw-flex tw-flex-col">
              <h6 class="tw-font-bold acc-color">Devi essere loggato per aggiungere prodotti al tuo carrello </h6>
              <a  class="acc-bg tw-text-white tw-p-3 tw-no-underline tw-rounded tw-m-2 text-center" href="{{route('login')}}">Login</a>
          </div>
          @endif
          </div>
      </div>
