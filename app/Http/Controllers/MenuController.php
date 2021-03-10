<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Menu::all();
        $data = Menu::select('menus.*', 'kategori')
            ->join('kategoris', 'kategoris.idkategori', '=', 'menus.idkategori')->get();

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'idkategori'    =>  'required',
            'menu'          =>  'required|unique:menus',
            'gambar'        =>  'required',
            'harga'         =>  'required'
        ]);
        $gambar = $request->file('gambar');
        $ext = $gambar->getClientOriginalExtension();
        $filename = 'Upload-' . time() . '.' . $ext;
        $gambar->move('upload', $filename);

        $data = [
            'idkategori'    =>  $request->input('idkategori'),
            'menu'          =>  $request->input('menu'),
            'gambar'        =>  url('upload/' . $filename),
            'harga'         =>  $request->input('harga')
        ];

        $respon = Menu::create($data);

        return response()->json([
            'pesan' =>  'menu berhasil disimpan',
            'data'  =>  $respon
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu, $id)
    {
        $data = $menu->select('menus.*', 'kategori')
            ->where('idmenu', $id)
            ->join('kategoris', 'kategoris.idkategori', '=', 'menus.idkategori')->get();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu, $id)
    {
        $this->validate($request, [
            'idkategori'    =>  'required',
            'menu'          =>  'required',
            'harga'         =>  'required'
        ]);

        $data = $menu->find($id);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $ext = $gambar->getClientOriginalExtension();
            $filename = 'Upload-' . time() . '.' . $ext;
            $gambar->move('upload', $filename);
            $filename = url('upload/' . $filename);
        } else {
            $filename = $data->gambar;
        }

        $data->idkategori = $request->idkategori;
        $data->menu = $request->menu;
        $data->gambar = $filename;
        $data->harga = $request->harga;
        $data->save();

        return response()->json([
            'pesan' =>  'menu berhasil diubah',
            'data'  =>  $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu, $id)
    {
        Menu::where('idmenu', $id)->delete();

        return response()->json("Data berhasil dihapus");
    }
}
