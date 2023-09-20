<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Buku::orderBy('judul', 'ASC')->get();

        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan!',
            'data' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Use Header = Accept / application/json

        // $rules = $request->validate([
        //     'judul' => 'required',
        //     'pengarang' => 'required',
        //     'tanggal_publikasi'=> 'required|date'
        // ]);

        // $validator = Validator::make($request->all(), $rules);

        // if($validator->fails()) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Gagal memasukkan data!',
        //         'data' => $validator->errors(),
        //     ]);
        // }

        // Not Use Header
        $rules = [
            'judul' => 'required',
            'pengarang' => 'required',
            'tanggal_publikasi'=> 'required|date'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memasukkan data!',
                'data' => $validator->errors(),
            ]);
        }

        $data = Buku::create([
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'tanggal_publikasi' => $request->tanggal_publikasi,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambahkan!',
            'data' => $data
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Buku:: find($id);
        if($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan!',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan!',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cekId = Buku::find($id);

        if(empty($cekId)) {
            return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan!',
            ], 404);
        }

        $rules = [
            'judul' => 'required',
            'pengarang' => 'required',
            'tanggal_publikasi'=> 'required|date'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengubah data!',
                'data' => $validator->errors(),
            ]);
        }

        $data = Buku::find($id);
        $data->update([
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'tanggal_publikasi' => $request->tanggal_publikasi,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diubah!',
            'data' => $data
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cekId = Buku::find($id);

        if(empty($cekId)) {
            return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan!',
            ], 404);
        }

        $data = Buku::find($id);
        $data->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus!'
        ], 200);
    }
}
