<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tempat;
use Illuminate\Http\Request;

class TempatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tempat = Tempat::all();
        return response([
            'total' => $tempat->count(),
            'messages' => 'Success',
            'data' => $tempat->toArray(),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tempat' => 'required',
            'wind' => 'required',
            'pressure' => 'required',
            'area' => 'required',
            'humidity' => 'required',
            'temperature' => 'required',
            'population' => 'required',            
        ]);

        $tempat = Tempat::create([
            "tempat" => $request->tempat,
            "wind" => $request->wind,
            "pressure" => $request->pressure,
            "area" => $request->area,
            "humidity" => $request->humidity,
            "temperature" => $request->temperature,
            "population" => $request->population,            
        ]);

        return response([
            'data' => $tempat,
            'message' => 'success',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tempat = Tempat::find($id);
        if ($tempat != null) {
            return response([
                'data' => $tempat,
            ], 200);
        }else {
            return response([
                'error' => 'Data not found',
            ], 404);
        }
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
        $request->validate([            
            'temperature' => 'required',                   
        ]);

        $tempat = Tempat::find($id);
        $tempat->temperature = $request->temperature;
        $tempat->save();

        return response([
            'data' => $tempat,
            'message' => 'success',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tempat = Tempat::find($id);
        if ($tempat == null) {
            return response([
                'message' => 'Data tidak ditemukan!!',
            ], 404);
        }
        $tempat->delete();
        return response([
            'message' => 'Data berhasil dihapus!',
        ], 200);
    }
}
