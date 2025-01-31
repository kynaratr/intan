<style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    table th,
                    table td {
                        padding: 8px;
                        text-align: left;
                        border-bottom: 1px solid #ddd;
                    }

                    table th {
                        background-color: #f2f2f2;
                    }

                    table tr:nth-child(even) {
                        background-color: #f9f9f9;
                    }

                    table tr:hover {
                        background-color: #f5f5f5;
                    }
                    </style>
@extends('adminlte::page')
@section('title', 'Tambah Pelanggan')
@section('content_header')
<h1 class="m-0 text-dark">Tambah Pelanggan</h1>
@stop
@section('content')
<form action="{{route('pelanggan.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" placeholder="Nama Lengkap" name="nama_lengkap" value="{{old('nama_lengkap')}}">
                        @error('nama_lengkap') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="no_hp">Nomor HandPhone</label>
                        <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" placeholder="Nomor HandPhone" name="no_hp" value="{{old('no_hp')}}">
                        @error('no_hp') <span class="textdanger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea type="text" class="form-control" name="alamat" value="{{old('alamat')}}"></textarea>
                        @error('alamat') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="id_user">Email</label>
                        <div class="input-group">
                            <input type="hidden" name="id_user" id="id_user" value="{{old('id_user')}}">
                            <input type="text" class="form-control
@error('users') is-invalid @enderror" placeholder="Email" id="users" name="users" value="{{old('users')}}" arialabel="kategori_berita" aria-describedby="cari" readonly>
                            <button class="btn btn-warning" type="button" data-bs-toggle="modal" id="cari" data-bs-target="#staticBackdrop"></i>
                                Cari Email</button>
                        </div>
                        <div class="form-group">
                            <label for="foto" class="form-label">Foto</label>
                            <img src="/vendor/adminlte/dist/img/no-image.png" class="img-thumbnail d-block" name="tampil" alt="..." width="10%" id="tampil">
                            <input class="form-control @error('foto') isinvalid @enderror" type="file" id="foto" name="foto" value="{{old('foto')}}">
                            @error('foto') <span class="text-danger">{{$message}}</span> @enderror
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{route('pelanggan.index')}}" class="btn btn-default">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Pencarian Email Pelanggan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover table-bordered tablestripped" id="example2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Email</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $a)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$a->email}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary
btn-xs" onclick="pilih('{{$a->id}}', '{{$a->email}}')" data-bs-dismiss="modal">
                                            Pilih
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
        @stop
        @push('js')
        <script>
            $('#example2').DataTable({
                "responsive": true,
            });


            function pilih(id, user) {
            document.getElementById('id_user').value = id
            document.getElementById('users').value = user
            }
        </script>
       @push('js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#tampil').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#foto").change(function() {
            readURL(this);
        });
    </script>
        @endpush
