<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('supplier.index', [
            'suppliers' => Kegiatan::all()
        ]);
    }

    public function getDataSupplier()
    {
        return response()->json([
            'success' => true,
            'data'    => Kegiatan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kegiatan'  => 'required',
            'keterangan'    => 'required'
        ],[
            'kegiatan.required' => 'Form Nama Perusahaan Wajib Di Isi !',
            'keterangan.required'   => 'Form Alamat Wajib Diisi'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $supplier = Kegiatan::create([
            'kegiatan'  => $request->supplier,
            'keterangan'    => $request->alamat,
            'user_id'   => auth()->user()->id
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data Berhasil Disimpan !',
            'data'      => $supplier
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kegiatan $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kegiatan $supplier)
    {
        return response()->json([
            'success' => true,
            'message' => 'Edit Data Barang',
            'data'    => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kegiatan $supplier)
    {
        $validator = Validator::make($request->all(), [
            'kegiatan'  => 'required',
            'keterangan'    => 'required'
        ],[
            'kegiatan.required' => 'Form Nama Perusahaan Wajib Di Isi !',
            'keterangan.required'   => 'Form Alamat Wajib Diisi'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $supplier->update([
            'kegiatan'  => $request->supplier,
            'keterangan'    => $request->alamat,
            'user_id'   => auth()->user()->id
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data Berhasil Terupdate',
            'data'      => $supplier
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $supplier)
    {
        Kegiatan::destroy($supplier->id);
        
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus'
        ]);
    }
}
