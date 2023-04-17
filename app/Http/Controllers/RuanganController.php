<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $ruangans = Ruangan::all();

        return view('ruangans.index', [
            'ruangans' => $ruangans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ruangans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'ruangan_name' => 'required',
        ]);

        Ruangan::create($request->all());

        return redirect()->route('ruangans.index')
                        ->with('success', 'Ruangan created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Ruangan $ruangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ruangan = Ruangan::where('idruangan', $id)->first();

        return view('ruangans.edit', compact('ruangan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'ruangan_name' => 'required',
        ]);

        $ruangan = Ruangan::where('idruangan', $id)->first();
        $ruangan->update($request->all());

        return redirect()->route('ruangans.index')
                        ->with('success', 'Ruangan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('ruangans')->where('idruangan', $id)->delete();

        return redirect()->route('ruangans.index')
        ->with('success', 'Ruangan deleted successfully');
    }
}
