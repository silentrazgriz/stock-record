@foreach($field['values'] as $index => $choice)
    <div class="custom-control custom-radio {{ $field['options']['inline'] ? 'custom-control-inline' : '' }}">
        <input
            type="radio"
            id="{{ $field['name'] }}-{{ $index }}"
            name="{{ $field['name'] }}"
            class="custom-control-input"
            value="{{ $choice['value'] }}"
            {{ $field['options']['value'] == $choice['value'] ||
                ($field['options']['value'] == null && ($choice['checked'] ?? $index == 0)) ? 'checked' : '' }}
        />
        <label class="custom-control-label" for="{{ $field['name'] }}-{{ $index }}">{{ $choice['text'] }}</label>
    </div>
@endforeach
@include('tekton::components.hint')