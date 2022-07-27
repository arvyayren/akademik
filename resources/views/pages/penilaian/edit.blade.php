@extends('adminlte::page')

@section('title', 'Akademik - Master Mapel')

@section('content_header')
    <h1>Edit</h1>
@stop

@section('content')
    <x-adminlte-card title="Edit Penilaian" theme="dark" icon="fas fa-list-alt">
        
        @include('widget.flash')

        <form action="/transaksi/penilaian/{{$data->id}}" method="post">
        @csrf
        {{ method_field('PUT') }}
        
            <div class="row">
                <x-adminlte-select label="Santri" fgroup-class="col-md-6" name="id_santri" required>
                    @foreach($santri as $s)
                    <option value="{{$s->id}}" <?php if($data->id_santri == $s->id){ echo 'selected';} ?>>{{$s->nama}}</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-select label="Bulan" fgroup-class="col-md-6" name="bulan" required>
                    <option value="Januari" <?php if($data->bulan == 'Januari'){ echo 'selected';} ?>>Januari</option>
                    <option value="Februari" <?php if($data->bulan == 'Februari'){ echo 'selected';} ?>>Februari</option>
                    <option value="Maret" <?php if($data->bulan == 'Maret'){ echo 'selected';} ?>>Maret</option>
                    <option value="April" <?php if($data->bulan == 'April'){ echo 'selected';} ?>>April</option>
                    <option value="Mei" <?php if($data->bulan == 'Mei'){ echo 'selected';} ?>>Mei</option>
                    <option value="Juni" <?php if($data->bulan == 'Juni'){ echo 'selected';} ?>>Juni</option>
                    <option value="Juli" <?php if($data->bulan == 'Juli'){ echo 'selected';} ?>>Juli</option>
                    <option value="Agustus" <?php if($data->bulan == 'Agustus'){ echo 'selected';} ?>>Agustus</option>
                    <option value="September" <?php if($data->bulan == 'September'){ echo 'selected';} ?>>September</option>
                    <option value="Oktober" <?php if($data->bulan == 'Oktober'){ echo 'selected';} ?>>Oktober</option>
                    <option value="November" <?php if($data->bulan == 'November'){ echo 'selected';} ?>>November</option>
                    <option value="Desember" <?php if($data->bulan == 'Desember'){ echo 'selected';} ?>>Desember</option>
                </x-adminlte-select>
            </div>
            
            <div class="row">
                <x-adminlte-select label="Wali Kelas" fgroup-class="col-md-6" name="wali_kelas" required>
                    @foreach($guru as $g)
                    <option value="{{$g->id}}" <?php if($data->wali_kelas == $g->id){ echo 'selected';} ?>>{{$g->nama}}</option>
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

    <x-adminlte-card title="Penilaian Santri" theme="dark" icon="fas fa-list-alt">
        
        <x-adminlte-modal id="create" title="Create" theme="success"
            icon="fas fa-plus-square" size='lg'>
            
                @php
                    $config = ['format' => 'Y-m-d'];
                @endphp
                
                <form action="/transaksi/penilaian_santri" method="post">
                @csrf
                
                <input type="hidden" name="id_penilaian" value="{{$data->id}}" />

                <div class="row">

                    <x-adminlte-input-date name="tanggal" :config="$config" placeholder="Pilih Tanggal..."
                        label="Tanggal" label-class="text-primary" fgroup-class="col-md-6" required>
                        <x-slot name="prependSlot">
                            <x-adminlte-button theme="outline-primary" icon="fas fa-calendar-alt"
                                title="Tanggal"/>
                        </x-slot>
                    </x-adminlte-input-date>

                    
                    <x-adminlte-select label="Mapel" fgroup-class="col-md-6" name="mapel" required>
                        @foreach($mapel as $m)
                        <option value="{{$m->id}}">{{$m->nama}}</option>
                        @endforeach
                    </x-adminlte-select>
                </div>
                
                <div class="row">
                    <x-adminlte-input name="subjek" label="Subjek" placeholder="Subjek..."
                    fgroup-class="col-md-6" disable-feedback required/>

                    <x-adminlte-input type="number" name="nilai" label="Nilai" placeholder="Nilai..."
                    fgroup-class="col-md-6" disable-feedback required/>
                </div>

                <div class="row">
                    <x-adminlte-textarea fgroup-class="col-md-12" label="Keterangan" name="keterangan"/>
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
                'Tanggal',
                'Mapel',
                'Subjek',
                'Nilai',
                'Keterangan',
                ['label' => 'Actions', 'no-export' => true, 'width' => 5],
            ];

            $config_table = [
                'data' => $penilaian,
                'order' => [[1, 'asc']],
                'columns' => [null, null, null, null, null, null,['orderable' => false]],
            ];
            @endphp

            {{-- Minimal example / fill data using the component slot --}}
            <x-adminlte-datatable id="table1" :heads="$heads">
                @foreach($config_table['data'] as $row)
                    <tr>
                        @foreach($row as $cell)
                            <td>{!! $cell !!}</td>
                        @endforeach
                        
                        <form id="delete{{$row[0]}}" method="POST" action="/transaksi/penilaian_santri/{{$row[0]}}">
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