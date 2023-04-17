<?php

namespace App\Http\Controllers;

use App\Models\Tingkatpendidikan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TingkatpendidikanController extends Controller
{
    public function index()
    {
        $tingkatpendidikans = Tingkatpendidikan::all();

        return view('tingkatpendidikans.index', [
            'tingkatpendidikans' => $tingkatpendidikans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tingkatpendidikans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tkpendidikan_name' => 'required',
        ]);

        Tingkatpendidikan::create($request->all());

        return redirect()->route('tingkatpendidikans.index')
                        ->with('success', 'Tingkat Pendidikan created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Tingkatpendidikan $tingkatpendidikan)
    {
        //
    }

    public function edit($id)
    {
        $tingkatpendidikan = Tingkatpendidikan::where('idtkpendidikan', $id)->first();

        return view('tingkatpendidikans.edit', compact('tingkatpendidikan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tkpendidikan_name' => 'required',
        ]);

            $tingkatpendidikan = Tingkatpendidikan::where('idtkpendidikan', $id)->first();
            $tingkatpendidikan->update($request->all());

            return redirect()->route('tingkatpendidikans.index')
                            ->with('success', 'Tingkat Pendidikan updated successfully');
    }

    public function destroy($id)
    {
        DB::table('tingkatpendidikans')->where('idtkpendidikan', $id)->delete();

        return redirect()->route('tingkatpendidikans.index')
        ->with('success', 'Tingkat Pendidikan deleted successfully');

    }
}
