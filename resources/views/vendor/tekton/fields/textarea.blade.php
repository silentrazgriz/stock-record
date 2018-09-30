<textarea
    id="{{ $field['name'] }}"
    name="{{ $field['name'] }}"
    class="form-control"
    placeholder="{{ $field['options']['placeholder'] }}"
    @if($field['options']['required']) required @endif
    @if($field['options']['readonly']) readonly @endif
>{{ $field['options']['value'] ?? '' }}</textarea>
@include('tekton::components.hint')