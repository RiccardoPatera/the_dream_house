<x-layout>
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="display-5 text-center acc-color">Registrati</h1>
            <div class="col-10 col-lg-6 main-color rounded p-5 my-3">
                <form  method="POST" action="{{route('register')}}" class="tw-flex tw-flex-col" >
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label acc-color tw-font-bold">Username</label>
                        <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="name">
                    </div>
                    @error('name')
                        <span class="tw-bg-red-500 error text-white p-2 rounded tw-mt-1 ">{{ $message }}</span>
                    @enderror
                    <div class="mb-3">
                        <label for="email" class="form-label acc-color tw-font-bold">Email</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                    </div>
                    @error('email')
                        <span class="tw-bg-red-500 error text-white p-2 rounded tw-mt-1">{{ $message }}</span>
                    @enderror
                    <div class="mb-3">
                        <label for="password" class="form-label acc-color tw-font-bold">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    @error('password')
                        <span class="tw-bg-red-500 error text-white p-2 rounded tw-mt-1 ">{{ $message }}</span>
                    @enderror

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label acc-color tw-font-bold"> Conferma Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                    @error('password_confirmation')
                        <span class="tw-bg-red-500 error text-white p-2 rounded tw-mt-1 ">{{ $message }}</span>
                    @enderror
                    <button type="submit" class="acc-bg tw-border-none w-100  tw-rounded  tw-p-2 text-white  mt-2">Registrati</button>
                    <h6 class=" my-3 text-light">Se sei già registrato <a class="text-light" href="{{route('login')}}">Clicca qui</a></h6>
                </form>
            </div>
        </div>
    </div>
    </x-layout>
