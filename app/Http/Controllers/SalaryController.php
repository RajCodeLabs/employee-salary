<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $year = $request->input('year');
        $query = Salary::where("employee_id", auth()->user()->id);
        if (is_numeric($year) && strlen($year) === 4 && $year >= 1970)
        {
            $query = $query->whereYear('credited_at', $year);
        }
        else
        {
            $year = null;
        }
        $salaries = $query->get();
        return view("salary.all")->with("salaries", $salaries)->with("year", $year);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("salary.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'numeric|required|min:0',
            'description' => 'string|nullable',
            'credited_at'=> 'required|date',
        ]);
        
        $salary = Salary::create([
            'amount'=> $request->amount,
            'description'=> $request->description,
            'credited_at'=> $request->credited_at,
            'employee_id' => auth()->user()->id,
        ]);
        
        if($salary){
            return redirect()->route('salary.index')->with('success','Salary Created.');
        }

        return redirect()->route('salary.create')->withInput(['amount', 'description', 'credited_at'])->withErrors(['Wrong' => 'Something went wrong.']);
    }
        
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $salary = Salary::find($id);
        if($salary)
        {
            return view('salary.edit')->with('salary', $salary);
        }
        return redirect()->route('salary.index')->withErrors(['NotFound' => 'Salary not found.']);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'amount' => 'numeric|required|min:0',
            'description' => 'string|nullable',
            'credited_at'=> 'required|date',
        ]);
        
        $salary = Salary::find($id);
        if($salary)
        {
            $updated = $salary->update([
                
                'amount'=> $request->amount,
                'description'=> $request->description,
                'credited_at'=> $request->credited_at,
            ]);
            if($updated){
                return redirect()->route('salary.index')->with('success','Salary Updated.');
            }
            return redirect()->route('salary.edit')->withInput(['amount', 'description', 'credited_at'])->withErrors(['Wrong' => 'Something went wrong.']);
        }
        return redirect()->route('salary.index')->withErrors(['NotFound' => 'Salary not found.']);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $salary = Salary::find($id);
        if($salary)
        {
            $deleted = $salary->delete();
            if($deleted){
                return redirect()->route('salary.index')->with('success','Salary Deleted.');
            }
            return redirect()->route('salary.index')->withErrors(['Wrong' => 'Something went wrong.']);
        }
        return redirect()->route('salary.index')->withErrors(['NotFound' => 'Salary not found.']);
    }
}
