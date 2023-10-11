<div class="tw-grid lg:tw-grid-cols-2  tw-grid-cols-1 lg:tw-gap-x-10 lg:tw-gap-y-3 tw-gap-y-10 tw  tw-h-screen  tw-items-start tw-justify-center tw-p-10">
    <section class="acc-bg tw-rounded p-3 tw-h-fit">
        <header>
            <h2 class="tw-text-lg tw-font-medium text-white">
                Aggiorna Password
            </h2>

            <p class="tw-mt-1 tw-text-sm text-white">
                Assicurati di inserire una password abbastanza lunga e sicura.
            </p>
        </header>

        <form wire:submit.prevent='updatePassword' class="tw-mt-6 tw-space-y-6">
            <div>
                <label for="current_password " class='tw-text-white'>Password attuale</label>
                <input id="current_password" wire:model="current_password" type="password" class="tw-mt-1 tw-block tw-w-full tw-rounded tw-p-1 tw-border-white"  />
            </div>
            @error('current_password')
                    <div class="tw-bg-red-500 error text-white p-2 rounded  p-0 ">{{ $message }}</div>
            @enderror

            <div>
                <label for="password" class='tw-text-white'>Nuova Password</label>
                <input id="password" wire:model="password" type="password" class="tw-mt-1 tw-block tw-w-full tw-rounded tw-p-1 tw-border-white"  />
            </div>
            @error('password')
                    <div class="tw-bg-red-500 error text-white p-2 rounded  ">{{ $message }}</div>
            @enderror

            <div>
                <label for="password_confirmation" class='tw-text-white'>Conferma password</label>
                <input id="password_confirmation" wire:model="password_confirmation" type="password" class="tw-mt-1 tw-block tw-w-full tw-rounded tw-p-1 tw-border-white"  />
            </div>
            @error('password_confirmation')
                    <div class="tw-bg-red-500 error text-white p-2 rounded  ">{{ $message }}</div>
            @enderror

            <div class="tw-flex tw-items-end tw-gap-4">
                <button class="tw-rounded tw-px-2 tw-py-1 tw-ms-auto tw-border-white tw-bg-white tw-font-bold">{{ __('Salva') }}</button>
            </div>
        </form>
    </section>

    {{-- Profilo --}}
    <section class="acc-bg tw-rounded p-3 tw-h-fit ">
        <header>
            <h2 class="tw-text-lg tw-font-medium tw-text-white ">
                Informazioni Profilo
            </h2>

            <p class="tw-mt-1 text-sm tw-text-white ">
                Aggiorna il nome utente o la tua mail.
            </p>
        </header>

        {{-- <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form> --}}

        <form wire:submit.prevent='profile_update' class="tw-mt-6 tw-space-y-6 tw-grid tw-col-1 ">
            <div class="tw-grid ">
                <label for="name" class="tw-text-white">Nome</label>
                <input id="name" wire:model='name'  type="text" class="tw-mt-1 tw-block tw-w-full tw-rounded tw-p-1 tw-border-white"  required autofocus autocomplete="name" />
            </div>

            <div class="tw-grid">
                <label for="email"  class="tw-text-white">Email</label>
                <input id="email" wire:model="email" type="email" class="tw-mt-1 tw-block tw-w-full tw-rounded tw-p-1 tw-border-white"  required autocomplete="username" />
                @error('email')
                        <span class="tw-bg-white error  p-2 rounded tw-mt-2 tw-text-[color:var(--acc)] ">{{ $message }}</span>
                @enderror

                {{-- @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="tw-text-sm tw-mt-2 tw-text-gray-800 ">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="underline text-sm text-gray-600  hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif --}}
            </div>

            <div class="tw-flex tw-items-end tw-gap-4">
                <button class="tw-rounded tw-px-2 tw-py-1 tw-ms-auto tw-border-white tw-bg-white tw-font-bold">{{ __('Salva') }}</button>
            </div>
        </form>
    </section>
    {{-- Indirizzo di Spedizione --}}



    </section>
    {{-- Elimina Account --}}
    <section class="w-full tw-mb-10 acc-bg tw-p-3 tw-rounded">
        <header>
            <h2 class="tw-text-lg tw-font-medium text-white">
                Elimina Account
            </h2>

            <p class="mt-1 text-sm text-white">
                Una volta che avrai elimato il tuo account tutti i tuoi dati saranno completamente eliminati e non potranno essere recuperati.
            </p>
        </header>

        <button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="tw-rounded tw-px-2 tw-py-1 tw-ms-auto tw-border-white tw-bg-red-500 tw-font-bold tw-text-white"
        >Elimina Account</button>

        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form wire:submit.prevent='profile_destroy' class="p-6">
                <h2 class="tw-text-lg font-medium text-gray-900 dark:text-gray-100">
                    Sei sicuro di voler eliminare il tuo account?
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Una volta che avrai eliminato il tuo account tutti i tuoi dati saranno completamente eliminati.
                </p>

                <div class="mt-6">
                    <label for="password"  class="sr-only"  >Password</label>

                    <input
                        id="password"
                        wire:model="password_for_delete"
                        type="password"
                        class="mt-1 block w-3/4 p-1 rounded"
                        placeholder="Password"
                    />
                </div>


                <div class="mt-6 flex justify-end w-full">
                <button class="tw-rounded tw-px-2 tw-py-1 tw-ms-auto tw-border-white tw-bg-red-500 tw-font-bold tw-text-white" class="ml-3">
                    {{ __('Elimina Account') }}
                </button>

        </form>
                <button class="tw-rounded tw-px-2 tw-py-1 tw-ms-auto tw-border-white  tw-font-bold acc-bg tw-text-white   ms-auto" x-on:click="$dispatch('close')">
                    {{ __('Annulla') }}
                </button>
            </x-modal>
        </section>
    </div>
</div>


