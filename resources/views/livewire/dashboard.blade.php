<div class="tw-min-h-screen">
@if(session('message'))
        <div class="alert acc-bg">
            <h6 class="text-center text-white">{{session('message')}}</h6>
        </div>
    @endif
    @if(session('deleted'))
        <div class="alert acc-bg">
            <h6 class="text-center text-white">{{session('deleted')}}</h6>
        </div>
    @endif
    <div class="container-fluid">
        <h1 class="text-center  my-2 acc-color">Prodotti caricati</h1>
        <div class="row my-5">
            <div class="col-12 acc-bg p-3">
                <input class="form-control me-2" type="search" placeholder="Cerca" aria-label="Search" wire:model='search'>
            </div>
            @forelse ($products->paginate(12) as $product )
            <div class="col-12 col-md-6 col-lg-3 my-3">
                <div class="card-container">
                    <div class="card">
                        <div class="front-content z-n1">
                        <img src="{{Storage::url($product->images[0]->url)}}" class='img-box'>
                        </div>
                        <div class="content z-5">
                            <p class="heading text-white ">{{$product->title}}</p>
                            @foreach ( $product->categories as $category )
                                <div class="row w-100 justify-content-evenly align-items-evenly ">
                                    <p class="rounded bg-white p-1  acc-color col-9 text-nowrap">{{$category->name}}</p>
                            @endforeach
                            @foreach ( $product->brands as $brand )
                                    <p class="rounded bg-white p-1  acc-color col-9 text-nowrap">{{$brand->name}}</p>

                            @endforeach
                                    <div class="d-flex   align-items-center w-100  ">
                                        <a href="{{route('edit',compact('product'))}}" class="btn btn-warning col-6 text-light m-1">Modifica</a>
                                        <a href="#" class="btn btn-danger col-6 m-1" data-bs-toggle="modal" data-bs-target="#product{{$product->id}}">Elimina</a>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
                @empty
                  <h3 class="text-center acc-color mt-2">Nessun Prodotto Trovato</h3>
                @endforelse
                <div class="tw-flex tw-justify-center tw-my-2">
                    {{$products->paginate(12)->links()}}
                </div>
        </div>
    </div>

    @foreach ($products as $product )
    <div class="modal fade" id="product{{$product->id}}" tabindex="-1" aria-labelledby="ProductDelete" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h1 class="modal-title fs-5 " id="exampleModalLabel">Eliminazione Articolo</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             Sei sicura di voler cancellare l'articolo?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <form  method="POST" action="{{route('delete',compact('product'))}}">
                    @csrf
                    @method('delete')
                    <button  class="btn btn-danger">Elimina</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endforeach
<div>
