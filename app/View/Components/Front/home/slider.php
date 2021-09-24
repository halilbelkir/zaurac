<?php

namespace App\View\Components\front\home;

use Illuminate\View\Component;

class slider extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $slider;
    public function __construct($slider)
    {
        $this->slider = $slider;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.front.home.slider');
    }
}
