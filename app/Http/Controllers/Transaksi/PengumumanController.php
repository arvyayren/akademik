<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TransaksiPengumumanPendaftaranHeader;
use App\Models\TransaksiPengumumanPendaftaranDetail;

class PengumumanController extends Controller
{
    public function index()
    {
        $list = TransaksiPengumumanPendaftaranHeader::select('id','tanggal','penanggung_jawab','deskripsi')->get();

        $data = array();

        foreach($list as $k => $v){

            $btnEdit = '<a href="/transaksi/pengumuman/'.$v->id.'/edit" class="btn btn-xs btn-default text-primary mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>';
            $btnDelete = '<button type="submit" form="delete'.$v->id.'" class="btn btn-xs btn-default text-danger mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>';

            $data[] = array(
                $v->id,$v->tanggal,$v->penanggung_jawab,$v->deskripsi,'<nobr>'.$btnEdit.$btnDelete.'</nobr>'
            );
        }

        return view('pages.pengumuman.index', compact('data'));
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

        $create = TransaksiPengumumanPendaftaranHeader::create($input);

        if($create){
            return redirect('/transaksi/pengumuman')->with(['success' => 'Data Berhasil Dibuat']);
        }else{
            return redirect('/transaksi/pengumuman')->with(['error' => 'Data Gagal Dibuat']);
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
        $data = TransaksiPengumumanPendaftaranHeader::find($id);

        $list = TransaksiPengumumanPendaftaranDetail::where('id_pengumuman_pendaftaran', $id)->get();

        $pendaftar = array();

        foreach($list as $k => $v){

            if($v->status == null){
                $diterima = '<button type="submit" form="diterima'.$v->id.'" class="btn btn-xs btn-default text-success mx-1 shadow">
                                <i class="fa fa-lg fa-fw fa-check-circle"></i> Terima
                            </button>';
                $ditolak = '<button type="submit" form="ditolak'.$v->id.'" class="btn btn-xs btn-default text-danger mx-1 shadow">
                                <i class="fa fa-lg fa-fw fa-window-close"></i> Tolak
                            </button>';
            }else{
                $diterima = '';
                $ditolak = '';
            }

            $pendaftar[] = array(
                $v->id,date('d M Y', strtotime($v->tanggal)),$v->nama,$v->tempat_lahir,date('d M Y', strtotime($v->tanggal_lahir)),$v->no_ktp,$v->riwayat_pendidikan,$v->nama_wali,$v->no_ktp_wali,$v->status,'<nobr>'.$diterima.$ditolak.'</nobr>'
            );
        }

        // print_r($pendaftar);exit;

        return view('pages.pengumuman.edit', compact('data','pendaftar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function status(Request $request){
        $update = TransaksiPengumumanPendaftaranDetail::where('id',$request->id)->update(['status' => $request->status]);

        if($update){
            if($request->status == 'Diterima'){
                return redirect()->back()->with(['success' => 'Pendaftar Diterima']);
            }else{
                return redirect()->back()->with(['error' => 'Pendaftar Ditolak']);
            }
        }else{
            return redirect()->back()->with(['error' => 'Error']);
        }
    }

    public function update(Request $request, $id)
    {
        $input = $request->except(['_token', '_method']);

        $update = TransaksiPengumumanPendaftaranHeader::where('id',$id)->update($input);

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
        $delete = TransaksiPengumumanPendaftaranHeader::where('id',$id)->delete($id);

        if($delete){
            return redirect('/transaksi/pengumuman')->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return redirect('/transaksi/pengumuman')->with(['error' => 'Data Gagal Dihapus']);
        }
    }
}
