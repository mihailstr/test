<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Page2 extends Controller
{
    public function __invoke(Request $request)
    {
		$result = DB::table('ds')->leftJoin('patient', 'patient.id', '=', 'ds.patient')->leftJoin('di', 'di.id', '=', 'ds.ds')->select('ds.id', 'ds.uid', 'patient.fio', 'di.text', 'ds.sdate', 'ds.fdate')->get();
		return view('page1', [
			'pagetitle' => 'Страница со списком случаев',
			'menuitems' => array('', 'UID', 'Пациент', 'Диагноз', 'Дата открытия', 'Дата закрытия', '', '', ''),
			'items' => $result,
			'view' => true,
		]);
    }
}
