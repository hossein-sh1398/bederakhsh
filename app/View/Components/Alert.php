<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $name;
    public $message;

    public function blue()
    {
        return 2 < 1;
    }
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $message)
    {
        $this->name = $name;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
