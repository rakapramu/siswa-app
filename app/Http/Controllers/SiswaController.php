<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Siswa::orderBy('nama', 'asc')->paginate(5);
        return view('siswa.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('nama', $request->nama);
        Session::flash('nim', $request->nim);
        Session::flash('gender', $request->gender);
        Session::flash('alamat', $request->alamat);

        $request->validate([
            'nama' => 'required|max:255',
            'nim' => 'required|numeric',
            'gender' => 'required|in:L,P',
            'alamat' => 'required|max:255'
        ], [
            'nama.required' => 'Nama wajib di isi',
            'nim.required' => 'Nim wajib di isi dalam bentuk angka',
            'gender.required' => 'Jenis kelamin wajib di isi [L/P]',
            'alamat' => 'Alamat wajib di isi'
        ]);
        $data = $request->all();
        $item = Siswa::create($data);
        if ($request->hasFile('foto')) {
            // buat folder mahasiswa kemudian taruh di folder fotomahasiswa
            $request->file('foto')->move('fotomahasiswa/', $request->file('foto')->getClientOriginalName());

            // tampung fotonya
            $item->foto = $request->file('foto')->getClientOriginalName();

            // kemudian save deh
            $item->save();
        }

        return redirect()->route('siswa.index')
            ->with('succes', 'Berhasil menambah mahasiswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Siswa::findOrFail($id);
        return view('siswa.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        Session::flash('nama', $request->nama);
        Session::flash('nim', $request->nim);
        Session::flash('gender', $request->gender);
        Session::flash('alamat', $request->alamat);

        $request->validate([
            'nama' => 'required|max:255',
            'nim' => 'required|numeric',
            'gender' => 'required|in:L,P',
            'alamat' => 'required|max:255',
            'foto' => 'required|mimes:jpg,jpeg,png,gif'
        ], [
            'nama.required' => 'Nama wajib di isi',
            'nim.required' => 'Nim wajib di isi dalam bentuk angka',
            'gender.required' => 'Jenis kelamin wajib di isi [L/P]',
            'alamat' => 'Alamat wajib di isi',
            'foto.required' => 'Foto harus di isi'
        ]);

        $data = $request->all();
        $siswa->update($data);
        return redirect()->route('siswa.index')->with('update', 'Berhasil update mahasiswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Siswa::findOrFail($id);
        $data->delete();
        return redirect()->back();
    }
}
