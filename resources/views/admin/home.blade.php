@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          
          <!-- Center col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Jumlah Alumni -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Jumlah Alumni
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                    <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>                         
                  </div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>                         
                  </div>  
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Center col -->

          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Lama Tunggu -->
            <div class="card bg-gradient-info">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Lama Tunggu
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas class="chart" id="chart-lama_tunggu" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
              <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">Mail-Orders</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">Online</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">In-Store</div>
                  </div>
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
            <!-- Serapan Kerja -->
            <div class="card bg-gradient-warning">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Serapan Kerja
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn bg-warning btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-warning btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas class="chart" id="chart-serapan_kerja" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->

          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">
            <!-- Ketercapaian Kompetensi -->
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Ketercapaian Kompetensi
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn bg-default btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-default btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas class="chart" id="chart-kompetensi" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- Gajih Alumni -->
            <div class="card bg-gradient-success">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Gajih Alumni
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
@stop

@section('css')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{URL::to('../')}}/assets/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{URL::to('../')}}/assets/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{URL::to('../')}}/assets/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{URL::to('../')}}/assets/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::to('../')}}/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{URL::to('../')}}/assets/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{URL::to('../')}}/assets/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{URL::to('../')}}/assets/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@stop

@section('js')    
    <!-- jQuery -->
    <script src="{{URL::to('../')}}/assets/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{URL::to('../')}}/assets/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{URL::to('../')}}/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="{{URL::to('../')}}/assets/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="{{URL::to('../')}}/assets/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="{{URL::to('../')}}/assets/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{URL::to('../')}}/assets/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{URL::to('../')}}/assets/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{URL::to('../')}}/assets/moment/moment.min.js"></script>
    <script src="{{URL::to('../')}}/assets/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{URL::to('../')}}/assets/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="{{URL::to('../')}}/assets/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{URL::to('../')}}/assets/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{URL::to('../')}}/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{URL::to('../')}}/dist/js/demo.js"></script>


    <script src="{{URL::to('../')}}/Scripts/chart-setting.js"></script>
    <script src="{{URL::to('../')}}/Scripts/chart-kompetensi.js"></script>
    <script src="{{URL::to('../')}}/Scripts/chart-jumlah_alumni.js"></script>
    <script src="{{URL::to('../')}}/Scripts/chart-gajih_alumni.js"></script>
    <script src="{{URL::to('../')}}/Scripts/chart-lama_tunggu.js"></script>
    <script src="{{URL::to('../')}}/Scripts/chart-serapan_kerja.js"></script>
    <script>
      {// Jumlah Alumni
        var label_jumlah_alumni = [<?php 
          foreach($jumlah_alumni_bar as $t){
            echo("'".$t->nama."', ");
          }
        ?>];
        var jumlah_alumni_mengisi = [<?php 
          foreach($jumlah_alumni_bar as $t){
            echo("'".$t->jumlah_mengisi."', ");
          }
        ?>];
        var jumlah_alumni = [<?php 
          foreach($jumlah_alumni_bar as $t){
            echo("'".$t->jumlah_alumni."', ");
          }
        ?>];

        var sudah_mengisi = <?php echo $jumlah_alumni_pie->sudah_mengisi ?>;      
        var belum_mengisi = <?php echo $jumlah_alumni_pie->belum_mengisi ?>;   
        var sedang_mengisi = <?php echo $jumlah_alumni_pie->sedang_mengisi ?>; 
        var belum_registrasi = <?php echo $jumlah_alumni_pie->jumlah_alumni - ($jumlah_alumni_pie->sudah_mengisi + $jumlah_alumni_pie->belum_mengisi + $jumlah_alumni_pie->sedang_mengisi) ?>;
      }

      {// Ketercapaian Kompetensi
        var label_kompetensi = [<?php
          foreach($jumlah_kompetensi as $k){
            echo("'Kode-".$k->kode."',");
          }
        ?>];
        var data_kompetensi_diri = [<?php
          foreach($jumlah_kompetensi as $k){
            echo("'".$k->jawaban_diri."',");
          }
        ?>];
        var data_kompetensi_pt = [<?php
          foreach($jumlah_kompetensi as $k){
            echo("'".$k->jawaban_pt."',");
          }
        ?>];
      }
      
    </script>

@stop