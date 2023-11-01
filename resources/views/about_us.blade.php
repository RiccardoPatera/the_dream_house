<x-layout>
    <div class="container-fluid tw-p-5">
        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2">
            <div class="tw-flex tw-items-center">
                <img src="{{asset('media/home/home4.jpg')}}" alt="about_us first image" class="tw-w-[100%] tw-object-contain">
            </div>
            <div class=" tw-flex tw-flex-col  tw-items-center tw-p-3 tw-justify-center ">
                <img src={{asset('media/logo/logo.svg')}} alt="logo" class="tw-w-[250px] tw-h-[100px]">
                <p class=" tw-p-3 tw-font-serif  tw-font-medium">Dal 2012 ci impegniamo per soddisfare i bisogni dei nostri clienti, selezionando prodotti di alta qualità; Da noi potrai trovare tutto ciò di cui hai bisogno per la tua casa, dal tessile fino alla profumazione per ambiente.</p>
                <p class=" tw-p-3 tw-font-serif  tw-font-medium">Forniamo anche servizi di allestimento per eventi, per info e contatti consulta il nostro footer.
                </p>

                <h2 class="acc-color">I nostri Marchi</h2>
                <div class="tw-grid tw-grid-cols-4 md:tw-grid-cols-7 tw-gap-10">
                    @for($i=1; $i<33; $i++)
                        <img src={{asset('media/logo/logo'. $i .'.webp')}} class="tw-h-[100px] tw-w-[100px] tw-object-contain tw-p-1" alt="brand-logo">
                    @endfor
                </div>

                
            </div>

        </div>
    </div>
</x-layout>