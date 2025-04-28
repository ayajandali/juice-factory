<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;

class RegisteredEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees=User::latest()->paginate(10);
        return view('dashboards.allemployees',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(auth()->user()-> role !=='HR')
        {
            abort(403);
        }
        return view('dashboards.partials.add-employee-from');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // التحقق من المدخلات
        $request->validate([
         'first_name'=>'required|string|max:255',
         'last_name'=>'required|string|max:255',
         'email'=>'required|email|unique:user,email',
         'password'=>'required|string',
         'birth_date'=>'required|date',
         'gender'=>'required|in:male,female',
         'role'=>'required|in:HR,Manager,Employee,Accountant,super-employee',
         'phone'=>'required|string|unique:user,phone',
         'address'=>'required|string',
         'salary'=>'required|float',
         'machine_id'=>'required'
        ]);
        $exists = Employee::where('first_name', $request->first_name)
        ->where('last_name', $request->last_name)
        ->where('email', $request->email)
        ->where('birth_date', $request->birth_date)
        ->where('gender', $request->gender)
        ->where('role', $request->role)
        ->exists();

    if ($exists) {
        return back()->withErrors(['error' => 'This Employee already exists'])->withInput();
    }
        
        $employee=User::create($request->all());
        return redirect()->route('dashboards.allemployees')->with('success','Employee added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $employee)
    {
        return view('dashboards.partials.edit-employee-from',compact('employee'));
    }

    /**
     */
    public function update(Request $request, string $id)
    {
         // التحقق من المدخلات
         $request->validate([
            'first_name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
            'password'=>'required|string',
            'birth_date'=>'required|date',
            'gender'=>'required|in:male,female',
            'role'=>'required|in:HR,Manager,Employee,Accountant,super-employee',
            'phone' => 'required|string|unique:employees,phone,' . $id,
            'address'=>'required|string',
            'salary'=>'required|numeric',
            'machine_id'=>'required'
           ]);
           $employee=User::update($request->all());
           return redirect()->route('dashboards.allemployees')->with('success','Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id->delete();
        return redirect()->route('dashboards.allemployees')
        ->with('success','emplyee deleted successfully');

    }
}
