<?php

namespace App\Http\Controllers;

use App\Models\Univ;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UnivController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $univs = Univ::all();

        return view('univs.index', [
            'univs' => $univs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('univs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'univ_name' => 'required',
        ]);

        Univ::create($request->all());

        return redirect()->route('univs.index')
                        ->with('success', 'Universitas created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Univ $univ)
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
        $univ = Univ::where('iduniv', $id)->first();

        return view('univs.edit', compact('univ'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Univ  $univ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'univ_name' => 'required',
        ]);

            $univ = Univ::where('iduniv', $id)->first();
            $univ->update($request->all());

            return redirect()->route('univs.index')
                            ->with('success', 'Univ updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Univ  $univ
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('univs')->where('iduniv', $id)->delete();

        return redirect()->route('univs.index')
        ->with('success', 'Universitas deleted successfully');

    }
}
