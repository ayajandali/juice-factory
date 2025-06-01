<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Machine;;

class RegisteredMachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $machines=Machine::latest()->paginate(10);
        return view('dashboards.allmachine',compact('machines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(auth()->user()-> role !=='Manager')
        {
            abort(403);
        }
        return view('dashboards.partials.add-machine-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive,under_maintenance',
            'last_maintenance_date' => 'nullable|date',
        ]);
    
        Machine::create($validated);
    
        return redirect()->route('manager.machine.index')->with('success', 'Machine added successfuly');
    
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
    public function edit(Machine $machine)
    {
        return view('dashboards.partials.edit-machine-form',compact('machine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Machine $machine)
    {
        // تحقق من صحة البيانات
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive,maintenance',
            'last_maintenance_date' => 'nullable|date',
        ]);
    
        // تحديث الآلة
        $machine->update([
            'name' => $validated['name'],
            'status' => $validated['status'],
            'last_maintenance' => $validated['last_maintenance_date'],
        ]);
    
        // إعادة التوجيه بعد التحديث
        return redirect()->route('manager.machine.index')->with('success', 'تم تحديث بيانات الآلة بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Machine $machine)
    {
        $machine->delete();
        return redirect()-> route('manager.machine.index')
        ->with('success','Machine deleted successfully');
    }

    public function maintenance()
    {

    }

    public function available()
    {

    }
}
