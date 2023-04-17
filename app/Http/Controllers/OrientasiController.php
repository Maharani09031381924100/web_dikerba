<?php

namespace App\Http\Controllers;

use App\Models\Orientasi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\OrientasiExport;

class OrientasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orientasis = Orientasi::all();
        $users = User::all();

        return view('orientasis.index', compact('orientasis', 'users'));

    }

    public function cetakorientasi(Request $request)
    {
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $orientasis = Orientasi::whereBetween('tgl_orientasi', [$start_date, $end_date])->get();
        } else {
            $orientasis = Orientasi::all();
        }

        return view('orientasis.cetakorientasi', [
            'orientasis' => $orientasis,
        ]);
    }

    public function downloadorientasipdf(Request $request)
    {
            $orientasis = Orientasi::whereIn('id', $request->orientasis)->get();

            $pdf = PDF::loadview('orientasis.downloadorientasipdf', compact('orientasis'));

            return $pdf->stream('laporan-orientasi.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('orientasis.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'jk' => 'required',
            'tgl_orientasi' => 'required',
            'tgl_selesaiorientasi' => 'required',
            'status_pegawai' => 'required',
            'pendidikan' => 'required',
            'asal' => 'required',
        ]);

        Orientasi::create($request->all());

        return redirect()->route('orientasis.index')
                        ->with('success', 'Orientasi created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Orientasi $orientasi)
    {
        return view('orientasis.show', compact('orientasi'));
    }

    /**
     * Display the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Orientasi $orientasi)
    {
        return view('orientasis.edit', compact('orientasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orientasi $orientasi)
    {
        $request->validate([
            'name' => 'required',
            'jk' => 'required',
            'tgl_orientasi' => 'required',
            'tgl_selesaiorientasi' => 'required',
            'status_pegawai' => 'required',
            'pendidikan' => 'required',
            'asal' => 'required',
        ]);

        $orientasi->update($request->all());

        return redirect()->route('orientasis.index')
                        ->with('success', 'Orientasi updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orientasi $orientasi)
    {
        $orientasi->delete();

        return redirect()->route('orientasis.index')
                        ->with('success', 'Orientasi deleted successfully');
    }

    public function excelOrientasi(Request $request){
        return (new OrientasiExport)->download('Daftar_Orientasi.xlsx');
    }
}
