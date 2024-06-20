<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\userProfile;

class Main extends Component
{   

    public $user ;

    public function render()
    {
        $this->user = userProfile::where('id',session('user'))->first();
        return view('livewire.chat.main');
    }
}
