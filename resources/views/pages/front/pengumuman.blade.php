<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Pengumuman</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

        <style>
            
        </style>
    </head>
    <body>

        <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="text-center">Pengumuman</h2>
            </div>

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">

                        <table class="table table-bordered">
                            @forelse($datas as $data)
                            <tr>
                                <td>
                                    <div class="card-title">
                                        <h6>{{date('d M Y', strtotime($data->tanggal))}}</h6>
                                        <div class="jumbotron jumbotron-fluid" style="padding: 1rem 1rem;">
                                            <div class="container">
                                                <p>{{$data->deskripsi}}</p>
                                            </div>
                                        </div>
                                        <h6><b>Penanggung Jawab</b> {{$data->penanggung_jawab}}</h6>
                                        <center><h4>Pendaftar</h4></center>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Kode Pendaftaran</th>
                                                    <th>Nama</th>
                                                    <th>Status</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($data->detail as $detail)
                                                <tr>
                                                    <td>{{date('d M Y', strtotime($detail->tanggal))}}</td>
                                                    <td>{{$detail->kode_pendaftaran}}</td>
                                                    <td>{{$detail->nama}}</td>
                                                    <td>
                                                        @if($detail->status == null)
                                                        Proses
                                                        @else
                                                        {{$detail->status}}
                                                        @endif
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr><td colspan="99">No Data</td></tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                                <td><button type="button" class="btn btn-sm btn-info btn-block" onclick="daftar({{$data->id}})" data-toggle="modal" data-target="#myModal">Daftar</button></td>
                            </tr>
                            @empty
                            <tr><td colspan="90">No Data</td></tr>
                            @endforelse
                        </table>

                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <!-- The Modal -->
        <div class="modal" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Pendaftaran</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post" action="/pendaftaran">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="id_pengumuman_pendaftaran" id="id_pengumuman_pendaftaran" />
                <input type="hidden" name="tanggal" value="{{date('Y-m-d')}}" />

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="nama">Nama Lengkap:</label>
                        <input type="text" class="form-control" name="nama" required />
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="no_ktp">No KTP:</label>
                        <input type="text" class="form-control" name="no_ktp" reqiured />
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="tempat_lahir">Tempat Lahir:</label>
                        <input type="text" class="form-control" name="tempat_lahir" required />
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="tanggal_lahir">Tanggal Lahir:</label>
                        <input type="date" class="form-control" name="tanggal_lahir" reqiured />
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="riwayat_pendidikan">Riwayat Pendidikan:</label>
                        <textarea class="form-control" name="riwayat_pendidikan" required></textarea>
                    </div>
                </div>
                
                
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="nama_wali">Nama Wali:</label>
                        <input type="text" class="form-control" name="nama_wali" required />
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="no_ktp_wali">No KTP Wali:</label>
                        <input type="text" class="form-control" name="no_ktp_wali" reqiured />
                    </div>
                </div>

                <button type="submit" class="btn btn-block btn-sm btn-success">Submit</button>

            </div>
            </form>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

            </div>
        </div>
        </div>

        <script>
            function daftar(id){
                $('#id_pengumuman_pendaftaran').val(id)
            }
        </script>
    </body>
</html>