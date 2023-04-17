<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use App\Models\Ruangan;
use App\Models\Univ;
use App\Models\Fakul;
use App\Models\Jurusan;
use App\Models\Laporanpraktik;
use App\Models\Prodi;
use App\Models\Tingkatpendidikan;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Exports\LaporanExport;

class LaporanpraktikController extends Controller
{
    public function index()
    {
        $univs = Univ::all();
        $fakuls = Fakul::all();
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();
        $tingkatpendidikans = Tingkatpendidikan::all();

        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $laporanpraktiks = Laporanpraktik::whereBetween('tgl_mulai', [$start_date, $end_date])->get();
        } else {
            $laporanpraktiks = Laporanpraktik::all();
        }

        return view('laporanpraktiks.index', compact('laporanpraktiks'));
        return view('laporanpraktiks.cetaklaporanpraktik', [
                'laporanpraktiks' => $laporanpraktiks,
            ]);
    }

    public function cetaklaporanpraktik(Request $request)
    {
        $laporanpraktiks = Laporanpraktik::query()
            ->whereIn('id', $request->laporanpraktiks)
            ->get();

        $pdf = PDF::loadview('laporanpraktiks.cetaklaporanpraktik', compact('laporanpraktiks'));
        $pdf->setPaper('A4','landscape');
        return $pdf->stream('laporan-laporanpraktik.pdf');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $univs = Univ::all();
        $fakuls = Fakul::all();
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();
        $tingkatpendidikans = Tingkatpendidikan::all();

        return view('laporanpraktiks.create', compact('univs', 'fakuls', 'jurusans', 'prodis', 'tingkatpendidikans'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'univ_id' => 'required',
            'fakul_id' => 'required',
            'jurusan_id' => 'required',
            'prodi_id' => 'required',
            'tkpendidikan_id' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required',
            'Kelulusan' => 'required',
        ]);

        Laporanpraktik::create($request->all());

        return redirect()->route('laporanpraktiks.index')
                        ->with('success', 'Data Laporan Praktik created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Laporanpraktik $laporanpraktik)
    {

            //tampilkan view mahasiswa dan kirim datanya ke view tersebut
            return view('laporanpraktiks.show', compact('laporanpraktik'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporanpraktik $laporanpraktik)
    {
        $univs = Univ::all();
        $fakuls = Fakul::all();
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();
        $tingkatpendidikans = Tingkatpendidikan::all();

        // dd($mahasiswa);
            //tampilkan view mahasiswa dan kirim datanya ke view tersebut
            return view('laporanpraktiks.edit', compact('laporanpraktik', 'univs', 'fakuls', 'jurusans', 'prodis', 'tingkatpendidikans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporanpraktik $laporanpraktik)
    {
        $request->validate([
            'univ_id' => 'required',
            'fakul_id' => 'required',
            'jurusan_id' => 'required',
            'prodi_id' => 'required',
            'tkpendidikan_id' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required',
            'Kelulusan' => 'required',
        ]);

        $laporanpraktik->update($request->all());

        return redirect()->route('laporanpraktiks.index')
                        ->with('success', 'Data Laporan Praktik updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporanpraktik $laporanpraktik)
    {
        $laporanpraktik->delete();

        return redirect()->route('laporanpraktiks.index')
                        ->with('success', 'Laporan Praktik deleted successfully');

    }

    public function excelLaporan(Request $request){
        return (new LaporanExport)->download('Laporan_Mahasiswa_Praktik.xlsx');
    }
}
