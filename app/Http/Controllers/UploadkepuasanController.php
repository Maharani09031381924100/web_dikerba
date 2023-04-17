<?php

namespace App\Http\Controllers;

use App\Models\Uploadkepuasan;
use Illuminate\Http\Request;

class UploadkepuasanController extends Controller
{
    public function index()
    {
        //ambil data dari database
        $data = Uploadkepuasan::all();

        //passing data ke view
        return view('uploadkepuasan.index')->with('data', $data);
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
        $file->move('file_uploadkepuasan', $file->getClientOriginalName());

        $uploadkepuasan = new Uploadkepuasan;
        $uploadkepuasan->file = $nama_file;
        $uploadkepuasan->keterangan = $request->input('keterangan');

        //menyimpan data ke database
        $uploadkepuasan->save();

        //kembali ke halaman sebelumnya
        return back();
    }
    public function destroy(Uploadkepuasan $uploadkepuasan)
    {
        $uploadkepuasan->delete();

        return redirect()->route('uploadkepuasan.index')
                        ->with('success', 'Deleted successfully');

    }
}
