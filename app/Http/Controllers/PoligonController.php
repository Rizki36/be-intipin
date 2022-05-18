<?php

namespace App\Http\Controllers;

use App\Models\Poligon;
use App\Http\Requests\StorePoligonRequest;
use App\Http\Requests\UpdatePoligonRequest;

class PoligonController extends Controller
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
     * @param  \App\Http\Requests\StorePoligonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePoligonRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poligon  $poligon
     * @return \Illuminate\Http\Response
     */
    public function show(Poligon $poligon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poligon  $poligon
     * @return \Illuminate\Http\Response
     */
    public function edit(Poligon $poligon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePoligonRequest  $request
     * @param  \App\Models\Poligon  $poligon
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePoligonRequest $request, Poligon $poligon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poligon  $poligon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poligon $poligon)
    {
        //
    }
}
