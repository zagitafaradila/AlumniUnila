@extends('adminlte::page')

@section('title', 'Tracer | Riwayat Pendidikan')

@section('content_header')
    <h1>Riwayat Pendidikan Alumni</h1>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
      <!-- Conten -->
      <div class="container-fluid">
        <div class="row">
          <!-- Table Riwayat Pendidikan-->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Daftar Riwayat Pendidikan</h5>
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
                          <th>Jenjang</th>
                          <th>Nama Sekolah / Perguruan Tinggi</th>
                          <th>Tahun</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <button id="add" type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-pendidikan"><i class="fas fa-plus"></i> Add</button>
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div> <!-- /.row -->

        
      </div><!--/. container-fluid -->

      <!-- modal pendidikan-->
      <div class="modal fade" id="modal-pendidikan">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Data Riwayat Pendidikan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-success" style="display: none;"></div>
              <div class="form-group col-md-4">
                <input class="form-control " type="hidden" id="id" name="id" visible="false">
              </div> 
              <div class="clearfix"></div>
              <div class="form-group col-md-12">
                <span>Jenjang</span>
                <select class="form-control required" id="jenjang" name="jenjang">
                  <option value=''>Pilih Jenjang</option>
                  <option value='SD/Sederajat'>SD/Sederajat</option>
                  <option value='SMP/Sederajat'>SMP/Sederajat</option>
                  <option value='SMA/Sederajat'>SMA/Sederajat</option>
                  <option value='D1'>D1</option>
                  <option value='D2'>D2</option>
                  <option value='D3'>D3</option>
                  <option value='S1'>S1</option>
                  <option value='S2'>S2</option>
                  <option value='S3'>S3</option>
                </select>
                <span class="valid-msg" id="jenjangmsg"></span>
              </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-12">
                <span>Nama Sekolah/Perguruan Tinggi</span>
                <input type="text" class="form-control required" id="school" name="school" placeholder="Nama Sekolah/Perguruan Tinggi">											
                <span class="valid-msg" id="schoolmsg"></span>
              </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-3">
                <span>Tahun</span>
                <input type="text" class="form-control required" id="tahun" name="tahun" placeholder="YYYY - YYYY">											
                <span class="valid-msg" id="tahunmsg"></span>
              </div>
              <div class="clearfix"></div>
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

  <script src="{{URL::to('../')}}/Scripts/riwayat_pendidikan.js"></script>
@stop