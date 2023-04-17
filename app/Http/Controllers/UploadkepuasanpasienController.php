<?php

namespace App\Http\Controllers;

use App\Models\Uploadkepuasanpasien;
use Illuminate\Http\Request;

class UploadkepuasanpasienController extends Controller
{
    public function index()
    {
        //ambil data dari database
        $data = Uploadkepuasanpasien::all();

        //passing data ke view
        return view('uploadkepuasanpasien.index')->with('data', $data);
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
        $file->move('file_uploadkepuasanpasien', $file->getClientOriginalName());

        $uploadkepuasanpasien = new Uploadkepuasanpasien;
        $uploadkepuasanpasien->file = $nama_file;
        $uploadkepuasanpasien->keterangan = $request->input('keterangan');

        //menyimpan data ke database
        $uploadkepuasanpasien->save();

        //kembali ke halaman sebelumnya
        return back();
    }
    public function destroy(Uploadkepuasanpasien $uploadkepuasanpasien)
    {
        $uploadkepuasanpasien->delete();

        return redirect()->route('uploadkepuasanpasien.index')
                        ->with('success', 'Deleted successfully');

    }
}
