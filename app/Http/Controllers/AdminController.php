<?php

namespace App\Http\Controllers;

use App\Employees;
use App\Employees_skills;
use App\Skills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function __construct()
    {
        //TODO If there time, I will add JWT for add security a these routes
        $this->middleware('auth')->except(['getEmployees', 'deleteEmployees']);
    }

    public function index()
    {
        return view('dashboard');
    }

    public function getEmployees()
    {
        $employees = Employees::select(['id', 'employeeKey', 'name', 'age', 'position', 'address']);
        return Datatables::of($employees)
            ->addColumn('skills', function ($employees) {
                return \App\Employees_skills::where('id_employee', $employees->id)->count();
            })
            ->addColumn('action', function ($employees) {
                return '<div class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    Acción
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" href="edit-employee/'.$employees->id.'">Editar</a>
                                    <a class="dropdown-item" onclick="deleteEmployee('.$employees->id.')">Eliminar</a>
                                  </div>
                             </div>';
            })
            ->make(true);
    }

    public function deleteEmployees(Request $request) {
        return Employees::where('id', $request->input('id'))->delete();
    }

    public function createEmployee() {
        $skills = Skills::all();
        return view('employees.createEmployee', ['skills' => $skills]);
    }

    public function createEmployeePost(Request $request) {
        $request->validate([
            'employeeKey' => 'required|unique:employees|max:255',
            'name' => 'required|string|max:255',
            'age' => 'required|integer|between:18,80',
            'position' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            //Todo you can validate if the value exist in the db: https://stackoverflow.com/a/42663392
            'skills' => 'array|max:255',
        ]);

        $idNewEmployee = DB::table('employees')->insertGetId([
            'employeeKey' => $request->input('employeeKey'),
            'name' => $request->input('name'),
            'age' => $request->input('age'),
            'position' => $request->input('position'),
            'address' => $request->input('address'),
        ]);

        if(!empty($idNewEmployee) && is_integer($idNewEmployee) && !empty($request->input('skills')) ) {
            foreach($request->input('skills') as $skill) {
                $skillId = Skills::where('name', $skill)->value('id');
                Employees_skills::create([
                   'id_employee' => $idNewEmployee,
                   'id_skill' => $skillId
                ]);
            }
        }

        return redirect('/');
    }

    public function updateEmployee($id){
        $skills = Skills::all();
        $skillsSaved = Employees_skills::select('id_skill')->where('id_employee', $id)->get();

        $skillsReturn = [];
        foreach($skills as $skill) {
            $Skillselected = false;
            foreach($skillsSaved as $skillSaved) {
                if($skill->id == $skillSaved->id_skill) {
                    $Skillselected = true;
                }
            }
            array_push($skillsReturn, ['name' => $skill->name, 'selected' => $Skillselected]);
        }

        $employee = Employees::where('id', $id)->first();
        return view('employees.createEmployee', ['employee' => $employee, 'skills' => $skillsReturn]);
    }

    public function updateEmployeePost(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|between:18,80',
            'position' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            //Todo you can validate if the value exist in the db: https://stackoverflow.com/a/42663392
            'skills' => 'array|max:255',
        ]);

        $idEmployee = (integer) $request->input('id');

        DB::table('employees')->where('id', $idEmployee)->update([
            'name' => $request->input('name'),
            'age' => $request->input('age'),
            'position' => $request->input('position'),
            'address' => $request->input('address'),
        ]);
        if(!empty($idEmployee) && is_integer($idEmployee) && !empty($request->input('skills')) ) {
            Employees_skills::where('id_employee', $idEmployee)->delete();
            foreach($request->input('skills') as $skill) {
                $skillId = Skills::where('name', $skill)->value('id');
                Employees_skills::create([
                    'id_employee' => $idEmployee,
                    'id_skill' => $skillId
                ]);
            }
        }

        return redirect('/');
    }
}
