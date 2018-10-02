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