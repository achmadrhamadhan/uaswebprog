<?php

namespace App\Http\Controllers;

use App\Models\Pengarang;
use Exception;
use Illuminate\Http\Request;
use App\Models\Buku;

class PengarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pengarang::orderByDesc('id')->paginate(10);

        return view('Master.pengarang.index', compact('data'));
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

            $request->validate([
                'nama' => 'required',
                'jenis_kelamin' => 'required',
                'negara'        => 'required',
            ]);

            Pengarang::create($request->all());

            return redirect()->route('pengarang.index')->with('success', 'Data Berhasil Ditambahkan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Pengarang::find($id);

        return view('Master.pengarang.edit', compact('data'));
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
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'negara'        => 'required',
        ]);

        //fungsi eloquent untuk mengupdate data inputan kita
        Pengarang::find($id)->update($request->all());

        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('pengarang.index')->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataCheck = Buku::where('pengarang_id', '=', $id)
            ->first();

        if ($dataCheck == null) {
            Pengarang::find($id)->delete();

            return response()->json(['message' => 'Data deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Data failed deleted, This data used on data book, so delete the book first'], 422);
        }
    }
}
