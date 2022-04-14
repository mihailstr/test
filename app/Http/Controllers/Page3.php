<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Page3 extends Controller {
    public function __invoke(Request $request) {
		$patient = DB::table('patient')->select('id', 'fio')->get();
		$di = DB::table('di')->select('id', 'text')->get();
		return view('page2', [
			'pagetitle' => 'Страница создания случая',
			'patient' => $patient,
			'di' => $di,
			'ds' => '',
		]);
    }
	public function change($id) {
		$di = DB::table('di')->select('id', 'text')->get();
		$ds = DB::table('ds')->where('id', $id)->first();
		$patient = DB::table('patient')->select('id', 'fio')->where('id', $ds->patient)->get();
		return view('page2', [
			'pagetitle' => 'Страница изменения случая',
			'patient' => $patient,
			'di' => $di,
			'ds' => $ds,
		]);
	}
	public function save($request, $id) {
		$request = $request->all();
		$di = $request['di'];
		if ($di == '0' && $request['newdi'] != '') {
			$di = DB::table('di')->insertGetId(['text' => $request['newdi']]);
		}
		if ($id) {
			$ds = ['uid' => $request['uid'], 'sdate' => $request['sdate'], 'ds' => $di];
			if (isset($request['fio'])) $ds['patient'] = $request['fio'];
			DB::table('ds')->where('id', $id)->update($ds);
			return Page3::change($id);
		}
		else {
			$id = DB::table('ds')->insertGetId(['uid' => $request['uid'], 'patient' => $request['fio'], 'sdate' => $request['sdate'], 'ds' => intval($di)]);
			return redirect('/page3/' . $id);
		}
	}
	public function dsdelete($id) {
		DB::table('ds')->where('id', $id)->delete();
		return redirect('/page2');
	}
	public function dsclose($id) {
		$di = DB::table('di')->select('id', 'text')->get();
		$ds = DB::table('ds')->where('id', $id)->first();
		$patient = DB::table('patient')->select('id', 'fio')->where('id', $ds->patient)->get();
		return view('close', [
			'pagetitle' => 'Страница закрытия случая',
			'patient' => $patient,
			'di' => $di,
			'ds' => $ds,
		]);
	}
	public function dsclosesave($request, $id) {
		$request = $request->all();
		$di = $request['di'];
		if ($di == -1) {
			$di = DB::table('di')->insertGetId(['text' => $request['newdi']]);
		}
		DB::table('ds')->where('id', $id)->update(['ds' => $di, 'fdate' => $request['fdate']]);
		return redirect('/page2');
	}
}
