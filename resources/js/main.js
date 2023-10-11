import Swiper from 'swiper/bundle';
import Offcanvas from '../../node_modules/bootstrap/js/src/offcanvas';
let logout=document.querySelector('#logout');

if (logout) {
    logout.addEventListener('click', (event)=>{
        event.preventDefault();
        let logoutForm = document.querySelector('#logoutForm');
        logoutForm.submit();
    });
}


let categories=document.querySelectorAll(".brandname");


categories.forEach(element=>
    element.onmouseover= function(){
       let text=element.querySelector('.brand-text')
       let img=element.querySelector('.brand-img')
       img.classList.add('opacity-brand')
       text.classList.remove('d-none')

    }
)
categories.forEach(element=>
    element.onmouseleave= function(){
        let text=element.querySelector('.brand-text')
        let img=element.querySelector('.brand-img')
        img.classList.remove('opacity-brand')
        text.classList.add('d-none')
    }
)


const notyf = new Notyf({
    duration: 1000,
    position: {
      x: 'right',
      y: 'top',
    },
    types: [
      {
        type: 'warning',
        background: 'orange',
        icon: {
          className: 'material-icons',
          tagName: 'i',
          text: 'warning'
        }
      },
      {
        type: 'error',
        background: 'indianred',
        duration: 2000,
        dismissible: true
      },
      {
        type: 'success',
        background: '#739aaf',
        duration: 4000,
        dismissible: true
      }
    ]
  });

    window.addEventListener('item_deleted', (e) => {
        notyf.success('Articolo rimosso correttamente')
    });

    window.addEventListener('item_add', (e) => {
        notyf.success('Articolo aggiunto correttamente')
    });

    window.addEventListener('item_not_avaible', (e) => {
        notyf.error('Questo articolo non è al momento disponibile');
    });
    window.addEventListener('item_no_longer_avaible', (e) => {
        notyf.error('Questo articolo non è più disponibile, articolo rimosso dal carrello');
    });

    window.addEventListener('item_max', (e) => {
        notyf.error('Quantità massima articolo raggiunta')
    });
    window.addEventListener('item_exceed', (e) => {
        notyf.error('Quantità massima articolo superata')
    });

    window.addEventListener('item_q_0', (e) => {
        notyf.error('La quantità minima è 1')
    });

    window.addEventListener('value_error', (e) => {
        notyf.error('Non è possibile inserire lettere in un campo numerico')
    });

    window.addEventListener('item_update', (e) => {
        notyf.success('Carrello aggiornato')
    });

    window.addEventListener('item_add_fav', (e) => {
        notyf.success('Prodotto aggiunto ai preferiti')
    });

    window.addEventListener('item_remove_fav', (e) => {
        notyf.success('Prodotto rimosso dai preferiti')
    });

    window.addEventListener('item_already_fav', (e) => {
        notyf.error('Prodotto già presente tra i preferiti')
    });

    window.addEventListener('user_update', (e) => {
        notyf.success('Informazioni utente aggiornate')
    });
    window.addEventListener('user_password_update', (e) => {
        notyf.success('Password aggiornata correttamente')
    });

    window.addEventListener('item_already_added', (e) => {
        notyf.error('Prodotto già presente nel carrello')
    });

    window.addEventListener('shipping_update', (e) => {
        notyf.success('Informazioni di spedizione aggiornate')
    });











   const swiper = new Swiper(".mySwiper", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
      });
      var swiper2 = new Swiper(".mySwiper2", {
        spaceBetween: 10,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        thumbs: {
          swiper: swiper,
        },
      });


const rangeInput = document.querySelectorAll(".range-input input"),
priceInput = document.querySelectorAll(".price-input input"),
range = document.querySelector(".slider .progress");
let priceGap =50;

priceInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minPrice = parseInt(priceInput[0].value),
        maxPrice = parseInt(priceInput[1].value);

        if((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max){
            if(e.target.className === "input-min"){
                rangeInput[0].value = minPrice;
                range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
            }else{
                rangeInput[1].value = maxPrice;
                range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
            }
        }
    });
});

rangeInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minVal = parseInt(rangeInput[0].value),
        maxVal = parseInt(rangeInput[1].value);

        if((maxVal - minVal) < priceGap){
            if(e.target.className === "range-min"){
                rangeInput[0].value = maxVal - priceGap
            }else{
                rangeInput[1].value = minVal + priceGap;
            }
        }else{
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
            range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
        }
    });
});



var MobileFilters = document.getElementById('MobileFilters')
document.addEventListener('searched', function () {
    let openedCanvas = Offcanvas.getInstance( MobileFilters);
    openedCanvas.hide();
})
