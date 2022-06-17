<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kasir;
use App\Models\Manager;

class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kasirs = Kasir::latest()->paginate(15);

        return view('kasir.dashboard', compact('kasirs'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = Manager::all();
        return view('kasir.create', compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([

            'nama_pelanggan' => 'required',
            'nama_menu' => 'required',
            'jumlah' => 'required',
            'nama_pegawai' => 'required'
        ]);

        $menu = Manager::whereNamaMenu($request->nama_menu)->first();
        $kurangstok = $menu->ketersediaan < $request->jumlah;
        if($kurangstok){
            return back()->with('error','Maaf G ada Stok');
        }else{
            Kasir::create([
                'nama_pelanggan' => $request->nama_pelanggan,
                'nama_menu' => $request->nama_menu,
                'jumlah' => $request->jumlah,
                'total_harga' => $menu->harga * $request->jumlah,
                'nama_pegawai' => $request->nama_pegawai,
            ]);
            $menu->update([
                'ketersediaan' => $menu->ketersediaan - $request->jumlah,
            ]);
            return redirect()->route('kasir.index')->with('succes','Berhasil!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kasir $kasir)
    {
        return view('kasir.edit', compact('kasir'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kasir $kasir)
    {
        $validateData = $request->validate([

            'nama_pelanggan' => 'required',
            'nama_menu' => 'required',
            'jumlah' => 'required',
            'total_harga' => 'required',
            'nama_pegawai' => 'required'
        ]);

        $kasir->update($validateData);

        return redirect()->route('kasir.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(kasir $kasir)
    {
        $kasir->delete();
     
        return redirect()->route('kasir.index');
    }
}