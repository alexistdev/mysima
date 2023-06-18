<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarLayout extends Component
{
    public $menuUtama;
    public $menuKedua;

    public function __construct($menuUtama,$menuKedua)
    {
        $this->menuUtama = $menuUtama;
        $this->menuKedua = $menuKedua;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.sidebar-layout');
    }
}
