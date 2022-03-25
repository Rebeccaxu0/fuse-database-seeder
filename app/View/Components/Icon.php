<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Icon extends Component
{
    public string $icon;
    public int $width;
    public int $height;
    public string $viewBox;
    public string $fill;
    public string $strokeWidth;
    public ?string $id;
    public ?string $class;
    public bool $displayOverride;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $icon,
        int $width = 24,
        int $height = 24,
        string $viewBox = '24 24',
        string $fill = 'none', // currentColor, none
        string $stroke = 'currentColor', // currentColor, none
        string $strokeWidth = "2",
        ?string $id = null,
        ?string $class = null,
        bool $displayOverride = false,
    )
    {
        $this->icon = $icon;
        $this->width = $width;
        $this->height = $height;
        $this->viewBox = $viewBox;
        $this->fill = $fill;
        $this->strokeWidth = $strokeWidth;
        $this->id = $id;
        $this->class = $class;
        $this->displayOverride = $displayOverride;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.icon');
    }
}
