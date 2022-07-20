<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MasterGuru;

class GuruController extends Controller
{
    public function index()
    {
        $list = MasterGuru::select('id','nama','tempat_lahir','tanggal_lahir','no_ktp')->get();

        $data = array();

        foreach($list as $k => $v){

            $btnEdit = '<a href="/master/guru/'.$v->id.'/edit" class="btn btn-xs btn-default text-primary mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>';
            $btnDelete = '<button type="submit" form="delete'.$v->id.'" class="btn btn-xs btn-default text-danger mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>';

            $data[] = array(
                $v->id,$v->nama,$v->tempat_lahir,$v->tanggal_lahir,$v->no_ktp,'<nobr>'.$btnEdit.$btnDelete.'</nobr>'
            );
        }

        return view('pages.guru.index', compact('data'));
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

        $create = MasterGuru::create($input);

        if($create){
            return redirect('/master/guru')->with(['success' => 'Data Berhasil Dibuat']);
        }else{
            return redirect('/master/guru')->with(['danger' => 'Data Gagal Dibuat']);
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
        $data = MasterGuru::find($id);

        return view('pages.guru.edit', compact('data'));
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

        $update = MasterGuru::where('id',$id)->update($input);

        if($update){
            return redirect()->back()->with(['success' => 'Data Berhasil Diubah']);
        }else{
            return redirect()->back()->with(['danger' => 'Data Gagal Diubah']);
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
        $delete = MasterGuru::where('id',$id)->delete($id);

        if($delete){
            return redirect('/master/guru')->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return redirect('/master/guru')->with(['danger' => 'Data Gagal Dihapus']);
        }
    }
}
