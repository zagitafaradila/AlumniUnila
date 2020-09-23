@extends('adminlte::page')

@section('title', 'Tracer | Distribusi Alumni')

@section('content_header')
    <h1>Distribusi Alumni</h1>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
      <!-- Conten -->
      <div class="container-fluid">
        <div class="row">
          <!-- Filter-->
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Filter</h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12"> <!-- Pilih Fakultas -->
                    <div class="form-group">
                      <select name="pilihFakultas" id="pilihFakultas" class="form-control select2" style="width: 100%;">
                        <option value = '%'>Semua Fakultas</option>
                        @foreach ($list_fakultas as $f)
                          <option value="{{{$f['kode']}}}">{{{$f['nama']}}}</option>
                        @endforeach
                      </select>
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <div class="col-md-12"> <!-- Pilih Jurusan -->
                    <div class="form-group">
                      <select name="pilihJurusan" id="pilihJurusan" class="form-control select2" style="width: 100%;">
                        <option value = '%'>Semua Jurusan</option>
                      </select>
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <div class="col-md-12"><!-- Pilih Prodi -->
                    <div class="form-group">
                      <select name="pilihProdi" id="pilihProdi" class="form-control select2" style="width: 100%;">
                        <option value = '%'>Semua Prodi</option>
                      </select>
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <!-- /.col -->              
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <!-- Table Program Studi-->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Daftar Distribusi Alumni</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table_distribusi" class="table table-bordered table-hover">
                  <thead>
                    <tr>                 
                      <th>Nama Surveyor</th>
                      <th>Jurusan</th>
                      <th>Program Studi</th>
                      <th>Angkatan</th>
                      <th>Jumlah Alumni</th>
                      <th>Jumlah Mengisi</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div> <!-- /.row -->

        
      </div><!--/. container-fluid -->

      <!-- modal Add-->
      <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Surveyor</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-success" style="display: none;"></div>
              <div class="form-group col-md-6">
                <span>NPM</span>
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <input class="form-control " type="hidden" id="npmLama" name="npmLama" visible="false">
                <input class="form-control required" type="text" id="npm" name="npm" placeholder="NPM">
                <span class="valid-msg" id="npmmsg"></span>
              </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-12">
                <span>Nama Lengkap</span>
                <input class="form-control required" type="text" id="nama" name="nama" placeholder="Nama Lengkap">
                <span class="valid-msg" id="namamsg"></span>
              </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-6">
                <span>Tanggal Lahir</span>
                <input class="form-control required datepicker" type="date" id="birthday" name="birthday">
                <span class="valid-msg" id="birthdaymsg"></span>
              </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-6">
                <span>Pilih Fakultas</span>
                <select class="form-control required" name="pilihFakultasModal" id="pilihFakultasModal">
                  <option value="0">Pilih Fakultas</option>
                  @foreach ($list_fakultas as $f)
                    <option value="{{{$f['kode']}}}">{{{$f['nama']}}}</option>
                  @endforeach
                </select>
                <span class="valid-msg" id="pilihFakultasModalmsg"></span>
              </div> 
              <div class="clearfix"></div>
              <div class="form-group col-md-6">
                <span>Pilih Jurusan</span>
                <select class="form-control required" name="pilihJurusanModal" id="pilihJurusanModal">
                  <option value="0">Pilih Jurusan</option>
                </select>
                <span class="valid-msg" id="pilihJurusanModalmsg"></span>
              </div> 
              <div class="clearfix"></div>
              <div class="form-group col-md-6">
                <span>Pilih Prodi</span>
                <select class="form-control required" name="pilihProdiModal" id="pilihProdiModal">
                  <option value="0">Pilih Program Studi</option>
                </select>
                <span class="valid-msg" id="pilihProdiModalmsg"></span>
              </div> 
              <div class="clearfix"></div>
              <div class="form-group col-md-4">
                <span>Angkatan</span>
                <input class="form-control required" type="number" id="angkatan" name="angkatan" placeholder="Angkatan">
                <span class="valid-msg" id="angkatanmsg"></span>
              </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-6">
                <span>Telepon</span>
                <input class="form-control required" type="number" id="telp" name="telp" placeholder="Telepon">
                <span class="valid-msg" id="telpmsg"></span>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success pull-right" id="save"><i class="fas fa-check"></i> Save</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->  
      <!-- modal remove-->
      <div class="modal fade" id="modal-remove">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-body">
              <p>Apakah Anda yakin akan menghapus data ini?</p>
              <input class="form-control " type="hidden" id="kode" name="kode" visible="false">
              <input class="form-control " type="hidden" id="kategori" name="kategori" visible="false">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              <button type="button" class="btn btn-danger"  id="konfirmRemove">Ya</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->  
      <!-- modal select remove-->
      <div class="modal fade" id="modal-remove-select">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-body" id="modal-body">
              <p id="modal-text"></p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              <button type="button" class="btn btn-danger"  id="konfirmRemoveSelect">Ya</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal --> 
    </section> 
@stop

@section('footer')
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.1
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">Tracer.Unila</a>.</strong> All rights
    reserved.
@stop

@section('css')
    <style>
      .valid-msg{
        font-size:12px;
        color:red;
      }
    </style>
    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::to('../')}}/assets/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{URL::to('../')}}/assets/datatables/datatables-responsive/css/responsive.bootstrap4.min.css">
@stop

@section('js')   
  <script src="{{URL::to('../')}}/assets/datatables/datatables/jquery.dataTables.min.js"></script>
  <script src="{{URL::to('../')}}/assets/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{URL::to('../')}}/assets/datatables/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{URL::to('../')}}/assets/datatables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <script>
    var Url = {
        combo: {
            jurusan: "{{ route('Mahasiswa.comboJurusan') }}",
            prodi: "{{ route('Mahasiswa.comboProdi') }}"
        }
    };
  </script>
  <script type="text/javascript" src="{{URL::to('../')}}/Scripts/distribusi_alumni.js"></script>
  @stop