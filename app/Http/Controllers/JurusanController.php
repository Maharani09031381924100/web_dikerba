<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::all();

        return view('jurusans.index', [
            'jurusans' => $jurusans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jurusans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'jurusan_name' => 'required',
        ]);

        Jurusan::create($request->all());

        return redirect()->route('jurusans.index')
                        ->with('success', 'Jurusan created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Jurusan $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Univ  $univ
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jurusan = Jurusan::where('idjurusan', $id)->first();

        return view('jurusans.edit', compact('jurusan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jurusan_name' => 'required',
        ]);

            $jurusan = Jurusan::where('idjurusan', $id)->first();
            $jurusan->update($request->all());

            return redirect()->route('jurusans.index')
                            ->with('success', 'Jurusan updated successfully');
    }

    public function destroy($id)
    {
        DB::table('jurusans')->where('idjurusan', $id)->delete();

        return redirect()->route('jurusans.index')
        ->with('success', 'Jurusan deleted successfully');

    }
}
