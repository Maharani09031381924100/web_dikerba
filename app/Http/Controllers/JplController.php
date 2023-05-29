<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\JplUtama;
use App\Models\Jpl;
use App\Models\Pegawai;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\PDF;
use App\Exports\JplExport;
use App\Exports\JplDetailExport;

use Illuminate\Http\Request;

class JplController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jplUtama=JplUtama::all();
        return view('jpls.index', ['jpls' => $jplUtama]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUtama()
    {
        return view('jpls.createUtama');
    }

    public function create($id)
    {
        $jplUtama=JplUtama::find($id);
        return view('jpls.create')->with(compact('jplUtama'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUtama(Request $request)
     {
         $request->validate([
            'tahun' => 'required',
         ],
         [
            'tahun.required'=>"Tahun harus diisi",
         ]);

         JplUtama::create($request->all());
         return redirect()->route('jpls.index')
             ->with('success_message', 'Berhasil menambah data JPL');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_pegawai' => 'required',
            'kategori' => 'required',
            'nama_kegiatan' => 'required',
            'tempat' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'jpl' => 'required',
            'no_sertif' => 'required',
            'penerbit' => 'required',
        ],
        [
            'no_pegawai.required'=>"Nomor pegawai harus diisi",
            'kategori.required'=>"Kategori harus diisi",
            'nama_kegiatan.required'=>"Nama kegiatan harus diisi",
            'tempat.required'=>"Tempat harus diisi",
            'tgl_mulai.required'=>"Tanggal mulai harus diisi",
            'tgl_selesai.required'=>"Tanggal selesai harus diisi",
            'jpl.required'=>"JPL harus diisi",
            'no_sertif.required'=>"Nomor sertifikat harus diisi",
            'penerbit.required'=>"Penerbit sertifikat harus diisi",
        ]);
        $array = $request->only([
            'no_pegawai','jpl_id','pegawai_id', 'kategori', 'nama_kegiatan','tempat','tgl_mulai','tgl_selesai','jpl','no_sertif','penerbit'
        ]);
        $jpl = Jpl::create($array);
        return redirect()->route('jpls.show',$jpl['jpl_id'])
            ->with('success_message', 'Berhasil menambah data JPL');
    }

    public function getAllFields(Request $request)
    {
        try {
            $pegawai = Pegawai::where('no_pegawai',$request->no_pegawai)->first();
            // here you could check for data and throw an exception if not found e.g.
            // if(!$pegawai) {
            //     throw new \Exception('Data not found');
            // }
            return response()->json($pegawai, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }
    public function showDetail($id)
    {
        DB::statement("SET SQL_MODE=''");
        $jplUtama=JplUtama::find($id);
        $jpl=Jpl::where(('jpl_id'),'=',($jplUtama['id']))->groupBy('pegawai_id')->get();
        return view('jpls.showDetail')->with(compact('jplUtama','jpl'));
    }

    public function showDetailJpl($id, $jplId)
    {
        $jplUtama=JplUtama::find($id);
        $jpl = Jpl::where('pegawai_id', $jplId)->first();
        $jpls = Jpl::where(('jpl_id'),'=',($jplUtama['id']))->where('pegawai_id', $jpl['pegawai_id'])->get();
        return view('jpls.show')->with(compact('jplUtama','jpl','jpls'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function editUtama($id)
     {
        $jplUtama=JplUtama::find($id);
        return view('jpls.editUtama')->with(compact('jplUtama'));
     }

    public function edit($jplId, $id)
    {
        $jplUtama=JplUtama::find($jplId);
        $jpl=Jpl::find($id);
        return view('jpls.edit')->with(compact('jplUtama','jpl'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateUtama(Request $request, $id)
     {

        $request->validate([
            'tahun'=>'required',
        ],
            [
                'tahun.required'=>"Tahun harus diisi"
            ]
        );
        $jplUtama= JplUtama::find($id);
        $jplUtama->tahun=$request->input('tahun');
        $jplUtama->save();
        return redirect(route('jpls.index'))->with('status', 'Data JPL berhasil diedit!');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'no_pegawai' => 'required',
            'kategori' => 'required',
            'nama_kegiatan' => 'required',
            'tempat' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'jpl' => 'required',
            'no_sertif' => 'required',
            'penerbit' => 'required',
        ],
        [
            'no_pegawai.required'=>"Nomor pegawai harus diisi",
            'kategori.required'=>"Kategori harus diisi",
            'nama_kegiatan.required'=>"Nama kegiatan harus diisi",
            'tempat.required'=>"Tempat harus diisi",
            'tgl_mulai.required'=>"Tanggal mulai harus diisi",
            'tgl_selesai.required'=>"Tanggal selesai harus diisi",
            'jpl.required'=>"JPL harus diisi",
            'no_sertif.required'=>"Nomor sertifikat harus diisi",
            'penerbit.required'=>"Penerbit sertifikat harus diisi",
        ]);
        $jplUtama=JplUtama::find($request->jpl_id);
        $jpl=Jpl::find($id);
        $jpl->kategori=$request->input('kategori');
        $jpl->nama_kegiatan=$request->input('nama_kegiatan');
        $jpl->tempat=$request->input('tempat');
        $jpl->tgl_mulai=$request->input('tgl_mulai');
        $jpl->tgl_selesai=$request->input('tgl_selesai');
        $jpl->jpl=$request->input('jpl');
        $jpl->no_sertif=$request->input('no_sertif');
        $jpl->penerbit=$request->input('penerbit');
        $jpl->save();
        return redirect()->route('jpls.show',$jpl['jpl_id'])
            ->with('success_message', 'Berhasil mengubah data JPL');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyUtama($id)
    {
        $jplUtama = JplUtama::find($id);
        $jplUtama->delete();
        return redirect()->route('jpls.index')->with('status', 'Data JPL berhasil dihapus!');
    }

     public function destroy($jplId, $id)
    {
        $jplUtama=JplUtama::find($jplId);
        $jpl=Jpl::find($id);
        $jpl->delete();
        return redirect(route('jpls.show',$jpl['jpl_id']))->with('status', 'Data detail JPL berhasil dihapus!');
    }

    public function cetakJpl($id){
        DB::statement("SET SQL_MODE=''");
        $jplUtama=JplUtama::find($id);
        $jpl=Jpl::where(('jpl_id'),'=',($jplUtama['id']))->groupBy('pegawai_id')->get();
        view()->share('jplUtama', $jplUtama);
        view()->share('jpl', $jpl);
        $pdf = PDF::loadView('jpls.jpl-pdf');
        // $pdf->setPaper('A4');
        return $pdf->stream('Daftar_JPL.pdf');
    }

    public function cetakDetail($id, $jplId){
        $jplUtama=JplUtama::find($id);
        $jpl = Jpl::where('pegawai_id', $jplId)->first();
        $jpls = Jpl::where(('jpl_id'),'=',($jplUtama['id']))->where('pegawai_id', $jpl['pegawai_id'])->get();
        view()->share('jplUtama', $jplUtama);
        view()->share('jpl', $jpl);
        view()->share('jpls', $jpls);
        $pdf = PDF::loadView('jpls.detail-pdf');
        // $pdf->setPaper('A4','landscape');
        return $pdf->stream('Daftar_JPL_Detail.pdf');
    }

    public function excelJpl($id){
        return (new JplExport($id))->download('Daftar_Jpl.xlsx');
    }

    public function excelDetailJpl($id, $jplId){
        return (new JplDetailExport($id, $jplId))->download('Daftar_Detail_Jpl.xlsx');
    }
}
