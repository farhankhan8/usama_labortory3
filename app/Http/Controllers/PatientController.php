<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\AvailableTest;
use App\Models\TestPerformed;
use Session;
use App\Models\Catagory;
use App\Models\Patient;
use App\Models\PatientCategory;
use Gate;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PatientController extends Controller
{
    public function index()
    {
        $patients  = Patient::all();
        return view('admin.patient.index', compact('patients'));
    }
    public function create()
    {
        $patientCategorys = PatientCategory::all()->pluck('Pcategory', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.patient.create',compact('patientCategorys'));
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'Pname' => 'required|max:120',
            'email' => 'required|email|unique:patients',
            'phone' => 'required|min:11|numeric',
            ]);
        $patient = Patient::create($request->all());
        return redirect()->route('patient-list');
    }
    public function edit($id)
    { 
        $patients = Patient::findOrFail($id);
        $patientCategorys = PatientCategory::all()->pluck('Pcategory', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.patient.edit', compact('patients','patientCategorys'));
    }
    public function update($id, Request $request)
   {
        $patient = Patient::findOrFail($id);
        $input = $request->all(); 
        $patient->fill($input)->save();
        return redirect()->route('patient-list');
    }
    public function show($id)
    { 
        $allTests = DB::table('test_performeds')
        ->where('test_performeds.patient_id', $id)
        ->join('available_tests', 'test_performeds.available_test_id', '=', 'available_tests.id')
        ->select('available_tests.name','test_performeds.created_at',"test_performeds.id")
        ->orderBy('patient_id', 'DESC')
        ->get();
         $tests = $allTests->pluck('name');    
         $patient = Patient::findOrFail($id);
      
        return view('admin.patient.show', compact('patient','tests','allTests'));
    }
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return redirect()->route('patient-list');
    }

    public function view_multiple_report(Request $request){
        $tests=TestPerformed::whereIn("id",$request->report_ids)->get();
        $getpatient=$tests[0]->patient;
        return view("admin.patient.multiple_reports",compact("tests","getpatient"));
    }
   
}
