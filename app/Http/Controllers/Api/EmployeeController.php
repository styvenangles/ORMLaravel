<?php

namespace App\Http\Controllers\Api;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest as Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Employee::chunk(10, function($employee) {
		return $employee;
	});
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       	 $employee = new Employee([
        'emp_no'=> $request->get('emp_no'),
        'first_name'=> $request->get('first_name'),
        'last_name'=> $request->get('last_name'),
        'birth_date'=> $request->get('birth_date'),
        'hire_date'=> $request->get('hire_date'),
        'gender'=> $request->get('gender')
        ]);
        $employee->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
       return $employee;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
	      $employees = Employee::find($employee)->first();
	      $employees->emp_no = $request->get('emp_no');
        $employees->first_name = $request->get('first_name');
	      $employees->last_name = $request->get('last_name');
        $employees->birth_date = $request->get('birth_date');
        $employees->hire_date = $request->get('hire_date');
	      $employees->gender = $request->get('gender');
        $employees->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $e = $employee;
	$employee->delete();
	return $e->toJson();
    }
}
