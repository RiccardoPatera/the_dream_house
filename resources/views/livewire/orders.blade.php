<div class="tw-min-h-screen">
    <form wire:submit.prevent='search' class="tw-w-full tw-flex  acc-bg tw-p-3 tw-rounded">
        <div class="form-group tw-flex tw-justify-between tw-w-full tw-items-center">
            <label class="active tw-text-white tw-font-bold" for="dateStandard">Ricerca per data</label>
            <input type="date" id="dateStandard" wire:model='date' class="tw-p-1 tw-rounded tw-ms-2">
            <button class="tw-rounded tw-border-none tw-px-2 tw-py-1 tw-ms-auto">Cerca</button>
        </div>
    </form>
    
    <div class="col-12 table-responsive">

        <table class="table tw-my-10">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Cognome</th>
                <th scope="col">Email</th>
                <th scope="col">Numero ordine</th>
                <th scope="col">Importo</th>
                <th scope="col">Prodotti</th>
                <th scope="col">Indirizzo Spedizione</th>
                <th scope="col">Data</th>
                <th scope="col">Stato pagamento</th>
              </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
              <tr>
                <th scope="row">{{$order->id}}</th>
                <td>{{$order->user->name}}</td>
                <td>{{$order->user->surname}}</td>
                <td>{{$order->user->email}}</td>
                <td>{{$order->id}}</td>
                <td>{{$order->total_price}}</td>
                <td>
                    <button class=" tw-border-none collapsed tw-bg-white  tw-grid tw-grid-cols-[95%_5%]" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$order->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
                         <h6 class="tw-text-center">Prodotti</h6>
                        <i class="fa-solid fa-caret-down" style="color: #000000;"></i>
                    </button>

                    <div id="flush-collapse{{$order->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                                <div class="tw-grid tw-grid-cols-2">
                                @foreach ($order->orderedproducts as $orderedproduct )
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Prodotto</th>
                                            <th scope="col">Quantità</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope='row'>
                                                <a class=" tw-text-sm  tw-p-1  tw-whitespace-nowrap " href="{{route('product_detail', $orderedproduct->product->id)}}">{{$orderedproduct->product->title}}</a>
                                            </td>
                                            <td scope='row'>
                                                <p class=" tw-text-sm   tw-p-1">
                                                    {{$orderedproduct->quantity}}</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                @endforeach
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
                        <p>{{$order->shipping->country}},
                            <span>
                                @if($order->shipping->state=='FR')
                                Francia
                                @elseif($order->shipping->state=='IT')
                                Italia
                                @else
                                Spagna
                                @endif
                            </span>
                        </p>
                    </div>
                </div>

                </td>
                <td>
                    {{$order->created_at}}
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
