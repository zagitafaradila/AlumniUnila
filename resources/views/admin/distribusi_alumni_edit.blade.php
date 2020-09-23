@extends('adminlte::page')

@section('title', 'Tracer | Distribusi Alumni')

@section('content_header')
    <h2><a href="{{ route('distribusi_alumni') }}">Distribusi Alumni</a> / Tambah Alumni</h2>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
      <!-- Conten -->
      <div class="container-fluid">
        <div class="row">
          <!-- Filter-->
          <div class="col-md-4">
          </div>
          <!-- /.col -->
          <!-- Data Surveyor -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Data Surveyor</h5>
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
              <div class="card-body p-0">
                <table class="table table-striped">
                  <tbody>
                    <tr>
                      <td>NPM</td>
                      <td colspan="2">
                        : {{$data_surveyor->npm}}
                        <input type="hidden" id="npm_surveyor" name="npm_surveyor" value="{{$data_surveyor->npm}}">
                        <input type="hidden" id="pilihJurusan" name="pilihJurusan" value="">
                        <input type="hidden" id="pilihFakultas" name="pilihFakultas" value="">
                      </td>
                    </tr>
                    <tr>
                      <td>Nama</td>
                      <td colspan="2">
                        : {{$data_surveyor->name}}
                      </td>
                    </tr>
                    <tr>
                      <td>Jumlah Alumni</td>
                      <td colspan="2">
                      : {{$data_surveyor->jumlah_alumni}}
                      </td>
                    </tr>
                    <tr>
                      <td style="width: 30%">Alumni Sudah Mengisi</td>
                      <td style="width: 50%">
                        <div class="progress progress-xs progress-striped active">
                          <div class="progress-bar bg-primary" style="width: {{$persen_mengisi}}%"></div>
                        </div>
                      </td>
                      <td style="width: 20%"><span class="badge bg-primary">{{$data_surveyor->jumlah_mengisi}}</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <!-- Table Alumni-->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Daftar Alumni yang harus disurvey</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table_alumni_surveyor" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style="text-align: center"><input type="checkbox" id="select_all" /></th>
                      <th>NPM</th>                      
                      <th>Nama Lengkap</th>
                      <th>Jurusan</th>
                      <th>Prodi</th>
                      <th>Kelulusan</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <button id="removeCheck" type="button" class="btn btn-outline-danger"><i class="fas fa-trash"></i> Hapus</button>
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div> <!-- /.row -->

        
      </div><!--/. container-fluid -->

      <!-- modal select Remove-->
      <div class="modal fade" id="modal-remove-select">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-body" id="modal-body">
              <p id="modal-text"></p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              <button type="button" class="btn btn-success"  id="konfirmRemoveSelect">Ya</button>
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
    <link rel="stylesheet" href="{{URL::to('../')}}/assets/datatables/datatables-select/css/select.bootstrap4.min.css">
    <link type="text/css" href="{{URL::to('../')}}/assets/datatables/jquery-datatables-checkboxes-1.2.11/css/dataTables.checkboxes.css" rel="stylesheet" />
@stop

@section('js')   
  <script src="{{URL::to('../')}}/assets/datatables/datatables/jquery.dataTables.min.js"></script>
  <script src="{{URL::to('../')}}/assets/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{URL::to('../')}}/assets/datatables/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{URL::to('../')}}/assets/datatables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="{{URL::to('../')}}/assets/datatables/datatables-select/js/dataTables.select.min.js"></script>
  <script src="{{URL::to('../')}}/assets/datatables/datatables-select/js/select.bootstrap4.min.js"></script>
  <script src="{{URL::to('../')}}/assets/datatables/jquery-datatables-checkboxes-1.2.11/js/dataTables.checkboxes.min.js"></script>

  <script>
    var Url = {
        combo: {
          jurusan: "{{ route('Mahasiswa.comboJurusan') }}",
          prodi: "{{ route('Mahasiswa.comboProdi') }}"
        },
        table: "{{ route('Distribusi.getAlumniSurveyor') }}",
        post: {
          removeSelect: "{{ route('Distribusi.removeSelect') }}",
        }
    };
  </script>
  <script src="{{URL::to('../')}}/Scripts/distribusi_alumni.js"></script>
@stop