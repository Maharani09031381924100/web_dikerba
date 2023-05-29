<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Barryvdh\DomPDF\Facade\PDF;
use App\Exports\PegawaiExport;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all();
        return view('pegawais.index', ['pegawais' => $pegawai]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawais.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_pegawai' => 'required',
            'email_address' => 'required',
            'nama_pegawai' => 'required',
            'jk' => 'required',
            'tk_pddkan' => 'required',
            'status_pekerjaan' => 'required',
            'status_jabatan' => 'required',
            'bidang' => 'required'
        ],
        [
            'no_pegawai.required'=>"Nomor pegawai harus diisi",
            'email_address.required'=>"Email harus diisi",
            'nama_pegawai.required'=>"Nama pegawai harus diisi",
            'jk.required'=>"Jenis kelamin harus diisi",
            'tk_pddkan.required'=>"Tingkat pendidikan harus diisi",
            'status_pekerjaan.required'=>"Status pekerjaan harus diisi",
            'status_jabatan.required'=>"Status jabatan harus diisi",
            'bidang.required'=>"Bidang atau bagian harus diisi",
        ]);
        $array = $request->only([
            'no_pegawai', 'email_address', 'nama_pegawai','jk','tk_pddkan','status_pekerjaan','status_jabatan','bidang'
        ]);
        $pegawai = Pegawai::create($array);
        return redirect()->route('pegawais.index')
            ->with('success_message', 'Berhasil menambah data pegawai');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pegawai = Pegawai::find($id);
        if (!$pegawai) return redirect()->route('pegawais.index')
            ->with('error_message', 'pegawai dengan nomor pegawai'.$id.' tidak ditemukan');
        return view('pegawais.edit', [
            'pegawai' => $pegawai
        ]);
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
            'no_pegawai' => 'required',
            'email_address' => 'required',
            'nama_pegawai' => 'required',
            'jk' => 'required',
            'tk_pddkan' => 'required',
            'status_pekerjaan' => 'required',
            'status_jabatan' => 'required',
            'bidang' => 'required'
        ],
        [
            'no_pegawai.required'=>"Nomor pegawai harus diisi",
            'email_address.required'=>"Email harus diisi",
            'nama_pegawai.required'=>"Nama pegawai harus diisi",
            'jk.required'=>"Jenis kelamin harus diisi",
            'tk_pddkan.required'=>"Tingkat pendidikan harus diisi",
            'status_pekerjaan.required'=>"Status pekerjaan harus diisi",
            'status_jabatan.required'=>"Status jabatan harus diisi",
            'bidang.required'=>"Bidang atau bagian harus diisi",
        ]);
        $pegawai = Pegawai::find($id);
        $pegawai->no_pegawai = $request->no_pegawai;
        $pegawai->email_address = $request->email_address;
        $pegawai->nama_pegawai = $request->nama_pegawai;
        $pegawai->jk = $request->jk;
        $pegawai->tk_pddkan = $request->tk_pddkan;
        $pegawai->status_pekerjaan = $request->status_pekerjaan;
        $pegawai->status_jabatan = $request->status_jabatan;
        $pegawai->bidang = $request->bidang;
        if ($pegawai) $pegawai->delete();
        $pegawai->save();
        return redirect()->route('pegawais.index')
            ->with('success_message', 'Berhasil mengubah data pegawai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        if ($pegawai) $pegawai->delete();
        return redirect()->route('pegawais.index')
            ->with('success_message', 'Berhasil menghapus data pegawai');
    }

    public function cetakPegawai(Request $request){
        $pegawai = Pegawai::all();

        view()->share('pegawai', $pegawai);
        $pdf = PDF::loadView('pegawais.pegawai-pdf');
        // $pdf->setPaper('A4');
        return $pdf->stream('Daftar_Pegawai.pdf');
    }

    public function excelPegawai(Request $request){
        return (new PegawaiExport)->download('Daftar_Pegawai.xlsx');
    }
}
