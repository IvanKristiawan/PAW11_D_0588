<?php

namespace App\Http\Controllers;

/* Import Model */

use App\Models\Departemen; /* import model departemen */
use Illuminate\Http\Request;
use App\Models\Proyek;
use App\Http\Resources\DepartemenResource;
use DB;

class ProyekController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get pegawai
        $proyek = Proyek::latest()->get();
        //render view with posts
        return new DepartemenResource(
            true,
            'List Data Proyek',
            $proyek
        );
    }
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('proyek.create');
    }
    
    public function edit($id)
    {
        $proyek = Proyek::find($id);
        return view('proyek.edit', compact('proyek'));  // -> resources/views/stocks/edit.blade.php
    }
    public function update(Request $request, $id)
    {
        // Validation for required fields (and using some regex to validate our numeric value)
        $request->validate([
            'nama_proyek' => 'required',
            'departemen_id' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'status' => 'required'
        ]);
        $stock = Proyek::find($id);
        // Getting values from the blade template form
        $stock->nama_proyek =  $request->get('nama_proyek');
        $stock->departemen_id = $request->get('departemen_id');
        $stock->waktu_mulai = $request->get('waktu_mulai');
        $stock->waktu_selesai = $request->get('waktu_selesai');
        $stock->status = $request->get('status');
        $stock->save();
    }
    public function destroy($id)
    {
        $user = Proyek::where('id', $id)->firstorfail()->delete();
        echo ("User Record deleted successfully.");
        return redirect()->route('proyek.index')->with(['success'
        => 'Data Berhasil Dihapus!']);
    }
    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //Validasi Formulir
        $this->validate($request, [
            'nama_proyek' => 'required',
            'departemen_id' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'status' => 'required'
        ]);
        //Fungsi Simpan Data ke dalam Database
        Proyek::create([
            'nama_proyek' => $request->nama_proyek,
            'departemen_id' => $request->departemen_id,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'status' => $request->status,
        ]);
    }

    public function show($id)
    {
        $proyek = Proyek::find($id);

        if (!is_null($proyek)) {
            return response([
                'message' => 'Retrieve Proyek Success',
                'data' => $proyek
            ], 200);
        }

        return response([
            'message' => 'Proyek Not Found',
            'data' => null
        ], 404);
    }
}