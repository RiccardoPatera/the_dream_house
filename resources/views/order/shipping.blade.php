<x-layout>
    <div class="container tw-h-full">
        <div class="row tw-justify-center p-2">
            @livewire('total', compact('user')) 

            <section class="acc-bg tw-rounded p-3 tw-h-fit tw-my-10 col-12 col-md-8">
                <header>
                    <h2 class="tw-text-lg tw-font-medium tw-text-white ">
                        Indirizzo di spedizione
                    </h2>

                    <p class="tw-mt-1 text-sm tw-text-white ">
                        Inserisci le informazioni necessarie per la spedizione. 
                    </p>
                </header>


                <form method="POST" action='{{route('checkout', compact('user'))}}' class="tw-mt-6 tw-space-y-6 tw-grid tw-col-1 ">
                    @csrf
                    <div class="tw-grid tw-grid-cols-[2fr_130px] tw-justify-center tw-items-center gap-3 ">
                        <div class="tw-flex tw-flex-col ">
                            <label for="address" class="tw-text-white">Via/Viale</label>
                            <input id="address" name='address'  type="text" class="tw-block tw-w-full tw-rounded tw-p-1 tw-border-white"  required autofocus autocomplete="address" />

                        </div>

                        <div class="tw-flex tw-flex-col ">
                            <label for="street_number"  class="tw-text-white">N. Civico</label>
                             <input id="street_number" name="street_number" type="number" class=" tw-block tw-w-full tw-rounded tw-p-1 tw-border-white"  required autocomplete="username" />
                             @error('street_number') <span class="error text-danger tw-bg-white tw-rounded tw-p-2 tw-mt-3">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="tw-grid tw-grid-cols-2 tw-justify-center tw-items-center gap-3 ">
                        <div class="tw-flex tw-flex-col ">
                            <label for="city" class="tw-text-white">Città</label>
                            <input id="city" name='city'  type="text" class="tw-block tw-w-full tw-rounded tw-p-1 tw-border-white"  required autofocus autocomplete="city" />
                            @error('city') <span class="error text-danger tw-bg-white tw-rounded tw-p-2 tw-mt-3">{{ $message }}</span> @enderror

                        </div>
                        <div class="tw-flex tw-flex-col ">
                            <label for="country" class="tw-text-white">Regione</label>
                            <input id="country" name='country'  type="text" class="tw-block tw-w-full tw-rounded tw-p-1 tw-border-white"  required autofocus autocomplete="country" />
                            @error('country') <span class="error text-danger tw-bg-white tw-rounded tw-p-2 tw-mt-3">{{ $message }}</span> @enderror
                        </div>
                        <div class="tw-flex tw-flex-col" >
                            <label for="zip_code" class="tw-text-white">Codice Postale</label>
                            <input id="zip_code" name='zip_code'  type="number" class="tw-block tw-w-full tw-rounded tw-p-1 tw-border-white"  required autofocus autocomplete="zip_code" />
                            @error('zip_code') <span class="error text-danger tw-bg-white tw-rounded tw-p-2 tw-mt-3">{{ $message }}</span> @enderror

                        </div>
                        <div class="tw-flex tw-flex-col">
                            <label for="state" class="tw-text-white">Stato/Nazione</label>
                            <select name="state" id="state" required class="tw-p-2 tw-rounded">
                                <option value="IT">Italia</option>
                                <option value="FR">Francia</option>
                                <option value="ES">Spagna</option>
                            </select>
                            {{-- <input id="state" name='state'  type="text" class="tw-block tw-w-full tw-rounded tw-p-1 tw-border-white"   /> --}}
                            @error('state') <span class="error text-danger tw-bg-white tw-rounded tw-p-2 tw-mt-3">{{ $message }}</span> @enderror

                        </div>
                    </div>



            </section>
                <div class="tw-flex tw-justify-between  tw-p-10">
                    <a href="{{route('cartsummary')}}" class="tw-bg-[color:var(--acc)] tw-rounded tw-no-underline tw-text-white  tw-p-3">Torna indietro</a>
                    <button class="tw-rounded tw-px-2 tw-py-1 tw-border-none  tw-bg-[color:var(--acc)] tw-font-bold tw-text-white" wire:click='checkout'>Checkout</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
