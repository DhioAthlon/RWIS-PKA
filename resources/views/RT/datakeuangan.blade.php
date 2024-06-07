@extends('layouts_rt.app')
@section ('content')
 {{-- <link rel="stylesheet" href="{{ asset('public/assets/css/mooli.min.css')}}"> --}}

 {{-- TOTAL KEUANGAN ATAS --}}
 <div class="col-12">
    <div class="card theme-bg gradient">
        
        <div class="card-body">
            <h4>Total Keuangan RT {{$rt}}</h4>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="fa fa-briefcase"></i></div>
                            <div class="ml-4">
                                <span>Iuran sampah</span>
                                <h2 class="mb-0 font-weight-medium">{{$iuranSampah}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="fa fa-briefcase"></i></div>
                            <div class="ml-4">
                                <span>Iuran Listrik</span>
                                <h2 class="mb-0 font-weight-medium">{{$iuranListrik}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="fa fa-briefcase"></i></div>
                            <div class="ml-4">
                                <span>Iuran PHB</span>
                                <h2 class="mb-0 font-weight-medium">{{$iuranPHB}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="fa fa-briefcase"></i></div>
                            <div class="ml-4">
                                <span>Iuran Kematian</span>
                                <h2 class="mb-0 font-weight-medium">{{$iuranKematian}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>         
        </div>
    </div>
    {{-- Tabel Keuangan --}}
    <div class="card">
        <div class="header">
            <h2>Laporan Keuangan RT {{$rt}}</h2><br>
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#Tambahkeuangan">Tambah Data Keuangan</button>
            <br><br>
            {{-- <h2>Filter Laporan Keuangan RW 01</h2> --}} 
            <form method="GET" action="{{ route('rt_data_keuangan') }}">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="start_date">Tanggal Mulai</label>
                            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="end_date">Tanggal Akhir</label>
                            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <select name="keterangan" class="form-control">
                                <option value="">Pilih Jenis Iuran</option>
                                <option value="iuran PHB" {{ request('keterangan') == 'iuran PHB' ? 'selected' : '' }}>iuran PHB</option>
                                <option value="iuran Kematian" {{ request('keterangan') == 'iuran Kematian' ? 'selected' : '' }}>iuran Kematian</option>
                                <option value="iuran Listrik" {{ request('keterangan') == 'iuran Listrik' ? 'selected' : '' }}>iuran Listrik</option>
                                <option value="iuran Sampah" {{ request('keterangan') == 'iuran Sampah' ? 'selected' : '' }}>iuran Sampah</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
                                            

        </div>
        <div class="body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Nama</th>
                            <th>Nominal</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_keuangan as $keuangan)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$keuangan->tanggal}}</td>
                            <td>{{$keuangan->jenis_data}} </td>
                            <td>{{$keuangan->nama}}</td>
                            <td>{{$keuangan->jumlah}}</td>
                            <td>{{$keuangan->jenis_iuran}}</td>
                            <td> 
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#EditKeuangan{{$keuangan->id}}">Edit</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="">Hapus</button>
                            </td>                                        
                        </tr>  
                        {{-- EDIT --}}
                        <div class="modal fade" id="EditKeuangan{{$keuangan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Data </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('rt_prosesEditKeuangan') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$keuangan->id}}">
                                            <div class="card">
                                                <div class="body">
                                                    <div class="row clearfix">
                                                        {{-- kiri atas --}}
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">Nama:</label>
                                                                <input name="nama" value="{{$keuangan->nama}}" type="text" class="form-control" placeholder="(Nama Lengkap)" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Kategori :</label>
                                                                <select name="kategori" class="custom-select" id="inputGroupSelect01" required>
                                                                    <option value="pemasukan" {{$keuangan->jenis_data == 'pemasukan' ? 'selected' : ''}}>Pemasukan</option>
                                                                    <option value="pengeluaran" {{$keuangan->jenis_data == 'pengeluaran' ? 'selected' : ''}}>Pengeluaran</option>    
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Keterangan :</label>
                                                                <select name="keterangan" class="custom-select" id="inputGroupSelect01" required>
                                                                    <option>Pilih Jenis Iuran</option>
                                                                    <option value="iuran PHB" {{$keuangan->jenis_iuran == 'iuran PHB' ? 'selected' : ''}}>iuran PHB</option>
                                                                    <option value="iuran Kematian" {{$keuangan->jenis_iuran == 'iuran Kematian' ? 'selected' : ''}}>iuran Kematian</option>
                                                                    <option value="iuran Listrik" {{$keuangan->jenis_iuran == 'iuran Listrik' ? 'selected' : ''}}>iuran Listrik</option>
                                                                    <option value="iuran Sampah" {{$keuangan->jenis_iuran == 'iuran Sampah' ? 'selected' : ''}}>iuran Sampah</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Tanggal :</label>
                                                                <input name="tanggal" value="{{$keuangan->tanggal}}" type="date" class="form-control" placeholder="tanggal" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Nominal :</label>
                                                                <input name="jumlah" value="{{$keuangan->jumlah}}" type="integer" class="form-control" placeholder="(Jumlah Iuran)" required>
                                                            </div>
                    
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>   
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary theme-bg gradient">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
{{-- Modals Tambah data Keuangan --}}
<div class="modal fade" id="Tambahkeuangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Keuangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{-- method diisi ya ganteng nanti --}}
                <form method="post" action="{{route('rt_prosesTambahKeuangan')}}">
                    @csrf
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                {{-- kiri atas --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Nama:</label>
                                        <input name="nama" type="text" class="form-control" placeholder="(Nama Lengkap)" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Kategori :</label>
                                        <select name="kategori" class="custom-select" id="inputGroupSelect01" required>
                                            <option >Pilih Kategori</option>
                                            <option value="pemasukan">Pemasukan</option>
                                            <option value="pengeluaran">Pengeluaran</option>    
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Keterangan :</label>
                                        <select name="keterangan" class="custom-select" id="inputGroupSelect01" required>
                                            <option>Pilih Jenis Iuran</option>
                                            <option value="iuran PHB">iuran PHB</option>
                                            <option value="iuran Kematian">iuran Kematian</option>
                                            <option value="iuran Listrik">iuran Listrik</option>
                                            <option value="iuran Sampah">iuran Sampah</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tanggal :</label>
                                        <input name="tanggal" type="date" class="form-control" placeholder="tanggal" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nominal :</label>
                                        <input name="jumlah" type="integer" class="form-control" placeholder="(Jumlah Iuran)" required>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary theme-bg gradient">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

<!-- Javascript -->
<script src="assets/bundles/libscripts.bundle.js"></script>    
<script src="assets/bundles/vendorscripts.bundle.js"></script>