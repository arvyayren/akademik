<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TransaksiPengumumanPendaftaranHeader;
use App\Models\TransaksiPengumumanPendaftaranDetail;

class IndexController extends Controller
{
    public function pengumuman(){

        $datas = TransaksiPengumumanPendaftaranHeader::select('*')->get();

        return view('pages.front.pengumuman',compact('datas'));
    }

    public function pendaftaran(Request $request){
        
        $input = $request->all();

        $create = TransaksiPengumumanPendaftaranDetail::create($input);

        return redirect('pengumuman');
    }
}
