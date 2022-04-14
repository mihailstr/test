<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('style.css') }}?ver=1" />
		<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
		<script>
			$(document).ready(function() {
				$(document).on('click', '.view', function(){
					location.href = '/page3/' + $(this).attr('data-id');
				});
				$(document).on('click', '.delete', function(){
					if (confirm('Удалить эту запись?')) location.href = '/page3/delete/' + $(this).attr('data-id');
				});
				$(document).on('click', '.close', function(){
					location.href = '/page3/close/' + $(this).attr('data-id');
				});
			});
		</script>
    </head>
    <body>
		<ul>
			<li><a href="/page1">СТРАНИЦА_1</a></li>
			<li><a href="/page2">СТРАНИЦА_2</a></li>
			<li><a href="/page3">СТРАНИЦА_3</a></li>
		</ul>
		<div>{{ $pagetitle }}</div>
		<table>
			<tr>
				@foreach ($menuitems as $menuitem)
					<td>{{ $menuitem }}</td>
				@endforeach
			</tr>
			@foreach ($items as $item)
				<tr>
					@foreach ($item as $key => $td)
						@if ($key == 'uid')
							<td><a href="/page3/{{ $item->id }}">{{ $td }}</a></td>
						@else
							<td>{{ $key == 'sex' ? ($td ? 'Ж' : 'М') : $td }}</td>
						@endif
					@endforeach
					@if ($view)
						<td><input type="button" class="view" data-id="{{ $item->id }}" value="просмотр"></td>
						<td><input type="button" class="delete" data-id="{{ $item->id }}" value="удалить случай"></td>
						<td><input type="button" class="close" data-id="{{ $item->id }}" value="закрыть случай"></td>
					@endif
				</tr>
			@endforeach
		</table>
    </body>
</html>
