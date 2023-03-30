<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePengaduanRequest;
use App\Http\Requests\UpdatePengaduanRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\logPengaduan;
use App\Repositories\PengaduanRepository;
use Illuminate\Http\Request;
use app\Models\Pengaduan;
use App\Models\Prelist;
use App\Models\wilayah;
use Illuminate\Support\Facades\DB;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class PengaduanController extends AppBaseController
{
    /** @var PengaduanRepository $pengaduanRepository*/
    private $pengaduanRepository;

    public function __construct(PengaduanRepository $pengaduanRepo)
    {
        $this->pengaduanRepository = $pengaduanRepo;
    }

    /**
     * Display a listing of the Pengaduan.
     */


    public function index(Request $request)
    {

        return view('pengaduans.index');
    }

    /**
     * Show the form for creating a new Pengaduan.
     */
    public function create()
    {
        $v = Pengaduan::latest()->first();
        // dd($v);
        $userid = Auth::user()->id;
        $wilayah = DB::table('wilayahs as w')->select(
            'w.*',
            'b.*',
            'prov.*',
            'kota.*',
            'kecamatan.*'
        )
            ->leftjoin('indonesia_provinces as prov', 'prov.code', '=', 'w.province_id')
            ->leftjoin('indonesia_cities as kota', 'kota.code', '=', 'w.kota_id')
            ->leftjoin('indonesia_districts as kecamatan', 'kecamatan.code', '=', 'w.kecamatan_id')
            ->leftjoin('indonesia_villages as b', 'b.code', '=', 'w.kelurahan_id')
            ->where('status_wilayah', '1')
            ->where('w.createdby', $userid)->get();

        // $alur = DB::table('alur')
        //     ->where('name', 'Draft')
        //     // ->where('name', 'supervisor')
        //     ->orWhere('name', 'Teruskan')
        //     ->get();
        $user = Auth::user();
        $roles = $user->roles()->pluck('name');
        if ($roles->contains('Back Ofiice kelurahan') || $roles->contains('supervisor')) {
            // Do something
            $alur = DB::table('alur')
                ->whereIn('name', ['Kembalikan', 'Tolak', 'Teruskan'])
                ->get();
        } else {
            // Do something else
            $alur = DB::table('alur')
                ->where('name', ['Dratft', 'Teruskan'])
                ->get();
        }


        $roleid = DB::table('roles')
            ->where('name', 'Back Ofiice kelurahan')
            // ->where('name', 'supervisor')
            ->orWhere('name', 'supervisor')
            ->get();

        // $user = Auth::user();
        // $roles = $user->roles()->pluck('name');
        // if ($roles->contains('Back Office kelurahan') || $roles->contains('supervisor')) {
        //     $pengaduan = DB::table('pengaduans')
        //         ->select('id', 'judul', 'createdby')
        //         ->get();
        // } else {
        //     $roleid = DB::table('roles')
        //         ->where('name', 'Back Office kelurahan')
        //         ->get();
        // }

        $createdby = DB::table('pengaduans')
            ->where('createdby', 'FO-Kelurahan')->get();
        $rolebackoffice = DB::table('roles')
            ->where('name', 'Back Ofiice kelurahan')
            // ->where('name', 'supervisor')
            // ->orWhere('name', 'supervisor')
            ->get();
        $checkroles = DB::table('model_has_roles')
            ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('model_id', '=', $userid)
            ->get();
        // $checkroles = DB::table('model_has_roles')->where('model_id','=', $userid);
        // dd($alur);
        return view('pengaduans.create', compact('wilayah', 'roleid', 'checkroles', 'rolebackoffice', 'alur', 'createdby'));
    }

    /**
     * Store a newly created Pengaduan in storage.
     */
    public function store(Request $request)
    {

        if ($request->get('nik') != null) {
            if ($request->get('no_dtks') != null) {
                //nik dan dtks ada
                $data = new Pengaduan;
                $data['id_alur'] = $request->get('id_alur');
                $data['no_pendaftaran'] = mt_rand(100, 1000);
                $data['id_provinsi'] = $request->get('id_provinsi');
                $data['id_kabkot'] = $request->get('id_kabkot');
                $data['id_kecamatan'] = $request->get('id_kecamatan');
                $data['id_kelurahan'] = $request->get('id_kelurahan');
                $data['jenis_pelapor'] = $request->get('jenis_pelapor');
                $data['ada_nik'] = $request->get('memiliki_nik');
                $data['nik'] = $request->get('nik');
                $data['no_kk'] = $request->get('no_kk');
                // $data['no_kis'] = $request->get('no_kis');
                $data['nama'] = $request->get('nama');
                $data['tgl_lahir'] = $request->get('tgl_lahir');
                $data['tempat_lahir'] = $request->get('tempat_lahir');
                // $data['alamat'] = $request->get('alamat');
                $data['telp'] = $request->get('telpon');
                $data['email'] = $request->get('email');
                $data['hubungan_terlapor'] = $request->get('hubungan_terlapor');
                $data['id_program_sosial'] = $request->get('id_program_sosial');
                $data['kepesertaan_program'] = $request->get('kepesertaan_program');
                $data['no_peserta'] = $request->get('no_peserta');
                $data['level_program'] = $request->get('level_program');
                $data['sektor_program'] = $request->get('sektor_program');
                $data['no_kartu_program'] = $request->get('no_kartu_program');
                $data['ringkasan_pengaduan']  = $request->get('ringkasan_pengaduan');
                $data['detail_pengaduan']  = $request->get('detail_pengaduan');
                // $data['tl_file']  = $request->get('detail_pengaduan');
                $data['no_dtks'] = $request->get('no_dtks');
                $data['tujuan'] = $request->get('tujuan');
                $data['status_aksi'] = $request->get('status_aksi');
                $data['petugas'] = $request->get('petugas');
                $data['createdby'] = Auth::user()->name;
                $data['updatedby'] = Auth::user()->name;
                // dd($data);
                $data->save();
                $logpengaduan = new logPengaduan;
                $logpengaduan['id_trx_pengaduan'] = $data->id;
                $logpengaduan['id_alur'] = $request->get('status_aksi');
                $logpengaduan['petugas'] = $request->get('petugas');
                $logpengaduan['catatan']  = $request->get('tl_catatan');
                $logpengaduan['file_pendukung'] = $request->get('file_pendukung');
                $logpengaduan['tujuan'] = $request->get('tujuan');
                $logpengaduan['created_by'] = Auth::user()->name;
                $logpengaduan['updated_by'] = Auth::user()->name;

                $logpengaduan->save();
                // dd($logpengaduan);
                return redirect('pengaduans')->withSuccess('Data Berhasil Disimpan');
            } else {
                //nik ada, dtks tidak

                //cek apakah sudah ada
                $cek = Prelist::where('nik', '=', $request->get('nik'))->exists();
                if (!$cek) {
                    $data = new Prelist;
                    $data['id_provinsi'] = $request->get('id_provinsi');
                    $data['id_kabkot'] = $request->get('id_kabkot');
                    $data['id_kecamatan'] = $request->get('id_kecamatan');
                    $data['id_kelurahan'] = $request->get('id_kelurahan');
                    $data['nik'] = $request->get('nik');
                    $data['no_kk'] = $request->get('no_kk');
                    // $data['no_kis'] = $request->get('no_kis');
                    $data['nama'] = $request->get('nama');
                    $data['tgl_lahir'] = $request->get('tgl_lahir');
                    // $data['alamat'] = $request->get('alamat');
                    $data['telp'] = $request->get('telpon');
                    $data['email'] = $request->get('email');
                    $data['status_data'] = 'prelistdtks';

                    $data->save();
                }
                $data = new Pengaduan;
                $data['id_alur'] = $request->get('id_alur');
                $data['no_pendaftaran'] = mt_rand(100, 1000);
                $data['id_provinsi'] = $request->get('id_provinsi');
                $data['id_kabkot'] = $request->get('id_kabkot');
                $data['id_kecamatan'] = $request->get('id_kecamatan');
                $data['id_kelurahan'] = $request->get('id_kelurahan');
                $data['jenis_pelapor'] = $request->get('jenis_pelapor');
                $data['ada_nik'] = $request->get('memiliki_nik');
                $data['nik'] = $request->get('nik');
                $data['no_kk'] = $request->get('no_kk');
                // $data['no_kis'] = $request->get('no_kis');
                $data['nama'] = $request->get('nama');
                $data['tgl_lahir'] = $request->get('tgl_lahir');
                $data['tempat_lahir'] = $request->get('tempat_lahir');
                // $data['alamat'] = $request->get('alamat');
                $data['telp'] = $request->get('telpon');
                $data['email'] = $request->get('email');
                $data['hubungan_terlapor'] = $request->get('hubungan_terlapor');
                $data['id_program_sosial'] = $request->get('id_program_sosial');
                $data['kepesertaan_program'] = $request->get('kepesertaan_program');
                $data['no_peserta'] = $request->get('no_peserta');
                $data['level_program'] = $request->get('level_program');
                $data['sektor_program'] = $request->get('sektor_program');
                $data['no_kartu_program'] = $request->get('no_kartu_program');
                $data['ringkasan_pengaduan']  = $request->get('ringkasan_pengaduan');
                $data['detail_pengaduan']  = $request->get('detail_pengaduan');
                // $data['tl_file']  = $request->get('detail_pengaduan');
                $data['no_dtks'] = $request->get('no_dtks');
                $data['tujuan'] = $request->get('tujuan');
                $data['status_aksi'] = $request->get('status_aksi');
                $data['createdby'] = Auth::user()->name;
                $data['updatedby'] = Auth::user()->name;
                // dd($data);
                $data->save();
                $logpengaduan = new logPengaduan;
                $logpengaduan['id_trx_pengaduan'] = $data->id;
                $logpengaduan['id_alur'] = $request->get('status_aksi');
                $logpengaduan['petugas'] = Auth::user()->name;
                $logpengaduan['catatan']  = $request->get('tl_catatan');
                $logpengaduan['file_pendukung'] = $request->get('file_pendukung');
                $logpengaduan['tujuan'] = $request->get('tujuan');
                $logpengaduan['created_by'] = Auth::user()->name;
                $logpengaduan['updated_by'] = Auth::user()->name;

                $logpengaduan->save();
                return redirect('pengaduans')->withSuccess('Data Berhasil Disimpan');
            }
        } else {
            //nik belum ada
            $data = new Pengaduan;
            $data['id_alur'] = $request->get('id_alur');
            $data['no_pendaftaran'] = mt_rand(100, 1000);
            $data['id_provinsi'] = $request->get('id_provinsi');
            $data['id_kabkot'] = $request->get('id_kabkot');
            $data['id_kecamatan'] = $request->get('id_kecamatan');
            $data['id_kelurahan'] = $request->get('id_kelurahan');
            $data['jenis_pelapor'] = $request->get('jenis_pelapor');
            $data['ada_nik'] = $request->get('memiliki_nik');
            $data['nik'] = $request->get('nik');
            $data['no_kk'] = $request->get('no_kk');
            // $data['no_kis'] = $request->get('no_kis');
            $data['nama'] = $request->get('nama');
            $data['tgl_lahir'] = $request->get('tgl_lahir');
            $data['tempat_lahir'] = $request->get('tempat_lahir');
            // $data['alamat'] = $request->get('alamat');
            $data['telp'] = $request->get('telpon');
            $data['email'] = $request->get('email');
            $data['hubungan_terlapor'] = $request->get('hubungan_terlapor');
            $data['id_program_sosial'] = $request->get('id_program_sosial');
            $data['kepesertaan_program'] = $request->get('kepesertaan_program');
            $data['no_peserta'] = $request->get('no_peserta');
            $data['level_program'] = $request->get('level_program');
            $data['sektor_program'] = $request->get('sektor_program');
            $data['no_kartu_program'] = $request->get('no_kartu_program');
            $data['ringkasan_pengaduan']  = $request->get('ringkasan_pengaduan');
            $data['detail_pengaduan']  = $request->get('detail_pengaduan');
            // $data['tl_file']  = $request->get('detail_pengaduan');
            $data['no_dtks'] = $request->get('no_dtks');
            $data['tujuan'] = $request->get('tujuan');
            $data['status_aksi'] = $request->get('status_aksi');
            $data['createdby'] = Auth::user()->name;
            $data['updatedby'] = Auth::user()->name;
            $data->save();
            return redirect('pengaduans')->withWarning('NIK Tidak Tersedia Data Disimpan sebagai draft');
        }
        // dd($data); 
    }

    /**
     * Display the specified Pengaduan.
     */
    public function show($id)
    {
        $userid = Auth::user()->id;
        $pengaduan = $this->pengaduanRepository->find((int) $id);
        $wilayah = DB::table('wilayahs as w')->select(
            'w.*',
            'b.*',
            'prov.*',
            'kota.*',
            'kecamatan.*'
        )
            ->leftjoin('indonesia_provinces as prov', 'prov.code', '=', 'w.province_id')
            ->leftjoin('indonesia_cities as kota', 'kota.code', '=', 'w.kota_id')
            ->leftjoin('indonesia_districts as kecamatan', 'kecamatan.code', '=', 'w.kecamatan_id')
            ->leftjoin('indonesia_villages as b', 'b.code', '=', 'w.kelurahan_id')
            ->where('status_wilayah', '1')
            ->where('w.createdby', $userid)->get();

        if (empty($pengaduan)) {
            Flash::error('Pengaduan not found');

            return redirect(route('pengaduans.index'));
        }
        $roleid = DB::table('roles')
            ->where('name', 'Back Ofiice kelurahan')
            // ->where('name', 'supervisor')
            ->orWhere('name', 'supervisor')
            ->get();
        $checkroles = DB::table('model_has_roles')
            ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->get();
        // dd($checkroles);
        return view('pengaduans.show', compact('pengaduan', 'roleid', 'wilayah', 'checkroles'));
    }

    /**
     * Show the form for editing the specified Pengaduan.
     */
    public function edit($id)
    {
        $userid = Auth::user()->id;
        $wilayah = DB::table('wilayahs as w')->select(
            'w.id',
            'b.*',
            'w.*',
            'prov.*',
            'kota.*',
            'kecamatan.*',
            'w.status_wilayah',
            'w.createdby',
        )
            ->leftjoin('indonesia_provinces as prov', 'prov.code', '=', 'w.province_id')
            ->leftjoin('indonesia_cities as kota', 'kota.code', '=', 'w.kota_id')
            ->leftjoin('indonesia_districts as kecamatan', 'kecamatan.code', '=', 'w.kecamatan_id')
            ->leftjoin('indonesia_villages as b', 'b.code', '=', 'w.kelurahan_id')
            ->where('status_wilayah', '1')
            ->where('w.createdby', $userid)->get();

            
        $checkuserrole = DB::table('model_has_roles')
            ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('model_id', '=', $userid)
            ->first();

        //Tujuan
        $createdby = DB::table('pengaduans')
        ->join('users', 'pengaduans.createdby', '=', 'users.name')
        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->select('pengaduans.id','pengaduans.createdby', 'roles.name')
        ->get();
        //Petugas
        // $createdby = DB::table('pengaduans')
        // ->join('users', 'pengaduans.createdby', '=', 'users.name')
        // ->join('model_has_roles', 'users.id', '=', 'model_has_roles.role_id')
        // ->select('pengaduans.*', 'users.*', 'model_has_roles.*')
        // ->get();


        $roleid = null;
        if ($checkuserrole->name == 'fasilitator') {
            $roleid = DB::table('roles')
                ->where('name', 'Back Ofiice kelurahan')
                // ->where('name', 'supervisor')
                ->orWhere('name', 'supervisor')
                ->get();
        } else if ($checkuserrole->name == 'Back Ofiice kelurahan') {
            $roleid = DB::table('roles')
                ->where('name', 'Front Office Kelurahan')
                ->get();
        } else if ($checkuserrole->name == 'Front Office Kelurahan') {
            $roleid = DB::table('roles')
                ->where('name', 'Back Ofiice kelurahan')
                // ->where('name', 'supervisor')
                ->orWhere('name', 'supervisor')
                ->get();
        }
        $pengaduans = Pengaduan::where('createdby', $userid)->get();
        $getdata = DB::table('model_has_roles')
            ->leftjoin('pengaduans as b', 'b.tujuan', '=', 'model_has_roles.role_id')
            ->where('b.id', $id)
            ->get();
        //alur
        if ($checkuserrole->name == 'fasilitator') {
            $alur = DB::table('alur')
                ->where('name', 'Draft')
                // ->where('name', 'supervisor')
                ->orWhere('name', 'Teruskan')
                ->get();
        } else if ($checkuserrole->name == 'Back Ofiice kelurahan') {
            $alur = DB::table('alur')
                ->where('name', 'Kembalikan')
                // ->where('name', 'supervisor')
                ->orWhere('name', 'Tolak')
                ->orWhere('name', 'Selesai')
                ->get();
        } else if ($checkuserrole->name == 'Front Office kota') {
            $alur = DB::table('alur')
                ->where('name', 'Kembalikan')
                // ->where('name', 'supervisor')
                ->orWhere('name', 'Tolak')
                ->orWhere('name', 'Selesai')
                ->get();
        } else if ($checkuserrole->name == 'Front Office Kelurahan') {
            $alur = DB::table('alur')
                ->where('name', 'Kembalikan')
                // ->where('name', 'supervisor')
                ->orWhere('name', 'Tolak')
                ->orWhere('name', 'Selesai')
                ->get();
        }

        $checkroles = DB::table('model_has_roles')
            ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('model_id', '=', $userid)
            ->get();



        $rolebackoffice = DB::table('roles')
            ->where('name', 'Back Ofiice kelurahan')
            // ->where('name', 'supervisor')
            // ->orWhere('name', 'supervisor')
            ->get();
        $pengaduan = $this->pengaduanRepository->find($id);
        return view('pengaduans.edit', compact('wilayah', 'pengaduan', 'roleid', 'getdata', 'alur', 'checkroles', 'rolebackoffice', 'createdby'));
    }

    /**
     * Update the specified Pengaduan in storage.
     */
    public function update(Request $request, $id)
    {
        // $pengaduan = Pengaduan::find($id);
        if ($request->get('nik') != null) {
            if ($request->get('no_dtks') != null) {

                // dd($pengaduan);
                $pengaduan['id_alur'] = $request->get('id_alur');
                $pengaduan['no_pendaftaran'] = mt_rand(100, 1000);
                $pengaduan['id_provinsi'] = $request->get('id_provinsi');
                $pengaduan['id_kabkot'] = $request->get('id_kabkot');
                $pengaduan['id_kecamatan'] = $request->get('id_kecamatan');
                $pengaduan['id_kelurahan'] = $request->get('id_kelurahan');
                $pengaduan['jenis_pelapor'] = $request->get('jenis_pelapor');
                $pengaduan['ada_nik'] = $request->get('memiliki_nik');
                $pengaduan['nik'] = $request->get('nik');
                $pengaduan['no_kk'] = $request->get('no_kk');
                $pengaduan['no_kis'] = $request->get('no_kis');
                $pengaduan['nama'] = $request->get('nama');
                $pengaduan['tgl_lahir'] = $request->get('tgl_lahir');
                $pengaduan['tempat_lahir'] = $request->get('tempat_lahir');
                $pengaduan['alamat'] = $request->get('alamat');
                $pengaduan['telp'] = $request->get('telpon');
                $pengaduan['email'] = $request->get('email');
                $pengaduan['hubungan_terlapor'] = $request->get('hubungan_terlapor');
                $pengaduan['id_program_sosial'] = $request->get('id_program_sosial');
                $pengaduan['kepesertaan_program'] = $request->get('kepesertaan_program');
                $pengaduan['no_peserta'] = $request->get('no_peserta');
                $pengaduan['level_program'] = $request->get('level_program');
                $pengaduan['sektor_program'] = $request->get('sektor_program');
                $pengaduan['no_kartu_program'] = $request->get('no_kartu_program');
                $pengaduan['ringkasan_pengaduan']  = $request->get('ringkasan_pengaduan');
                $pengaduan['detail_pengaduan']  = $request->get('detail_pengaduan');
                // $pengaduan['tl_file']  = $request->get('detail_pengaduan');
                $pengaduan['no_dtks'] = $request->get('no_dtks');
                $pengaduan['tujuan'] = $request->get('tujuan');
                $pengaduan['status_aksi'] = $request->get('status_aksi');
                $pengaduan['createdby'] = Auth::user()->name;
                $pengaduan['updatedby'] = Auth::user()->name;


                // dd($pengaduan);
                Pengaduan::where('id', $id)->update($pengaduan);

                return redirect('pengaduans')->withSuccess('pengaduan Berhasil Diubah');
            } else {
                $cek = Prelist::where('nik', '=', $request->get('nik'))->exists();
                if ($cek) {
                    return redirect('pengaduans')->withWarning('NIK Sudah Terdaftar Di Prelist');
                } else {

                    $pengaduan['id_provinsi'] = $request->get('id_provinsi');
                    $pengaduan['id_kabkot'] = $request->get('id_kabkot');
                    $pengaduan['id_kecamatan'] = $request->get('id_kecamatan');
                    $pengaduan['id_kelurahan'] = $request->get('id_kelurahan');
                    $pengaduan['nik'] = $request->get('nik');
                    $pengaduan['no_kk'] = $request->get('no_kk');
                    $pengaduan['no_kis'] = $request->get('no_kis');
                    $pengaduan['nama'] = $request->get('nama');
                    $pengaduan['tgl_lahir'] = $request->get('tgl_lahir');
                    $pengaduan['alamat'] = $request->get('alamat');
                    $pengaduan['telp'] = $request->get('telpon');
                    $pengaduan['email'] = $request->get('email');
                    $pengaduan['status_pengaduan'] = 'prelistdtks';

                    Prelist::where('id', $id)->update($pengaduan);
                    return redirect('pengaduans')->withSuccess('pengaduan Berhasil Disimpan Di Prelist');
                }
            }
        } else {

            // dd($pengaduan);
            $pengaduan['id_alur'] = $request->get('id_alur');
            $pengaduan['no_pendaftaran'] = mt_rand(100, 1000);
            $pengaduan['id_provinsi'] = $request->get('id_provinsi');
            $pengaduan['id_kabkot'] = $request->get('id_kabkot');
            $pengaduan['id_kecamatan'] = $request->get('id_kecamatan');
            $pengaduan['id_kelurahan'] = $request->get('id_kelurahan');
            $pengaduan['jenis_pelapor'] = $request->get('jenis_pelapor');
            $pengaduan['ada_nik'] = $request->get('memiliki_nik');
            $pengaduan['nik'] = $request->get('nik');
            $pengaduan['no_kk'] = $request->get('no_kk');
            $pengaduan['no_kis'] = $request->get('no_kis');
            $pengaduan['nama'] = $request->get('nama');
            $pengaduan['tgl_lahir'] = $request->get('tgl_lahir');
            $pengaduan['tempat_lahir'] = $request->get('tempat_lahir');
            $pengaduan['alamat'] = $request->get('alamat');
            $pengaduan['telp'] = $request->get('telpon');
            $pengaduan['email'] = $request->get('email');
            $pengaduan['hubungan_terlapor'] = $request->get('hubungan_terlapor');
            $pengaduan['id_program_sosial'] = $request->get('id_program_sosial');
            $pengaduan['kepesertaan_program'] = $request->get('kepesertaan_program');
            $pengaduan['no_peserta'] = $request->get('no_peserta');
            $pengaduan['level_program'] = $request->get('level_program');
            $pengaduan['sektor_program'] = $request->get('sektor_program');
            $pengaduan['no_kartu_program'] = $request->get('no_kartu_program');
            $pengaduan['ringkasan_pengaduan']  = $request->get('ringkasan_pengaduan');
            $pengaduan['detail_pengaduan']  = $request->get('detail_pengaduan');
            // $pengaduan['tl_file']  = $request->get('detail_pengaduan');
            $pengaduan['no_dtks'] = $request->get('no_dtks');
            $pengaduan['tujuan'] = $request->get('tujuan');
            $pengaduan['status_aksi'] = $request->get('status_aksi');
            $pengaduan['createdby'] = Auth::user()->name;
            $pengaduan['updatedby'] = Auth::user()->name;
            // dd($pengaduan);

            Pengaduan::where('id', $id)->update($pengaduan);

            return redirect('pengaduans')->withSuccess('Data Berhasil Diubah');
        }
    }

    /**
     * Remove the specified Pengaduan from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pengaduan = $this->pengaduanRepository->find($id);

        if (empty($pengaduan)) {
            Flash::error('Pengaduan not found');

            return redirect('pengaduans')->withSuccess('Data Berhasil Dihapus');
        }

        $this->pengaduanRepository->delete($id);

        Flash::success('Pengaduan deleted successfully.');

        return redirect('pengaduans')->withSuccess('Data Berhasil Dihapus');
    }
    public function draft(Request $request)
    {
        $user_name = Auth::user()->name;
        $query = DB::table('pengaduans')
            ->leftjoin('users', 'users.name', '=', 'pengaduans.createdby')
            ->leftjoin('wilayahs', 'wilayahs.createdby', '=', 'pengaduans.createdby')
            ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'pengaduans.tujuan')
            ->leftjoin('indonesia_villages as b', 'b.code', '=', 'pengaduans.id_kelurahan')

            ->select('pengaduans.*', 'b.name_village')
            ->distinct();
        $user_id = Auth::user()->id;
        $user_wilayah = DB::table('wilayahs')
            // ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
            ->where('createdby', $user_id)
            ->where(function ($query) {
                $query->where('status_wilayah', 1);
            })
            ->first();
        $query->Where(function ($query) use ($user_wilayah) {
            $query->where('pengaduans.id_kelurahan', $user_wilayah->kelurahan_id);
            $query->where('pengaduans.status_aksi', 'Draft');
            $query->where('pengaduans.createdby',  Auth::user()->id);
            // })
        });
        if ($request->has('search')) {
            // dd($query);

            $search = $request->search['value'];
            $query->where(function ($query) use ($search) {
                $query->where('pengaduans.nama', 'like', "%$search%");
            });
        }
        // Get total count of filtered items
        $total_filtered_items = $query->count();
        // Add ordering
        if ($request->has('order')) {
            $order_column = $request->order[0]['column'];
            $order_direction = $request->order[0]['dir'];
            $query->orderBy($request->input('columns.' . $order_column . '.data'), $order_direction);
        }
        // Get paginated data
        $data = $query->paginate($request->input('length'));
        // dd($data);
        // mengubah data JSON menjadi objek PHP

        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => Pengaduan::count(),
            'recordsFiltered' => $total_filtered_items,
            'data' => $data,
        ]);
    }

    public function diproses(Request $request)
    {
        $user_name = Auth::user()->name;
        $query = DB::table('pengaduans')
            ->leftJoin('users', 'users.name', '=', 'pengaduans.createdby')
            // ->leftJoin('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'pengaduans.id')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'pengaduans.tujuan')
            ->leftJoin('indonesia_villages as b', 'b.code', '=', 'pengaduans.id_kelurahan')
            ->select('pengaduans.*', 'b.name_village');
        $user_id = Auth::user()->id;
        $user_wilayah = DB::table('wilayahs')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
            ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('createdby', $user_id)
            ->where(function ($query) {
                $query->where('status_wilayah', 1);
            })
            ->first();
        // dd($user_wilayah);
        if ($user_wilayah->name == 'fasilitator') {
            $query->orWhere(function ($query) use ($user_wilayah) {
                $query->where('pengaduans.id_kelurahan', $user_wilayah->kelurahan_id)
                    ->where('pengaduans.tujuan', $user_wilayah->role_id)
                    ->where('pengaduans.status_aksi', 'Teruskan')
                    ->orwhere('pengaduans.status_aksi', 'kembalikan');

                // dd($va);
            });
        }
        if ($user_wilayah->name == 'Back Ofiice kelurahan') {
            $query->orWhere(function ($query) use ($user_wilayah) {
                $query->where('pengaduans.id_kelurahan', $user_wilayah->kelurahan_id)
                    ->where('pengaduans.tujuan', $user_wilayah->role_id)
                    ->where('pengaduans.petugas', auth::user()->id)
                    ->where('pengaduans.status_aksi', 'Teruskan')
                    ->orwhere('pengaduans.status_aksi', 'kembalikan');
                // dd($va);
            });
        }
        if ($request->has('search')) {
            // dd($query);

            $search = $request->search['value'];
            $query->where(function ($query) use ($search) {
                $query->where('pengaduans.nama', 'like', "%$search%");
            });
        }
        // Get total count of filtered items
        $total_filtered_items = $query->count();
        // Add ordering
        if ($request->has('order')) {
            $order_column = $request->order[0]['column'];
            $order_direction = $request->order[0]['dir'];
            $query->orderBy($request->input('columns.' . $order_column . '.data'), $order_direction);
        }
        // Get paginated data
        $data = $query->paginate($request->input('length'));
        // dd($data);
        // mengubah data JSON menjadi objek PHP

        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => Pengaduan::count(),
            'recordsFiltered' => $total_filtered_items,
            'data' => $data,
        ]);
    }

    public function teruskan(Request $request)
    {
        $user_name = Auth::user()->name;
        $query = DB::table('pengaduans')
            ->join('users', 'users.name', '=', 'pengaduans.createdby')
            ->join('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'pengaduans.id')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'pengaduans.tujuan')
            ->join('indonesia_villages as b', 'b.code', '=', 'pengaduans.id_kelurahan')
            ->select('pengaduans.*', 'b.name_village', 'log_pengaduan.*');

        // dd($query);
        $user_id = Auth::user()->id;

        $user_wilayah = DB::table('wilayahs')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
            ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('wilayahs.createdby', $user_id)
            ->where(function ($query) {
                $query->where('status_wilayah', 1);
            })
            ->first();
        // dd($user_wilayah);
        if ($user_wilayah->name == 'fasilitator') {
            $query->orWhere(function ($query) use ($user_wilayah) {
                $query->where('pengaduans.id_kelurahan', $user_wilayah->kelurahan_id)
                    ->where('pengaduans.tujuan', '!=', $user_wilayah->role_id)
                    ->where('log_pengaduan.petugas', '=', $user_wilayah->model_id);

                // dd($va);
            });
        } elseif ($user_wilayah->name == 'Back Ofiice kelurahan') {
            // dd($user_wilayah);

            $query->orWhere(function ($query) use ($user_wilayah) {
                $query->where('pengaduans.id_kelurahan', $user_wilayah->kelurahan_id)
                    //  ->where('pengaduans.tujuan','!=', $user_wilayah->role_id)
                    ->where('log_pengaduan.petugas', '=', $user_wilayah->model_id)
                    ->where('log_pengaduan.tujuan', $user_wilayah->role_id);
                // ->where('log_pengaduan.petugas', $user_wilayah->model_id);
                // ->where('pengaduans.status_aksi', 'Teruskan');
            });
        }
        if ($request->has('search')) {
            $search = $request->search['value'];
            $query->where(function ($query) use ($search) {
                $query->where('pengaduans.nama', 'like', "%$search%");
            });
        }

        // Get total count of filtered items
        $total_filtered_items = $query->count();
        // Add ordering
        if ($request->has('order')) {
            $order_column = $request->order[0]['column'];
            $order_direction = $request->order[0]['dir'];
            $query->orderBy($request->input('columns.' . $order_column . '.data'), $order_direction);
        }
        // Get paginated data
        $data = $query->paginate($request->input('length'));
        // dd($data);
        // mengubah data JSON menjadi objek PHP

        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => Pengaduan::count(),
            'recordsFiltered' => $total_filtered_items,
            'data' => $data,
        ]);
    }

    public function selesai(Request $request)
    {
        $user_name = Auth::user()->name;
        $query = DB::table('pengaduans')
            ->join('users', 'users.name', '=', 'pengaduans.createdby')
            ->join('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'pengaduans.id')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'pengaduans.tujuan')
            ->join('indonesia_villages as b', 'b.code', '=', 'pengaduans.id_kelurahan')
            ->select('pengaduans.*', 'b.name_village');
        $user_id = Auth::user()->id;
        $user_wilayah = DB::table('wilayahs')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
            ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('createdby', $user_id)
            ->where(function ($query) {
                $query->where('status_wilayah', 1);
            })
            ->first();
        // dd($user_wilayah);
        // Add where conditions based on user's wilayah data
        if ($user_wilayah->name == 'fasilitator') {
            $query->orWhere(function ($query) use ($user_wilayah) {
                $query->where('pengaduans.id_kelurahan', $user_wilayah->kelurahan_id)
                    ->where('pengaduans.tujuan', '!=', $user_wilayah->role_id)
                    ->where('log_pengaduan.petugas', '=', $user_wilayah->model_id)
                    ->where('pengaduans.status_aksi', 'Selesai')
                    ->orwhere('pengaduans.status_aksi', 'Ditolak');
                // dd($va);
            });
        } else
            $query->orWhere(function ($query) use ($user_wilayah) {
                $query->where('pengaduans.id_kelurahan', $user_wilayah->kelurahan_id)
                    // ->where('pengaduans.tujuan', $value->role_id)
                    ->where('pengaduans.createdby', $user_wilayah->name)
                    ->where('pengaduans.status_aksi', 'Teruskan')
                    ->orwhere('pengaduans.status_aksi', 'kembalikan')
                    ->orWhere('model_has_roles.model_id', $user_wilayah->role_id);
                // dd($query);
            });
        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $query = DB::table('pengaduans')
                ->join('users', 'users.name', '=', 'pengaduans.createdby')
                ->join('wilayahs', 'wilayahs.createdby', '=', 'users.id')
                ->join('model_has_roles', 'model_has_roles.model_id', '=', 'pengaduans.tujuan')
                ->join('indonesia_villages as b', 'b.code', '=', 'pengaduans.id_kelurahan')
                ->select('pengaduans.*', 'b.name_village')
                ->where(function ($query) use ($search) {
                    $query->where('pengaduans.nama', 'like', "%$search%");
                });
        }

        // Get total count of filtered items
        $total_filtered_items = $query->count();
        // Add ordering
        if ($request->has('order')) {
            $order_column = $request->order[0]['column'];
            $order_direction = $request->order[0]['dir'];
            $query->orderBy($request->input('columns.' . $order_column . '.data'), $order_direction);
        }
        // Get paginated data
        $data = $query->paginate($request->input('length'));
        // dd($data);
        // mengubah data JSON menjadi objek PHP

        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => Pengaduan::count(),
            'recordsFiltered' => $total_filtered_items,
            'data' => $data,
        ]);
    }
    public function prelistDTKS(Request $request)
    {
        $columns = [
            // daftar kolom yang akan ditampilkan pada tabel
            'id_provinsi',
            'id_kabkot',
            'id_kecamatan',
            'id_kelurahan',
            'nik',
            'no_kk',
            'nama',
            'tgl_lahir',
            'telp',
            'status_data',
            'email'
        ];

        // $query = Prelist::where('status_data', 'prelistdtks');
        $query = DB::table('prelist')
            ->join('indonesia_districts as a', 'a.code', '=', 'prelist.id_kecamatan')
            ->join('indonesia_villages as b', 'b.code', '=', 'prelist.id_kelurahan')
            ->select('prelist.*', 'a.name_districts', 'b.name_village');
        // dd($query);
        // menambahkan kondisi pencarian jika ada
        if ($request->has('search')) {
            $searchValue = $request->search['value'];
            $query->where(function ($query) use ($columns, $searchValue) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'like', '%' . $searchValue . '%');
                }
            });
        }
        // menambahkan kondisi sortir jika ada
        if ($request->has('order')) {
            $orderColumn = $columns[$request->order[0]['column']];
            $orderDirection = $request->order[0]['dir'];
            $query->orderBy($orderColumn, $orderDirection);
        }

        // mengambil data sesuai dengan paginasi yang diminta
        $perPage = $request->length ?: config('app.pagination.per_page');
        $currentPage = $request->start ? ($request->start / $perPage) + 1 : 1;
        $data = $query->paginate($perPage, ['*'], 'page', $currentPage);

        // memformat data untuk dikirim ke client
        $no = 1;
        $formattedData = [];
        foreach ($data as $item) {
            $formattedData[] = [
                'no' => $no++,
                'id_provinsi' => $item->id_provinsi,
                'id_kabkot' => $item->id_kabkot,
                'id_kecamatan' => $item->name_village,
                'id_kelurahan' => $item->name_districts,
                'nik' => $item->nik,
                'no_kk' => $item->no_kk,
                'nama' => $item->nama,
                'tgl_lahir' => $item->tgl_lahir,
                'telp' => $item->telp,
                'email' => $item->email,
            ];
        }
        // mengembalikan data dalam format JSON
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => Pengaduan::count(),
            'recordsFiltered' => $data->total(),
            'data' => $formattedData
        ]);
    }
    public function prelistPage(Request $request)
    {
        return view('prelist.index');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $data = Pengaduan::where('name', 'like', '%' . $query . '%')
            ->orWhere('status', 'like', '%' . $query . '%')
            ->paginate(10);
        return view('pengaduans.index', compact('data'));
    }
}
