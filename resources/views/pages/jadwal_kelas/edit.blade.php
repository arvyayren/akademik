@extends('adminlte::page')

@section('title', 'Akademik - Master Mapel')

@section('content_header')
    <h1>Edit Jadwal Kelas</h1>
@stop

@section('content')
    <x-adminlte-card title="Edit Mapel" theme="dark" icon="fas fa-list-alt">
        
        @include('widget.flash')

        <form action="/transaksi/jadwal_kelas/{{$data->id}}" method="post">
        @csrf
        {{ method_field('PUT') }}
        
        <div class="row">
                <x-adminlte-input name="hari" label="Hari" placeholder="Hari..."
                fgroup-class="col-md-6" value="{{$data->hari}}" disable-feedback required/>

                <x-adminlte-select label="Mapel" fgroup-class="col-md-6" name="mapel" required>
                    @foreach($mapel as $m)
                    <option value="{{$m->id}}" <?php if($data->mapel == $m->id){ echo 'selected';} ?>>{{$m->nama}}</option>
                    @endforeach
                </x-adminlte-select>
            </div>
            
            <div class="row">
                <x-adminlte-select label="Nama Guru" fgroup-class="col-md-6" name="nama_guru" required>
                    @foreach($guru as $g)
                    <option value="{{$g->id}}" <?php if($data->nama_guru == $g->id){ echo 'selected';} ?>>{{$g->nama}}</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-select label="Kelas" fgroup-class="col-md-6" name="kelas" required>
                    <option value="A" <?php if($data->kelas == 'A'){ echo 'selected';} ?>>A</option>
                    <option value="B" <?php if($data->kelas == 'B'){ echo 'selected';} ?>>B</option>
                    <option value="C" <?php if($data->kelas == 'C'){ echo 'selected';} ?>>C</option>
                </x-adminlte-select>
            </div>
        
        <x-adminlte-button icon="fas fa-check-circle" type="submit" label="Submit" class="bg-success btn-block"/>
        </form>

    </x-adminlte-card>

@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" integrity="sha512-f0tzWhCwVFS3WeYaofoLWkTP62ObhewQ1EZn65oSYDZUg1+CyywGKkWzm8BxaJj5HGKI72PnMH9jYyIFz+GH7g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@stop