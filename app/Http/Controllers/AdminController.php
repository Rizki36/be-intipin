<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Menampilkan view admin
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('admin.admin.index');
    }

    /**
     * menampilkan view tambah admin
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     * Menyimpan data admin
     *
     * @param  StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        // mengambil data yang dibutuhkan saja
        $data = $request->safe()->only([
            'name',
            'email',
            'password',
            'username',
        ]);

        // membuat user baru
        User::create($data);

        return redirect()->route('admin.index')->with('success', 'User berhasil ditambahkan');
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Menampilkan view edit admin
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.admin.create', [
            'user' => $user
        ]);
    }

    /**
     * Menyimpan data admin
     *
     * @param  UpdateUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        // mengambil data yang dibutuhkan saja
        $data = $request->safe()->only([
            'name',
            'email',
            'username',
        ]);

        // mengupdate user
        User::findOrFail($id)->update($data);

        return redirect()->route('admin.index')->with('success', 'User berhasil diubah');
    }

    /**
     * Menghapus data admin
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::destroy($id);
        return $user;
    }
}
