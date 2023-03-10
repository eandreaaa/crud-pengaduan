<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function edit($report_id)
    {
        // ambil data response yang bakal dimunculin, data yg diambil data response yg report_id nya sama spt $report_id dr path dinamis {report_id}
        // kalau ada, data d ambil satu / first()
        // ga pke firstOrFail() kareba nnt bakal munculin not found view, kalau pk first() viewny ttp dtampilin
        $report = Response::where('report_id', $report_id)->first();
        // krn mau kirim data {report_id} buat d route updatenya, jd biar bisa dpake di blade kita simpen data path dinamis $report_id nya ke 
        // variable baru yg bakal d compact dan dipanggil di bladenya
        $reportId = $report_id;
        return view('response', compact('report', 'reportId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $report_id)
    {
        $request->validate([
            'keadaan' => 'required',
            'pesan' => 'required',
        ]);

        // updateOrCreate() untuk melakukan update data kalo emg d db response udh ada data yg punya report_id dgn $report_id dr path dinamis,
        // kalau gaada maka di create
        // array pertama acuan dr datanya
        // array kedua data yg dkirim
        // pke updateOrCreate karena response kan kl tdnnya gada akan dtambah, kl ada mau diupdate aja
        Response::updateOrCreate(
            [
                'report_id' => $report_id,
            ],
            [
                'keadaan' => $request->keadaan,
                'pesan' => $request->pesan,
            ]
        );

        // setelah berhasil, arahakan ke route yg name nya data-petugas dgn alert
        return redirect()->route('data-petugas')->with('responseSuccess', 'Berhasil mengubah respons.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(Response $response)
    {
        //
    }
}
