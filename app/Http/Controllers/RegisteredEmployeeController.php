<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Machine;


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
        $machines = Machine::all();
        return view('dashboards.partials.add-employee-form' , compact('machines'));
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
         'password'=>'required|string|min:8',
         'birth_date'=>'required|date',
         'gender'=>'required|in:male,female',
         'role'=>'required|in:HR,Manager,Employee,Accountant,super-employee',
         'phone'=>'required|string|unique:user,phone',
         'address'=>'required|string',
         'salary'=>'required|numeric',
         'machine_id'=>'nullable|integer'
        ]);
        $exists = User::where('first_name', $request->first_name)
        ->where('last_name', $request->last_name)
        ->where('email', $request->email)
        ->where('birth_date', $request->birth_date)
        ->where('gender', $request->gender)
        ->where('role', $request->role)
        ->exists();

    if ($exists) {
        return back()->withErrors(['error' => 'This Employee already exists'])->withInput();
    }
    $requestData = $request->all();
    $requestData['password'] = Hash::make($request->password);
    // تشفير كلمة المرور
    $requestData['machine_id']=$request->machine_id?:null; 
        $employee=User::create($requestData);
        return redirect()->route('hr.employees.index')->with('success','Employee added successfully');
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
    public function edit(User $employee)
{
    $machines = Machine::all(); // جلب كل الماكينات من قاعدة البيانات
    return view('dashboards.partials.edit-employee-form', compact('employee', 'machines'));
}

    /**
     */
    public function update(Request $request, string $id)
    {
         // التحقق من المدخلات
         $request->validate([
            'first_name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'email' => 'required|email|unique:user,email,' . $id,
            'password'=>'nullable|string',
            'birth_date'=>'required|date',
            'gender'=>'required|in:male,female',
            'role'=>'required|in:HR,Manager,Employee,Accountant,super-employee',
            'phone' => 'required|string|unique:user,phone,' . $id,
            'address'=>'required|string',
            'salary'=>'required|numeric',
            'machine_id'=>'nullable'
           ]);
           $employee = User::findOrFail($id);

           $employee->first_name = $request->first_name;
           $employee->last_name = $request->last_name;
           $employee->email = $request->email;
           $employee->role = $request->role;
           $employee->phone = $request->phone;
           $employee->birth_date = $request->birth_date;
           $employee->salary = $request->salary;
           $employee->address = $request->address;
           $employee->gender = $request->gender;
           $employee->machine_id =$request->machine_id?:null;
           $employee->save();
           return redirect()->route('hr.employees.index')->with('success','Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $employee)
    {
       
        $employee->delete();
        return redirect()-> route('hr.dashboard')
        ->with('success','emplyee deleted successfully');

    }
}
