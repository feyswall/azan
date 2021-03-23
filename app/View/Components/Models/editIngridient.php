<?php

namespace App\View\Components\models;

use Illuminate\View\Component;

class editIngridient extends Component
{
    public $ingr;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $ingr )
    {
        $this->$ingr = $ingr;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.models.edit-ingridient');
    }
}
