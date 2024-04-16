@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://picsum.photos/100/100" class="logo" alt="Gym point logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
