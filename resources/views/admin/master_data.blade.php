@extends('adminlte::page')

@section('title', 'Tracer | Master Data')

@section('content_header')
    <h1>Master Data</h1>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
      <!-- Conten -->
      <div class="container-fluid">
        <div class="row">
          <!-- Table Fakultas-->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Daftar Fakultas</h5>
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
                <table id="table_fakultas" class="table table-bordered table-hover">
                  <thead>
                      <tr>
                          <th>Urutan</th>
                          <th>Kode Fakultas</th>
                          <th class="text-center">Nama Fakultas</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <button id="addFak" type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-fakultas"><i class="fas fa-plus"></i> Add</button>
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <!-- Table Jurusan-->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Daftar Jurusan</h5>
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
                  <div class="col-md-4">
                    <div class="form-group">
                      <select name="pilihFakultas" id="pilihFakultas" class="form-control select2" style="width: 100%;">
                        <option value = ''>Pilih Fakultas</option>
                      </select>
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <!-- /.col -->              
                </div>
                <!-- /.row -->
                <table id="table_jurusan" class="table table-bordered table-hover">
                  <thead>
                      <tr>
                          <th>Urutan</th>
                          <th>Kode Jurusan</th>
                          <th class="text-center">Nama Jurusan</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <button id="addJur" type="button" class="btn btn-outline-success"><i class="fas fa-plus"></i> Add</button>
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
                <h5 class="card-title">Daftar Program Studi</h5>
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
                  <div class="col-md-4">
                    <div class="form-group">
                      <select name="pilihJurusan" id="pilihJurusan" class="form-control select2" style="width: 100%;">
                        <option value = ''>Pilih Jurusan</option>
                      </select>
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <!-- /.col -->              
                </div>
                <!-- /.row -->
                <table id="table_prodi" class="table table-bordered table-hover">
                  <thead>
                      <tr>
                          <th>Urutan</th>
                          <th>Kode Prodi</th>
                          <th class="text-center">Nama Program Studi</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <button id="addProdi" type="button" class="btn btn-outline-success"><i class="fas fa-plus"></i> Add</button>
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div> <!-- /.row -->

        
      </div><!--/. container-fluid -->

      <!-- modal Fakultas-->
      <div class="modal fade" id="modal-fakultas">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Fakultas</h4>
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
                <span>Nama Fakultas</span>
                <input class="form-control requiredFak" type="text" id="namaFak" name="namaFak" placeholder="Nama Fakultas">
                <span class="valid-msg" id="namaFakmsg"></span>
              </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-2">
                <span>Urutan</span>
                <input type="number" class="form-control" id="urutFak" name="urutFak" placeholder="Urutan" style="width:85px;">											
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
              <meta name="csrf-token" content="{{ csrf_token() }}">
              <button type="button" class="btn btn-success pull-right" id="saveFak"><i class="fas fa-check"></i> Save</button>
            </div>
          </div><!-- /.modal-content -->          
        </div><!-- /.modal-dialog -->        
      </div><!-- /.modal -->    
      <!-- modal Jurusan-->
      <div class="modal fade" id="modal-jurusan">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Jurusan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-success" style="display: none;"></div>
              <div class="form-group col-md-12">
                <span>Pilih Fakultas</span>
                <div class="clearfix"></div>
                <select name="fakJur" class="requiredJur" id="fakJur">
                  <option value="">Pilih Fakultas</option>
                </select>
                <span class="valid-msg" id="fakJurmsg"></span>
              </div>
              <div class="form-group col-md-4">
                <input class="form-control " type="hidden" id="idJur" name="idJur" visible="false">
              </div> 
              <div class="clearfix"></div>
              <div class="form-group col-md-12">
                <span>Nama Jurusan</span>
                <input class="form-control requiredJur" type="text" id="namaJur" name="namaJur" placeholder="Nama Jurusan">
                <span class="valid-msg" id="namaJurmsg"></span>
              </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-2">
                <span>Urutan</span>
                <input type="number" class="form-control" id="urutJur" name="urutJur" placeholder="Urutan" style="width:85px;">											
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
              <meta name="csrf-token" content="{{ csrf_token() }}">
              <button type="button" class="btn btn-success pull-right" id="saveJur"><i class="fas fa-check"></i> Save</button>
            </div>
          </div><!-- /.modal-content -->          
        </div><!-- /.modal-dialog -->        
      </div><!-- /.modal --> 
      <!-- modal Prodi-->
      <div class="modal fade" id="modal-prodi">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Program Studi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-success" style="display: none;"></div>
              <div class="form-group col-md-12">
                <span>Pilih Fakultas</span>
                <div class="clearfix"></div>
                <select name="fakProdi" class="requiredProdi" id="fakProdi">
                  <option value="">Pilih Fakultas</option>
                </select>
                <span class="valid-msg" id="fakProdimsg"></span>
              </div>
              <div class="form-group col-md-4">
                <input class="form-control " type="hidden" id="idProdi" name="idProdi" visible="false">
              </div> 
              <div class="clearfix"></div>
              <div class="form-group col-md-12">
                <span>Pilih Jurusan</span>
                <div class="clearfix"></div>
                <select name="jurProdi" class="requiredProdi" id="jurProdi">
                  <option value="">Pilih Jurusan</option>
                </select>
                <span class="valid-msg" id="jurProdimsg"></span>
              </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-12">
                <span>Nama Prodi</span>
                <input class="form-control requiredProdi" type="text" id="namaProdi" name="namaProdi" placeholder="Nama Prodi">
                <span class="valid-msg" id="namaProdimsg"></span>
              </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-2">
                <span>Urutan</span>
                <input type="number" class="form-control" id="urutProdi" name="urutProdi" placeholder="Urutan" style="width:85px;">											
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
              <meta name="csrf-token" content="{{ csrf_token() }}">
              <button type="button" class="btn btn-success pull-right" id="saveProdi"><i class="fas fa-check"></i> Save</button>
            </div>
          </div><!-- /.modal-content -->          
        </div><!-- /.modal-dialog -->        
      </div><!-- /.modal -->   
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

  <script src="{{URL::to('../')}}/Scripts/master_data.js"></script>
@stop