@extends('adminlte::page')

@section('title', 'Akademik - Master Pengumuman')

@section('content_header')
    <h1>Edit Pengumuman</h1>
@stop

@section('content')
    <x-adminlte-card title="Edit Pengumuman" theme="dark" icon="fas fa-list-alt">
        
        @include('widget.flash')

        <form action="/transaksi/pengumuman/{{$data->id}}" method="post">
        @csrf
        {{ method_field('PUT') }}
        <div class="row">
            @php
                $config = ['format' => 'Y-m-d'];
            @endphp
            <x-adminlte-input name="penanggung_jawab" value="{{$data->penanggung_jawab}}" label="Penanggung Jawab" placeholder="Penanggung Jawab..."
            fgroup-class="col-md-6" disable-feedback required/>

            <x-adminlte-input-date name="tanggal" value="{{$data->tanggal}}" :config="$config" placeholder="Pilih Tanggal..."
                label="Tanggal" label-class="text-primary" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <x-adminlte-button theme="outline-primary" icon="fas fa-calendar-alt"
                        title="Tanggal"/>
                </x-slot>
            </x-adminlte-input-date>
        </div>

        <div class="row">
            <x-adminlte-textarea name="deskripsi" fgroup-class="col-md-6" label="Deskripsi" placeholder="Deskripsi..." required>
                {{$data->deskripsi}}
            </x-adminlte-texarea>
        </div>
        
        <x-adminlte-button icon="fas fa-check-circle" type="submit" label="Submit" class="bg-success btn-block"/>
        </form>

    </x-adminlte-card>

    <x-adminlte-card title="List Pendaftar" theme="dark" icon="fas fa-list-alt">
        
        @php
        $heads = [
            'id',
            'Kode Pendaftaran',
            'Tanggal',
            'Nama',
            'Tempat Lahir',
            'Tanggal Lahir',
            'No KTP',
            'Riwayat Pendidikan',
            'Nama Wali',
            'No KTP Wali',
            'Status',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];

        $config = [
            'data' => $pendaftar,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, null,null, null, null, null,null, null, ['orderable' => false]],
        ];
        @endphp

        {{-- Minimal example / fill data using the component slot --}}
        <x-adminlte-datatable id="table1" :heads="$heads">
            @foreach($config['data'] as $row)
                <tr>
                    @foreach($row as $cell)
                        <td>{!! $cell !!}</td>
                    @endforeach
                    
                    <form id="diterima{{$row[0]}}" method="POST" action="/status/pengumuman">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$row[0]}}">
                        <input type="hidden" name="status" value="Diterima">
                    </form>

                    <form id="ditolak{{$row[0]}}" method="POST" action="/status/pengumuman">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$row[0]}}">
                        <input type="hidden" name="status" value="Ditolak">
                    </form>
                </tr>
            @endforeach
        </x-adminlte-datatable>
        
    </x-adminlte-card>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" integrity="sha512-f0tzWhCwVFS3WeYaofoLWkTP62ObhewQ1EZn65oSYDZUg1+CyywGKkWzm8BxaJj5HGKI72PnMH9jYyIFz+GH7g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@stop