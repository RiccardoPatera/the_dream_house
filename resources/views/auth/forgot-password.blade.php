<x-layout>
    <div class="container  ">
        @if (session('status'))
            <div class="text-center text-white acc-bg p-2 rounded">
        {{ session('status') }}
            </div>
    @endif
        <h1 class="display-5 text-center acc-color">Password dimenticata?</h1>
        <div class="row justify-content-center  h-100 p-2">
            <div class="col-12 col-lg-6 main-color rounded p-5 my-3">
                <form  method="POST" action="/forgot-password" class="tw-flex tw-flex-col">
                @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                    </div>
                    @error('email')
                        <span class="tw-bg-red-500 error text-white p-2 rounded tw-mt-2 ">{{ $message }}</span>
                    @enderror
                    <button type="submit" class="btn bg-light  mt-2">Conferma</button>
                </form>
                <h6 class=" my-3 text-light"><a class="text-light" href="{{route('login')}}">Torna al login</a></h6>
            </div>
        </div>
    </div>
</x-layout>
