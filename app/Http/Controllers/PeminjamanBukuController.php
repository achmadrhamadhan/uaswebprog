<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\User;
use App\Models\PeminjamanBuku;
use Exception;
use Illuminate\Support\Facades\Auth;

class PeminjamanBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $UserAuth = Auth::user();

        $builder = PeminjamanBuku::with(['buku','user'])
            ->orderByDesc('id');

        if($UserAuth->role === 'user'){
            $builder->where('user_id','=',$UserAuth->id);
        }
        
        $data = $builder->paginate(10);

        $buku = Buku::with(['penerbit','pengarang'])->where('status','=',1)->get();

        return view('Transaksi.peminjaman.index', compact('data', 'buku'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $UserAuth = Auth::user();

        try {
            $data = New PeminjamanBuku;
            $data->buku_id = $request->buku_id;
            $data->user_id = $UserAuth->id;
            $data->status = 1;
            $data->save();

            return redirect()->route('peminjaman-buku.index')->with('success', 'Data Berhasil Ditambahkan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function approve(Request $request,$id)
    {
        try {
            $data = PeminjamanBuku::find($id);
            $data->status = 2;
            $data->save();

            $dataBuku = Buku::find($data->buku_id);
            $dataBuku->status = 2;
            $dataBuku->save();

            return response()->json(['message' => 'Data Berhasil Diapprove'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Gagal Approve Data'], 422);
        }
    }

    public function return($id)
    {
        //
        try {
            $data = PeminjamanBuku::find($id);
            $data->status = 3;
            $data->save();

            $dataBuku = Buku::find($data->buku_id);
            $dataBuku->status = 1;
            $dataBuku->save();

            return response()->json(['message' => 'Buku Telah Dikembalikan'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Gagal'], 422);
        }
    }
}
