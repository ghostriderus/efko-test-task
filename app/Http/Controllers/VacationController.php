<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User, App\Models\Vacation, Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VacationController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function index()
	{
		$vacations = Vacation::with('user')->get();
		return view('index',['vacations' => $vacations]);
	}
	
	public function edit()
	{
		$vacation = Auth::user()->vacation;
		return view('vacation',['vacation' => $vacation]);
	}
	
	public function update(Request $request)
	{
		$vac = Auth::user()->vacation;
		if($vac->approved){
			Session::flash('warning','Даты отпуска зафиксированы, вы не можете их изменить');
		} else {
			$validated = $request->validate([
				'start' => 'required|date|after:today',
				'end' 	=> 'required|date|after:today'
			]);
			$vac->update([
				'start_date' => $request->start,
				'end_date' 	 => $request->end
			]);
			Session::flash('success', 'Даты успешно установлены');
		}
		return redirect('/');
	}
	
	public function approve($vid)
	{
		if(Auth::user()->leader){
			$vacation = Vacation::find($vid);
			if($vacation && isset($vacation->start_date) && isset($vacation->end_date)){
				$vacation->update(['approved' => true]);
				Session::flash('success', "Даты отпуска для {$vacation->user->fullname} зафиксированы");
			}
		}
		return redirect()->back();
	}
}
