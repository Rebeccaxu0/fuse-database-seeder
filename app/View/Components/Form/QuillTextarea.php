<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class QuillTextarea extends Component
{
    // Name and request parameter.
    public string $name;
    public string $label;
    public ?string $sublabel;
    public string $quillToolbarOptions;
    // Variable name for content of quill editor box.
    public string $content;
    public ?string $old;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name, string $label, string $content = '', ?string $old = '', ?string $sublabel = '', ?string $quillToolbarOptions = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->sublabel = $sublabel;
        $this->content = $content;
        $this->old = $old;
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
