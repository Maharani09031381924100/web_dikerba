<?php

namespace App\Http\Controllers;

use App\Models\Uploadevaluasipenyelenggaraan;
use Illuminate\Http\Request;

class UploadevaluasipenyelenggaraanController extends Controller
{
    public function index()
    {
        //ambil data dari database
        $data = Uploadevaluasipenyelenggaraan::all();

        //passing data ke view
        return view('uploadevaluasipenyelenggaraan.index')->with('data', $data);
    }

    public function store(Request $request)
    {

        //membuat validasi, jika tidak diisi maka akan menampilkan pesan error
        $this->validate($request, [
            'file' => 'required',
            'keterangan' => 'required',
        ]);

        //mengambil data file yang diupload
        $file = $request->file('file');
        //mengambil nama file
        $nama_file = $file->getClientOriginalName();

        //memindahkan file ke folder tujuan
        $file->move('file_uploadevaluasipenyelenggaraan', $file->getClientOriginalName());

        $uploadevaluasipenyelenggaraan = new Uploadevaluasipenyelenggaraan;
        $uploadevaluasipenyelenggaraan->file = $nama_file;
        $uploadevaluasipenyelenggaraan->keterangan = $request->input('keterangan');

        //menyimpan data ke database
        $uploadevaluasipenyelenggaraan->save();

        //kembali ke halaman sebelumnya
        return back();
    }
    public function destroy(Uploadevaluasipenyelenggaraan $uploadevaluasipenyelenggaraan)
    {
        $uploadevaluasipenyelenggaraan->delete();

        return redirect()->route('uploadevaluasipenyelenggaraan.index')
                        ->with('success', 'Deleted successfully');

    }
}
