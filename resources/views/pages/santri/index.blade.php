@extends('adminlte::page')

@section('title', 'Akademik - Master Santri')

@section('content_header')
    <h1>Data Santri</h1>
@stop

@section('content')

    <x-adminlte-card title="List Santri" theme="dark" icon="fas fa-list-alt">
        
        @include('widget.flash')

        <x-adminlte-modal id="create" title="Create" theme="success"
        icon="fas fa-plus-square" size='lg'>
            <form action="/master/santri" method="post">
            @csrf
            <div class="row">
                <x-adminlte-input name="nama" label="Nama" placeholder="Nama..."
                fgroup-class="col-md-6" disable-feedback required/>

                <x-adminlte-input name="no_ktp" label="No KTP" placeholder="No KTP..."
                fgroup-class="col-md-6" disable-feedback required/>
            </div>
            
            <div class="row">
                @php
                $config = ['format' => 'Y-m-d'];
                @endphp
                
                <x-adminlte-input name="tempat_lahir" label="Tempat Lahir" placeholder="Tempat Lahir..."
                fgroup-class="col-md-6" disable-feedback required/>

                <x-adminlte-input-date name="tanggal_lahir" :config="$config" placeholder="Pilih Tanggal..."
                    label="Tanggal Lahir" label-class="text-primary" fgroup-class="col-md-6" required>
                    <x-slot name="prependSlot">
                        <x-adminlte-button theme="outline-primary" icon="fas fa-calendar-alt"
                            title="Tanggal Lahir"/>
                    </x-slot>
                </x-adminlte-input-date>
            </div>

            <div class="row">
                <x-adminlte-textarea name="riwayat_pendidikan" fgroup-class="col-md-6" label="Riwayat Pendidikan" placeholder="Riwayat Pendidikan..." required/>
                
                <x-adminlte-select label="Kelas" fgroup-class="col-md-6" name="kelas" required>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </x-adminlte-select>
            </div>
            
            <div class="row">
                <x-adminlte-input name="nama_wali" label="Nama Wali" placeholder="Nama Wali..."
                fgroup-class="col-md-6" disable-feedback required/>

                <x-adminlte-input name="no_ktp_wali" label="No KTP Wali" placeholder="No KTP Wali..."
                fgroup-class="col-md-6" disable-feedback required/>
            </div>
            
            <x-adminlte-button icon="fas fa-check-circle" type="submit" label="Submit" class="bg-success btn-block"/>
            </form>

            <x-slot name="footerSlot">
                <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal"/>
            </x-slot>
        </x-adminlte-modal>
        @if(Auth::user()->email == 'admin@admin.com')
        <x-adminlte-button icon="fas fa-plus-square" label="Create" data-toggle="modal" data-target="#create" class="bg-success"/>    
        <br/><br/>
        @endif

        @php
        $heads = [
            'ID',
            'Nama',
            'Tempat Lahir',
            'Tanggal Lahir',
            'No KTP',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
          
        ];

        $config = [
            'data' => $data,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, null, null, ['orderable' => false]],
        ];
        @endphp

        {{-- Minimal example / fill data using the component slot --}}
        <x-adminlte-datatable id="table1" :heads="$heads">
            @foreach($config['data'] as $row)
                <tr>
                    @foreach($row as $cell)
                        <td>{!! $cell !!}</td>
                    @endforeach
                    
                    <form id="delete{{$row[0]}}" method="POST" action="/master/santri/{{$row[0]}}">
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