<x-layout>
    <div class="container p-5">
        <div class="row justify-content-center ">
            <h1 class="display-5 text-center my-2 acc-color"> Modifica prodotto</h1>
            <div class="col-md-6 col-12 main-color p-3 rounded">
                @livewire('edit-product',compact('product'))
            </div>
        </div>
    </div>
</x-layout>
