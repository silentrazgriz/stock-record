<form
        @if(null != $tekton['id']) id="{{ $tekton['id'] }}" @endif
method="POST"
        action="{{ $tekton['url'] }}"
        class="tekton-form needs-validation"
        enctype="multipart/form-data"
        novalidate
>
    @csrf
    @include('tekton::components.method')
    @include('tekton::buttons.group.top', ['button' => $tekton['options']['button']])
    <h3 class="{{ $tekton['options']['labelAlign'] }} mb-3">{{ $tekton['title'] }}</h3>
    @foreach($tekton['rows'] as $row)
        @include('tekton::row', ['row' => $row])
    @endforeach
    @include('tekton::buttons.group.bottom', ['button' => $tekton['options']['button']])
</form>

@section('tekton-styles')
    @php($tektonStyles = [])
    @foreach(config('tekton.load-styles') as $style)
        @if (!in_array($style, $tektonStyles))
            @php(array_push($tektonStyles, $style))
            <link rel="stylesheet" href="{{ asset($style) }}"/>
        @endif
    @endforeach
@endsection

@section('tekton-scripts')
    @php($tektonScripts = [])
    @foreach(config('tekton.load-scripts') as $script)
        @if (!in_array($script, $tektonScripts))
            @php(array_push($tektonScripts, $script))
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endif
    @endforeach
    @foreach($tekton['rows'] as $row)
        @foreach($row['fields'] as $field)
            @if (config('tekton.scripts.' . $field['type']))
                @php($scripts = config('tekton.scripts.' . $field['type']))
                @foreach($scripts as $script)
                    @if(!in_array($script, $tektonScripts))
                        @php(array_push($tektonScripts, $script))
                        <script src="{{ asset($script) }}" type="text/javascript"></script>
                    @endif
                @endforeach
            @endif
        @endforeach
    @endforeach
@endsection