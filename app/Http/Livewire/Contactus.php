<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Livewire\Component;

class Contactus extends Component
{
    public $nom;
    public $email;
    public $message;

    protected $rules =[
        'nom' => 'required|min:5',
        'email' => 'required|email',
        'message' => 'required|max:255'
    ];

    protected $messages = [
        'required' => 'Ce champ est obligatoire',
        'email' => 'Email non valide',
        'min' => 'Nom trop court',
        'max' => 'Texte trop long'
    ];

    public function envoyerMessage(){

        $validateMessage = $this->validate();
        Message::create($validateMessage);

        session()->flash('success_message','Votre email est bien envoyée');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.contactus');
    }
}
