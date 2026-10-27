<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademyCategory;
use App\Models\AcademyPerformance;

class PerformanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $performances = AcademyPerformance::orderByDesc('year')->orderByDesc('month')->lazy();

        return view('admin.performance.index',[
            'data' => $performances,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $category = empty($request->category) ? 'Brevet Pajak' : $request->category;
        // Fetch from database
        $records = AcademyPerformance::select('year', 'month', 'training', 'certification')->where('category', $category)->get();
        
        // Group by year, then key by month for direct access: $data[2021][3]
        $returns = $records->groupBy('year')->map(function ($yearGroup) {
            return $yearGroup->keyBy('month');
        });

        $availableYears = $returns->keys()->sortDesc();

        // Mapping for display
        $monthMap = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'Aug',
            9 => 'Sept', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'
        ];

        return view('admin.performance.show', compact('returns', 'monthMap', 'availableYears', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request,[
            'category' => 'required',
            'year' => 'required',
            'month' => 'required',
            'training' => 'required',
            'certification' => 'required',
            'description' => 'nullable',
        ]);

        AcademyPerformance::create($validated);

        $request->session()->flash('alert-success', 'Performance berhasil dibuat');
        return redirect()->back();
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $this->validate($request,[
            'category' => 'required',
            'year' => 'required',
            'month' => 'required',
            'training' => 'required',
            'certification' => 'required',
            'description' => 'nullable',
        ]);

        $academy_performance = AcademyPerformance::findOrFail($id);
        $academy_performance->update($validated);

        $request->session()->flash('alert-success', 'Performance berhasil diubah');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        AcademyPerformance::findOrFail($id)->delete();

        $request->session()->flash('alert-success', 'Performance berhasil dihapus');
        return redirect()->back();
    }
}
