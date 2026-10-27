@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
<img src="{{ url('/disc/assets/media/logos/Routind Colour.png') }}" width="100px" alt="{{ $slot }} Logo">
@endif
</a>
</td>
</tr>
