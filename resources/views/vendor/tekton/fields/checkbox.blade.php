@foreach($field['values'] as $index => $choice)
    <div class="custom-control custom-checkbox {{ $field['options']['inline'] ? 'custom-control-inline' : '' }}">
        <input
            type="checkbox"
            id="{{ $field['name'] }}-{{ $index }}"
            name="{{ $field['name'] }}"
            class="custom-control-input"
            value="{{ $choice['value'] }}"
            {{ $field['options']['value'] == $choice['value'] ||
                ($field['options']['value'] == null && ($choice['checked'] ?? false)) ? 'checked' : '' }}
        />
        <label class="custom-control-label" for="{{ $field['name'] }}-{{ $index }}">{{ $choice['text'] }}</label>
    </div>
@endforeach
@include('tekton::components.hint')