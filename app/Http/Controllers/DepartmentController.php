<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\DepartmentRequest as Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Department::chunk(10, function($department) {
		return $department;
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
       	 $department = new Department([
        'dept_no'=> $request->get('dept_no'),
        'dept_name'=> $request->get('dept_name')
        ]);
        $department->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return $department;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $departments = Department::find($department)->first();
	      $departments->dept_name = $request->get('dept_name');
        $departments->save();
    }
}
