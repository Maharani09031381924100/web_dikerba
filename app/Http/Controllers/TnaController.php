<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Tna;
use App\Models\TnaUtama;
use Barryvdh\DomPDF\Facade\PDF;
use App\Exports\TnaExport;

class TnaController extends Controller
{
    public function index()
    {
        $tnaUtama = TnaUtama::all();
        return view('tnas.index', ['tnas' => $tnaUtama]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function createUtama()
     {
         return view('tnas.createUtama');
     }

     public function create($id)
    {
        $tnaUtama=TnaUtama::find($id);
        return view('tnas.create')->with(compact('tnaUtama'));
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

         TnaUtama::create($request->all());
         return redirect()->route('tnas.index')
             ->with('success_message', 'Berhasil menambah data TNA');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_pegawai' => 'required',
            'umur' => 'required',
            'lama_kerja_rs' => 'required',
            'lama_kerja_skrg' => 'required',
            'kompetensi' => 'required',
            'masalah' => 'required',
            'pelatihan_2_thn' => 'required',
            'pelatihan_tupoksi' => 'required'
        ],
        [
            'no_pegawai.required'=>"Nomor pegawai harus diisi",
            'umur.required'=>"Umur harus diisi",
            'lama_kerja_rs.required'=>"Lama kerja di RS harus diisi",
            'lama_kerja_skrg.required'=>"Lama kerja di tempat sekarang harus diisi",
            'kompetensi.required'=>"Kompetensi sesuai tupoksi harus diisi",
            'masalah.required'=>"Masalah pengembangan kompetensi harus diisi",
            'pelatihan_2_thn.required'=>"Pelatihan 2 tahun terakhir harus diisi",
            'pelatihan_tupoksi.required'=>"Pelatihan sesuai tupoksi harus diisi"
        ]);
        $tnaUtama=TnaUtama::find($request->tna_id);
        $array = $request->only([
            'no_pegawai','tna_id','pegawai_id', 'umur', 'lama_kerja_rs','lama_kerja_skrg','kompetensi','masalah','pelatihan_2_thn','pelatihan_tupoksi'
        ]);
        $tna = Tna::create($array);
        return redirect()->route('tnas.show',$tna['tna_id'])
            ->with('success_message', 'Berhasil menambah data TNA');
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
        $tnaUtama=TnaUtama::find($id);
        $tna=Tna::all()->where(('tna_id'),'=',($tnaUtama['id']));
        return view('tnas.show')->with(compact('tnaUtama','tna'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function editUtama($id)
     {
        $tnaUtama=TnaUtama::find($id);
        return view('tnas.editUtama')->with(compact('tnaUtama'));
     }

    public function edit($tnaId, $id)
    {
        $tna=Tna::find($id);
        return view('tnas.edit')->with(compact('tna'));
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
        $tnaUtama= TnaUtama::find($id);
        $tnaUtama->tahun=$request->input('tahun');
        $tnaUtama->save();
        return redirect(route('tnas.index'))->with('status', 'Data TNA berhasil diedit!');
     }

     public function update(Request $request, $id)
    {
        $request->validate([
            'no_pegawai' => 'required',
            'umur' => 'required',
            'lama_kerja_rs' => 'required',
            'lama_kerja_skrg' => 'required',
            'kompetensi' => 'required',
            'masalah' => 'required',
            'pelatihan_2_thn' => 'required',
            'pelatihan_tupoksi' => 'required'
        ],
        [
            'no_pegawai.required'=>"Nomor pegawai harus diisi",
            'umur.required'=>"Umur harus diisi",
            'lama_kerja_rs.required'=>"Lama kerja di RS harus diisi",
            'lama_kerja_skrg.required'=>"Lama kerja di tempat sekarang harus diisi",
            'kompetensi.required'=>"Kompetensi sesuai tupoksi harus diisi",
            'masalah.required'=>"Masalah pengembangan kompetensi harus diisi",
            'pelatihan_2_thn.required'=>"Pelatihan 2 tahun terakhir harus diisi",
            'pelatihan_tupoksi.required'=>"Pelatihan sesuai tupoksi harus diisi"
        ]);
        $tnaUtama=TnaUtama::find($request->tna_id);
        $tna=Tna::find($id);
        $tna->umur=$request->input('umur');
        $tna->lama_kerja_rs=$request->input('lama_kerja_rs');
        $tna->lama_kerja_skrg=$request->input('lama_kerja_skrg');
        $tna->kompetensi=$request->input('kompetensi');
        $tna->masalah=$request->input('masalah');
        $tna->pelatihan_2_thn=$request->input('pelatihan_2_thn');
        $tna->pelatihan_tupoksi=$request->input('pelatihan_tupoksi');
        $tna->save();
        return redirect()->route('tnas.show',$tna['tna_id'])
            ->with('success_message', 'Berhasil mengubah data TNA');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function destroyUtama($id)
    {
        $tnaUtama = TnaUtama::find($id);
        $tnaUtama->delete();
        return redirect()->route('tnas.index')->with('status', 'Data TNA berhasil dihapus!');
    }

     public function destroy($tnaId, $id)
    {
        $tnaUtama=TnaUtama::find($tnaId);
        $tna=Tna::find($id);
        $tna->delete();
        return redirect(route('tnas.show',$tna['tna_id']))->with('status', 'Data kegiatan pelatihan berhasil dihapus!');

    }

    public function cetakTna($id){
        $tnaUtama=TnaUtama::find($id);
        $tna=Tna::all()->where(('tna_id'),'=',($tnaUtama['id']));
        view()->share('tnaUtama', $tnaUtama);
        view()->share('tna', $tna);
        $pdf = PDF::loadView('tnas.tna-pdf');
        $pdf->setPaper('A4','landscape');
        return $pdf->stream('Daftar_TNA.pdf');
    }

    public function excelTna($id){
        return (new TnaExport($id))->download('Daftar_TNA.xlsx');
    }
}
