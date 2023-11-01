<x-layout>
    <div class="container  ">
        @if(session('mustlog'))
            <div class="text-center alert acc-bg text-white ">
                {{session('mustlog')}}
            </div>
        @endif
        @if (session('status'))
            <div class="text-center alert acc-bg text-white">
                {{ session('status') }}
            </div>
        @endif
        <h1 class="display-5 text-center acc-color ">Login</h1>
        <div class="row justify-content-center  h-100 p-2">
            <div class="col-12 col-lg-6 main-color rounded p-5 my-3">
                <form  method="POST" action="{{route('login')}}" class="tw-flex tw-flex-col">
                @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label tw-font-bold acc-color">Email</label>
                        <input type="text" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                    </div>
                    @error('email')
                        <span class="tw-bg-[color:var(--acc)] error text-white p-2 rounded tw-my-2 ">{{ $message }}</span>
                    @enderror

                    <div class="mb-3 mt-2">
                    <label for="password" class="form-label tw-font-bold acc-color">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    </div>
                    @error('password')
                     <span class="tw-bg-[color:var(--acc)] error text-white p-2 rounded tw-my-2">{{ $message }}</span>
                    @enderror
                    <button type="submit" class="acc-bg tw-border-none w-100  tw-rounded  tw-p-2 text-white  mt-2">Conferma</button>
                </form>
                <h6 class=" my-3 tw-font-bold text-white">Se non sei registrato <a class="tw-font-bold text-white" href="{{route('register')}}">Clicca qui</a></h6>
                <h6 class=" my-3 tw-font-bold text-white">Password dimenticata? <a class="tw-font-bold text-white" href="/forgot-password">Clicca qui</a></h6>

            </div>
        </div>
    </div>
</x-layout>
