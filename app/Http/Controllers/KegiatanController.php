<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Validator;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('supplier.index', [
            'kegiatans' => Kegiatan::all(),
        ]);
    }

    public function getDataKegiatan()
    {
        return response()->json([
            'success' => true,
            'data'    => Kegiatan::all(),
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
            'kegiatan'   => 'required|string|max:255',
            'keterangan' => 'required|string',
        ],[
            'kegiatan.required'   => 'Form Nama Kegiatan wajib diisi!',
            'keterangan.required' => 'Form Keterangan wajib diisi!',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kegiatan = Kegiatan::create([
            'kegiatan'   => $request->kegiatan,
            'keterangan' => $request->keterangan,
            'user_id'    => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'data'    => $kegiatan,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kegiatan $kegiatan)
    {
        return response()->json([
            'success' => true,
            'data'    => $kegiatan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kegiatan $kegiatan)
    {
        return response()->json([
            'success' => true,
            'message' => 'Edit data kegiatan',
            'data'    => $kegiatan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validator = Validator::make($request->all(), [
            'kegiatan'   => 'required|string|max:255',
            'keterangan' => 'required|string',
        ],[
            'kegiatan.required'   => 'Form Nama Kegiatan wajib diisi!',
            'keterangan.required' => 'Form Keterangan wajib diisi!',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kegiatan->update([
            'kegiatan'   => $request->kegiatan,
            'keterangan' => $request->keterangan,
            'user_id'    => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil terupdate!',
            'data'    => $kegiatan,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!',
        ]);
    }
}
