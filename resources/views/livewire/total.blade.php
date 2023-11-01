<div>
    <button class="col-12 tw-border-none tw-rounded tw-flex tw-justify-between tw-items-center  tw-p-4 tw-bg-[color:var(--acc)]" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        <h6 class="tw-text-center tw-text-white">Riepilogo Carrello</h6>
        <div class="tw-text-white tw-flex tw-items-center">
            <h5 class="tw-mx-1  tw-flex tw-items-center">Totale: {{$total}} &euro;
                <i class="fa-solid tw-mx-2 fa-caret-down  " style="color: #ffffff;"></i>
            </h5>
        </div>
    </button>
    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <section >
                <div class="tw-full tw-grid tw-p-3 tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-5 tw-gap-3 ">
                    @foreach($user->cartitems as $cartitem)
                    <div class="tw-bg-[color:var(--acc)] tw-w-fit tw-p-3 tw-rounded">
                        <h6 class="tw-text-white tw-whitespace-break-spaces tw-break-all">{{$cartitem->product->title}}</h6>
                        <img src="{{Storage::url($cartitem->product->images->first()->url)}}" alt="product image" class="tw-w-[100%] tw-max-h-[300px] tw-object-scale-down">
                        <h6 class="tw-text-white tw-p-1 tw-text-center">Quantità: {{$cartitem->quantity}}</h6>
                        <h6 class="tw-text-center tw-text-white">Totale parziale: {{$cartitem->quantity * $cartitem->product->price}} &euro;</h6>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</div>