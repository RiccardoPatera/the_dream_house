<?php

namespace App\Http\Livewire;

use Auth;
use Exception;
use App\Models\User;
use Livewire\Component;
use App\Models\Shipping;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class Profile extends Component
{

    public $user;
    public $name;
    public $surname;
    public $email;
    public $current_password;
    public $password_confirmation;
    public $password;
    public $password_for_delete;






    protected $rules=[
        'name'=>'required',
        'surname'=>'required',
        'email'=>"required|email|",
        'current_password'=>'required',
        'password' => 'required|min:8|confirmed|different:current_password'
    ];

    protected $messages=[
        'name.required'=>"Il campo nome è obbligatorio",
        'surname.required'=>"Il campo nome è obbligatorio",
        'email.required'=>"Il campo email è obbligatorio",
        'email.email'=>"Il campo email è deve rispettare il formato mail",
        'current_password.required'=>"Il campo Password Attuale è obbligatorio",
        'password.required'=>"Il campo Password è obbligatorio",
        'password.min'=>"Il campo Password deve contenere almeno 8 caratteri",
        'password.confirmed'=>"Le Password non corrispondono",
        'password.different'=>"Il campo Password deve essere diverso dalla password attuale",
        'email.unique:users,email'=>"Questa mail è gia presente nei nostri database",

    ];

    public function profile_update(){
        $this->validate([
            'name'=>'required',
            'surname'=>'required',
        ]);

        if(Auth::user()->email!=$this->email)
        $this->validate([
            'email'=>'required|email|unique:users,email',
        ]);


       $user=User::findOrFail($this->user->id)
        ->update([
        'name'=>$this->name,
        'surname'=>$this->surname,
        'email'=>$this->email,
        ]);

       $this->emit('refresh_nav');
       $this->dispatchBrowserEvent('user_update');
    }

    public function updatePassword(UpdatesUserPasswords $updater) {
        $this->validate([
            'current_password'=>'required',
        'password' => 'required|min:8|confirmed|different:current_password']
        );

        if(Hash::check($this->current_password,Auth::user()->password))
        {
            $user = User::findOrFail(Auth::user()->id);
            $user->password = Hash::make($this->password);
            $user->save();
            $this->reset();
            $this->dispatchBrowserEvent('user_password_update');
        }
        else
        {
            $this->dispatchBrowserEvent('user_password_not_match');
        }
    }

    public function shipping_update(){
        if(Auth::user()->shipping== null){
            Shipping::create([
                'user_id'=>Auth::id(),
                'address'=>$this->address,
                'street_number'=>$this->street_number,
                'city'=>$this->city,
                'country'=>$this->country,
                'zip_code'=>$this->zip_code,
                'state'=>$this->state,
            ]);
        }
        else{
            Auth::user()->shipping->update([
                'user_id'=>Auth::id(),
                'address'=>$this->address,
                'street_number'=>$this->street_number,
                'city'=>$this->city,
                'country'=>$this->country,
                'zip_code'=>$this->zip_code,
                'state'=>$this->state,
            ]);
        }
            $this->dispatchBrowserEvent('shipping_update');
        }


    public function profile_destroy(){

        if(Hash::check($this->password_for_delete,Auth::user()->password))
        {
            Auth::user()->delete();
            return redirect(route('login'));
        }
    }


    public function mount(){
        $this->name=Auth::user()->name;
        $this->surname=Auth::user()->surname;
        $this->email=Auth::user()->email;
        if(Auth::user()->shipping){
            $this->address=Auth::user()->shipping->address;
            $this->city=Auth::user()->shipping->city;
            $this->zip_code=Auth::user()->shipping->zip_code;
            $this->state=Auth::user()->shipping->state;
            $this->country=Auth::user()->shipping->country;
            $this->street_number=Auth::user()->shipping->street_number;
        }

    }

    public function render()
    {

        $this->user=Auth::user();

        return view('livewire.profile');
    }
}
