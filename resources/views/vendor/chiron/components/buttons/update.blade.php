@if($options['actions']['update'])
    <a href="{{ route($options['route'] . '.edit', $collection['id']) }}"
       class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</a>
@endif