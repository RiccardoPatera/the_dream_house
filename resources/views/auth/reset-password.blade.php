<x-layout>
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="display-5 text-center acc-color">Reimposta la tua password</h1>
            <div class="col-10 col-lg-6 main-color rounded p-5 my-3">
                <form  method="POST" action="/reset-password" class="tw-flex tw-flex-col" >
                    @csrf
                    <input  type="hidden" name='token'  class="tw-hidden" value="{{request()->route('token')}}">
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    @error('password')
                        <span class="tw-bg-red-500 error text-white p-2 rounded tw-mt-1 ">{{ $message }}</span>
                    @enderror

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label"> Conferma Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                    @error('password_confirmation')
                        <span class="tw-bg-red-500 error text-white p-2 rounded tw-mt-1 ">{{ $message }}</span>
                    @enderror
                    <button type="submit" class="btn bg-light my-2">Conferma</button>
                    <h6 class=" my-3 text-light">Se sei già registrato <a class="text-light" href="{{route('login')}}">Clicca qui</a></h6>
                </form>
            </div>
        </div>
    </div>
    </x-layout>
