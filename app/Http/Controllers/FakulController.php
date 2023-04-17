<?php

namespace App\Http\Controllers;

use App\Models\Fakul;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FakulController extends Controller
{
    public function index()
    {
        $fakuls = Fakul::all();

        return view('fakuls.index', [
            'fakuls' => $fakuls,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fakuls.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fakul_name' => 'required',
        ]);

        Fakul::create($request->all());

        return redirect()->route('fakuls.index')
                        ->with('success', 'Fakultas created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Fakul $fakul)
    {
        //
    }

    public function edit($id)
    {
        $fakul = Fakul::where('idfakul', $id)->first();

        return view('fakuls.edit', compact('fakul'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fakul_name' => 'required',
        ]);

            $fakul = Fakul::where('idfakul', $id)->first();
            $fakul->update($request->all());

            return redirect()->route('fakuls.index')
                            ->with('success', 'Fakultas updated successfully');
    }

    public function destroy($id)
    {
        DB::table('fakuls')->where('idfakul', $id)->delete();

        return redirect()->route('fakuls.index')
        ->with('success', 'Fakultas deleted successfully');

    }
}
