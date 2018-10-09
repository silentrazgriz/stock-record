@php
    $userAccounts = \App\Data\UserAccount\UserAccount::where('user_id', Auth::id())
        ->get()
        ->toArray();
@endphp

<select id="select-user-account" class="select2">
    @foreach($userAccounts as $userAccount)
        <option value="{{ $userAccount['id'] }}">{{ $userAccount['name'] }}</option>
    @endforeach
</select>


@section('scripts')
    <script>
        $('#select-user-account').select2().change(function(e) {
            fetch('{{ url('set-user-account') }}/' + $(this).val());
        });
    </script>
@append