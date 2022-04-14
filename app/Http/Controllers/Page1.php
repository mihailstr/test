<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Page1 extends Controller
{
    public function __invoke(Request $request)
    {
		$result = DB::table('patient')->get();
		return view('page1', [
			'pagetitle' => 'Страница со списком пациентов',
			'menuitems' => array('', 'ФИО', 'Пол', 'дата_рождения', 'дата_смерти'),
			'items' => $result,
			'view' => false,
		]);
    }
}
