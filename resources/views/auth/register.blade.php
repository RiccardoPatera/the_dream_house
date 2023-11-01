<x-layout>
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="display-5 text-center acc-color">Registrati</h1>
            <div class="col-10 col-lg-6 main-color rounded p-5 my-3">
                <form  method="POST" action="{{route('register')}}" class="tw-flex tw-flex-col" >
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label acc-color tw-font-bold">Nome </label>
                        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name">
                    </div>
                    @error('name')
                        <span class="tw-bg-red-500 error text-white p-2 rounded tw-my-2 ">{{ $message }}</span>
                    @enderror
                    <div class="mb-3">
                        <label for="surname" class="form-label acc-color tw-font-bold">Cognome</label>
                        <input type="text" class="form-control" id="surname" aria-describedby="emailHelp" name="surname">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label acc-color tw-font-bold tw-flex tw-items-center">
                            Email
                            <button type="button" class=" tw-ms-1 tw-text-white acc-bg tw-border-solid tw-rounded-full tw-flex tw-items-center tw-border-2 tw-border-white  tw-h-[20px] tw-w-[20px] " data-bs-toggle="popover" data-bs-title="Email" data-bs-content="Dovrai usare la tua email per accedere">i</button>
                        </label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                        
                    </div>
                    @error('email')
                        <span class="tw-bg-red-500 error text-white p-2 rounded tw-my-2">{{ $message }}</span>
                    @enderror
                    <div class="mb-3">
                        <label for="password" class="form-label acc-color  acc-color tw-font-bold tw-flex tw-items-center">
                            Password
                            <button type="button" class=" tw-ms-1 tw-text-white acc-bg tw-border-solid tw-rounded-full tw-flex tw-items-center tw-border-2 tw-border-white  tw-h-[20px] tw-w-[20px] " data-bs-toggle="popover" data-bs-title="Password" data-bs-content="La tua password deve essere composta da almeno 8 caratteri, un numero, una lettera maiuscola , una lettera minuscola ed un carattere speciale">i</button>
                        </label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    @error('password')
                        <span class="tw-bg-red-500 error text-white p-2 rounded tw-my-2 ">{{ $message }}</span>
                    @enderror

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label acc-color tw-font-bold"> Conferma Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                    @error('password_confirmation')
                        <span class="tw-bg-red-500 error text-white p-2 rounded tw-my-2 ">{{ $message }}</span>
                    @enderror
                    <button type="submit" class="acc-bg tw-border-none w-100  tw-rounded  tw-p-2 text-white  mt-2">Registrati</button>
                    <h6 class=" my-3 text-light">Se sei già registrato <a class="text-light" href="{{route('login')}}">Clicca qui</a></h6>
                </form>
            </div>
        </div>
    </div>
    </x-layout>
