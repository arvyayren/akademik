<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MasterMapel;

class MapelController extends Controller
{
    public function index()
    {
        $list = MasterMapel::select('id', 'kode', 'nama')->get();

        $data = array();

        $no = 0;

        foreach($list as $k => $v){

            $btnEdit = '<a href="/master/mapel/'.$v->id.'/edit" class="btn btn-xs btn-default text-primary mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>';
            $btnDelete = '<button type="submit" form="delete'.$v->id.'" class="btn btn-xs btn-default text-danger mx-1 shadow">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>';
            
            $no = $no+1;

            $data[] = array(
                $no, $v->kode, $v->nama,'<nobr>'.$btnEdit.$btnDelete.'</nobr>'
            );
        }

        return view('pages.mapel.index', compact('data'));
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

        $create = MasterMapel::create($input);

        if($create){
            return redirect('/master/mapel')->with(['success' => 'Data Berhasil Dibuat']);
        }else{
            return redirect('/master/mapel')->with(['error' => 'Data Gagal Dibuat']);
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
        $data = MasterMapel::find($id);

        return view('pages.mapel.edit', compact('data'));
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

        $update = MasterMapel::where('id',$id)->update($input);

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
        $delete = MasterMapel::where('id',$id)->delete($id);

        if($delete){
            return redirect('/master/mapel')->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return redirect('/master/mapel')->with(['error' => 'Data Gagal Dihapus']);
        }
    }
}
