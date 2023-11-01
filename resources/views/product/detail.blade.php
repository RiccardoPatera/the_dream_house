<x-layout>
    
    {{-- Container Prodotto img --}}
        <div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-2  tw-gap-6 tw-min-h-screen tw-p-10 ">



            <div class="tw-max-w-fit">
                <div class="swiper mySwiper2">
                    <div class="swiper-wrapper">
                        @foreach($product->images as $image)
                      <div class="swiper-slide">
                        <img src={{Storage::url($image->url)}}  class='tw-max-w-[100%] tw-h-[fit]' />
                      </div>
                      @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                  <div thumbsSlider="" class="swiper mySwiper tw-mt-5">
                    <div class="swiper-wrapper ">
                        @foreach($product->images as $image)
                        <div class="swiper-slide">
                          <img src={{Storage::url($image->url)}} class='tw-max-w-[100%] tw-h-[fit]' />
                        </div>
                        @endforeach
                    </div>
                  </div>
            </div>
            
            
            {{-- Titolo , Descrizione --}}
            <div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-[50%_50%] tw-gap-3 tw-h-full">
                <div class="tw-flex tw-flex-col tw-justify-between ">
                    <div>
                        <div class=" tw-flex tw-justify-between ">
                            @foreach ( $product->categories as $category )
                                <p class="rounded acc-bg p-1  text-white   tw-flex tw-justify-center  tw-text-sm tw-min-w-[110px] ">{{$category->name== "Materiale per confezionare" ? "Confezionare" : $category->name }}</p>
                            @endforeach
                            @foreach ( $product->brands as $brand )
                                <p class="rounded acc-bg p-1  text-white    tw-flex tw-justify-center  tw-min-w-[110px] tw-text-sm">{{$brand->name}}</p>
                            @endforeach
                            
                            {{-- @foreach ( $product->occurences as $occurence ) --}}
                            @if(count($product->occurences)>1)
                                <p class="rounded acc-bg p-1  text-white     tw-flex tw-justify-center tw-min-w-[110px] ms-1 tw-text-sm"> 
                                    {{count($product->occurences)}} occasioni 
                                    <button type="button" class=" tw-ms-1  tw-text-white acc-bg tw-border-solid tw-rounded-full tw-flex tw-items-center tw-border-1 tw-border-white  tw-h-[20px] tw-w-[20px] " data-bs-toggle="popover" data-bs-title="Occasioni" 
                                    data-bs-content="
                                    @foreach($product->occurences as $key=>$occurence) 
                                        {{$product->occurences[$key]->name}}
                                    @endforeach
                                    ">i
                                    </button>
                                </p>
                            @else
                            <p class="rounded acc-bg p-1  text-white     tw-flex tw-justify-center tw-min-w-[110px] ms-1 tw-text-sm"> 
                                {{$product->occurences->first()->name}}
                            </p>
                            
                            @endif
                        </div>
                        <div>
                            <h1 class="fs-3 tw-h-fit tw-whitespace-break-spaces tw-break-all ">{{$product->title}}</h1>
                            <hr class="hr">
                            <h6 class=" tw-whitespace-break-spaces tw-break-all">{{$product->description}}</h6>
                        </div>
                    </div>
                    
                    <div class="tw-w-full tw-flex tw-items-end">
                        <p class="tw-font-bold tw-flex tw-mt-auto tw-self-end tw-rounded acc-bg tw-p-2  tw-text-white tw-ms-auto">EAN: {{$product->barcode}}</p>
                    </div> 
                </div>

                {{-- PayBox --}}
                <div class="acc-bg tw-text-white tw-rounded p-3 ">
                    @livewire('pay-box', compact('product'))
                </div>
            </div>


            
        </div>
</x-layout>
