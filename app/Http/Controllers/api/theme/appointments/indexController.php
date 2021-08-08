<?php

namespace App\Http\Controllers\api\theme\appointments;

use App\Http\Controllers\Controller;
use App\Model\Theme\Appointment;
use App\Model\Theme\Dietician;
use App\Model\Theme\Dieticians;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index()
    {
        $appointments=Appointment::all();
        return response()->json([
            'success'=>true,
            'data'=>$appointments
        ],200);
    }

    public function show($slug)
    {
        $dietician=Dieticians::where('slug',$slug)->firstOrFail();
        $appointments=Appointment::where('dietician_id',$dietician->_id)->get();
        return response()->json(['data'=>$appointments]);

    }
    public function store(Request $request)
    {
        $request->validate([
           'fullname'=>'required',
           'phone'=>'required'
        ]);
        $dieticianid=Dieticians::where('slug',$request->slug)->firstOrFail()->_id;

        $appointment=Appointment::create([
           'fullname'=>$request->fullname ?? '',
           'email'=>$request->email ?? '',
           'phone'=>$request->phone ?? '',
           'description'=>$request->description ?? '',
           'dietician_id'=>$dieticianid,
           'date'=>$request->date ?? '',
        ]);
        return response()->json(['data'=>$appointment]);
    }
}
