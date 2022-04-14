<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="{{ URL::asset('style.css') }}?ver=1" />
		<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
		<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
		<script>
			$(document).ready(function() {
				$(".datepicker").datepicker({dateFormat: "yy-mm-dd"});
				$(document).on('change', 'select[name="di"]', function(){
					if ($(this).val() > 0) $('#newdi').hide();
					else $('#newdi').show();
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
		<form method="POST" action="/page3/{{ isset($ds->id) ? $ds->id : 0 }}">
			@csrf
			<div>
				<label for="uid">UID</label>
				<input name="uid" type="text" value="{{ isset($ds->uid) ? $ds->uid : '' }}" required>
			</div>
			<div>
				<label for="fio">Пациент</label>
				<select name="fio" {{ empty($ds) ? 'required' : 'disabled'}}>
					<option value=""></option>
					@foreach ($patient as $p)
						<option {{ isset($ds->patient) ? ($p->id == $ds->patient ? 'selected="selected" ' : '') : '' }}value="{{ $p->id }}">{{ $p->fio }}</option>
					@endforeach
				</select>
				<input id="newfio" style="display:none;" name="newfio" type="text" value="">
			</div>
			<div>
				<label for="sdate">Дата открытия</label>
				<input name="sdate" type="text" class="datepicker" value="{{ isset($ds->sdate) ? $ds->sdate : '' }}" required>
			</div>
			<div>
				<label for="di">Диагноз</label>
				<select name="di">
					<option value="0">добавить новый</option>
					<option value=""></option>
					@foreach ($di as $p)
						<option {{ isset($ds->ds) ? ($p->id == $ds->ds ? 'selected="selected" ' : '') : '' }}value="{{ $p->id }}">{{ $p->text }}</option>
					@endforeach
				</select>
				<input id="newdi" style="display:none;" name="newdi" type="text" value="">
			</div>
			<div>
				<input type="submit" value="Сохранить">
			<div>
		</form>
    </body>
</html>
