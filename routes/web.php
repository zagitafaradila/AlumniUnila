<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/user_manager', 'UserController@user_manager')->name('user_manager');
Route::get('/admin/master_data', 'MasterDataController@index')->name('master_data');
Route::get('/admin/master_mahasiswa', 'MasterMahasiswaController@index')->name('master_mahasiswa');
Route::get('/admin/master_alumni', 'MasterAlumniController@index')->name('master_alumni');
Route::get('/admin/distribusi_alumni', 'DistribusiAlumniController@index')->name('distribusi_alumni');
Route::get('/admin/distribusi_alumni/add/{id}', 'DistribusiAlumniController@indexAdd')->name('distribusi_alumni_add');
Route::get('/admin/distribusi_alumni/edit/{id}', 'DistribusiAlumniController@indexEdit')->name('distribusi_alumni_edit');
Route::get('/alumni/distribusi_alumni/update_status_pekerjaan', 'DistribusiAlumniController@update_status_pekerjaan')->name('update_status_pekerjaan');
Route::get('/alumni/distribusi_alumni/update_status_kompetensi', 'DistribusiAlumniController@update_status_kompetensi')->name('update_status_kompetensi');
Route::get('/admin/questioner_builder', 'KuesionerBuilderController@index')->name('questioner_builder');

Route::get('/admin/master_data/getFakultas', 'MasterDataController@getFakultas')->name('getFakultas');
Route::get('/admin/master_data/comboFakultas', 'MasterDataController@comboFakultas')->name('master.comboFakultas');
Route::post('/admin/master_data/saveFakultas', 'MasterDataController@saveFakultas')->name('saveFakultas');
Route::post('/admin/master_data/activeFakultas', 'MasterDataController@activeFakultas')->name('activeFakultas');

Route::get('/admin/master_data/getJurusan', 'MasterDataController@getJurusan')->name('getJurusan');
Route::get('/admin/master_data/comboJurusan', 'MasterDataController@comboJurusan')->name('master.comboJurusan');
Route::post('/admin/master_data/saveJurusan', 'MasterDataController@saveJurusan')->name('saveJurusan');
Route::post('/admin/master_data/activeJurusan', 'MasterDataController@activeJurusan')->name('activeJurusan');

Route::get('/admin/master_data/getProdi', 'MasterDataController@getProdi')->name('getProdi');
Route::get('/admin/master_data/getProdiClear', 'MasterDataController@getProdiClear')->name('getProdiClear');
Route::post('/admin/master_data/saveProdi', 'MasterDataController@saveProdi')->name('saveProdi');
Route::post('/admin/master_data/activeProdi', 'MasterDataController@activeProdi')->name('activeProdi');

Route::post('/admin/master_data/hapusData', 'MasterDataController@hapusData')->name('master.hapusData');

Route::get('/admin/user/getUser', 'UserController@getUser')->name('getUser');
Route::get('/admin/user/comboFakultas', 'UserController@comboFakultas')->name('user.comboFakultas');
Route::get('/admin/user/comboJurusan', 'UserController@comboJurusan')->name('user.comboJurusan');
Route::get('/admin/user/comboProdi', 'UserController@comboProdi')->name('user.comboProdi');
Route::post('/admin/user/save', 'UserController@save')->name('save');
Route::post('/admin/user/hapusData', 'UserController@hapusData')->name('user.hapusData');

Route::get('/admin/mahasiswa/getMahasiswa', 'MasterMahasiswaController@getMahasiswa')->name('getMahasiswa');
Route::get('/admin/mahasiswa/comboJurusan', 'MasterMahasiswaController@comboJurusan')->name('Mahasiswa.comboJurusan');
Route::get('/admin/mahasiswa/comboProdi', 'MasterMahasiswaController@comboProdi')->name('Mahasiswa.comboProdi');
Route::get('/admin/mahasiswa/comboJurusanModal', 'MasterMahasiswaController@comboJurusanModal')->name('Mahasiswa.comboJurusanModal');
Route::get('/admin/mahasiswa/comboProdiModal', 'MasterMahasiswaController@comboProdiModal')->name('Mahasiswa.comboProdiModal');
Route::post('/admin/mahasiswa/save', 'MasterMahasiswaController@save')->name('save');
Route::post('/admin/mahasiswa/hapusData', 'MasterMahasiswaController@hapusData')->name('Mahasiswa.hapusData');
Route::post('/admin/mahasiswa/hapusDataSelect', 'MasterMahasiswaController@hapusDataSelect')->name('Mahasiswa.hapusDataSelect');

Route::get('/admin/alumni/getAlumni', 'MasterAlumniController@getAlumni')->name('getAlumni');
Route::post('/admin/alumni/save', 'MasterAlumniController@save')->name('save');
Route::post('/admin/alumni/hapusData', 'MasterAlumniController@hapusData')->name('Alumni.hapusData');
Route::post('/admin/alumni/hapusDataSelect', 'MasterAlumniController@hapusDataSelect')->name('Alumni.hapusDataSelect');

Route::get('/admin/distribusi/getListDistribusi', 'DistribusiAlumniController@getListDistribusi')->name('getListDistribusi');
Route::get('/admin/distribusi/getAlumniFree', 'DistribusiAlumniController@getAlumniFree')->name('Distribusi.getAlumniFree');
Route::get('/admin/distribusi/getAlumniSurveyor', 'DistribusiAlumniController@getAlumniSurveyor')->name('Distribusi.getAlumniSurveyor');
Route::post('/admin/distribusi/addSelect', 'DistribusiAlumniController@addSelect')->name('Distribusi.addSelect');
Route::post('/admin/distribusi/removeSelect', 'DistribusiAlumniController@removeSelect')->name('Distribusi.removeSelect');

Route::get('/admin/questioner_builder/getKuesioner', 'KuesionerBuilderController@getKuesioner')->name('getKuesioner');
Route::get('/admin/questioner_builder/getDistribusi', 'KuesionerBuilderController@getDistribusi')->name('questioner.getDistribusi');
Route::get('/admin/questioner_builder/getPertanyaan', 'KuesionerBuilderController@getPertanyaan')->name('getPertanyaan');
Route::get('/admin/questioner_builder/getKategori', 'KuesionerBuilderController@getKategori')->name('getKategori');
Route::get('/admin/questioner_builder/comboKuesioner', 'KuesionerBuilderController@comboKuesioner')->name('comboKuesioner');
Route::get('/admin/questioner_builder/comboTahun', 'KuesionerBuilderController@comboTahun')->name('comboTahun');
Route::get('/admin/questioner_builder/comboKPerusahaan', 'KuesionerBuilderController@comboKPerusahaan')->name('comboKPerusahaan');
Route::get('/admin/questioner_builder/comboKPekerjaan', 'KuesionerBuilderController@comboKPekerjaan')->name('comboKPekerjaan');
Route::get('/admin/questioner_builder/comboKKompetensi', 'KuesionerBuilderController@comboKKompetensi')->name('comboKKompetensi');
Route::get('/admin/questioner_builder/comboKProgramStudi', 'KuesionerBuilderController@comboKProgramStudi')->name('comboKProgramStudi');
Route::get('/admin/questioner_builder/editPertanyaan', 'KuesionerBuilderController@editPertanyaan')->name('editPertanyaan');
Route::post('/admin/questioner_builder/saveKuesioner', 'KuesionerBuilderController@saveKuesioner')->name('saveKuesioner');
Route::post('/admin/questioner_builder/removeKuesioner', 'KuesionerBuilderController@removeKuesioner')->name('removeKuesioner');
Route::post('/admin/questioner_builder/saveDistribusi', 'KuesionerBuilderController@saveDistribusi')->name('saveDistribusi');
Route::post('/admin/questioner_builder/removeDistribusi', 'KuesionerBuilderController@removeDistribusi')->name('removeDistribusi');
Route::post('/admin/questioner_builder/savePertanyaan', 'KuesionerBuilderController@savePertanyaan')->name('savePertanyaan');
Route::post('/admin/questioner_builder/savePertanyaanDetails', 'KuesionerBuilderController@savePertanyaanDetails')->name('savePertanyaanDetails');
Route::post('/admin/questioner_builder/removePertanyaan', 'KuesionerBuilderController@removePertanyaan')->name('removePertanyaan');



Route::get('/alumni/profil', 'ProfilAlumniController@index')->name('profil_alumni');
Route::post('/alumni/profil/save', 'ProfilAlumniController@save')->name('alumni.save_profil');

Route::get('/alumni/riwayat_pendidikan', 'RiwayatPendidikanController@index')->name('riwayat_pendidikan');
Route::get('/alumni/riwayat_pendidikan/getData', 'RiwayatPendidikanController@getData')->name('riwayat_pendidikan.get_data');
Route::post('/alumni/riwayat_pendidikan/save', 'RiwayatPendidikanController@save')->name('riwayat_pendidikan.save');
Route::post('/alumni/riwayat_pendidikan/remove', 'RiwayatPendidikanController@remove')->name('riwayat_pendidikan.remove');

Route::get('/alumni/riwayat_pekerjaan', 'RiwayatPekerjaanController@index')->name('riwayat_pekerjaan');
Route::get('/alumni/riwayat_pekerjaan/getData', 'RiwayatPekerjaanController@getData')->name('riwayat_pekerjaan.get_data');
Route::post('/alumni/riwayat_pekerjaan/save', 'RiwayatPekerjaanController@save')->name('riwayat_pekerjaan.save');
Route::post('/alumni/riwayat_pekerjaan/remove', 'RiwayatPekerjaanController@remove')->name('riwayat_pekerjaan.remove');

Route::get('/alumni/kuesioner_pekerjaan', 'KuesionerPekerjaanController@index')->name('kuesioner_pekerjaan');
Route::post('/alumni/kuesioner_pekerjaan/save', 'KuesionerPekerjaanController@save')->name('kuesioner_pekerjaan.save');
Route::post('/alumni/kuesioner_pekerjaan/remove', 'KuesionerPekerjaanController@remove')->name('kuesioner_pekerjaan.remove');

Route::get('/alumni/kuesioner_kompetensi', 'KuesionerKompetensiController@index')->name('kuesioner_kompetensi');
Route::post('/alumni/kuesioner_kompetensi/save', 'KuesionerKompetensiController@save')->name('kuesioner_kompetensi.save');
Route::post('/alumni/kuesioner_kompetensi/remove', 'KuesionerKompetensiController@remove')->name('kuesioner_kompetensi.remove');


Route::get('/chart/jumlah_alumni', 'ChartController@jumlah_alumni')->name('chart.jumlah_alumni');


