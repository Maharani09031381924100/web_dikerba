<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Ruangan;
use App\Models\Univ;
use App\Models\Fakul;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\Tingkatpendidikan;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Exports\MahasiswaExport;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = DB::table('mahasiswas')
                    ->join('univs', 'univs.iduniv', '=', 'mahasiswas.univ_id')
                    ->join('fakuls', 'fakuls.idfakul', '=', 'mahasiswas.fakul_id')
                    ->join('jurusans', 'jurusans.idjurusan', '=', 'mahasiswas.jurusan_id')
                    ->join('prodis', 'prodis.idprodi', '=', 'mahasiswas.prodi_id')
                    ->join('tingkatpendidikans', 'tingkatpendidikans.idtkpendidikan', '=', 'mahasiswas.tkpendidikan_id')
                    ->join('ruangans', 'ruangans.idruangan', '=', 'mahasiswas.ruangan_id')
                    ->get();

            //tampilkan view mahasiswa dan kirim datanya ke view tersebut
            return view('mahasiswas.index')->with('data', $data);

    }

    public function cetakmahasiswa(Request $request)
    {
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $mahasiswas = Mahasiswa::whereBetween('tgl_mulai', [$start_date, $end_date])->get();
        } else {
            $mahasiswas = Mahasiswa::all();
        }

            return view('mahasiswas.cetakmahasiswa', [
                'mahasiswas' => $mahasiswas,
            ]);
    }

    public function downloadmahasiswapdf(Request $request)
    {

        $mahasiswas = Mahasiswa::query()
            ->with('univ')
            ->whereIn('id', $request->mahasiswas)
            ->get();

            $mhs = Mahasiswa::query()
            ->with('univ', 'ruangan')
            ->whereIn('id', $request->mahasiswas)
            ->get()
            ->groupBy([
                function ($query) {
                    return $query->univ->univ_name;
                },
                function ($query) {
                    return $query->fakul->fakul_name;
                },
                function ($query) {
                    return $query->jurusan->jurusan_name;
                },
                function ($query) {
                    return $query->prodi->prodi_name;
                },
                function ($query) {
                    return $query->tingkatpendidikan->tkpendidikan_name;
                },
                function ($query) {
                    return $query->ruangan->ruangan_name;
                },
            ]);
        $pdf = PDF::loadview('mahasiswas.downloadmahasiswapdf', compact('mahasiswas', 'mhs'));
        // $pdf->setPaper('A4','landscape');
        return $pdf->stream('laporan-mahasiswa.pdf');
    }
    // public function excelmahasiswa(Request $request)
    // {
    //     return(new MahasiswaExport)->download('Data_Mahasiswa.xlsx');
    // }

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
        $ruangans = Ruangan::all();

        return view('mahasiswas.create', compact('univs', 'fakuls', 'jurusans', 'prodis', 'tingkatpendidikans', 'ruangans'));

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
            'ruangan_id' => 'required',
            'nim' => 'required',
            'nama_mahasiswa' => 'required',
            'jk' => 'required',
            'semester' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'keterangan' => 'required',
            'Kelulusan' => 'required',
        ]);

        Mahasiswa::create($request->all());

        return redirect()->route('mahasiswas.index')
                        ->with('success', 'Mahasiswa created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {

            //tampilkan view mahasiswa dan kirim datanya ke view tersebut
            return view('mahasiswas.show', compact('mahasiswa'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $univs = Univ::all();
        $fakuls = Fakul::all();
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();
        $tingkatpendidikans = Tingkatpendidikan::all();
        $ruangans = Ruangan::all();

        // dd($mahasiswa);
            //tampilkan view mahasiswa dan kirim datanya ke view tersebut
            return view('mahasiswas.edit', compact('mahasiswa', 'univs', 'fakuls', 'jurusans', 'prodis', 'tingkatpendidikans', 'ruangans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'univ_id' => 'required',
            'fakul_id' => 'required',
            'jurusan_id' => 'required',
            'prodi_id' => 'required',
            'tkpendidikan_id' => 'required',
            'ruangan_id' => 'required',
            'nim' => 'required',
            'nama_mahasiswa' => 'required',
            'jk' => 'required',
            'semester' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'keterangan' => 'required',
            'Kelulusan' => 'required',
        ]);

        $mahasiswa->update($request->all());

        return redirect()->route('mahasiswas.index')
                        ->with('success', 'Mahasiswa updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswas.index')
                        ->with('success', 'Mahasiswa deleted successfully');

    }

    public function excelMahasiswa(Request $request){
        return (new MahasiswaExport)->download('Daftar_Mahasiswa.xlsx');
    }
}
