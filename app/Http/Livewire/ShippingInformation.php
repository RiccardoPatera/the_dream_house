<?php

namespace App\Http\Livewire;

use Stripe\Stripe;
use App\Models\Order;
use Livewire\Component;
use App\Models\Shipping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShippingInformation extends Component
{
    public $user;
    public $state;
    public $zip_code;
    public $address;
    public $street_number;
    public $city;
    public $country;

    protected $rules = [
        'address' => 'required',
        'state' => 'required',
        'zip_code' => 'required|numeric|doesnt_start_with:-|regex:/^\d+(\.\d{1,2})?$/',
        'street_number' => 'required',
        'city' => 'required',
        'country'=>'required',
    ];

    protected $messages = [
        'address.required'=> "L'indirizzo è obbligatorio",
        'state.required'=> 'Lo stato è obbligatorio',
        'zip_code.required'=> 'Il C.A.P/ ZIP Code è obbligatorio',
        'zip_code.regex'=> 'Il prezzo è un valore numerico con due valori decimali.',
        'street_number.required'=> 'N. civico  obbligatorio',
        'city.required'=> "La città è obbligatoria",
        'country.required'=> 'La regione è obbligatoria',
    ];




    public function mount(){
        if(Auth::user()){
            $this->user=Auth::user();
        }
        else{
            redirect(route('login'));
        }

    }


    public function render()
    {
        return view('livewire.shipping-information');
    }

}

