<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public string $size;
    public string $type;
    public ?string $url;
    public bool $newTab;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $size = 'md',
        string $type = 'primary',
        ?string $url = null,
        bool $newTab = false
    ) {
        $this->size = in_array($size, ['md', 'lg', 'xl']) ? $size : 'md';
        $this->type = in_array($type, ['primary', 'secondary']) ? $type : 'primary';
        $this->url = $url;
        $this->newTab = $newTab;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }

    /**
     * Get the CSS classes for the button based on size and type.
     */
    public function getClasses(): string
    {
        $baseClasses = 'inline-flex items-center justify-center font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2';

        // Size classes
        $sizeClasses = [
            'md' => 'px-4 py-2 text-sm',
            'lg' => 'px-6 py-3 text-base',
            'xl' => 'px-8 py-4 text-lg',
        ];

        // Type classes
        $typeClasses = [
            'primary' => 'bg-gradient-to-r from-secondary-darker to-secondary-lighter text-white hover:from-secondary-mid hover:to-secondary-dark focus:ring-secondary-mid',
            'secondary' => 'bg-transparent border-2 border-secondary-darker text-secondary-darker hover:bg-secondary-darker hover:text-white focus:ring-secondary-darker',
        ];

        return $baseClasses . ' ' . $sizeClasses[$this->size] . ' ' . $typeClasses[$this->type];
    }

    /**
     * Get the target attribute for the link.
     */
    public function getTarget(): string
    {
        return $this->newTab ? '_blank' : '_self';
    }

    /**
     * Get the rel attribute for the link when opening in new tab.
     */
    public function getRel(): string
    {
        return $this->newTab ? 'noopener noreferrer' : '';
    }
}
