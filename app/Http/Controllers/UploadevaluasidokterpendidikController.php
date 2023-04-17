<?php

namespace App\Http\Controllers;

use App\Models\Uploadevaluasidokterpendidik;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UploadevaluasidokterpendidikController extends Controller
{
    public function index()
    {
        //ambil data dari database
        $data = Uploadevaluasidokterpendidik::all();

        //passing data ke view
        return view('uploadevaluasidokterpendidik.index')->with('data', $data);
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
        $file->move('file_uploadevaluasidokterpendidik', $file->getClientOriginalName());

        $uploadevaluasidokterpendidik = new Uploadevaluasidokterpendidik;
        $uploadevaluasidokterpendidik->file = $nama_file;
        $uploadevaluasidokterpendidik->keterangan = $request->input('keterangan');

        //menyimpan data ke database
        $uploadevaluasidokterpendidik->save();

        //kembali ke halaman sebelumnya
        return back();
    }
    public function destroy(Uploadevaluasidokterpendidik $uploadevaluasidokterpendidik)
    {
        $uploadevaluasidokterpendidik->delete();

        return redirect()->route('uploadevaluasidokterpendidik.index')
                        ->with('success', 'Deleted successfully');

    }
}
