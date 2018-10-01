<div class="custom-file">
    <input
            type="file"
            id="{{ $field['name'] }}"
            name="{{ $field['name'] }}"
            class="custom-file-input tekton-image-upload"
            accept="image/*"
            @if($field['options']['required']) required @endif
            @if($field['options']['readonly']) readonly @endif
            data-target="#tekton-preview-{{ $field['name'] }}"
            data-container="#tekton-container-{{ $field['name'] }}"
    />
    <label class="custom-file-label" for="{{ $field['name'] }}">Choose image</label>
</div>
<div id="tekton-container-{{ $field['name'] }}"
     class="tekton-image-preview mt-3 {{ isset($field['options']['value']) ? 'tekton-show-preview' : '' }}"
>
    <img id="tekton-preview-{{ $field['name'] }}" @if(isset($field['options']['value'])) src="{{ asset($field['options']['value']) }}" @endif/>
</div>
@include('tekton::components.hint')