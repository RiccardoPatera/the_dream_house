<x-layout>
    {{-- Container Prodotto img --}}
    <div class="container-fluid my-1 ">
        <div class="row  p-2">
            <div class="col-12  col-lg-6  tw-h-fit tw-p-2">
                <div  class="swiper mySwiper2">
                    <div class="swiper-wrapper tw-max-h-[80vh]">
                        @foreach($product->images as $image )
                            <div class="swiper-slide ">
                                <img src={{Storage::url($image->url)}}  class=' object-fit-contain  img-fluid tw-bg-[#f1efec]  ' />
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <div  class="swiper mySwiper mt-2">
                    <div class="swiper-wrapper ">
                        @foreach ($product->images as $image )
                            <div class="swiper-slide">
                                <img src={{Storage::url($image->url)}} />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Titolo , Descrizione --}}
            <div class="col-12 col-lg-3 d-flex flex-column   ">
                <div class="row w-100 justify-content-around tw-flex  lg:tw-h-[90%]">
                    <div class=" tw-grid  tw-w-full tw-grid-cols-3 tw-gap-2  tw-p-0">
                        @foreach ( $product->categories as $category )
                            <p class="rounded acc-bg p-1  text-white  text-nowrap  tw-flex tw-justify-center tw-min-w-fit tw-text-sm ">{{$category->name== "Materiale per confezionare" ? "Confezionare" : $category->name }}</p>
                        @endforeach
                        @foreach ( $product->brands as $brand )
                            <p class="rounded acc-bg p-1  text-white  text-nowrap   tw-flex tw-justify-center  tw-min-w-[110px] tw-text-sm">{{$brand->name}}</p>
                        @endforeach
                        @foreach ( $product->occurences as $occurence )
                            <p class="rounded acc-bg p-1  text-white  text-nowrap    tw-flex tw-justify-center tw-min-w-[110px] ms-1 tw-text-sm" >{{$occurence->name}}</p>
                        @endforeach
                    </div>
                    <div class="col-12 tw-h-full tw-flex tw-flex-col">
                        <h1 class="fs-3">{{$product->title}}</h1>
                        <hr class="hr">
                        <p>{{$product->description}}</p>
                        <p class="tw-font-bold tw-flex lg:tw-mt-auto tw-self-end tw-rounded acc-bg tw-p-2  tw-text-white tw-w-full">EAN: {{$product->barcode}}</p>
                    </div>
                </div>
            </div>


            {{-- Pay-Box --}}
            <div class="col-12 col-lg-3 box p-3">
                @livewire('pay-box', compact('product'))
            </div>

        </div>
    </div>
</x-layout>
