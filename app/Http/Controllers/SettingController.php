<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAllSettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Menampilkan halaman setting
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $description_1 = Setting::where('name', 'description_1')->first();
        $description_2 = Setting::where('name', 'description_2')->first();
        $image_1 = Setting::where('name', 'image_1')->first();
        $image_2 = Setting::where('name', 'image_2')->first();

        return view('admin.setting.index', [
            'description_1' => $description_1->value,
            'description_2' => $description_2->value,
            'image_1' => $image_1->value,
            'image_2' => $image_2->value,
        ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function update_all(UpdateAllSettingRequest $request)
    {
        // upload gambar
        $req_image_1 = $request->file('image_1');
        $req_image_2 = $request->file('image_2');
        if ($req_image_1) {
            $image_1_name = time() . '.' . $req_image_1->getClientOriginalExtension();
            $image_1 = Setting::where('name', 'image_1')->first();
            $req_image_1->move(public_path('images'), $image_1_name);
            $image_1->value = $image_1_name;
            $image_1->save();
        }

        if ($req_image_2) {
            $image_2_name = time() . '.' . $req_image_2->getClientOriginalExtension();
            $image_2 = Setting::where('name', 'image_2')->first();
            $req_image_2->move(public_path('images'), $image_2_name);
            $image_2->value = $image_2_name;
            $image_2->save();
        }

        $description_1 = Setting::where('name', 'description_1')->first();
        $description_2 = Setting::where('name', 'description_2')->first();

        $description_1->value = $request->description_1;
        $description_2->value = $request->description_2;

        $description_1->save();
        $description_2->save();

        return redirect()->route('setting.index');
    }
}
