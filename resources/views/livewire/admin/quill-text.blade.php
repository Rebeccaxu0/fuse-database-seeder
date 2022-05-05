<div class="mt-8">
  <!-- Include Quill stylesheet -->
  <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet">
  <!-- Hidden input for form submission (request parameter) -->
  <input type="hidden" id="{{ $name }}" name="{{ $name }}" />


  <span class="text-gray-700 mb-2">{{ $label }}</span>
  <span class="text-gray-700 text-xs mb-2">{{ $sublabel }}</span>

  <!-- Create the toolbar container -->
  <div id="{{ $name }}-toolbar">
  </div>
  <!-- Create the editor container -->
  <div id="{{ $name }}-editor">
  </div>
  <br />
  <!-- Include the Quill library -->
  <script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>

  <!-- Initialize Quill editor -->
  <script>
    var {{ $name }} = new Quill('#{{ $name }}-editor', {
      modules: {
        toolbar: [
          ['bold', 'italic'],
          ['link', 'blockquote',],
          [{
            list: 'ordered'
          }, {
            list: 'bullet'
          }]
        ]
      },
      theme: 'snow'
    });
    {{$name}}.root.innerHTML = "{!! $old !!}";
    // Set value for form submission
    var {{ $content }} = document.getElementById("{{ $name }}");
    {{ $name }}.on('text-change', function() {
      {{ $content }}.value = {{$name}}.root.innerHTML;
    });
  </script>
</div>