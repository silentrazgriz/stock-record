<div id="form-row-{{ $row['id'] }}" class="form-group row">
    <label class="{{ $row['options']['style']['label'] }} col-form-label">{{ $row['options']['label'] ? $row['label'] : '' }}</label>
    <div class="{{ $row['options']['style']['input'] }}">
        <div class="form-row">
            @foreach($row['fields'] as $field)
                <div class="{{ $field['options']['style'] }}">
                    @include('tekton::fields.' . $field['type'], ['field' => $field])
                </div>
            @endforeach
        </div>
    </div>
</div>