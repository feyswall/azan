<?php

namespace App\View\Components\models;

use Illuminate\View\Component;

class allUsersTable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $datas;

    public function __construct( $datas )
    {
        $this->datas = $datas;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.models.all-users-table');
    }
}
