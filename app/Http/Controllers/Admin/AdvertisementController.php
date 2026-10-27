<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademyCategory;
use App\Models\AcademyAdvertisement;
use DB;

class AdvertisementController extends Controller
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
        $data = AcademyAdvertisement::orderByDesc('date')->lazy();

        return view('admin.advertisement.index',[
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $date = (!empty($request->date)) ? $request->date : date('m/d/Y', strtotime('-1 month')) . ' - ' . date('m/d/Y');;
        $start = date_create(substr($date, 0, 10));
        $end = date_create(substr($date, 13, 10));

        $data = AcademyAdvertisement::select('date', 'category', DB::raw('SUM(total) as total_biaya'))
            ->whereDate('date', '>=', date_format($start,"Y-m-d"))->whereDate('date', '<=', date_format($end,"Y-m-d"))
            ->groupBy('date', 'category')
            ->orderBy('date', 'asc')
            ->get();

        // Format data untuk ApexCharts
        $labels = $data->pluck('date')->unique()->values()->toArray();

        $dataBrevet = [];
        $dataAccurate = [];

        foreach ($labels as $label) {
            $brevet = $data->where('date', $label)->where('category', 'Brevet Pajak')->first();
            $accurate = $data->where('date', $label)->where('category', 'Accurate')->first();

            $dataBrevet[] = $brevet ? (int)$brevet->total_biaya : 0;
            $dataAccurate[] = $accurate ? (int)$accurate->total_biaya : 0;
        }
        $last = AcademyAdvertisement::select('category', DB::raw('SUM(total) as total_biaya'))
            ->whereDate('date', '>=', date_format($start,"Y-m-d"))->whereDate('date', '<=', date_format($end,"Y-m-d"))
            ->groupBy('category')
            ->orderBy('date', 'asc')
            ->get();
        return view('admin.advertisement.show', compact('labels', 'dataBrevet', 'dataAccurate', 'date', 'last'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request,[
            'category' => 'required',
            'account' => 'required',
            'impression' => 'required',
            'budget' => 'required',
            'tax' => 'required',
            'total' => 'required',
            'date' => 'required',
        ]);

        AcademyAdvertisement::create($validated);

        $request->session()->flash('alert-success', 'Advertisement berhasil dibuat');
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
            'account' => 'required',
            'impression' => 'required',
            'budget' => 'required',
            'tax' => 'required',
            'total' => 'required',
            'date' => 'required',
        ]);

        $academy_performance = AcademyAdvertisement::findOrFail($id);
        $academy_performance->update($validated);

        $request->session()->flash('alert-success', 'Advertisement berhasil diubah');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        AcademyAdvertisement::findOrFail($id)->delete();

        $request->session()->flash('alert-success', 'Advertisement berhasil dihapus');
        return redirect()->back();
    }
}
