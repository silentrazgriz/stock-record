@extends('base')

@section('content')
    @php($options = $chiron['options'])
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    {{ $chiron['title'] }}
                </div>
                <div class="card-body">
                    @if($options['actions']['store'] || $options['actions']['search'])
                        <div class="row mb-3">
                            <div class="col">
                                @if($options['actions']['store'])
                                    <a href="{{ route($options['route'] . '.create') }}" class="btn btn-success">
                                        <i class="fas fa-plus"></i> Create
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                    <table class="table table-hover mb-2">
                        <thead>
                        <tr>
                            @foreach($chiron['fields'] as $field)
                                @php($colTitleParts = explode('.', $field['key']))
                                @php($colTitle = ucwords(str_replace('_', ' ', end($colTitleParts))))
                                @if($field['type'] == 'number' || $field['type'] == 'float')
                                    <th class="text-right" scope="col">{{ $colTitle }}</th>
                                @else
                                    <th scope="col">{{ $colTitle }}</th>
                                @endif
                            @endforeach
                            @if(
                                $options['actions']['detail'] ||
                                $options['actions']['update'] ||
                                $options['actions']['destroy']
                            )
                                <th scope="col" class="action text-center">Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($chiron['collections']['data'] as $collection)
                            <tr>
                                @foreach($chiron['fields'] as $field)
                                    @if($field['type'] == 'number')
                                        <td class="text-right">
                                            {{ number_format(data_get($collection, $field['key']), 0) }}
                                        </td>
                                    @elseif($field['type'] == 'float')
                                        <td class="text-right">
                                            {{ number_format(data_get($collection, $field['key']), 2) }}
                                        </td>
                                    @else
                                        <td>
                                            {{ data_get($collection, $field['key']) }}
                                        </td>
                                    @endif
                                @endforeach
                                @if(
                                    $options['actions']['detail'] ||
                                    $options['actions']['update'] ||
                                    $options['actions']['destroy']
                                )
                                    <td class="action text-center">
                                        <div class="btn-group" role="group">
                                            @if($options['actions']['detail'])
                                                <a href="{{ route($options['route'] . '.show', $collection['id']) }}"
                                                   class="btn btn-sm btn-facebook"><i class="fas fa-info"></i>
                                                    Detail</a>
                                            @endif
                                            @if($options['actions']['update'])
                                                <a href="{{ route($options['route'] . '.edit', $collection['id']) }}"
                                                   class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</a>
                                            @endif
                                            @if($options['actions']['destroy'])
                                                <a
                                                        class="btn btn-sm btn-danger delete-item"
                                                        data-target="#delete-{{ $collection['id'] }}"
                                                ><i class="far fa-trash-alt"></i> Destroy</a>
                                            @endif
                                        </div>
                                        @if($options['actions']['destroy'])
                                            <form
                                                    method="POST"
                                                    action="{{ route($options['route'] . '.destroy', $collection['id']) }}"
                                                    id="delete-{{ $collection['id'] }}"
                                            >
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE"/>
                                            </form>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col">
                            {{ $chiron['links'] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('vendor/sizzle/sizzle.min.js') }}"></script>
    <script>
        Sizzle('.delete-item').forEach((item) => {
            item.addEventListener('click', (e) => {
                let target = item.dataset.target;
                Sizzle(target)[0].submit();
            });
        });
    </script>
@append