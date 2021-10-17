<?php

namespace App\Base\Http\Livewire;

use Livewire\Component;

class Header extends Component
{
    public $languages;

    public function __construct()
    {
        $this->languages = available_languages();
    }

    public function render()
    {
        return view('livewire.header');
    }
}