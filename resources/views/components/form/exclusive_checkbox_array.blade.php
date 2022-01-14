@props(['name', 'value', 'label', 'active' => null])
<div>
    <div class="inline-flex items-center">
        <input type="checkbox" class="form-checkbox" id="{{ "{$name}-{$value}" }}" name="{{ $name }}[]"
            value="{{ $value }}" {{ (old($name) && in_array($value, old($name))) || $active ? 'checked' : '' }}
            onclick="singleCheck(this);" />
        <label for="{{ "{$name}-{$value}" }}">
            <span class="mx-2 text-gray-700">{{ $label }}</span>
        </label>
        @error($name)
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
        @enderror
    </div>
</div>
<script>
    function singleCheck(chk) {
        var list = chk.parentNode.parentNode.parentNode;
        var chks = list.getElementsByTagName("input");
        for (var i = 0; i < chks.length; i++) {
            if (chks[i] != chk && chk.checked) {
                chks[i].checked = false;
            }
        }
    }
</script>
