<form wire:submit.prevent='create' class="p-3">
    @if(session('message'))
        <div class="alert alert-success">
        <h6 class="text-center">Prodotto aggiunto correttamente</h6>
        </div>
    @endif
    <div class="mb-3">
        <label for="title" class="form-label">Titolo Prodotto</label>
        <input type="text" class="form-control" id="title" wire:model='title'>
        @error('title') <span class="error text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3 ">
        <label for="description" class="form-label">Descrizione</label>
        <textarea wire:model='description' id="description" cols="30" rows="10" class="form-control"></textarea>
        @error('description') <span class="error text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3 ">
        <label  for="price" class="form-label">Prezzo</label>
        <input type="number" class="form-control" id="price" wire:model='price'>
        @error('price') <span class="error text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3 ">
        <label  for="quantity" class="form-label">Quantità</label>
        <input type="text" class="form-control" id="quantity" wire:model='quantity'>
        @error('quantity') <span class="error text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3 ">
        <label  for="img" class="form-label">Immagine</label>
        <input type="file" class="form-control" id="img" wire:model='img' multiple>
        @error('img') <span class="error text-danger">{{ $message }}</span> @enderror
    </div>
    @if($img)
        <div class="tw-border-3 tw-border-solid tw-border-white tw-flex row tw-rounded tw-justify-start tw-p-3">
            @for($i=0; $i<count($img); $i++ )
                <div class="col-4 tw-object-contain tw-flex tw-flex-col tw-justify-between tw-p-2">
                    <img src="{{$img[$i]->temporaryUrl()}}" alt="img_temporay" class="img-fluid tw-object-contain img-thumbnail">
                    <a wire:click='delete_temp(@js($i))' class="tw-cursor-pointer tw-w-full tw-bg-red-600 tw-text-white tw-no-underline tw-text-center tw-p-2 tw-mt-2 tw-rounded">Elimina</a>
                </div>
            @endfor
        </div>
    @endif


    <div class="mb-3">
        <label  for="category">Categoria</label>
        <select  wire:model='category' id="category" class="form-select">
        @foreach ($categories as $category)
            <option value="{{$category->id}}" >{{ $category->name }}</option>
        @endforeach
        </select>
        @error('category') <span class="error text-danger">{{ $message }}</span> @enderror
    </div>



        <div class="mb-3">
            <label  for="brand">Brand</label>
            <select  wire:model='brand' id="brand" class="form-select">
                @foreach ($brands as $brand)
                    <option value="{{$brand->id}}" >{{ $brand->name }}</option>
                @endforeach
            </select>
            @error('brand') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>


        <div class="mb-3">
            <h6>Occasione</h6>
            <div class="tw-grid tw-grid-cols-4 tw-bg-white tw-p-2 tw-rounded">
                @foreach ($occurences as $occurence)
                <div class="tw-flex tw-justify-between tw-px-3">
                    <label  for={{$occurence->name}} >{{$occurence->name}} </label>
                    <input  wire:model='occurence' class="form-check-input" type="checkbox"  id={{$occurence->name}}   value="{{$occurence->id}}">
                </div>
                @endforeach
            </div>
            
            @error('occurence') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3 ">
            <label for="barcode" class="form-label">Codice a Barre</label>
            <input type="number" minlength="14" wire:model='barcode' id="barcode"  class="form-control">
            @error('barcode') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>
        {{-- <div class="mb-3">
            <h6>Colore</h6>
            <div class="tw-grid tw-grid-cols-4 tw-p-2 tw-bg-white tw-rounded">
                    @foreach ($colors as $color)
                    <div class="tw-flex tw-items-center tw-m-2">
                        <input  type="radio" wire:model='color' value={{$color->id}}  class="tw-w-7 tw-h-7 tw-py-2 " style='accent-color:{{$color->style}}; background-color:{{$color->style}}'>
                        <label class="tw-ml-2 tw-text-sm tw-font-medium">{{ucfirst($color->name)}}</label>
                    </div>
                    @endforeach
            </div>
            @error('color') <span class="error text-danger">{{ $message }}</span> @enderror
        </div> --}}
      <button type="submit" class="btn bg-light my-2">Conferma</button>
</form>
