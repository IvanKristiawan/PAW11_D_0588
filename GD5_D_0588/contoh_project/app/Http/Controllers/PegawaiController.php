<?php

namespace App\Http\Controllers;

/* Import Model */

use App\Models\Pegawai; /* import model departemen */
use App\Models\Departemen;
use Illuminate\Http\Request;
use App\Http\Resources\DepartemenResource;
use DB;

class PegawaiController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get pegawai
        $pegawai = Pegawai::latest()->get();
        //render view with posts
        return new DepartemenResource(
            true,
            'List Data Pegawai',
            $pegawai
        );
    }
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('pegawai.create');
    }

    public function edit($id)
    {
        $pegawai = Pegawai::find($id);
        return view('pegawai.edit', compact('pegawai'));  // -> resources/views/stocks/edit.blade.php
    }

    public function update(Request $request, $id)
    {
        // Validation for required fields (and using some regex to validate our numeric value)
        $request->validate([
            'nomor_induk_pegawai' => 'required',
            'nama_pegawai' => 'required',
            'id_departemen' => 'required',
            'email' => 'required',
            'telepon' => 'required',
            'gender' => 'required',
            'status' => 'required'
        ]);
        $stock = Pegawai::find($id);
        // Getting values from the blade template form
        $stock->nomor_induk_pegawai =  $request->get('nomor_induk_pegawai');
        $stock->nama_pegawai = $request->get('nama_pegawai');
        $stock->id_departemen = $request->get('id_departemen');
        $stock->email = $request->get('email');
        $stock->telepon = $request->get('telepon');
        $stock->gender = $request->get('gender');
        $stock->status = $request->get('status');
        $stock->save();
    }
    public function destroy($id)
    {
        $user = Pegawai::where('id', $id)->firstorfail()->delete();
        echo ("User Record deleted successfully.");
        return redirect()->route('pegawai.index')->with(['success'
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
            'nomor_induk_pegawai' => 'required',
            'nama_pegawai' => 'required',
            'id_departemen' => 'required',
            'email' => 'required',
            // 'telepon' => 'required|regex:/(08)[0-9]{6-7}/',
            'telepon' => 'required',
            'gender' => 'required',
            'status' => 'required'
        ]);
        //Fungsi Simpan Data ke dalam Database
        Pegawai::create([
            'nomor_induk_pegawai' => $request->nomor_induk_pegawai,
            'nama_pegawai' => $request->nama_pegawai,
            'id_departemen' => $request->id_departemen,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'gender' => $request->gender,
            'status' => $request->status
        ]);
    }

    public function show($id)
    {
        $pegawai = Pegawai::find($id);

        if (!is_null($pegawai)) {
            return response([
                'message' => 'Retrieve Pegawai Success',
                'data' => $pegawai
            ], 200);
        }

        return response([
            'message' => 'Pegawai Not Found',
            'data' => null
        ], 404);
    }
}
