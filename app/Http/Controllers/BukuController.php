<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Penerbit;
use App\Models\Pengarang;
use Exception;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Buku::with(['penerbit','pengarang'])
            ->orderByDesc('id')
            ->paginate(10);
        
        $penerbit = Penerbit::select('id','nama')->get();
        $pengarang = Pengarang::select('id','nama')->get();

        return view('Master.buku.index', compact('data', 'penerbit', 'pengarang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $data = New Buku;
            $data->pengarang_id = $request->pengarang_id;
            $data->penerbit_id = $request->penerbit_id;
            $data->status = $request->status;
            $data->nama = $request->nama;
            $data->genre = $request->genre;
            $data->tahun = $request->tahun;
            $data->sinopsis = $request->sinopsis;
            $data->save();

            return redirect()->route('buku.index')->with('success', 'Data Berhasil Ditambahkan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id){
        $data = Buku::with(['pengarang','penerbit'])->find($id);

        return response($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Buku::with(['pengarang','penerbit'])->find($id);

        $penerbit = Penerbit::select('id','nama')->get();
        $pengarang = Pengarang::select('id','nama')->get();

        return view('Master.buku.edit', compact('data', 'penerbit', 'pengarang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //melakukan validasi data
        $request->validate([
            'pengarang_id'   => 'required',
            'penerbit_id' => 'required',
            'status' => 'required',
            'nama' => 'required',
            'genre' => 'required',
            'tahun' => 'required',
            'sinopsis' => 'required',
        ]);

        //fungsi eloquent untuk mengupdate data inputan kita
        Buku::find($id)->update($request->all());

        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('buku.index')->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Buku::find($id)->delete();

        return back()->with('success', 'Data deleted successfully');
    }
}
