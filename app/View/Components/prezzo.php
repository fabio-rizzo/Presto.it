<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Prezzo extends Component
{
    public $announcement;

    /**
     * Create a new component instance.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return void
     */
    public function __construct($announcement)
    {
        $this->announcement = $announcement;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render(): View|string
    {
        return view('components.prezzo');
    }
}