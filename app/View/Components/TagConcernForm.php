<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TagConcernForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $tags,
        public $concerns
    ) {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tag-concern-form');
    }
}
