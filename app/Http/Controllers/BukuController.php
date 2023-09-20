<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();

        $url = "http://127.0.0.1:8000/api/buku";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        
        return view('buku.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $judul = $request->judul;
        $pengarang = $request->pengarang;
        $tanggal_publikasi = $request->tanggal_publikasi;

        $parameter = [
            'judul' => $judul,
            'pengarang' => $pengarang,
            'tanggal_publikasi' => $tanggal_publikasi
        ];

        $client = new Client();

        $url = "http://127.0.0.1:8000/api/buku";
        $response = $client->request('POST', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($parameter)
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if($contentArray['status'] != true){
            $error = $contentArray['data'];
            return redirect('/buku')->withErrors($error)->withInput();
        } else {
            return redirect('/buku')->with('status', 'Data Buku Berhasil Ditambahkan!');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = new Client();

        $url = "http://127.0.0.1:8000/api/buku/$id";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if($contentArray['status'] != true) {
            $error = $contentArray['message'];

            return redirect('/buku')->with('status-gagal', $error);
        } else {
            $data = $contentArray['data'];
            return view('buku.index', compact('data'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $judul = $request->judul;
        $pengarang = $request->pengarang;
        $tanggal_publikasi = $request->tanggal_publikasi;

        $parameter = [
            'judul' => $judul,
            'pengarang' => $pengarang,
            'tanggal_publikasi' => $tanggal_publikasi
        ];

        $client = new Client();

        $url = "http://127.0.0.1:8000/api/buku/$id";
        $response = $client->request('PATCH', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($parameter)
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if($contentArray['status'] != true){
            $error = $contentArray['data'];
            return redirect('/buku/'.$id)->withErrors($error)->withInput();
        } else {
            return redirect('/buku')->with('status', 'Data Buku Berhasil Diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = new Client();

        $url = "http://127.0.0.1:8000/api/buku/$id";
        $response = $client->request('DELETE', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if($contentArray['status'] != true){
            $error = $contentArray['data'];
            return redirect('/buku')->withErrors($error)->withInput();
        } else {
            return redirect('/buku')->with('status', 'Data Buku Berhasil Dihapus!');
        }
    }
}
