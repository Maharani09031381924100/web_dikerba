<?php

namespace App\Http\Controllers;

use App\Models\Uploadevaluasikinerjadokter;
use Illuminate\Http\Request;

class UploadevaluasikinerjadokterController extends Controller
{
    public function index()
    {
        //ambil data dari database
        $data = Uploadevaluasikinerjadokter::all();

        //passing data ke view
        return view('uploadevaluasikinerjadokter.index')->with('data', $data);
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
        $file->move('file_uploadevaluasikinerjadokter', $file->getClientOriginalName());

        $uploadevaluasikinerjadokter = new Uploadevaluasikinerjadokter;
        $uploadevaluasikinerjadokter->file = $nama_file;
        $uploadevaluasikinerjadokter->keterangan = $request->input('keterangan');

        //menyimpan data ke database
        $uploadevaluasikinerjadokter->save();

        //kembali ke halaman sebelumnya
        return back();
    }
    public function destroy(Uploadevaluasikinerjadokter $uploadevaluasikinerjadokter)
    {
        $uploadevaluasikinerjadokter->delete();

        return redirect()->route('uploadevaluasikinerjadokter.index')
                        ->with('success', 'Deleted successfully');

    }
}
