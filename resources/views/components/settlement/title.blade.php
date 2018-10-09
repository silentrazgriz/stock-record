<thead>
<tr>
    <th scope="col">Description</th>
    @foreach($account['settlements'] as $key => $settlement)
        <th class="text-right" scope="col">{{ $key }}</th>
    @endforeach
</tr>
</thead>