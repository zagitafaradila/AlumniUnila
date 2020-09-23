@extends('adminlte::page')

@section('title', 'Tracer | Riwayat Pekerjaan')

@section('content_header')
    <h1>Riwayat Pekerjaan Alumni</h1>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
      <!-- Conten -->
      <div class="container-fluid">
        <div class="row">
          <!-- Table Riwayat Pekerjaan-->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Daftar Riwayat Pekerjaan</h5>
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
                <table id="table_daftar" class="table table-bordered table-hover">
                  <thead>
                      <tr>
                          <th>Tahun</th>
                          <th>Nama Perusahaan</th>
                          <th>Posisi</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <button id="add" type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-fakultas"><i class="fas fa-plus"></i> Add</button>
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div> <!-- /.row -->

        
      </div><!--/. container-fluid -->

      <!-- modal Pekerjaan-->
      <div class="modal fade" id="modal-pekerjaan">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Data pengalaman Kerja</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-success" style="display: none;"></div>
              <div class="form-group col-md-4">
                <input class="form-control " type="hidden" id="idFak" name="idFak" visible="false">
              </div> 
              <div class="clearfix"></div>
              <div class="form-group col-md-12">
                <input class="form-control" type="hidden" id="id" name="id" visible="false">
                <span>Nama Perusahaan</span>
                <input class="form-control required" type="text" id="perusahaan" name="perusahaan" placeholder="Nama Perusahaan">
                <span class="valid-msg" id="perusahaanmsg"></span>
              </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-4">
                <span>Tahun</span>
                <input class="form-control required" type="text" id="tahun" name="tahun" placeholder="YYYY - YYYY">
                <span class="valid-msg" id="tahunmsg"></span>										
              </div>
              <div class="clearfix"></div>              
              <div class="form-group col-md-9">
                <span>Posisi</span>
                <input class="form-control required" type="text" id="posisi" name="posisi" placeholder="Posisi">
                <span class="valid-msg" id="posisimsg"></span>
              </div>              
              <div class="clearfix"></div>
              <div class="form-group col-md-12">
                <span>Nama Atasan</span>
                <input class="form-control required" type="text" id="nama" name="nama" placeholder="Nama Atasan">
                <span class="valid-msg" id="namamsg"></span>
              </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-6">
                <span>Telp. Atasan</span>
                <input class="form-control required" type="text" id="telp" name="telp" placeholder="Telp. Atasan">
                <span class="valid-msg" id="telpmsg"></span>
              </div>
              <div class="form-group col-md-6">
                <span>Email Atasan</span>
                <input class="form-control required" type="text" id="email" name="email" placeholder="Email Atasan">
                <input class="form-control" type="hidden" id="emailold" name="emailold">
                <span class="valid-msg" id="emailmsg"></span>
              </div>
              <div class="clearfix"></div>
              <div class="alert alert-danger">
                <p>Pihak Universitas akan mengirim Email (secara otomatis setelah Anda menyimpan data) ke atasan Anda untuk keperluan Tracer Study, Mohon Cantumkan Email Atasan Anda atau Kosongkan jika Anda tidak ingin melakukannya</p>
              </div>
            </div>
            <div class="modal-footer">
              <meta name="csrf-token" content="{{ csrf_token() }}">
              <button type="button" class="btn btn-success pull-right" id="save"><i class="fas fa-check"></i> Save</button>
            </div>
          </div><!-- /.modal-content -->          
        </div><!-- /.modal-dialog -->        
      </div><!-- /.modal -->
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

  <script src="{{URL::to('../')}}/Scripts/riwayat_pekerjaan.js"></script>
@stop