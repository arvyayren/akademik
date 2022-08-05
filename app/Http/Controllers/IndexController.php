<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TransaksiPengumumanPendaftaranHeader;
use App\Models\TransaksiPengumumanPendaftaranDetail;

class IndexController extends Controller
{
    public function pengumuman(){

        $datas = TransaksiPengumumanPendaftaranHeader::select('*')->get();

        foreach($datas as $k => $v){
            $v->detail = TransaksiPengumumanPendaftaranDetail::where('id_pengumuman_pendaftaran', $v->id)->get();
        }

        return view('pages.front.pengumuman',compact('datas'));
    }

    public function pendaftaran(Request $request){
        
        $input = $request->all();

        $tahun = date('Y');
        
        $bulan = date('m');

        $no = 1;

        $check = TransaksiPengumumanPendaftaranDetail::whereYear('created_at', '=', $tahun)
        ->whereMonth('created_at', '=', $bulan)
        ->get();

        $max = count($check);

        if($max > 0){
            $kode_pendaftaran = 'RG' . $tahun . $bulan . sprintf("%04s", abs($max + 1));
        }else{
            $kode_pendaftaran = 'RG' . $tahun . $bulan . sprintf("%04s", $no);
        }    
        

        $create = TransaksiPengumumanPendaftaranDetail::create([
            'id_pengumuman_pendaftaran' => $request->id_pengumuman_pendaftaran,
            'tanggal' => $request->tanggal,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_ktp' => $request->no_ktp,
            'riwayat_pendidikan' => $request->riwayat_pendidikan,
            'nama_wali' => $request->nama_wali,
            'no_ktp_wali' => $request->no_ktp_wali,
            'status' => $request->status,
            'kode_pendaftaran' => $kode_pendaftaran,
        ]);

        return redirect('pengumuman');
    }
}
