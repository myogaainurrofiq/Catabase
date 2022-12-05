<?php

namespace App\Http\Controllers;

use App\Models\toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request) {
        if($request->has('search')){
       $datas = DB::select('SELECT
        toko.nama_toko,
        toko.lokasi,
        kucing.id_kucing,
        ras.jenis_ras,
        kucing.warna,
        kucing.usia
      FROM kucing
      LEFT JOIN toko
        ON toko.id_toko = kucing.id_kucing
      LEFT JOIN ras
        ON ras.id_ras = kucing.id_ras 
       WHERE kucing.is_delete = 0 AND ras.jenis_ras = :search;',[
                 'search'=>$request->search   
             ]);
    // LIKE \'%' . $request->search . '%\';');
        return view('toko.index')
            ->with('datas', $datas);
            } 
            else {
                $datas = DB::select('SELECT
            toko.nama_toko,
            toko.lokasi,
            kucing.id_kucing,
            ras.jenis_ras,
            kucing.warna,
            kucing.usia
          FROM kucing
          LEFT JOIN toko
            ON toko.id_toko = kucing.id_kucing
          LEFT JOIN ras
            ON ras.id_ras = kucing.id_ras WHERE kucing.is_delete = 0'); 
            return view('toko.index')
                ->with('datas', $datas);
            }
    }

    public function create() {
        // $ras = DB::select('SELECT jenis_ras FROM ras');
        // return view('toko.add', ["ras"=>$ras]);
        return view('toko.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_kucing' => 'required',
            'warna' => 'required',
            'usia' => 'required',
            'id_ras' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO kucing(id_kucing, warna, usia, id_ras) VALUES (:id_kucing, :warna, :usia, :id_ras)',
        [
            'id_kucing' => $request->id_kucing,
            'warna' => $request->warna,
            'usia' => $request->usia,
            'id_ras' => $request->id_ras
        ]
        );

        return redirect()->route('toko.index')->with('success', 'Data Toko berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('kucing')->where('id_kucing', $id)->first();

        return view('toko.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_kucing' => 'required',
            'warna' => 'required',
            'usia' => 'required',
            'id_ras' => 'required'
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE kucing SET warna = :warna, usia = :usia, id_ras = :id_ras, id_toko = :id_toko WHERE id_kucing = :id_kucing',
        [
            'id_kucing' => $id,
            'warna' => $request->warna,
            'usia' => $request->usia,
            'id_ras' => $request->id_ras,
            'id_toko' => $request->id_toko
        ]
        );

        return redirect()->route('toko.index')->with('success', 'Data Toko berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM kucing WHERE id_kucing = :id_kucing', ['id_kucing' => $id]);
        return redirect()->route('toko.index')->with('success', 'Data Toko berhasil dihapus');
    }

    public function softDelete ($id) {
        DB::update('UPDATE kucing SET is_delete = 1 WHERE id_kucing = :id_kucing', ['id_kucing' => $id]);
        return redirect()->route('toko.index')->with('success', 'Data Admin berhasil dihapus');
    }
}
