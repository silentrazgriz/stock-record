<input
    type="text"
    id="{{ $field['name'] }}"
    name="{{ $field['name'] }}"
    value="{{ $field['options']['value'] ?? '' }}"
    class="form-control tekton-money"
    placeholder="{{ $field['options']['placeholder'] }}"
    @if($field['options']['required']) required @endif
    @if($field['options']['readonly']) readonly @endif
/>
@include('tekton::components.hint')