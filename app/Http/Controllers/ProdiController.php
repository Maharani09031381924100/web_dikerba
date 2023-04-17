<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $prodis = Prodi::all();

        return view('prodis.index', [
            'prodis' => $prodis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prodis.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'prodi_name' => 'required',
        ]);

        Prodi::create($request->all());

        return redirect()->route('prodis.index')
                        ->with('success', 'Program Studi created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Prodi $prodi)
    {
        //
    }

    public function edit($id)
    {
        $prodi = Prodi::where('idprodi', $id)->first();

        return view('prodis.edit', compact('prodi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'prodi_name' => 'required',
        ]);

            $prodi = Prodi::where('idprodi', $id)->first();
            $prodi->update($request->all());

            return redirect()->route('prodis.index')
                            ->with('success', 'Prodi updated successfully');
    }

    public function destroy($id)
    {
        DB::table('prodis')->where('idprodi', $id)->delete();

        return redirect()->route('prodis.index')
        ->with('success', 'Program Studi deleted successfully');

    }
}
