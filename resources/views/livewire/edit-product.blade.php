<form wire:submit.prevent='edit' class="my-3">
    @if(session('message'))
    <div class="alert alert-success">
       <h6 class="text-center">Prodotto modificato correttamente</h6>
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
       <input type="text" class="form-control" id="price" wire:model='price'>
       @error('price') <span class="error text-danger">{{ $message }}</span> @enderror
     </div>
     <div class="mb-3 ">
        <label  for="quantity" class="form-label">Quantità</label>
        <input type="text" class="form-control" id="quantity" wire:model='quantity'>
        @error('quantity') <span class="error text-danger">{{ $message }}</span> @enderror
      </div>
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
        <label  for="occurence">Occasione</label>
        <select  wire:model='occurence' id="occurence" class="form-select">
            @foreach ($occurences as $occurence)
                <option value="{{$occurence->id}}" >{{ $occurence->name }}</option>
            @endforeach
        </select>
        @error('occurence') <span class="error text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="mb-3 ">
        <label for="barcode" class="form-label">EAN</label>
        <input wire:model='barcode' id="barcode"  class="form-control">
        @error('barcode') <span class="error text-danger">{{ $message }}</span> @enderror
    </div>

     <button type="submit" class="btn bg-light my-2">Conferma</button>
</form>
