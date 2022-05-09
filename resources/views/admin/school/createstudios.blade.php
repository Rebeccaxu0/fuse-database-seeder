<x-app-layout>

    <x-slot name="header">{{ __('Create Studios for :name', ['name' => $school->name]) }}</x-slot>

    <x-slot name="title">{{ __('Create Studios for :name', ['name' => $school->name]) }}</x-slot>

    <form class="w-full max-w-lg mt-6" action="{{ route('admin.schools.addstudios', $school) }}" method="POST">
        @csrf
        <label for="number"> Number of studios to create </label>
        <input id="number" class="form-control rounded required" type="text">
        <div class="col-sm-12">
            <br>
            <fieldset>
                <legend> Names </legend>
                <div class="row">
                    <div id="studioslist" name="studioslist" class="input_fields_wrap" />
                </div>
                <div class="col-sm-12">
                    <button class="btn btn-link btn-sm add_field_button" type="button" onclick="addNew();"> +
                        Add</button>
                </div>
        </div>
        </fieldset>
        <br>
        </div>
        <div class="flex flex-wrap mt-4 -mx-3 mb-2">
            <button type="" id="btn-submit" class="text-md h-12 px-6 m-2 bg-fuse-green rounded-lg text-white">
                {{ __('Save Studios to :name', ['name' => $school->name]) }}
            </button>
        </div>
    </form>
    <script>
        function addNew() {
                var newinput = document.createElement('div');
                newinput.innerHTML = "<input class='form-control rounded' name='createstudios[]' type='text'>";
                document.getElementById("studioslist").appendChild(newinput);
            }
            document.getElementById('number').addEventListener("keyup",
                function addDefaults() {
                    var number = document.getElementById('number').value;
                    if (number.length == 0){
                        document.getElementById("studioslist").innerHTML = "";
                    }
                    for (let i = 0; i < number; i++) {
                        var newinput = document.createElement('div');
                        var string = "Studio " + (i+1);
                        newinput.innerHTML = "<input class='form-control rounded' name='createstudios[]' type='text'>";
                        document.getElementById("studioslist").appendChild(newinput);
                        document.getElementsByName("createstudios[]")[i].value = string;
                    }
                }, false);
        </script>
</x-app-layout>
