<div>
    <div class="col-12 acc-bg p-3">
        <input class="form-control me-2" type="search" placeholder="Cerca" aria-label="Search" wire:model='search'>

    </div>
    <div class="col-12 table-responsive">

        <table class="table tw-my-10">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Numero ordine</th>
                <th scope="col">Importo</th>
                <th scope="col">Prodotti</th>
                <th scope="col">Indirizzo Spedizione</th>
                <th scope="col">Stato pagamento</th>
              </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
              <tr>
                <th scope="row">{{$order->id}}</th>
                <td>{{$order->users->first()->name}}</td>
                <td>{{$order->users->first()->email}}</td>
                <td>{{$order->id}}</td>
                <td>{{$order->total_price}}</td>
                <td>
                    <button class=" tw-border-none collapsed tw-bg-white  tw-grid tw-grid-cols-[95%_5%]" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$order->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
                         <h6 class="tw-text-center">Prodotti</h6>
                        <i class="fa-solid fa-caret-down" style="color: #000000;"></i>
                    </button>

                    <div id="flush-collapse{{$order->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                                <div>
                                @foreach ($order->products as $product )
                                        <a href="{{route('product_detail', $product->id)}}">{{$product->title}}</a>
                                @endforeach
                                    <p>{{$order->quantity}}</p>
                                </div>

                        </div>
                    </div>
                </td>
                <td>
                    <button class=" tw-border-none collapsed tw-bg-white  tw-grid tw-grid-cols-[95%_5%]" type="button" data-bs-toggle="collapse" data-bs-target="#shipping-{{$order->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
                        <h6 class="tw-text-center">Indirizzo Spedizione</h6>
                       <i class="fa-solid fa-caret-down" style="color: #000000;"></i>
                   </button>
                   <div id="shipping-{{$order->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <p>{{$order->shipping->address}}, {{$order->shipping->street_number}}</p>
                        <p>{{$order->shipping->city}}, {{$order->shipping->zip_code}}</p>
                        <p>{{$order->shipping->country}}, {{$order->shipping->state}}</p>
                    </div>
                </div>

                </td>
                @if($order->status=='unpaid')
                    <td>
                        <div class="tw-bg-red-600  tw-flex tw-justify-center  tw-h-fit tw-rounded">
                        <p class="tw-text-white">Non Pagato</p>
                        </div>
                    </td>
                @else
                    <td>
                        <div class="tw-bg-green-600 tw-flex tw-justify-center  tw-h-fit tw-rounded tw-text-white">
                            <p>Pagato</p>
                        </div>

                    </td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>
</div>
