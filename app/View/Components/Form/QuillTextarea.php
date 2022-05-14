<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class QuillTextarea extends Component
{
    public string $name;
    public string $label;
    public ?string $sublabel;
    public string $quillToolbarOptions;
    public ?string $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name, string $label, ?string $value = '', ?string $sublabel = '', ?string $quillToolbarOptions = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->sublabel = $sublabel;
        $this->value = $value;
        $this->quillToolbarOptions = $quillToolbarOptions ?? <<<JAVASCRIPT
[
    ['bold', 'italic'],
    ['link', 'blockquote'],
    [
        {list: 'ordered'},
        {list: 'bullet'}
    ]
]
JAVASCRIPT;
    }

    public function render()
    {
        return view('components.form.quill-textarea');
    }
}
