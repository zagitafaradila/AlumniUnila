@extends('adminlte::page')

@section('title', 'Tracer | Questioner Builder')

@section('content_header')
    <h1>Questioner Builder</h1>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
      <!-- Conten -->
      <div class="container-fluid">
        <div class="row">
          @if(Auth::user()->access == "Administrator")
            <!-- Table Kuesioner-->
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Daftar Kuesioner</h5>
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
                  <table id="table_kuesioner" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                          <th>Kode</th>
                          <th>Nama Kuesioner</th>
                          <th>Kategori</th>
                          <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <button id="addKuesioner" type="button" class="btn btn-outline-success"><i class="fas fa-plus"></i> Add</button>
                </div>
                <!-- ./card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
            <!-- Table Distribusi Kuesioner-->
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Distribusi Kuesioner</h5>
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
                  <table id="table_distribusi" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                          <th>Angkatan</th>
                          <th>Kuesioner Perusahaan</th>
                          <th>Kuesioner Pekerjaan</th>						
                          <th>Kuesioner Kompetensi</th>				
                          <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <button id="addDistribusi" type="button" class="btn btn-outline-success"><i class="fas fa-plus"></i> Add</button>
                </div>
                <!-- ./card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          @endif
          @if(Auth::user()->access == "Kepala Program Studi")
            <!-- Table Kuesioner Prodi-->
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Daftar Kuesioner Khusus Program Studi</h5>
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
                  <table id="table_kuesionerPS" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                          <th>Kode</th>
                          <th>Nama Kuesioner</th>
                          <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <button id="addKuesioner" type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-fakultas"><i class="fas fa-plus"></i> Add</button>
                </div>
                <!-- ./card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
            <!-- Table Distribusi Kuesioner Prodi-->
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Distribusi Kuesioner Khusus Program Studi</h5>
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
                  <table id="table_distribusiPS" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                          <th>Angkatan</th>
                          <th>Kuesioner Program Studi</th>
                          <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <button id="addDistribusi" type="button" class="btn btn-outline-success"><i class="fas fa-plus"></i> Add</button>
                </div>
                <!-- ./card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          @endif
          <!-- Table Daftar Pertanyaan-->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Daftar Pertanyaan</h5>
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
                      <select name="pilihKuesioner" id="pilihKuesioner" class="form-control select2" style="width: 100%;">
                        <option value = ''>Pilih Kuesioner</option>
                      </select>
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <!-- /.col -->              
                </div>
                <!-- /.row -->
                <table id="table_pertanyaan" class="table table-bordered table-hover">
                  <thead>
                      <tr>
                          <th>Kode/Nomor</th>
                          <th>Pertanyaan</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <button id="addPertanyaan" type="button" class="btn btn-outline-success"><i class="fas fa-plus"></i> Add</button>
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div> <!-- /.row -->        
      </div><!--/. container-fluid -->

      <!-- Modal Kuesioner -->
      <div class="modal fade" id="modal-kuesioner">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Data Kuesioner</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-success" style="display: none;"></div>
              <div class="form-group col-md-4">
                <span>Kode Kuesioner</span>
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <input class="form-control" type="hidden" id="idKuesioner" name="idKuesioner">
                <input class="form-control requiredKuesioner" type="text" id="kodeKuesioner" name="kodeKuesioner" placeholder="Kode Kuesioner">
                <span class="valid-msg" id="kodeKuesionermsg"></span>
              </div>
              <div class="clearfix"></div>
              <div class="form-group col-md-12">
                <span>Nama </span>
                <input class="form-control requiredKuesioner" type="text" id="namaKuesioner" name="namaKuesioner" placeholder="Nama">
                <span class="valid-msg" id="namaKuesionermsg"></span>
              </div>
              @if(Auth::user()->access == 'Administrator')
                <div class="clearfix"></div>
                <div class="form-group col-md-12">
                  <span>Kategori</span>
                  <div class="clearfix"></div>
                  <select name="pilihKategori" id="pilihKategori" class="form-control requiredKuesioner">
                    <option value="">Pilih</option>
                    <option value="Perusahaan">Perusahaan</option>
                    <option value="Pekerjaan">Pekerjaan</option>
                    <option value="Kompetensi">Kompetensi</option>
                  </select>
                  <span class="valid-msg" id="pilihKategorimsg"></span>
                </div>
              @endif
              <div class="clearfix"></div>
            </div>
            <div class="modal-footer ">
              <button type="button" class="btn btn-success pull-right" id="saveKuesioner"><i class="fas fa-check"></i> Save</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Distribusi -->
      <div class="modal fade" id="modal-distribusi">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Distribusi Kuesioner</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-success" style="display: none;"></div>
              <div class="form-group col-md-12">
                <span>Tahun</span>
                <div class="clearfix"></div>
                <select name="pilihTahun" id="pilihTahun" class="form-control requiredDistribution">
                </select>
                <span class="valid-msg" id="pilihTahunmsg"></span>
              </div>
              @if(Auth::user()->access == 'Administrator')
                <div class="clearfix"></div>
                <div class="form-group col-md-12">
                  <span>Kuesioner Perusahaan</span>
                  <div class="clearfix"></div>
                  <select name="pilihKPerusahaan" id="pilihKPerusahaan" class="form-control requiredDistribution">
                  </select>
                  <span class="valid-msg" id="pilihKPerusahaanmsg"></span>
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-md-12">
                  <span>Kuesioner Pekerjaan</span>
                  <div class="clearfix"></div>
                  <select name="pilihKPekerjaan" id="pilihKPekerjaan" class="form-control requiredDistribution">
                  </select>
                  <span class="valid-msg" id="pilihKPekerjaanmsg"></span>
                </div>
                <div class="clearfix"></div>					
                <div class="form-group col-md-12">
                  <span>Kuesioner Kompetensi</span>
                  <div class="clearfix"></div>
                  <select name="pilihKKompetensi" id="pilihKKompetensi" class="form-control requiredDistribution">
                  </select>
                  <span class="valid-msg" id="pilihKKompetensimsg"></span>
                </div>
              @endif
              @if(Auth::user()->access == 'Kepala Program Studi')
                <div class="clearfix"></div>
                <div class="form-group col-md-12">
                  <span>Kuesioner Khusus Program Studi</span>
                  <div class="clearfix"></div>
                  <select name="pilihKProgramStudi" id="pilihKProgramStudi" class="form-control requiredDistribution">
                  </select>
                  <span class="valid-msg" id="pilihKProgramStudimsg"></span>
                </div>
              @endif
              <div class="clearfix"></div>
            </div>
            <div class="modal-footer ">
              <button type="button" class="btn btn-success pull-right" id="saveDistribusi"><i class="fas fa-check"></i> Save</button>
            </div>
          </div>
        </div>
      </div>
	
      <!-- Modal Pertanyaan -->
      <div class="modal fade" id="modal-pertanyaan">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Data Pertanyaan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-success" style="display: none;"></div>
              <div class="col-md-2">
                <span>Kode/Nomor Urut</span>
              </div>
              <div class="col-md-2">
                <input class="form-control" type="hidden" id="QuesID">
                <input class="form-control requiredPertanyaan" type="text" id="QuesKode" name="QuesKode" placeholder="Kode/Nomor Urut">
                <span class="valid-msg" id="QuesKodemsg"></span>
              </div>
              <div class="clearfix"></div>
              <div class="col-md-2 QuesLevel-form">
                <span>Level Jawaban</span>
              </div>
              <div class="col-md-2 QuesLevel-form">
                <select class="form-control requiredPertanyaan" name="QuesLevel" id="QuesLevel">
                  <option value="">Pilih</option>
                  <option value="Wajib">Wajib</option>
                  <option value="Opsional">Opsional</option>
                </select>
                <span class="valid-msg" id="QuesLevelmsg"></span>
              </div>
              <div class="clearfix"></div>
              <div class="col-md-2">
                <span>Pertanyaan</span>
              </div>
              <div class="col-md-12">
                <input class="form-control requiredPertanyaan" type="text" id="QuesPertanyaan" name="QuesPertanyaan" placeholder="Pertanyaan">
                <span class="valid-msg" id="QuesPertanyaanmsg"></span>
              </div>
              <div class="clearfix"></div>
              <div class="col-md-2">
                <span>Teks Bantuan</span>
              </div>
              <div class="col-md-12">
                <input class="form-control" type="text" id="QuesBantuan" name="QuesBantuan" placeholder="Teks Bantuan">
              </div>
              <div class="clearfix"></div>
              <div class="col-md-2">
                <span>Jenis Jawaban</span>
              </div>
              <div class="col-md-4">
                <select class="form-control requiredPertanyaan" name="QuesJenis" id="QuesJenis">
                  <option value="">Pilih</option>
                  <option value="Radio">Radio</option>
                  <option value="Checkbox">Checkbox</option>
                  <option value="Combobox">Combobox</option>
                  <option value="Text">Text</option>
                  <option value="Textarea">Textarea</option>
                </select>
                <span class="valid-msg" id="QuesJenismsg"></span>
              </div>
              <div class="clearfix"></div>
              <div class="col-md-2">
                <span id="QuesTextJenis">Pilihan Jawaban</span>
              </div>
              <div class="col-md-12">
              
              <div class="table-responsive">   		
                <table id="QuesTable" border="0">
                  <tbody>
                  </tbody>
                </table>
                <button id="QuesTableAdd" class="btn btn-block btn-primary btn-xs col-md-1" title="Add">
                    <span class="fas fa-plus"></span> Add Row
                </button>
              </div>
              
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="modal-footer ">
              <button type="button" class="btn btn-success pull-right" id="savePertanyaan"><i class="fas fa-check"></i> Save</button>
            </div>
          </div>
        </div>
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

  <script src="{{URL::to('../')}}/Scripts/questioner_builder.js"></script>
@stop