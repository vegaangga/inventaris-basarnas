<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Satuan;
use App\Models\Kegiatan;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('barang-keluar.index', [
            'barangs'      => Barang::all(),
            'barangsKeluar' => BarangKeluar::all(),
            'kegiatans'    => Kegiatan::all()
        ]);
    }

    public function getDataBarangKeluar()
    {
        return response()->json([
            'success'   => true,
            'data'      => BarangKeluar::all(),
            'kegiatan'  => Kegiatan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang-keluar.create', [
            'barangs'   => Barang::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_keluar'     => 'required',
            'nama_barang'       => 'required',
            'jumlah_keluar'      => 'required',
            'kegiatan_id'       => 'required',
            'keterangan'        => 'required'
        ],[
            'tanggal_keluar.required'    => 'Pilih Barang Terlebih Dahulu !',
            'nama_barang.required'      => 'Form Nama Barang Wajib Di Isi !',
            'jumlah_keluar.required'     => 'Form Jumlah Stok Keluar Wajib Di Isi !',
            'kegiatan_id.required'      => 'Pilih Kegiatan !',
            'keterangan.required'       => 'Form Keterangan Wajib Di Isi !'
        ]);


        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $barangKeluar = BarangKeluar::create([
            'tanggal_keluar'     => $request->tanggal_keluar,
            'nama_barang'       => $request->nama_barang,
            'jumlah_keluar'      => $request->jumlah_keluar,
            'kegiatan_id'       => $request->kegiatan_id,
            'kode_transaksi'    => $request->kode_transaksi,
            'user_id'           => auth()->user()->id,
            'keterangan'        => $request->keterangan
        ]); 

        if ($barangKeluar) {
            $barang = Barang::where('nama_barang', $request->nama_barang)->first();
            if ($barang) {
                $barang->stok += $request->jumlah_keluar;
                $barang->save();
            }
        }

        return response()->json([
            'success'   => true,
            'message'   => 'Data Berhasil Disimpan !',
            'data'      => $barangKeluar
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        return response()->json([
            'success' => true,
            'message' => 'Edit Data Barang',
            'data'    => $barangKeluar
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangKeluar $barangKeluar)
    {
        $jumlahKeluar = $barangKeluar->jumlah_keluar;
        $barangKeluar->delete();

        $barang = Barang::where('nama_barang', $barangKeluar->nama_barang)->first();
        if ($barang) {
            $barang->stok -= $jumlahKeluar;
            $barang->save();
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Data Barang Berhasil Dihapus!'
        ]);
    }


    /**
     * Create Autocomplete Data
     */
    public function getAutoCompleteData(Request $request)
    {
        $barang = Barang::where('nama_barang', $request->nama_barang)->first();;
        if($barang){
            return response()->json([
                'nama_barang'   => $barang->nama_barang,
                'stok'          => $barang->stok,
                'satuan_id'     => $barang->satuan_id,
                'keterangan'    => $barang->keterangan
            ]);
        }
    }

    /**
     * Get Satuan
     */
    public function getSatuan()
    {
       $satuans = Satuan::all();
       
       return response()->json($satuans);
    }

}
