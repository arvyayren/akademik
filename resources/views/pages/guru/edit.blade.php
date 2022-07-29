@extends('adminlte::page')

@section('title', 'Akademik - Master Guru')

@section('content_header')
    <h1>Edit Data Guru</h1>
@stop

@section('content')
    <x-adminlte-card title="Edit Guru" theme="dark" icon="fas fa-list-alt">
        
        @include('widget.flash')

        <form action="/master/guru/{{$data->id}}" method="post">
        @csrf
        {{ method_field('PUT') }}
        
        <div class="row">
            <x-adminlte-input name="nama" value="{{$data->nama}}" label="Nama" placeholder="Nama..."
            fgroup-class="col-md-6" disable-feedback required/>

            <x-adminlte-input name="no_ktp" value="{{$data->no_ktp}}" label="No KTP" placeholder="No KTP..."
            fgroup-class="col-md-6" disable-feedback required/>
        </div>
        
        <div class="row">
            @php
            $config = ['format' => 'Y-m-d'];
            @endphp
            
            <x-adminlte-input name="tempat_lahir" value="{{$data->tempat_lahir}}" label="Tempat Lahir" placeholder="Tempat Lahir..."
            fgroup-class="col-md-6" disable-feedback required/>

            <x-adminlte-input-date name="tanggal_lahir" value="{{$data->tanggal_lahir}}" :config="$config" placeholder="Pilih Tanggal..."
                label="Tanggal Lahir" label-class="text-primary" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <x-adminlte-button theme="outline-primary" icon="fas fa-calendar-alt"
                        title="Tanggal Lahir"/>
                </x-slot>
            </x-adminlte-input-date>
        </div>

        
        <div class="row">
            <x-adminlte-textarea name="alamat" fgroup-class="col-md-6" label="Alamat" placeholder="Alamat..." required>
                {{$data->alamat}}
            </x-adminlte-texarea>

            <x-adminlte-textarea name="riwayat_pendidikan" fgroup-class="col-md-6" label="Riwayat Pendidikan" placeholder="Riwayat Pendidikan..." required>
                {{$data->riwayat_pendidikan}}
            </x-adminlte-texarea>
        </div>
        
        <div class="row">
            <x-adminlte-select label="Kelas" fgroup-class="col-md-6" name="wali_kelas" required>
                <option value="A" <?php if($data->wali_kelas == 'A'){ echo 'selected';} ?>>A</option>
                <option value="B" <?php if($data->wali_kelas == 'B'){ echo 'selected';} ?>>B</option>
                <option value="C" <?php if($data->wali_kelas == 'C'){ echo 'selected';} ?>>C</option>
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