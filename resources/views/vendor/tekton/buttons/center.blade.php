<div class="col text-center">
    @if($button['action']['reset']['enabled'])
        <button type="submit" class="btn">{{ $button['action']['reset']['text'] }}</button>
    @endif
    @if($button['action']['submit']['enabled'])
        <button type="submit" class="btn btn-primary">{{ $button['action']['submit']['text'] }}</button>
    @endif
</div>
