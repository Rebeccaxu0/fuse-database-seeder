<div class="mt-8">
  <!-- Include Quill stylesheet -->
  <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet">
  <!-- Hidden input for form submission (request parameter) -->
  <input type="hidden" id="{{ $name }}" name="{{ $name }}" />


  <span class="text-gray-700 mb-2">{{ $label }}</span>

  <!-- Create the toolbar container -->
  <div id="toolbar">
  </div>

  <!-- Create the editor container -->
  <div id="editor">
  </div>
  <br />
  <!-- Include the Quill library -->
  <script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>

  <!-- Initialize Quill editor -->
  <script>
    var quill = new Quill('#editor', {
      modules: {
        toolbar: [
          ['bold', 'italic'],
          ['link', 'blockquote', 'code-block', 'image'],
          [{
            list: 'ordered'
          }, {
            list: 'bullet'
          }]
        ]
      },
      theme: 'snow'
    });

    // Set value for form submission
    var content = document.getElementById("{{ $name }}");
    quill.on('text-change', function() {
      content.value = quill.root.innerHTML;
    });
  </script>
</div>