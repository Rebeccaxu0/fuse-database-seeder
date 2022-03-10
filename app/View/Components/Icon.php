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

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $icon = null,
        $width = 24,
        $height = 24,
        $viewBox = '24 24',
        $fill = 'none', // currentColor, none
        $stroke = 'currentColor', // currentColor, none
        $strokeWidth = "2",
        $id = null,
        $class = null
    )
    {
        $this->icon = $icon;
        $this->width = $width;
        $this->height = $height;
        $this->viewBox = $viewBox;
        $this->fill = $fill;
        $this->strokeWidth = $strokeWidth;
        $this->id = $id ?? '';
        $this->class = $class ?? '';
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
