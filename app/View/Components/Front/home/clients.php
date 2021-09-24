<?php

namespace App\View\Components\front\home;

use Illuminate\View\Component;

class clients extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $clients;
    public function __construct($clients)
    {
        $this->clients = $clients;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.front.home.clients');
    }
}
