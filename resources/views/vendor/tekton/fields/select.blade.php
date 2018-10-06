<select
    id="{{ $field['name'] }}"
    name="{{ $field['name'] }}"
    class="form-control select2"
    @if($field['options']['required']) required @endif
    @if($field['options']['readonly']) readonly @endif
>
    @foreach($field['values'] as $choice)
        <option
            value="{{ $choice['value'] }}"
            {{ $choice['value'] == $field['options']['value'] ? 'selected' : '' }}
        >
            {{ $choice['text'] }}
        </option>
    @endforeach
</select>
@include('tekton::components.hint')