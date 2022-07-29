@extends('adminlte::page')

@section('title', 'Akademik - Laporan Penilaian Santri')

@section('content_header')
    <h1>Laporan Penilaian</h1>
@stop

@section('content')

    <div class="card p-5 no-print">
        <h5 class="pb-5">Pilih Parameter</h5>
        <form action="" method="get">
            <div class="row">
                <div class="col-md-6">
                    <select class="form-control" name="santri" id="santri">
                        @foreach($data_santri as $data_santri)
                        <option value="{{ $data_santri->id }}">{{ $data_santri->nama }} - {{ $data_santri->bulan }} - {{ date('Y') }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary" type="submit">
                        Cari
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if(count($data_detail) > 0)
    <div class="card p-5">
        <div class="col-md-6 no-print">
            <button class="btn btn-danger" onclick="window.print()">
                <i class='fas fa-print'></i> PRINT
            </button>
        </div>
        <div class="pb-3 pt-5">
            <h5 class="text-center pb-5">Laporan Penilaian Bulan {{ $data_header->bulan }} - {{ date('Y') }}</h5>
            <h6>Nama Santri : {{ $data_header->nama}}</h6>
            <h6>Kelas : {{ $data_header->kelas}}</h6>
            <h6>Nama Wali Kelas : {{ $data_header->wali_kelas}}</h6>

        </div>
        <table id="example" class="table" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Mapel</th>
                    <th>Subjek</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_detail as $datas)
                <tr>
                    <td>{{ $no++}}</td>
                    <td>{{ $datas->tanggal }}</td>
                    <td>{{ $datas->mapel }}</td>
                    <td>{{ $datas->subjek }}</td>
                    <td>{{ $datas->nilai }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-right">Rata-rata</td>
                    <td>{{ $rata2 }}</td>
                </tr>
        </table>
    </div>
    @endif
    
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
    @media print
    {    
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

@stop