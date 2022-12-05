<?php

namespace App\Http\Controllers;

use App\Models\store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function index(Request $request) {
        if($request->has('search')){
        $datas = DB::select('SELECT * FROM toko WHERE is_delete = 0 AND toko.nama_toko = :search;',[
            'search'=>$request->search   
        ]);
    return view('store.index')
        ->with('datas', $datas);
        } 
             else {
               $datas = DB::select('SELECT * FROM toko WHERE is_delete = 0');
            return view('store.index')
                ->with('datas', $datas);
            }
        }

    public function create() {
        return view('store.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_toko' => 'required',
            'nama_toko' => 'required',
            'lokasi' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO toko(id_toko, nama_toko, lokasi) VALUES (:id_toko, :nama_toko, :lokasi)',
        [
            'id_toko' => $request->id_toko,
            'nama_toko' => $request->nama_toko,
            'lokasi' => $request->lokasi,
        ]
        );

        return redirect()->route('store.index')->with('success', 'Data Toko berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('toko')->where('id_toko', $id)->first();

        return view('store.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_toko' => 'required',
            'nama_toko' => 'required',
            'lokasi' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE toko SET nama_toko = :nama_toko, lokasi = :lokasi  WHERE id_toko = :id_toko',
        [
            'id_toko' => $id,
            'nama_toko' => $request->nama_toko,
            'lokasi' => $request->lokasi,
        ]
        );

        return redirect()->route('store.index')->with('success', 'Data Toko berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM toko WHERE id_toko = :id_toko', ['id_toko' => $id]);

        return redirect()->route('store.index')->with('success', 'Data Toko berhasil dihapus');
    }

    public function softDelete ($id) {
        DB::update('UPDATE toko SET is_delete = 1 WHERE id_toko = :id_toko', ['id_toko' => $id]);
        return redirect()->route('store.index')->with('success', 'Data Admin berhasil dihapus');
    }
}
