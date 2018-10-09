<tbody>
<tr>
    <td>Income</td>
    @foreach($account['settlements'] as $settlement)
        <td class="text-right">{{ number_format($settlement['income']) }}</td>
    @endforeach
</tr>
<tr>
    <td>Outcome</td>
    @foreach($account['settlements'] as $settlement)
        <td class="text-right">{{ number_format($settlement['outcome']) }}</td>
    @endforeach
</tr>
<tr>
    <td>Net</td>
    @foreach($account['settlements'] as $settlement)
        <td class="text-right">{{ number_format($settlement['net']) }}</td>
    @endforeach
</tr>
<tr>
    <td>Est. Margin</td>
    @foreach($account['settlements'] as $settlement)
        <td class="text-right">{{ number_format($settlement['margin']) }}</td>
    @endforeach
</tr>
<tr>
    <td>Total</td>
    @foreach($account['settlements'] as $settlement)
        <td class="text-right font-weight-bold {{ $settlement['total'] < 0 ? 'text-danger' : 'text-success' }}">{{ number_format($settlement['total']) }}</td>
    @endforeach
</tr>
</tbody>