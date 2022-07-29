@extends('adminlte::page')

@section('title', 'Akademik - Transaksi Jadwal Kelas')

@section('content_header')
    <h1>Jadwal Kelas</h1>
@stop

@section('content')

    <x-adminlte-card title="List Jadwal Kelas" theme="dark" icon="fas fa-list-alt">
        
        @include('widget.flash')

        <x-adminlte-modal id="create" title="Create" theme="success"
        icon="fas fa-plus-square" size='lg'>
            <form action="/transaksi/jadwal_kelas" method="post">
            @csrf
            <div class="row">
                <x-adminlte-input name="hari" label="Hari" placeholder="Hari..."
                fgroup-class="col-md-6" disable-feedback required/>

                <x-adminlte-select label="Mapel" fgroup-class="col-md-6" name="mapel" required>
                    @foreach($mapel as $m)
                    <option value="{{$m->id}}">{{$m->nama}}</option>
                    @endforeach
                </x-adminlte-select>
            </div>
            
            <div class="row">
                <x-adminlte-select label="Nama Guru" fgroup-class="col-md-6" name="nama_guru" required>
                    @foreach($guru as $g)
                    <option value="{{$g->id}}">{{$g->nama}}</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-select label="Kelas" fgroup-class="col-md-6" name="kelas" required>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </x-adminlte-select>
            </div>

            <x-adminlte-button icon="fas fa-check-circle" type="submit" label="Submit" class="bg-success btn-block"/>
            </form>

            <x-slot name="footerSlot">
                <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal"/>
            </x-slot>
        </x-adminlte-modal>

        <x-adminlte-button icon="fas fa-plus-square" label="Create" data-toggle="modal" data-target="#create" class="bg-success"/>    
        <br/><br/>

        @php
        $heads = [
            'ID',
            'Hari',
            'Kelas',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];

        $config = [
            'data' => $data,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
        @endphp

        {{-- Minimal example / fill data using the component slot --}}
        <x-adminlte-datatable id="table1" :heads="$heads">
            @foreach($config['data'] as $row)
                <tr>
                    @foreach($row as $cell)
                        <td>{!! $cell !!}</td>
                    @endforeach
                    
                    <form id="delete{{$row[0]}}" method="POST" action="/transaksi/jadwal_kelas/{{$row[0]}}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
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