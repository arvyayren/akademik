<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TransaksiPenilaianSantriHeader;
use App\Models\TransaksiPenilaianSantriDetail;

use App\Models\MasterGuru;
use App\Models\MasterMapel;
use App\Models\MasterSantri;

class PenilaianController extends Controller
{
    public function index()
    {
        $list = TransaksiPenilaianSantriHeader::select('id','nama','kelas','wali_kelas','bulan','rekap_nilai_bulanan')->get();

        $data = array();

        foreach($list as $k => $v){

            $btnEdit = '<a href="/transaksi/penilaian/'.$v->id.'/edit" class="btn btn-xs btn-default text-primary mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>';
            $btnDelete = '<button type="submit" form="delete'.$v->id.'" class="btn btn-xs btn-default text-danger mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>';

            $nama_wali = MasterGuru::where('id',$v->wali_kelas)->value('nama');

            $penilaian_detail = TransaksiPenilaianSantriDetail::where('id_penilaian',$v->id)->get();
            $nilai = array();

            foreach($penilaian_detail as $val){
                $nilai[] = $val->nilai;
            }

            $nilai = array_filter($nilai);
            if(count($nilai) > 0){
            $rata_rata = array_sum($nilai)/count($nilai);
            }else{
                $rata_rata = 0;
            }

            $data[] = array(
                $v->id,$v->nama,$v->kelas,$nama_wali,$v->bulan,$rata_rata,'<nobr>'.$btnEdit.$btnDelete.'</nobr>'
            );
        }

        $guru = MasterGuru::get();
        $mapel = MasterMapel::get();
        $santri = MasterSantri::get();

        return view('pages.penilaian.index', compact('data','guru','mapel','santri'));
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
        $input['nama'] = MasterSantri::where('id', $input['id_santri'])->value('nama');

        $create = TransaksiPenilaianSantriHeader::create($input);

        if($create){
            return redirect('/transaksi/penilaian')->with(['success' => 'Data Berhasil Dibuat']);
        }else{
            return redirect('/transaksi/penilaian')->with(['error' => 'Data Gagal Dibuat']);
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
        $data = TransaksiPenilaianSantriHeader::find($id);
        $guru = MasterGuru::get();
        $mapel = MasterMapel::get();
        $santri = MasterSantri::get();

        $list = TransaksiPenilaianSantriDetail::select('id','tanggal','subjek','nilai','keterangan','mapel')
        ->where('id_penilaian',$id)->get();

        $penilaian = array();

        foreach($list as $k => $v){
            $btnDelete = '<button type="submit" form="delete'.$v->id.'" class="btn btn-xs btn-default text-danger mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>';

            $nama_mapel = MasterMapel::where('id',$v->mapel)->value('nama');

            $penilaian[] = array(
                $v->id,$v->tanggal,$nama_mapel,$v->subjek,$v->nilai,$v->keterangan,'<nobr>'.$btnDelete.'</nobr>'
            );
        }

        return view('pages.penilaian.edit', compact('data','guru','mapel','santri','penilaian'));
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
        
        $input['nama'] = MasterSantri::where('id', $input['id_santri'])->value('nama');

        $update = TransaksiPenilaianSantriHeader::where('id',$id)->update($input);

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
        $delete = TransaksiPenilaianSantriHeader::where('id',$id)->delete($id);

        if($delete){
            return redirect('/transaksi/penilaian')->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return redirect('/transaksi/penilaian')->with(['error' => 'Data Gagal Dihapus']);
        }
    }

    public function storePenilaianSantri(Request $request){
        $input = $request->all();

        $create = TransaksiPenilaianSantriDetail::create($input);

        if($create){
            return redirect()->back()->with(['success' => 'Data Berhasil Dibuat']);
        }else{
            return redirect()->back()->with(['error' => 'Data Gagal Dibuat']);
        }
    }
    
    public function deletePenilaianSantri($id){
        $delete = TransaksiPenilaianSantriDetail::where('id',$id)->delete($id);

        if($delete){
            return redirect()->back()->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return redirect()->back()->with(['error' => 'Data Gagal Dihapus']);
        }
    }
}
