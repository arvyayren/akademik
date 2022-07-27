<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TransaksiJadwalKelas;
use App\Models\MasterGuru;
use App\Models\MasterMapel;

class JadwalKelasController extends Controller
{
    public function index()
    {
        $list = TransaksiJadwalKelas::select('id','hari','kelas')->get();

        $data = array();

        foreach($list as $k => $v){

            $btnEdit = '<a href="/transaksi/jadwal_kelas/'.$v->id.'/edit" class="btn btn-xs btn-default text-primary mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>';
            $btnDelete = '<button type="submit" form="delete'.$v->id.'" class="btn btn-xs btn-default text-danger mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>';

            $data[] = array(
                $v->id,$v->hari,$v->kelas,'<nobr>'.$btnEdit.$btnDelete.'</nobr>'
            );
        }

        $guru = MasterGuru::get();
        $mapel = MasterMapel::get();

        return view('pages.jadwal_kelas.index', compact('data','guru','mapel'));
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
        $input = $request->all();

        $create = TransaksiJadwalKelas::create($input);

        if($create){
            return redirect('/transaksi/jadwal_kelas')->with(['success' => 'Data Berhasil Dibuat']);
        }else{
            return redirect('/transaksi/jadwal_kelas')->with(['error' => 'Data Gagal Dibuat']);
        }

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
        $data = TransaksiJadwalKelas::find($id);
        $guru = MasterGuru::get();
        $mapel = MasterMapel::get();

        return view('pages.jadwal_kelas.edit', compact('data','guru','mapel'));
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
        $input = $request->except(['_token', '_method']);

        $update = TransaksiJadwalKelas::where('id',$id)->update($input);

        if($update){
            return redirect()->back()->with(['success' => 'Data Berhasil Diubah']);
        }else{
            return redirect()->back()->with(['error' => 'Data Gagal Diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = TransaksiJadwalKelas::where('id',$id)->delete($id);

        if($delete){
            return redirect('/transaksi/jadwal_kelas')->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return redirect('/transaksi/jadwal_kelas')->with(['error' => 'Data Gagal Dihapus']);
        }
    }
}
