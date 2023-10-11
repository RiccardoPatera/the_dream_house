<div class="tw-flex  tw-flex-col tw-justify-center">
    @if ($product->quantity>0)
        <h2 >{{$product->price}}&euro;</h2>
        <p>Consegna GRATUITA , su ordini superiori ai 70€.</p>
        <div class="tw-flex  tw-content-center">
            <div  id='supply' class= {{($product->quantity>0)? "tw-bg-green-500 tw-my-2" : "tw-bg-red-500 tw-my-2"}}></div>
            <h4 class="tw-ms-3">Disponibilità Immediata</h4>
        </div>

        <label  for="quantity"  class="p-1"><p class="p-0">Quantità massima: {{$product->quantity}} pz</p></label>
        <div class="tw-flex">
            <button  class='tw-px-3 tw-rounded acc-bg tw-text-white tw-me-1 tw-border-white tw-font-bold' wire:click='remove'>-</button>
            <input readonly="readonly"  class="form-control tw-appearance-none  tw-text-center tw-font-bold" input='number' wire:model='quantity' id="quantity" max={{$product->quantity}}>
            <button class='tw-px-3 tw-rounded acc-bg tw-text-white tw-ms-1 tw-border-white tw-font-bold' wire:click='add'>+</button>
        </div>
        @error('quantity') <span class="error tw-border-white tw-border-2 tw-border-solid acc-bg tw-text-white tw-rounded tw-p-2 tw-text-center tw-w-full tw-mt-2 tw-font-bold">{{ $message }}</span> @enderror
        <div class="tw-mt-10">
            <button wire:click='addtocart' class="bg-light tw-font-bold tw-p-2 rounded text-black  tw-no-underline my-1 tw-cursor-pointer tw-border-2 tw-border-white tw-border-solid tw-text-center w-100 tw-mt-40 hover:tw-border-black tw-transition tw-ease-in-out tw-delay-150 hover:tw-translate-y-1 hover:tw-scale-105 tw-duration-300 ">Aggiungi al carrello</button>
        </div>
    @else
        <form wire:submit.prevent='contact'>
            <h2 >{{$product->price}}&euro;</h2>
            <p>Consegna GRATUITA , su ordini superiori ai 70€. </p>
            <div class="tw-flex tw-content-center">
                <div  id='supply' class= {{($product->quantity>0)? "tw-bg-green-500" : "tw-bg-red-500"}}>
                </div>
                <h3>Non Disponibile</h3>
            </div>
            <h5 class="mt-5">Avvisami quando sarà disponibile</h5>
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" aria-describedby="emailHelp" wire:model="email">
            <button class="btn btn-light acc-color mt-2">Conferma</button>
        </form>
    @endif
    {{-- @if(!count($favorite->where('markable_id' , $product->id))>=1) --}}
        <a wire:click='AddtoFav(@js($product->id))' class="bg-light tw-font-bold tw-p-2 rounded text-black  tw-no-underline my-1 tw-cursor-pointer tw-border-2 tw-border-white tw-border-solid tw-text-center hover:tw-border-black tw-transition tw-ease-in-out tw-delay-150 hover:tw-translate-y-1 hover:tw-scale-105 tw-duration-300 ">Aggiungi ai preferiti <i class="fa-solid fa-heart fa-xl" style="color: #eb0505;"></i></a>
    {{-- @endif --}}
    </div>
