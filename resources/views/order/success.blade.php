<x-layout>
    <div class="container  tw-p-5 tw-text-white tw-min-h-[100vh] ">
      <div class="row tw-bg-[color:var(--acc)] tw-p-3  ">
          <h1 class="text-xl  text-center tw-font-bold">Grazie per il tuo ordine!</h1>
          <h6 class="text-center">
            Apprezziamo il tuo ordine! Riceverai presto una mail di conferma dell'ordine
          </h6>
          <div class="tw-grid tw-grid-cols-1 tw-justify-center tw-items-center">
            <h3 class="text-center">Riepilogo Ordine</h3>
            <div class="tw-grid md:tw-grid-cols-2 tw-grid-cols-1 tw-gap-7  tw-border-white tw-border-2 tw-rounded tw-border-solid tw-p-3 ">
              <div class="tw-grid tw-grid-cols-3 tw-gap-6  " >
                @foreach($order->orderedproducts as $orderedproduct)
                  <div class="tw-rounded tw-h-full  tw-flex tw-flex-col tw-justify-center ">
                    <h6 class="text-center">{{$orderedproduct->product->title}}</h6>
                    <img src={{Storage::url($orderedproduct->product->images->first()->url)}} alt="" class='tw-max-[100%] tw-max-w-[100%] tw-rounded-full'>
                    <h6 class="text-center"> Quantità: {{$orderedproduct->quantity}} </h6>
                  </div>
                @endforeach
              </div>
          
              <div class="tw-bg-white shadow tw-p-3 tw-rounded tw-text-black ">
                <h3 class="text-center">Dettagli Spedizione</h3>
                <h5 class="tw-mt-10">Nome: {{$order->user->name}}</h5>
                <h5 >Cognome:{{$order->user->surname}}</h5>
                <h5>Email: {{$order->user->email}}</h5>
                <h5>Indirizzo spedizione: {{$order->shipping->address}} , {{$order->shipping->street_number}} </h5>
                <div>
                  <h5>
                    {{$order->shipping->city}} , {{$order->shipping->country}}, 
                    <span>
                      @if($order->shipping->state=='FR')
                        Francia
                      @elseif($order->shipping->state=='IT')
                        Italia
                      @else
                        Spagna
                      @endif
                    </span>
                  </h5>
                </div>
              </div>

            </div>
            <div class="tw-mt-7 tw-flex  tw-flex-col tw-justify-center tw-text-center">
              <h4>Per info e contatti</h4>
              <a class="tw-text-white  text-center" href="mailto:thedreamhouseinterior@gmail.com">thedreamhouseinterior@gmail.com</a>
            </div>
          </div>
      </div>
    </div>
</x-layout>
