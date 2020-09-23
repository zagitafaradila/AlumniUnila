@extends('adminlte::page')

@section('title', 'Tracer | Profil Alumni')

@section('content_header')
    <h2>Profil Alumni</h2>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
      <!-- Conten -->
      <div class="container-fluid">
        <div class="row">
          <!-- Profil-->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"></h5>
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
                <form method="POST" action="{{ route('alumni.save_profil') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="panel-body">
                    <div class="form-group col-sm-4">
                      <label>Nomor Pokok Mahasiswa</label>
                      <input class="form-control" type="text" id="npm" name="npm" placeholder="Nomor Pokok Mahasiswa" value="{{{$alumni->npm}}}" disabled="disabled">
                    </div>  
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-12">
                      <label>Nama Lengkap & Gelar <span class="isrequired">*</span></label>
                      <input class="form-control" type="text" id="nama" name="nama" placeholder="Nama Lengkap & Gelar" value="{{{$alumni->name}}}" maxlength="30">
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-4">
                      <label>Fakultas <span class="isrequired">*</span></label>
                      <select  id="fakultas" name="fakultas" class="form-control">
                        <option value="">Pilih Fakultas</option>
                      @foreach ($fakultas as $f)
                        <option value="{{{$f['kode']}}}" @if ($f['kode']==$alumni->fak) selected @endif>{{{$f['nama']}}}</option>
                      @endforeach
                      </select>
                    </div> 
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-4">
                      <label>Jurusan <span class="isrequired">*</span></label>
                      <select  id="jurusan" name="jurusan" class="form-control">
                        <option value="">Pilih Jurusan</option>
                      @foreach ($jurusan as $r)
                        <option value="{{{$r['kode']}}}" @if ($r['kode']==$alumni->jur) selected @endif>{{{$r['nama']}}}</option>
                      @endforeach
                      </select>
                    </div> 
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-4">
                      <label>Program Studi</label>
                      <select  id="prodi" name="prodi" class="form-control">
                        <option value="">Pilih Program Studi</option>
                      @foreach ($prodi as $r)
                        <option value="{{{$r['kode']}}}" @if ($r['kode']==$alumni->prodi) selected @endif>{{{$r['nama']}}}</option>
                      @endforeach
                      </select>
                    </div> 	
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-2">
                      <label>Tanggal Wisuda</label>
                      <input class="form-control datepicker" type="text" id="tglwisuda" name="tglwisuda" placeholder="dd-mm-yyyy" value="{{{date('d-m-Y',strtotime($alumni->wisuda))}}}">
                    </div>  
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-4">
                      <label>Tempat Lahir <span class="isrequired">*</span></label>
                      <input class="form-control" type="text" id="tempatlahir" name="tempatlahir" placeholder="Tempat Lahir" value="{{{$alumni->birth_place}}}">
                    </div> 
                    <div class="form-group col-sm-2">
                      <label>Tanggal Lahir <span class="isrequired">*</span></label>
                      <input class="form-control datepicker" type="text" id="tgllahir" name="tgllahir" placeholder="dd-mm-yyyy" value="{{{date('d-m-Y',strtotime($alumni->birthday))}}}">
                    </div>  
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-2">
                      <label>Jenis Kelamin <span class="isrequired">*</span></label>
                      <select class="form-control" id="jk" name="jk">
                        <option value="" @if($alumni->jk=='') selected @endif>Pilih</option>
                        <option value="Laki-Laki" @if($alumni->jk=='Laki-Laki') selected @endif>Laki-Laki</option>
                        <option value="Perempuan" @if($alumni->jk=='Perempuan') selected @endif>Perempuan</option>
                      </select>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-2">
                      <label>Agama <span class="isrequired">*</span></label>
                      <select class="form-control" id="agama" name="agama"value="{{{$alumni->agama}}}">
                        <option value="" @if($alumni->agama=='') selected @endif>Pilih</option>
                        <option value="Islam" @if($alumni->agama=='Islam') selected @endif>Islam</option>
                        <option value="Katholik" @if($alumni->agama=='Katholik') selected @endif>Katholik</option>
                        <option value="Protestan" @if($alumni->agama=='Protestan') selected @endif>Protestan</option>
                        <option value="Hindu" @if($alumni->agama=='Hindu') selected @endif>Hindu</option>
                        <option value="Budha" @if($alumni->agama=='Budha') selected @endif>Budha</option>
                      </select>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-4">
                      <label>No. Telp <span class="isrequired">*</span></label>
                      <input class="form-control" type="text" id="telp" name="telp" placeholder="No. Telp" value="{{{$alumni->telp}}}">
                      <span class="valid-msg"><?php echo $errors->first('telp')?></span>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-4">
                      <label>Email <span class="isrequired">*</span></label>
                      <input class="form-control" type="text" id="email" name="email" placeholder="Email" value="{{{$alumni->email}}}">
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-4">
                      <label>No. WhatsApp</label>
                      <input class="form-control" type="text" id="telp_wa" name="telp_wa" placeholder="No. WhatsApp" value="{{{$alumni->telp_wa}}}">
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-4">
                      <label>Instagram</label>
                      <input class="form-control" type="text" id="instagram" name="instagram" placeholder="Instagram" value="{{{$alumni->instagram}}}">
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-12">
                      <label>Facebook</label>
                      <input class="form-control" type="text" id="fb" name="fb" placeholder="Facebook Link (Contoh : http://facebook.com/IDFacebookAnda" value="{{{$alumni->fb}}}">
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-12">
                      <label>Twitter</label>
                      <input class="form-control" type="text" id="twitter" name="twitter" placeholder="Twitter ID (Contoh: @akunAnda)" value="{{{$alumni->twitter}}}">
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-12">
                      <label>Linkedin</label>
                      <input class="form-control" type="text" id="linkedin" name="linkedin" placeholder="Linkedin" value="{{{$alumni->linkedin}}}">
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-12">
                      <label>Media Sosial Lain</label>
                      <input class="form-control" type="text" id="sosial" name="sosial" placeholder="Pisahkan dengan Koma (,) Contoh : 08123456790 (Line), B98N52 (Pin BB)" value="{{{$alumni->social}}}">
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-4">
                      <label>No. Telp Keluarga Terdekat</label>
                      <input class="form-control" type="text" id="telp2" name="telp2" placeholder="No. Telp Keluarga" value="{{{$alumni->telp_other}}}">
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-12">
                      <label>Alamat <span class="isrequired">*</span></label>
                      <textarea class="form-control" row="3" id="alamat" name="alamat" placeholder="Alamat">{{{$alumni->address}}}</textarea>
                    </div> 
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-3">
                      <label>Foto <span class="isrequired">*</span></label>
                      <div id="imageFoto" class="ratio img-responsive img-circle" style="background-image: url(@if ($alumni->foto) URL::to('../')}}/assets/uploads/profile-images/{{$alumni->foto}}@else URL::to('../')}}/assets/images/default_profile.jpg @endif);"></div>
                      <div class="clearfix"></div>	
                      <input type="file" id="foto" name="foto" value="{{{$alumni->foto}}}" accept="image/*" style="display:none">
                      <center><a class="btn-purple btn" id="btn-browse"><i class="glyphicon glyphicon-picture"></i></span> Browse</a></center>
                    </div> 	
                    <div class="clearfix"></div>						
                    <div class="form-group col-sm-12" style="text-align:center">
                      <input  type="submit" name="submit" value="Save Data"class="btn btn-outline-primary" >
                    </div>                
                  </div>
                </form>
                <!-- /.Form -->
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
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">Tracer.Unila</a>.</strong> All rights
    reserved.
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
  
@stop