<?php

namespace App\Http\Controllers;

use App\Models\formsModel;
use App\Models\genderModele;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function createForm(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'umur' => 'required|integer',
            'berat' => 'required|integer',
            'tinggi' => 'required|integer',
            'gender' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message' => $validation->errors()
            ], 400);
        }

        $user = Auth::user();
        $gender = genderModele::find($request->gender);

        $data = formsModel::create([
            'name' => $user->name,
            'umur' => $request->umur,
            'berat' => $request->berat,
            'tinggi' => $request->tinggi,
        ], 200);

        // Mengambil data bentuk yang baru saja dibuat berdasarkan ID
        $newForm = formsModel::find($data->id);

        return response()->json([
            'message' => $newForm,
            'name' => $user->name,
            'gender' => $gender->gender
        ], 200);
    }

    public function delete($id){
        $data = formsModel::find($id);

    if (!$data) {
        return response()->json([
            'message' => 'Tidak ada produk'
        ]);
    }

    $data->delete();

    return response()->json([
        'message' => 'Sukses Dihapus'
    ]);
    }

    public function get($id){
        $data = formsModel::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Bentuk tidak ditemukan'
            ]);
        }

        return response()->json([
            'message' => $data
        ]);
    }

}
