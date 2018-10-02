<thead>
<tr>
    @foreach($chiron['fields'] as $field)
        @php($colTitle = ucwords($field['label']))
        @include('chiron::components.titles.' . $field['type'])
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