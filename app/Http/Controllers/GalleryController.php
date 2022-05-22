<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
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
        // request validation
        $request->validate([
            'image_slider' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // get image file
        $req_image = $request->file('image_slider');
        $image_name = time() . '.slider.' . $req_image->getClientOriginalExtension();
        $req_image->move(public_path('images'), $image_name);

        // insert data to database
        $image = new Gallery();
        $image->filename = $image_name;
        $image->save();

        return redirect()->back()->with('success', 'Image slider successfully uploaded.');
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
        // delete gallery by id
        $gallery = Gallery::find($id);
        $gallery->delete();

        // delete image file
        $image_path = public_path('images/' . $gallery->filename);
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        return redirect()->back()->with('success', 'Image successfully deleted.');
    }
}
