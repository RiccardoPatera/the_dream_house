<footer class=" tw-w-full tw-text-white acc-bg tw-flex  tw-justify-center tw-border-top-10  border-top tw-p-0 tw-mt-auto  ">
    <div class=" mb-3 tw-grid tw-grid-cols-1  md:tw-grid-cols-[1fr_1fr_1fr] tw-items-center tw-justify-center  tw-w-full tw-h-full  tw-mt-4  ">
        <div class="tw-flex tw-flex-col tw-items-center tw-justify-center">
            <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
              <img src="{{asset('media/logo/logo_white.svg')}}" alt="logodreamhouse" class="tw-h-[100px] tw-w-[200px] ">
            </a>
            <p class=" tw-text-white">© 2023</p>
        </div>
        <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full  ">
            <ul class="tw-text-white  tw-list-none tw-w-full   tw-flex tw-flex-col tw-items-center">
                <li>The Dream House Interiors di Alessandra Schilardi</li>
                <li>P.iva: 02355610748</li>
                <li>Via San pietro,28</li>
                <li>San Pietro Vernotico,(BR),Puglia</li>
                <li>
                    <a class="text-white" href="mailto:thedreamhouseinterior@gmail.com">thedreamhouseinterior@gmail.com</a>
                </li>
                <li><a  class="text-white" href="tel:+393296111648">+393296111648</a></li>
            </ul> 
            <div class="tw-flex  tw-justify-center tw-w-full ">
                <a href="https://www.instagram.com/thedreamhouseinterior/" class=" tw-px-2 hover:tw-scale-110">
                    <i class="fa-brands fa-instagram fa-xl" style="color: #ffffff;"></i>
                </a>
                <a href="https://www.amazon.it/s?me=AK16Q4HVS36OH&marketplaceID=APJ6JRA9NG5V4" class="tw-px-2 hover:tw-scale-110">
                    <i class="fa-brands fa-amazon fa-xl" style="color: #ffffff;"></i>
                </a>
                <a href="https://www.facebook.com/thedreamhouseinteriors" class="tw-px-2 hover:tw-scale-110">
                    <i class="fa-brands fa-facebook fa-xl" style="color: #ffffff;"></i>
                </a>
            </div>
        </div>
        
        
        
        <div class=" mb-3 tw-flex tw-justify-center tw-flex-col tw-items-center  tw-w-full tw-mt-5 md:tw-mt-0 ">
            <ul class="  tw-list-disc tw-flex  md:tw-flex-col  tw-justify-between   ">
                <li class=" tw-m-3"><a href={{route('welcome')}} class=" tw-no-underline tw-text-white">Home</a></li>
                <li class=" tw-m-3 "><a href={{route('product_index')}} class=" tw-no-underline tw-text-white">Shop</a></li>
                <li class=" tw-m-3 "><a href={{route('about_us')}} class="tw-no-underline  tw-text-white">About</a></li>
                <li class=" tw-m-3  tw-whitespace-nowrap"><a href={{route('privacy')}} class=" tw-no-underline  tw-text-white">Privacy Policy</a></li>
            </ul>
        </div>
    </div>
  </footer>