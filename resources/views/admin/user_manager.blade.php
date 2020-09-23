@extends('adminlte::page')

@section('title', 'Tracer | User Manager')

@section('content_header')
    <h1>User Manager</h1>
@stop

@section('content')
    <section class="content">
      <!-- content -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Akun User Tracer Unila</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="table_user" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Fakultas</th>
                        <th>Jurusan</th>
                        <th>Program Studi</th>
                        <th>Akses</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
              <button id="addUser" type="button" class="btn btn-outline-success"><i class="fas fa-plus"></i> Add</button>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- modal Add-->
      <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">User Manager</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-success" style="display: none;"></div>
              <div class="form-group col-md-12">
                <span>Username</span>
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <input class="form-control " type="hidden" id="idlama" name="idlama" visible="false">
                <input class="form-control required" type="text" id="id" name="id" placeholder="Username">
                <span class="valid-msg" id="idmsg"></span>
              </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-12">
                <span>Password</span>
                <input class="form-control required" type="password" id="password" name="password" placeholder="Password Baru">
                <span class="valid-msg" id="passwordmsg"></span>
              </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-12">
                <span>Ulangi Password</span>
                <input class="form-control required" type="password" id="repassword" name="repassword" placeholder="Ulangi Password">
                <span class="valid-msg" id="repasswordmsg"></span>
              </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-12">
                <span>Pilih Level</span>
                <div class="clearfix"></div>
                <select name="pilihLevel" id="pilihLevel">
                  <option value="">Pilih</option>
                  <option value="Administrator">Administrator</option>
                  <option value="Kepala Program Studi">Kepala Program Studi</option>
                </select>
              </div> 
              <div class="clearfix"></div>
              <div class="form-group col-md-12">
                <span>Pilih Fakultas</span>
                <div class="clearfix"></div>
                <select name="pilihFakultas" id="pilihFakultas">
                  <option value="0">Semua Fakultas</option>
                  @foreach ($list_fakultas as $f)
                    <option value="{{{$f['kode']}}}">{{{$f['nama']}}}</option>
                  @endforeach
                </select>
              </div> 
              <div class="clearfix"></div>
              <div class="form-group col-md-12">
                <span>Pilih Jurusan</span>
                <div class="clearfix"></div>
                <select name="pilihJurusan" id="pilihJurusan">
                  <option value="0">Semua Jurusan</option>
                </select>
              </div> 
              <div class="clearfix"></div>
              <div class="form-group col-md-12">
                <span>Pilih Prodi</span>
                <div class="clearfix"></div>
                <select name="pilihProdi" id="pilihProdi">
                  <option value="0">Semua Program Studi</option>
                </select>
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
      <!-- modal Remove-->
      <div class="modal fade" id="modal-remove">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-body">
              <p>Apakah Anda yakin akan menghapus data ini?</p>
              <input class="form-control " type="hidden" id="id" name="id" visible="false">
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

  <script src="{{URL::to('../')}}/Scripts/user.js"></script>
  @stop