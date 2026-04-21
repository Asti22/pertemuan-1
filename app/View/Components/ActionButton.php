<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ActionButton extends Component
{
    public $type;
    public $url;

    public function __construct($type, $url)
    {
        $this->type = $type;
        $this->url = $url;
    }

    public function render()
    {
        return view('components.action-button');
    }
}