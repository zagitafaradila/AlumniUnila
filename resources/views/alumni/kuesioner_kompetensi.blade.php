@extends('adminlte::page')

@section('title', 'Tracer | Kuesioner Kompetensi')

@section('content_header')
    <h2>Kuesinoer Kompetensi Alumni</h2>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
      <!-- Conten -->
      <div class="container-fluid">
        <div class="row">
          <!-- Profil-->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Data Diri</h5>
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
                      <td>[F1]</td>
                      <td>Nama Lengkap</td>
                      <td>:</td>
                      <td>
                        {{$alumni->name}}
                      </td>
                    </tr>
                    <tr>
                      <td>[F2]</td>
                      <td>NPM</td>
                      <td>:</td>
                      <td>
                        {{$alumni->npm}}
                      </td>
                    </tr>
                    <tr>
                      <td>[F3]</td>
                      <td>Fakultas</td>
                      <td>:</td>
                      <td>
                        {{$alumni->fak}}
                      </td>
                    </tr>
                    <tr>
                      <td>[F4]</td>
                      <td>Jurusan</td>
                      <td>:</td>
                      <td>
                        {{$alumni->jur}}
                      </td>
                    </tr>
                    <tr>
                      <td>[F5]</td>
                      <td>Prodi</td>
                      <td>:</td>
                      <td>
                        {{$alumni->prodi}}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <!-- Kuesioner Baru-->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Kuesioner Kompetensi</h5>
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
                <table class="table table-striped table-hover">
                  <tbody>
                    <tr>
                      <th style="text-align:center; width:5%">No</th>
                      <th style="text-align:center; width:45%">Pertanyaan</th>
                      <th style="text-align:center; width:25%">Ketercapian Diri</th>
                      <th style="text-align:center; width:25%">Kontribusi Perguruan Tinggi</th>
                    </tr>
                    {!!$html_table!!}
                  </tbody>
                </table>
                <div class="form-group col-sm-12" style="text-align:center">
                  <meta name="csrf-token" content="{{ csrf_token() }}">
                  <input id='save' type="submit" name="submit" value="Save Data" class="btn btn-outline-primary" >
                </div>   
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div> <!-- /.row -->

        
      </div><!--/. container-fluid -->

      <!-- modal select Add-->
      <div class="modal fade" id="modal-add-select">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-body" id="modal-body">
              <p id="modal-text"></p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              <button type="button" class="btn btn-success"  id="konfirmAddSelect">Ya</button>
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
    <strong>Copyright &copy; 2020 <a href="http://adminlte.io">Tracer.Unila</a>.</strong>
@stop

@section('css')
    <style>
      .valid-msg{
        font-size:12px;
        color:red;
      }
      .isrequired{
        font-size:12px;
        color:red;
      }
    </style>
@stop

@section('js')   
  <script src="{{URL::to('../')}}/Scripts/kuesioner_kompetensi.js"></script
  
@stop