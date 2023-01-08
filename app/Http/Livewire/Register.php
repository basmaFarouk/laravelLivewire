<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{

    public $form=[
        'name'=>'',
        'email'=>'',
        'password'=>'',
        'password_confirmation'=>'',
    ];

    protected $rules = [
        'form.name' => 'required|min:6',
        'form.email' => 'required|email',
        'form.password' =>'required|confirmed',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.register');
    }

    public function submit(){
        $validatedData = $this->validate();
        // dd($validatedData);
        User::create($this->form);
        return redirect()->route('login');
    }
}
