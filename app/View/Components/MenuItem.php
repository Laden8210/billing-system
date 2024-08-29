<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuItem extends Component
{
    public $title;
    public $active;
    public $icon;
    public $url;

    public function __construct($title, $url, $active = false, $icon = ''){
        $this->title = $title;
        $this->active = $active;
        $this->icon =$icon;
        $this->url = $url;
    }

    public function render(): View|Closure|string
    {
        return view('components.menu-item');
    }
}
