<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Iht;
use App\Models\Detail_Iht;
use App\Models\Peserta_Iht;
use App\Models\Narasumber_Iht;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\PDF;
use App\Exports\IhtExport;
use App\Exports\IhtDetailExport;
use App\Exports\IhtPesertaExport;

class IhtController extends Controller
{
    public function index()
    {
        $iht = Iht::all();
        return view('ihts.iht', ['iht'=>$iht]);
    }

    public function indexDashboard()
    {
        $iht = Iht::all();
        return view('home', ['iht'=>$iht]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'tgl_mulai'=>'required',
            'tgl_selesai'=>'required',
            'jenis_kegiatan'=>'required',
            'nama_pelatihan'=>'required',
            'status'=>'required'
        ],
            [
                'tgl_mulai.required'=>"Tanggal mulai harus diisi",
                'tgl_selesai.required'=>"Tanggal selesai harus diisi",
                'jenis_kegiatan.required'=>"Jenis kegiatan harus diisi",
                'nama_pelatihan.required'=>"Nama pelatihan harus diisi",
                'status.required'=>"Status kegiatan harus diisi"
            ]
        );

        iht::create($request->all());
        return redirect('/iht')->with('status', 'Data IHT berhasil ditambahkan!');
    }

    public function storeDetail(Request $request)
    {
        $tgl_mulai = iht::select('tgl_mulai')->where('id', $request->iht_id)->first();
        $tgl_selesai = iht::select('tgl_selesai')->where('id', $request->iht_id)->first();
        $request->validate([
            'tgl_pelaksanaan'=>['required','date','after_or_equal:'.$tgl_mulai->tgl_mulai,'before_or_equal:'.$tgl_selesai->tgl_selesai],
            'nama_detail'=>'required',
            'gelombang'=>'required',
            'tempat'=>'required',
            'peserta'=>'required',
            'narasumber'=>'required'
        ],
            [
                'tgl_pelaksanaan.required'=>"Tanggal pelaksanaan harus diisi",
                'tgl_pelaksanaan.after_or_equal'=>"Tanggal pelaksanaan harus sama atau setelah $tgl_mulai->tgl_mulai",
                'tgl_pelaksanaan.before_or_equal'=>"Tanggal pelaksanaan harus sama atau sebelum $tgl_selesai->tgl_selesai",
                'nama_detail.required'=>"Nama detail harus diisi",
                'gelombang.required'=>"Gelombang harus diisi",
                'tempat.required'=>"Tempat harus diisi",
                'peserta.required'=>"Jumlah peserta harus diisi",
                'narasumber.required'=>"Jumlah narasumber harus diisi"
            ]
        );
        $iht = iht::findOrFail($request->iht_id);
        $detailIht = Detail_Iht::create([
            'tgl_pelaksanaan'=>$request->tgl_pelaksanaan,
            'nama_detail'=>$request->nama_detail,
            'gelombang'=>$request->gelombang,
            'tempat'=>$request->tempat,
            'peserta'=>$request->peserta,
            'narasumber'=>$request->narasumber,
            'iht_id'=>$iht->id
        ]);
        return redirect(route('iht.show',$detailIht['iht_id']))->with('status', 'Data detail kegiatan berhasil ditambahkan!');
    }

    public function storePeserta(Request $request)
    {
        $request->validate([
            'nama_peserta'=>'required',
            'tempat_tugas'=>'required'
        ],
            [
                'nama_peserta.required'=>"Nama peserta harus diisi",
                'tempat_tugas.required'=>"Tempat tugas harus diisi"
            ]
        );

        $detailIht = Detail_Iht::findOrFail($request->detail_iht_id);
        $pesertaIht = Peserta_Iht::create([
            'nama_peserta'=>$request->nama_peserta,
            'tempat_tugas'=>$request->tempat_tugas,
            'detail_iht_id'=>$detailIht->id,
        ]);
        return redirect(route('iht.showPeserta', array($detailIht['iht_id'], $pesertaIht['detail_iht_id'])))->with('status', 'Data peserta pelatihan berhasil ditambahkan!');
    }

    public function storeNarasumber(Request $request)
    {
        $request->validate([
            'nama_narasumber'=>'required',
            'instansi'=>'required'
        ],
            [
                'nama_narasumber.required'=>"Nama narasumber harus diisi",
                'instansi.required'=>"Tempat tugas harus diisi"
            ]
        );
        $detailIht = Detail_Iht::findOrFail($request->detail_iht_id);
        $narasumberIht = Narasumber_Iht::create([
            'nama_narasumber'=>$request->nama_narasumber,
            'instansi'=>$request->instansi,
            'detail_iht_id'=>$detailIht->id
        ]);
        return redirect(route('iht.showPeserta',array($detailIht['iht_id'], $narasumberIht['detail_iht_id'])))->with('status', 'Data narasumber pelatihan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function show($id)
    {
        $iht= iht::find($id);
        $detailIht=Detail_Iht::all()->where(('iht_id'),'=',($iht['id']));
        $total_peserta = DB::table('detail_ihts')->where(('iht_id'),'=',($iht['id']))->sum('peserta');
        $total_narasumber = DB::table('detail_ihts')->where(('iht_id'),'=',($iht['id']))->sum('narasumber');
        $total = $total_peserta + $total_narasumber;
        return view('ihts.ihtDetail')->with(compact('detailIht', 'iht', 'total_peserta', 'total_narasumber', 'total'));
    }

    public function showPeserta($id, $detail_id)
    {
        $iht=iht::find($id);
        $detailIht=Detail_Iht::find($detail_id);
        $pesertaIht = Peserta_Iht::all()->where(('detail_iht_id'),'=',($detailIht['id']));
        $narasumberIht = Narasumber_Iht::all()->where(('detail_iht_id'),'=',($detailIht['id']));
        return view('ihts.ihtDetailPeserta')->with(compact('iht','detailIht', 'pesertaIht', 'narasumberIht'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_mulai'=>'required',
            'tgl_selesai'=>'required',
            'jenis_kegiatan'=>'required',
            'nama_pelatihan'=>'required',
            'status'=>'required'
        ],
            [
                'tgl_mulai.required'=>"Tanggal mulai harus diisi",
                'tgl_selesai.required'=>"Tanggal selesai harus diisi",
                'jenis_kegiatan.required'=>"Jenis kegiatan harus diisi",
                'nama_pelatihan.required'=>"Nama pelatihan harus diisi",
                'status.required'=>"Status harus diisi"
            ]
        );

        $iht= iht::find($id);
        $iht->tgl_mulai=$request->input('tgl_mulai');
        $iht->tgl_selesai=$request->input('tgl_selesai');
        $iht->jenis_kegiatan=$request->input('jenis_kegiatan');
        $iht->nama_pelatihan=$request->input('nama_pelatihan');
        $iht->status=$request->input('status');
        $iht->save();
        return redirect('/iht')->with('status', 'Data IHT berhasil diedit!');
    }

    public function updateDetail(Request $request)
    {
        $tgl_mulai = iht::select('tgl_mulai')->where('id', $request->iht_id)->first();
        $tgl_selesai = iht::select('tgl_selesai')->where('id', $request->iht_id)->first();
        $request->validate([
            'tgl_pelaksanaan'=>['required','date','after_or_equal:'.$tgl_mulai->tgl_mulai,'before_or_equal:'.$tgl_selesai->tgl_selesai],
            'nama_detail'=>'required',
            'gelombang'=>'required',
            'tempat'=>'required',
            'peserta'=>'required',
            'narasumber'=>'required'
        ],
            [
                'tgl_pelaksanaan.required'=>"Tanggal pelaksanaan harus diisi",
                'tgl_pelaksanaan.after_or_equal'=>"Tanggal pelaksanaan harus sama atau setelah $tgl_mulai->tgl_mulai",
                'tgl_pelaksanaan.before_or_equal'=>"Tanggal pelaksanaan harus sama atau sebelum $tgl_selesai->tgl_selesai",
                'nama_detail.required'=>"Nama detail harus diisi",
                'gelombang.required'=>"Gelombang harus diisi",
                'tempat.required'=>"Tempat harus diisi",
                'peserta.required'=>"Jumlah peserta harus diisi",
                'narasumber.required'=>"Jumlah narasumber harus diisi"
            ]
        );
        $iht = iht::find($request->iht_id);
        $detailIht = Detail_Iht::find($request->id);

        $detailIht->tgl_pelaksanaan=$request->input('tgl_pelaksanaan');
        $detailIht->nama_detail=$request->input('nama_detail');
        $detailIht->gelombang=$request->input('gelombang');
        $detailIht->tempat=$request->input('tempat');
        $detailIht->peserta=$request->input('peserta');
        $detailIht->narasumber=$request->input('narasumber');
        $detailIht->save();
        return redirect(route('iht.show',$detailIht['iht_id']))->with('status', 'Data kegiatan pelatihan berhasil diedit!');
    }

    public function updatePeserta(Request $request)
    {
        $request->validate([
            'nama_peserta'=>'required',
            'tempat_tugas'=>'required'
        ],
            [
                'nama_peserta.required'=>"Nama peserta harus diisi",
                'tempat_tugas.required'=>"Tempat tugas harus diisi"
            ]
        );
        $detailIht = Detail_Iht::find($request->detail_iht_id);
        $pesertaIht = Peserta_Iht::find($request->id);
        $pesertaIht->nama_peserta=$request->input('nama_peserta');
        $pesertaIht->tempat_tugas=$request->input('tempat_tugas');
        $pesertaIht->save();

        return redirect(route('iht.showPeserta', array($detailIht['iht_id'], $pesertaIht['detail_iht_id'])))->with('status', 'Data peserta berhasil diedit!');
    }

    public function updateNarasumber(Request $request)
    {
        $request->validate([
            'nama_narasumber'=>'required',
            'instansi'=>'required'
        ],
            [
                'nama_narasumber.required'=>"Nama narasumber harus diisi",
                'instansi.required'=>"Instansi harus diisi"
            ]
        );
        $detailIht = Detail_Iht::find($request->detail_iht_id);
        $narasumberIht = Narasumber_Iht::find($request->id);

        $narasumberIht->nama_narasumber=$request->input('nama_narasumber');
        $narasumberIht->instansi=$request->input('instansi');
        $narasumberIht->save();

        return redirect(route('iht.showPeserta', array($detailIht['iht_id'], $narasumberIht['detail_iht_id'])))->with('status', 'Data narasumber berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $iht = iht::find($id);
        $iht->delete();
        return redirect('/iht')->with('status', 'Data IHT berhasil dihapus!');
    }

    public function destroyDetail($id)
    {
        $detailIht = Detail_Iht::find($id);
        $detailIht->delete();
        return redirect(route('iht.show',$detailIht['iht_id']))->with('status', 'Data kegiatan pelatihan berhasil dihapus!');
    }

    public function destroyPeserta($id)
    {
        $pesertaIht = Peserta_Iht::find($id);
        $detailIht = Detail_Iht::select('iht_id')->where('id', $pesertaIht->detail_iht_id)->first();
        $pesertaIht->delete();
        return redirect(route('iht.showPeserta',array($detailIht['iht_id'], $pesertaIht['detail_iht_id'])))->with('status', 'Data peserta pelatihan berhasil dihapus!');
    }

    public function destroyNarasumber($id)
    {
        $narasumberIht = Narasumber_Iht::find($id);
        $detailIht = Detail_Iht::select('iht_id')->where('id', $narasumberIht->detail_iht_id)->first();
        $narasumberIht->delete();
        return redirect(route('iht.showPeserta',array($detailIht['iht_id'], $narasumberIht['detail_iht_id'])))->with('status', 'Data narasumber pelatihan berhasil dihapus!');
    }

    public function filterPelatihan(Request $request){
        if (request()->startdate || request()->enddate) {
            $startdate = Carbon::parse(request()->startdate)->toDateTimeString();
            $enddate = Carbon::parse(request()->enddate)->toDateTimeString();
            $iht = iht::whereBetween('tgl_mulai',[$startdate,$enddate])->whereBetween('tgl_selesai',[$startdate,$enddate])->get();
        } else {
            $iht = iht::all();
        }
        view()->share('iht', $iht);
        return view('ihts.iht')->with(compact('iht'));
    }

    public function cetakPelatihan(Request $request){
        if (request()->startdate || request()->enddate) {
            $startdate = Carbon::parse(request()->startdate)->toDateTimeString();
            $enddate = Carbon::parse(request()->enddate)->toDateTimeString();
            $iht = iht::whereBetween('tgl_mulai',[$startdate,$enddate])->whereBetween('tgl_selesai',[$startdate,$enddate])->get();
            $start=$startdate;
            $end=$enddate;
        } else {
            $iht = iht::all();
            $start=null;
            $end=null;
        }
        view()->share('start', $start);
        view()->share('end', $end);
        view()->share('iht', $iht);
        $pdf = PDF::loadView('ihts.pelatihan-pdf');
        $pdf->setPaper('A4');
        return $pdf->stream('Daftar_Pelatihan.pdf');
    }

    public function cetakDetail($id){
        $iht=iht::find($id);
        $detailIht=Detail_Iht::all()->where(('iht_id'),'=',($iht['id']));
        view()->share('iht', $iht);
        view()->share('detailIht', $detailIht);
        $pdf = PDF::loadView('ihts.detail-pdf');
        $pdf->setPaper('A4');
        return $pdf->stream('Daftar_Kegiatan.pdf');
    }

    public function cetakPeserta($id, $detail_id){
        $iht=iht::find($id);
        $detailIht=Detail_Iht::find($detail_id);
        $pesertaIht = Peserta_Iht::all()->where(('detail_iht_id'),'=',($detailIht['id']));
        $narasumberIht = Narasumber_Iht::all()->where(('detail_iht_id'),'=',($detailIht['id']));
        view()->share('iht', $iht);
        view()->share('detailIht', $detailIht);
        view()->share('pesertaIht', $pesertaIht);
        view()->share('narasumberIht', $narasumberIht);
        $pdf = PDF::loadView('ihts.peserta-pdf');
        $pdf->setPaper('A4');
        return $pdf->stream('Daftar_Peserta.pdf');
    }

    public function excelPelatihan(Request $request){
        return (new IhtExport)->download('Daftar_Pelatihan.xlsx');
    }

    public function excelDetail($id){
        return (new IhtDetailExport($id))->download('Daftar_Kegiatan.xlsx');
    }

    public function excelPeserta($id){
        return (new IhtPesertaExport($id))->download('Daftar_Peserta.xlsx');
    }

}
