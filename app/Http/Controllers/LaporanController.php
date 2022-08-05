<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MasterGuru;
use App\Models\MasterSantri;
use App\Models\MasterMapel;
use App\Models\TransaksiPengumumanPendaftaranHeader;
use App\Models\TransaksiPengumumanPendaftaranDetail;
use App\Models\TransaksiPenilaianSantriHeader;
use App\Models\TransaksiPenilaianSantriDetail;

class LaporanController extends Controller
{
    public function santri(){
        $data = MasterSantri::orderBy('nama', 'asc')
        ->get();
        $no = 1;
        $compactData = [
            'data' => $data,
            'no' => $no
        ];
        return view('laporan.santri', $compactData);
    }

    public function guru(){
        $data = MasterGuru::orderBy('nama', 'asc')
        ->get();
        $no = 1;
        $compactData = [
            'data' => $data,
            'no' => $no
        ];
        return view('laporan.guru', $compactData);
    }

    public function penerimaan_santri(request $request){
        $data_tanggal = TransaksiPengumumanPendaftaranHeader::orderBy('tanggal', 'asc')
        ->get();
        $data = [];
        $no = 1;
        
        if($request->tanggal != null){
            $data = TransaksiPengumumanPendaftaranDetail::where('id_pengumuman_pendaftaran', $request->tanggal)
            ->orderBy('nama', 'asc')
            ->get();
        }

        $compactData = [
            'data_tanggal' => $data_tanggal,
            'data' => $data,
            'no' => $no
        ];
        return view('laporan.penerimaan-santri', $compactData);
    }

    public function penilaian_santri(request $request){
        $data_santri = TransaksiPenilaianSantriHeader::orderBy('nama', 'asc')
        ->get();
        $data_header = [];
        $data_detail = [];
        $rata2 = 0;
        $no = 1;
        
        if($request->santri != null){
            $data_header = TransaksiPenilaianSantriHeader::select('transaksi_penilaian_santri_header.bulan as bulan', 'transaksi_penilaian_santri_header.nama as nama', 'transaksi_penilaian_santri_header.kelas as kelas', 'data_guru.nama as wali_kelas')
            ->join('data_guru', 'transaksi_penilaian_santri_header.wali_kelas', 'data_guru.id')
            ->where('transaksi_penilaian_santri_header.id', $request->santri)
            ->first();
            $data_detail = TransaksiPenilaianSantriDetail::select('transaksi_penilaian_santri_detail.tanggal as tanggal', 'data_mapel.nama as mapel', 'transaksi_penilaian_santri_detail.subjek as subjek', 'transaksi_penilaian_santri_detail.nilai as nilai')
            ->join('data_mapel', 'transaksi_penilaian_santri_detail.mapel', 'data_mapel.id')
            ->where('transaksi_penilaian_santri_detail.id_penilaian', $request->santri)
            ->orderBy('transaksi_penilaian_santri_detail.tanggal', 'asc')
            ->get();
            $rata2 = $data_detail->sum("nilai")/$data_detail->count();
        }

        $compactData = [
            'data_santri' => $data_santri,
            'data_header' => $data_header,
            'data_detail' => $data_detail,
            'rata2' => $rata2,
            'no' => $no
        ];
        return view('laporan.penilaian-santri', $compactData);
    }
}
