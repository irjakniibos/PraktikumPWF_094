<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteProduct extends Component
{
    public string $action;
    public string $label;
    public string $confirmMessage;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $action,
        string $label = 'Delete',
        string $confirmMessage = 'Are you sure you want to delete this product?'
    ) {
        $this->action = $action;
        $this->label = $label;
        $this->confirmMessage = $confirmMessage;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-product');
    }
}
