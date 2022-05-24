<?php

namespace App\Http\Controllers;

use App\DataTables\LokasiDataTable;
use App\Models\Lokasi;
use App\Http\Requests\StoreLokasiRequest;
use App\Http\Requests\UpdateLokasiRequest;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LokasiDataTable $dataTable)
    {
        return $dataTable->render('admin.lokasi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lokasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLokasiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLokasiRequest $request)
    {
        $data = $request->only([
            'nama',
            'deskripsi',
            'alamat',
            'lat',
            'lng',
            'tipe',
            'link_google_maps',
            'id_kecamatan',
            'id_kelurahan',
        ]);

        // upload foto
        $req_image = $request->file('foto');
        $image_name = time() . '.lokasi.' . $req_image->getClientOriginalExtension();
        $req_image->move(public_path('images'), $image_name);

        $data['foto'] = $image_name;

        Lokasi::create($data);

        return redirect()->route('lokasi.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function show(Lokasi $lokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lokasi = Lokasi::findOrFail($id);

        return view('admin.lokasi.create', [
            'lokasi' => $lokasi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLokasiRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLokasiRequest $request, $id)
    {
        $lokasi = Lokasi::findOrFail($id);

        $data = $request->only([
            'nama',
            'deskripsi',
            'alamat',
            'lat',
            'lng',
            'tipe',
            'link_google_maps',
            'id_kecamatan',
            'id_kelurahan',
        ]);

        $req_image = $request->file('foto');
        if ($req_image) {
            $image_name = time() . '.lokasi.' . $req_image->getClientOriginalExtension();
            $req_image->move(public_path('images'), $image_name);
            $data['foto'] = $image_name;

            // hapus foto lama
            $old_image = public_path('images/' . $lokasi->foto);
            if (file_exists($old_image)) unlink($old_image);
        }

        $lokasi->update($data);

        return redirect()->route('lokasi.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete data
        $lokasi = Lokasi::destroy($id);
        return $lokasi;
    }
}
