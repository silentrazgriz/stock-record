@if($options['actions']['store'])
    <a href="{{ route($options['route'] . '.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Create
    </a>
@endif
