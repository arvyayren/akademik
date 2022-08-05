<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MasterSantri;

use Auth;

class SantriController extends Controller
{
    public function index()
    {
        $list = MasterSantri::select('id','nama','tempat_lahir','tanggal_lahir','no_ktp')->get();

        $data = array();

        $no = 0;

        foreach($list as $k => $v){
            
            if(Auth::user()->email == 'admin@admin.com'){
            $btnEdit = '<a href="/master/santri/'.$v->id.'/edit" class="btn btn-xs btn-default text-primary mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>';
            $btnDelete = '<button type="submit" form="delete'.$v->id.'" class="btn btn-xs btn-default text-danger mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>';
            }else{
                $btnEdit ="";
                $btnDelete = "" ;
            }
            $no = $no+1;
        
            $data[] = array(
                $no,$v->nama,$v->tempat_lahir,$v->tanggal_lahir,$v->no_ktp,'<nobr>'.$btnEdit.$btnDelete.'</nobr>'
            );
        }

        return view('pages.santri.index', compact('data'));
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

        $create = MasterSantri::create($input);

        if($create){
            return redirect('/master/santri')->with(['success' => 'Data Berhasil Dibuat']);
        }else{
            return redirect('/master/santri')->with(['error' => 'Data Gagal Dibuat']);
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
        $data = MasterSantri::find($id);

        return view('pages.santri.edit', compact('data'));
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

        $update = MasterSantri::where('id',$id)->update($input);

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
        $delete = MasterSantri::where('id',$id)->delete($id);

        if($delete){
            return redirect('/master/santri')->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return redirect('/master/santri')->with(['error' => 'Data Gagal Dihapus']);
        }
    }
}
