<?php

namespace App\Http\Controllers;

/* Import Model */

use Mail;
use App\Mail\DepartemenMail; /* import model mail */
use App\Models\Departemen; /* import model departemen */
use Illuminate\Http\Request;
use App\Http\Resources\DepartemenResource;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;

class DepartemenController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get departemen
        $departemen = Departemen::latest()->get();
        //render view with posts
        return new DepartemenResource(
            true,
            'List Data Departemen',
            $departemen
        );
    }
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('departemen.create');
    }

    public function show($id)
    {
        $departemen = Departemen::find($id);

        if (!is_null($departemen)) {
            return response([
                'message' => 'Retrieve Departemen Success',
                'data' => $departemen
            ], 200);
        }

        return response([
            'message' => 'Departemen Not Found',
            'data' => null
        ], 404);
    }

    public function edit($id)
    {
        $departemen = Departemen::find($id);
        return view('departemen.edit', compact('departemen'));  // -> resources/views/stocks/edit.blade.php
    }
    public function update(Request $request, $id)
    {
        // Validation for required fields (and using some regex to validate our numeric value)
        $request->validate([
            'nama_departemen' => 'required',
            'nama_manager' => 'required',
            'jumlah_pegawai' => 'required'
        ]);
        $stock = Departemen::find($id);
        // Getting values from the blade template form
        $stock->nama_departemen =  $request->get('nama_departemen');
        $stock->nama_manager = $request->get('nama_manager');
        $stock->jumlah_pegawai = $request->get('jumlah_pegawai');
        $stock->save();
    }
    public function destroy($id)
    {
        $departemen = Departemen::find($id);

        if (is_null($departemen)) {
            return response([
                'message' => 'Departemen Not Found',
                'data' => null
            ], 404);
        }

        if ($departemen->delete()) {
            return response([
                'message' => 'Delete Departemen Success',
                'data' => $departemen
            ], 200);
        }

        return response([
            'message' => 'Delete Departemen Failed',
            'data' => null
        ], 400);
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
        $validator = Validator::make($request->all(), [
            'nama_departemen' => 'required',
            'nama_manager' => 'required',
            'jumlah_pegawai' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //Fungsi Post ke Database
        $departemen = Departemen::create([
            'nama_departemen' => $request->nama_departemen,
            'nama_manager' => $request->nama_manager,
            'jumlah_pegawai' => $request->jumlah_pegawai
        ]);
        return new DepartemenResource(true, 'Data Departemen
            Berhasil Ditambahkan!', $departemen);
    }
}
