<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createrekomendasi_terdaftar_yayasanRequest;
use App\Http\Requests\Updaterekomendasi_terdaftar_yayasanRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\logYayasan;
use App\Models\Prelist;
use app\Models\rekomendasi_terdaftar_yayasan;
use App\Models\Roles;
use App\Repositories\rekomendasi_terdaftar_yayasanRepository;
use Illuminate\Http\Request;
use app\Models\Pengaduan;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class rekomendasi_terdaftar_yayasanController extends AppBaseController
{
    /** @var rekomendasi_terdaftar_yayasanRepository $rekomendasiTerdaftarYayasanRepository*/
    private $rekomendasiTerdaftarYayasanRepository;

    public function __construct(rekomendasi_terdaftar_yayasanRepository $rekomendasiTerdaftarYayasanRepo)
    {
        $this->rekomendasiTerdaftarYayasanRepository = $rekomendasiTerdaftarYayasanRepo;
    }

    /**
     * Display a listing of the rekomendasi_terdaftar_yayasan.
     */



    public function index(Request $request)
    {
        $rekomendasiTerdaftarYayasans = $this->rekomendasiTerdaftarYayasanRepository->paginate(10);

        return view('rekomendasi_terdaftar_yayasans.index')
            ->with('rekomendasiTerdaftarYayasans', $rekomendasiTerdaftarYayasans);
    }

    /**
     * Show the form for creating a new rekomendasi_terdaftar_yayasan.
     */

    public function create()
    {
        $v = rekomendasi_terdaftar_yayasan::latest()->first();
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

        //ALUR
        $user = Auth::user();
        $roles = $user->roles()->pluck('name');

        if ($roles->contains('Front Office kota')) {
            // Jika user memiliki role 'FO-Kota', maka tampilkan alur dengan nama 'Draft' dan 'Teruskan'
            $alur = DB::table('alur')
                ->whereIn('name', ['Draft', 'Teruskan'])
                ->get();
        } else if ($roles->contains('Back Ofiice Kota') || $roles->contains('Sekdis')) {
            // Jika user memiliki role 'BO-Kota' atau 'Sekdis', maka tampilkan alur dengan nama 'Kembalikan', 'Tolak', dan 'Teruskan'
            $alur = DB::table('alur')
                ->whereIn('name', ['Kembalikan', 'Tolak', 'Teruskan'])
                ->get();
        } else if ($roles->contains('Kadis')) {
            // Jika user memiliki role 'Kadus', maka tampilkan alur dengan nama 'Selesai' dan 'Tolak'
            $alur = DB::table('alur')
                ->whereIn('name', ['Selesai', 'Tolak'])
                ->get();
        } else {
            // Jika user tidak memiliki role yang sesuai, maka tampilkan alur kosong
            $alur = collect();
        }


        $user = Auth::user();
        $roles = $user->roles()->pluck('name');
        
        if ($roles->contains('Front Office kota')) {
            $roleid = DB::table('roles')
                ->where('name', 'Back Ofiice Kota')
                ->get();
        } else if ($roles->contains('Back Ofiice Kota')) {
            $roleid = DB::table('roles')
                ->whereIn('name', ['Front Office kota', 'Sekdis'])
                ->get();
        } else if ($roles->contains('Sekdis')) {
            $roleid = DB::table('roles')
                ->whereIn('name', ['Back Ofiice Kota', 'Kadis'])
                ->get();
        } else if ($roles->contains('Kadis')) {
            $roleid = DB::table('roles')
                ->where('name', 'Front Office kota')
                ->get();
        }
            $checkroles = Roles::where('name', 'Front Office kota')
                ->orWhere('name', 'Sekdis')
                ->orWhere('name', 'Kadis')
                ->get();
           
        // $rolebackoffice = DB::table('roles')
        //     ->where('name', 'Back Ofiice kelurahan')
        //     // ->where('name', 'supervisor')
        //     // ->orWhere('name', 'supervisor')
        //     ->get();
        // $checkroles = DB::table('model_has_roles')
        //     ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
        //     ->where('model_id', '=', $userid)
        //     ->get();


        // $checkroles = DB::table('model_has_roles')->where('model_id','=', $userid);
        // dd($alur);
        return view('rekomendasi_terdaftar_yayasans.create', compact('wilayah', 'roleid', 'checkroles', 'alur'));
    }

    /**
     * Store a newly created rekomendasi_terdaftar_yayasan in storage.
     */
    public function store(Request $request)
    {

        $getdata = rekomendasi_terdaftar_yayasan::where('id', Auth::user()->id)->first();

        if ($request->file('file_permohonan') != null) {
            $file_permohonan = $request->file('file_permohonan');
            $nama_file_permohonan = time() . "_" . $file_permohonan->getClientOriginalName();
            $tujuan = 'upload/ktp/';
            $file_permohonan->move($tujuan, $nama_file_permohonan);
        } elseif ($request->file_permohonan != null) {
            $nama_file_permohonan = $getdata->nama_file_permohonan;
        } else {
            $nama_file_permohonan = null;
        }

        //programtahunan
        if ($request->file('draft_rekomendasi') != null) {
            $draft_rekomendasi = $request->file('draft_rekomendasi');
            $nama_draft_rekomendasi = time() . "." . $draft_rekomendasi->getClientOriginalName();
            $tujuan = 'upload/kk/';
            $draft_rekomendasi->move($tujuan, $nama_draft_rekomendasi);
        } elseif ($request->draft_rekomendasi != null) {
            $nama_draft_rekomendasi = $getdata->nama_draft_rekomendasi;
        } else {
            $nama_draft_rekomendasi = null;
        }

   
        $data = new rekomendasi_terdaftar_yayasan();
        $data['id_alur'] = $request->get('id_alur');
        $data['no_pendaftaran'] = mt_rand(100, 1000);
        $data['id_provinsi'] = $request->get('id_provinsi');
        $data['id_kabkot'] = $request->get('id_kabkot');
        $data['id_kecamatan'] = $request->get('id_kecamatan');
        $data['id_kelurahan'] = $request->get('id_kelurahan');
        $data['jenis_pelapor'] = $request->get('jenis_pelapor');
        $data['nik_ter'] = $request->get('nik_ter');
        $data['nama_ter'] = $request->get('nama_ter');
        $data['tempat_lahir'] = $request->get('tempat_lahir');
        $data['tgl_lahir'] = $request->get('tgl_lahir');
        $data['jenis_kelamin'] = $request->get('jenis_kelamin');
        $data['telp'] = $request->get('telp');
        $data['alamat'] = $request->get('alamat');
        $data['nik_pel'] = $request->get('nik_pel');
        $data['nama_pel'] = $request->get('nama_pel');
        $data['tempat_lahirpel'] = $request->get('tempat_lahirpel');
        $data['tgl_lahirpel'] = $request->get('tgl_lahirpel');
        $data['jenis_kelaminpel'] = $request->get('jenis_kelaminpel');
        $data['telp_pel'] = $request->get('telp_pel');
        $data['alamat_pel'] = $request->get('alamat_pel');
        $data['nama_lembaga'] = $request->get('nama_lembaga');
        $data['alamat_lembaga'] = $request->get('alamat_lembaga');
        $data['akta_notaris'] = $request->get('akta_notaris');
        $data['no_akta'] = $request->get('no_akta');
        $data['nama_ketua'] = $request->get('nama_ketua');
        $data['jenis_kesos'] = $request->get('jenis_kesos');
        $data['status'] = $request->get('status');
        $data['wil_kerja'] = $request->get('wil_kerja');
        $data['tipe'] = $request->get('tipe');
        $data['masaberlaku'] = $request->get('masaberlaku');
        $data['file_pemohonan'] = $file_permohonan;
        $data['draft_rekomendasi'] = $draft_rekomendasi;
        $data['catatan']  = $request->get('catatan');
        $data['status_alur'] = $request->get('status_alur');
        $data['tujuan'] = $request->get('tujuan');
        $data['petugas'] = $request->get('petugas');
        $data['createdby'] = Auth::user()->name;
        $data['updatedby'] = Auth::user()->name;
        $data->save();
        $logpengaduan = new logYayasan();
        $logpengaduan['id_trx_yayasan'] = $data->id;
        $logpengaduan['id_alur'] = $request->get('status_alur');
        $logpengaduan['petugas'] = $request->get('petugas');
        $logpengaduan['catatan']  = $request->get('tl_catatan');
        $logpengaduan['file_permohonan'] = $request->get('file_permohonan');
        $logpengaduan['draft_rekomendasi'] = $request->get('draft_rekomendasi');
        $logpengaduan['tujuan'] = $request->get('tujuan');
        $logpengaduan['created_by'] = Auth::user()->name;
        $logpengaduan['updated_by'] = Auth::user()->name;

        $logpengaduan->save();
        // dd($logpengaduan);

        return redirect('rekomendasi_terdafar_yayasans')->withSuccess('Data Berhasil Disimpan');
    }

    /**
     * Display the specified rekomendasi_terdaftar_yayasan.
     */
    public function show($id)
    {
        $userid = Auth::user()->id;
        $rekomendasiTerdaftarYayasan = $this->rekomendasiTerdaftarYayasanRepository->find((int) $id);
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

        if (empty($rekomendasiTerdaftarYayasan)) {
            Flash::error('Rekomendasi not found');

            return redirect(route('rekomendasi_terdafar_yayasans.index'));
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
        return view('rekomendasi_terdafar_yayasans.show', compact('rekomendasiTerdaftarYayasan', 'roleid', 'wilayah', 'checkroles'));
    }


    /**
     * Show the form for editing the specified rekomendasi_terdaftar_yayasan.
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
            ->select('pengaduans.id', 'pengaduans.createdby', 'roles.name')
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
        $rekomendasiTerdaftarYayasans = rekomendasi_terdaftar_yayasan::where('createdby', $userid)->get();
        $getdata = DB::table('model_has_roles')
            ->leftjoin('pengaduans as b', 'b.tujuan', '=', 'model_has_roles.role_id')
            ->where('b.id', $id)
            ->get();
        //alur
        $user = Auth::user();
        $roles = $user->roles()->pluck('name');

        if ($roles->contains('Front Office kota')) {
            // Jika user memiliki role 'FO-Kota', maka tampilkan alur dengan nama 'Draft' dan 'Teruskan'
            $alur = DB::table('alur')
                ->whereIn('name', ['Draft', 'Teruskan'])
                ->get();
        } else if ($roles->contains('Back Ofiice Kota') || $roles->contains('Sekdis')) {
            // Jika user memiliki role 'BO-Kota' atau 'Sekdis', maka tampilkan alur dengan nama 'Kembalikan', 'Tolak', dan 'Teruskan'
            $alur = DB::table('alur')
                ->whereIn('name', ['Kembalikan', 'Tolak', 'Teruskan'])
                ->get();
        } else if ($roles->contains('Kadis')) {
            // Jika user memiliki role 'Kadus', maka tampilkan alur dengan nama 'Selesai' dan 'Tolak'
            $alur = DB::table('alur')
                ->whereIn('name', ['Selesai', 'Tolak'])
                ->get();
        } else {
            // Jika user tidak memiliki role yang sesuai, maka tampilkan alur kosong
            $alur = collect();
        }


        $user = Auth::user();
        $roles = $user->roles()->pluck('name');
        
        if ($roles->contains('Front Office kota')) {
            $roleid = DB::table('roles')
                ->where('name', 'Back Ofiice Kota')
                ->get();
        } else if ($roles->contains('Back Ofiice Kota')) {
            $roleid = DB::table('roles')
                ->whereIn('name', ['Front Office kota', 'Sekdis'])
                ->get();
        } else if ($roles->contains('Sekdis')) {
            $roleid = DB::table('roles')
                ->whereIn('name', ['Back Ofiice Kota', 'Kadis'])
                ->get();
        } else if ($roles->contains('Kadis')) {
            $roleid = DB::table('roles')
                ->where('name', 'Front Office kota')
                ->get();
        }

        $role_id= null;
        $users = DB::table('users as u')
        ->join('model_has_roles as mhr', 'u.id', '=', 'mhr.model_id')
        ->join('roles as r', 'mhr.role_id', '=', 'r.id')
        ->select('u.id', 'u.name', 'u.email', 'r.name as role')
        ->where('mhr.model_type', '=', 'App\Models\User')
        ->where('mhr.role_id', '=', $role_id)
        ->get();

        $rekomendasiTerdaftarYayasan = $this->rekomendasiTerdaftarYayasanRepository->find($id);


        return view('rekomendasi_terdaftar_yayasans.edit', compact('wilayah', 'rekomendasiTerdaftarYayasan','roleid', 'getdata', 'alur', 'createdby'));
    }
    public function getPetugas($id)
    {
        $users = DB::table('users as u')
        ->join('model_has_roles as mhr', 'u.id', '=', 'mhr.model_id')
        ->join('roles as r', 'mhr.role_id', '=', 'r.id')
        ->select('u.id', 'u.name', 'u.email', 'r.name as role')
        ->where('mhr.model_type', '=', 'App\Models\User')
        ->where('mhr.role_id', '=', $id)
        ->get();

        return response()->json($users);
    }
    /**
     * Update the specified rekomendasi_terdaftar_yayasan in storage.
     */
    public function update($id, Request $request)
    {
        $getdata = rekomendasi_terdaftar_yayasan::where('id', $id)->first();
        $data = $request->all();
        if ($request->file('file_permohonan') != null) {
            $file_permohonan = $request->file('file_permohonan');
            $nama_file_permohonan = time() . "_" . $file_permohonan->getClientOriginalName();
            $tujuan = 'upload/ktp/';
            $file_permohonan->move($tujuan, $nama_file_permohonan);
            $data['file_permohonan'] = $nama_file_permohonan;
        } elseif ($request->file_permohonan != null) {
            $data['file_permohonan'] = $getdata->nama_file_permohonan;
        }

        //programtahunan
        if ($request->file('draft_rekomendasi') != null) {
            $draft_rekomendasi = $request->file('draft_rekomendasi');
            $nama_draft_rekomendasi = time() . "." . $draft_rekomendasi->getClientOriginalName();
            $tujuan = 'upload/kk/';
            $draft_rekomendasi->move($tujuan, $nama_draft_rekomendasi);
            $data['draft_rekomendasi'] = $nama_draft_rekomendasi;
        } elseif ($request->draft_rekomendasi != null) {
            $data['draft_rekomendasi'] = $getdata->nama_draft_rekomendasi;
        }

        $data['updatedby'] = Auth::user()->name;
        $getdata->update($data);

        $logpengaduan = new logYayasan();
        $logpengaduan['id_trx_yayasan'] = $getdata->id;
        $logpengaduan['id_alur'] = $request->get('status_alur');
        $logpengaduan['petugas'] = $request->get('petugas');
        $logpengaduan['catatan']  = $request->get('tl_catatan');
        $logpengaduan['file_pendukung'] = $request->get('file_pendukung');
        $logpengaduan['tujuan'] = $request->get('tujuan');
        $logpengaduan['created_by'] = Auth::user()->name;
        $logpengaduan->save();
        return redirect()->route('rekomendasi_terdaftar_yayasans.index')->with('success', 'Data berhasil diupdate.');
    }

    /**
     * Remove the specified rekomendasi_terdaftar_yayasan from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rekomendasi = rekomendasi_terdaftar_yayasan::findOrFail($id);

        // delete uploaded files
        if (!empty($rekomendasi->filektp)) {
            Storage::delete('upload/ktp/' . $rekomendasi->filektp);
        }
        if (!empty($rekomendasi->filekk)) {
            Storage::delete('upload/kk/' . $rekomendasi->filekk);
        }
        if (!empty($rekomendasi->suket)) {
            Storage::delete('upload/suket/' . $rekomendasi->suket);
        }
        if (!empty($rekomendasi->draftfrom)) {
            Storage::delete('upload/draftFrom/' . $rekomendasi->draftfrom);
        }

        // delete the record
        $rekomendasi->delete();

        return redirect()->route('rekomendasi-terdaftar.index')
            ->with('success', 'Rekomendasi terdaftar yayasan berhasil dihapus.');
    }
    public function diproses(Request $request)
    {

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
            if ($user_wilayah->name_roles == 'fasilitator' ) {
                $query = DB::table('rekomendasi_terdaftar_yayasans')
                    ->join('users', 'users.id', '=', 'rekomendasi_terdaftar_yayasans.createdby')
                    ->join('indonesia_districts as d', 'd.code', '=', 'rekomendasi_terdaftar_yayasans.id_kecamatan')
                    ->join('indonesia_villages as b', 'b.code', '=', 'rekomendasi_terdaftar_yayasans.id_kelurahan')
                    ->select('rekomendasi_terdaftar_yayasans.*', 'b.name_village','d.name_districts');
            }elseif ($user_wilayah->name_roles == 'Back Ofiice Kota') {
                $query = DB::table('rekomendasi_terdaftar_yayasans')
                    ->join('users', 'users.id', '=', 'pengaduans.createdby')
                    ->join('indonesia_districts as d', 'd.code', '=', 'pengaduans.id_kecamatan')
                    ->join('indonesia_villages as b', 'b.code', '=', 'pengaduans.id_kelurahan')
                    ->select('pengaduans.*', 'b.name_village','d.name_districts');
            }else {
                $query = DB::table('rekomendasi_terdaftar_yayasans')
                    ->join('users', 'users.id', '=', 'rekomendasi_terdaftar_yayasans.createdby')
                    ->join('indonesia_villages as b', 'b.code', '=', 'rekomendasi_terdaftar_yayasans.id_kelurahan')
                    ->select('rekomendasi_terdaftar_yayasans.*', 'b.name_village');
            }
        // dd($query);
            if ($user_wilayah->name_roles == 'fasilitator' ) {
                // dd($user_wilayah->role_id); 
                $query->orWhere(function($query) use ($user_wilayah) {
                       $query->where('rekomendasi_terdaftar_yayasans.id_kelurahan', '=' , $user_wilayah->kelurahan_id)
                             ->where('rekomendasi_terdaftar_yayasans.tujuan', '=' , $user_wilayah->role_id)
                            ->where(function($query){
                                $query->where('rekomendasi_terdaftar_yayasans.status_aksi', '=', 'Teruskan')
                                      ->orWhere('rekomendasi_terdaftar_yayasans.status_aksi', '=', 'kembalikan');
                            }); 
                 });
                // dd($query);
            }
            if ($user_wilayah->name_roles == 'Front Office kota' ) {
                //  dd($user_wilayah->role_id);
                
                $query->orWhere(function($query) use ($user_wilayah) {
                       $query->where('pengaduans.id_kelurahan', '=' , $user_wilayah->kelurahan_id)
                                ->where('pengaduans.tujuan', '=' ,$user_wilayah->role_id)
                                ->where(function($query){
                                    $query->where('rekomendasi_terdaftar_yayasans.status_aksi', '=', 'Teruskan')
                                          ->orWhere('rekomendasi_terdaftar_yayasans.status_aksi', '=', 'kembalikan');
                                });
                    });

            }
            if ($user_wilayah->name_roles == 'Front Office Kelurahan' ) {
                //  dd($user_wilayah->role_id);
                $query->orWhere(function($query) use ($user_wilayah) {
                    $query->where('rekomendasi_terdaftar_yayasans.id_kelurahan', '=' , $user_wilayah->kelurahan_id)
                          ->where('rekomendasi_terdaftar_yayasans.tujuan', '=' , $user_wilayah->role_id)
                         ->where(function($query){
                             $query->where('rekomendasi_terdaftar_yayasans.status_alur', '=', 'Teruskan')
                                   ->orWhere('rekomendasi_terdaftar_yayasans.status_alur', '=', 'kembalikan');
                         }); 
              });

            }
            if ($user_wilayah->name_roles == 'Back Ofiice kelurahan' ) {
                // dd(auth::user()->id);
                $query->orWhere(function($query) use ($user_wilayah) {
                    $query->where('pengaduans.id_kelurahan', '=' , $user_wilayah->kelurahan_id)
                    ->where('pengaduans.tujuan', '=' , $user_wilayah->role_id)
                    ->where('pengaduans.petugas', '=' , auth::user()->id)
                    ->where(function($query){
                       $query->where('pengaduans.status_aksi', '=', 'Teruskan')
                             ->orWhere('pengaduans.status_aksi', '=', 'kembalikan');
                   }); 
                    // dd($va);
                });
            }
            if ($user_wilayah->name_roles == 'Back Ofiice Kota' ) {
                
                $query->orWhere(function($query) use ($user_wilayah) {
                    $query->where('pengaduans.id_kelurahan', '=' , $user_wilayah->kelurahan_id)
                    ->where('pengaduans.tujuan', '=' , $user_wilayah->role_id)
                    ->where('pengaduans.petugas', '=' , $user_wilayah->model_id)
                    ->where(function($query){
                       $query->where('pengaduans.status_aksi', '=', 'Teruskan')
                             ->orWhere('pengaduans.status_aksi', '=', 'kembalikan');
                   }); 
                    // dd($va);
                });
            }
            if ($user_wilayah->name_roles == 'supervisor' ) {
                // dd($user_wilayah);
                $query->orWhere(function($query) use ($user_wilayah) {
                    $query->where('pengaduans.id_kelurahan', '=' , $user_wilayah->kelurahan_id)
                    ->where('pengaduans.tujuan', '=' , $user_wilayah->role_id)
                    ->where('pengaduans.petugas', '=' , $user_wilayah->model_id)
                    ->where(function($query){
                       $query->where('pengaduans.status_aksi', '=', 'Teruskan')
                             ->orWhere('pengaduans.status_aksi', '=', 'kembalikan');
                   }); 
                    // dd($va);
                });
            }
            if ($user_wilayah->name_roles == 'kepala bidang' ) {
                // dd($user_wilayah);
                  $query->orWhere(function($query) use ($user_wilayah) {
                    $query->where('pengaduans.id_kelurahan', '=' , $user_wilayah->kelurahan_id)
                    ->where('pengaduans.tujuan', '=' , $user_wilayah->role_id)
                    ->where('pengaduans.petugas', '=' , $user_wilayah->model_id)
                    ->where(function($query){
                       $query->where('pengaduans.status_aksi', '=', 'Teruskan')
                             ->orWhere('pengaduans.status_aksi', '=', 'kembalikan');
                   }); 
                    // dd($va);
                });
            }
            if ($request->has('search') && !empty($request->search['value'])) {
                $search = $request->search['value'];
                $query = DB::table('pengaduans')
                ->join('users', 'users.id', '=', 'pengaduans.createdby')
                ->join('indonesia_districts as d', 'd.code', '=', 'pengaduans.id_kecamatan')
                ->join('indonesia_villages as b', 'b.code', '=', 'pengaduans.id_kelurahan')
                ->select('pengaduans.*', 'b.name_village','d.name_districts')
                ->where(function($query) use ($search) {
                    $query->where('pengaduans.no_pendaftaran', 'like', "%$search%");
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
            'recordsTotal' => rekomendasi_terdaftar_yayasan::count(),
            'recordsFiltered' => $total_filtered_items,
            'data' => $data,
        ]);
       
    }

    public function teruskan(Request $request)
    {
        $user_name = Auth::user()->name;
        // dd($user_name);

        $query = DB::table('pengaduans')
                ->join('users', 'users.id', '=', 'pengaduans.createdby')
                ->join('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'pengaduans.id')
                // ->join('model_has_roles', 'model_has_roles.role_id', '=', 'pengaduans.tujuan')
                ->join('indonesia_villages as b', 'b.code', '=', 'pengaduans.id_kelurahan')
               
                ->select('pengaduans.*', 'b.name_village');
        $user_id = Auth::user()->id;
        // dd($user_id);

        $user_wilayah = DB::table('wilayahs')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
            ->join('users', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('wilayahs.createdby', $user_id)
            ->where(function ($query) {
                $query->where('status_wilayah', 1);
            })
            ->first();
            // dd($user_wilayah);
            if ($user_wilayah->name_roles == 'fasilitator' ) {
                // dd($user_wilayah->model_id);
                $query = DB::table('rekomendasi_terdaftar_yayasans')
                    ->join('users', 'users.id', '=', 'rekomendasi_terdaftar_yayasans.createdby')
                    ->join('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'rekomendasi_terdaftar_yayasans.id')
                    // ->join('model_has_roles', 'model_has_roles.model_id', '=', 'rekomendasi_terdaftar_yayasans.tujuan')
                    ->join('indonesia_villages as b', 'b.code', '=', 'rekomendasi_terdaftar_yayasans.id_kelurahan')
                    ->select('rekomendasi_terdaftar_yayasans.*','b.name_village','log_pengaduan.tujuan','log_pengaduan.petugas' )
                    ->orWhere(function($query) use ($user_wilayah) {
                        $query->where('rekomendasi_terdaftar_yayasans.id_kelurahan', $user_wilayah->kelurahan_id)
                                    ->where('rekomendasi_terdaftar_yayasans.tujuan','!=', $user_wilayah->role_id)
                                    ->where('log_pengaduan.created_by','=', auth::user()->id)
                                    // ->where('rekomendasi_terdaftar_yayasans.petugas','!=', $user_wilayah->model_id)
                                    ->where(function($query){
                                        $query->where('rekomendasi_terdaftar_yayasans.status_aksi', '=', 'Teruskan')
                                            ->orWhere('rekomendasi_terdaftar_yayasans.status_aksi', '=', 'kembalikan');
                                    });
                    })->distinct();
            }
            //front office kota
            if ($user_wilayah->name_roles == 'Front Office kota' ) {
                // dd($user_wilayah->model_id);
                $query = DB::table('rekomendasi_terdaftar_yayasans')
                ->join('users', 'users.id', '=', 'rekomendasi_terdaftar_yayasans.createdby')
                ->join('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'rekomendasi_terdaftar_yayasans.id')
                // ->join('model_has_roles', 'model_has_roles.model_id', '=', 'rekomendasi_terdaftar_yayasans.tujuan')
                ->join('indonesia_villages as b', 'b.code', '=', 'rekomendasi_terdaftar_yayasans.id_kelurahan')
                ->select('rekomendasi_terdaftar_yayasans.*','b.name_village')
                ->orWhere(function($query) use ($user_wilayah) {
                    $query->where('rekomendasi_terdaftar_yayasans.id_kelurahan', $user_wilayah->kelurahan_id)
                                ->where('log_pengaduan.tujuan','!=', $user_wilayah->role_id)
                                ->where('log_pengaduan.created_by','=', auth::user()->id)
                                // ->where('rekomendasi_terdaftar_yayasans.petugas','!=', $user_wilayah->model_id)
                                ->where(function($query){
                                    $query->where('rekomendasi_terdaftar_yayasans.status_aksi', '=', 'Teruskan')
                                        ->orWhere('rekomendasi_terdaftar_yayasans.status_aksi', '=', 'kembalikan');
                                });
                });
                // ->get();
                // dd($query);
            }
            //front-office-kelurahan
            if ($user_wilayah->name_roles == 'Front Office Kelurahan' ) {
                // dd($user_wilayah->model_id);
                $query = DB::table('rekomendasi_terdaftar_yayasans')
                ->join('users', 'users.id', '=', 'rekomendasi_terdaftar_yayasans.createdby')
                // ->join('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'rekomendasi_terdaftar_yayasans.id')
                // ->join('model_has_roles', 'model_has_roles.model_id', '=', 'rekomendasi_terdaftar_yayasans.tujuan')
                ->join('indonesia_villages as b', 'b.code', '=', 'rekomendasi_terdaftar_yayasans.id_kelurahan')
                ->select('rekomendasi_terdaftar_yayasans.*','b.name_village')
                ->orWhere(function($query) use ($user_wilayah) {
                    $query->where('rekomendasi_terdaftar_yayasans.id_kelurahan', $user_wilayah->kelurahan_id)
                                ->where('rekomendasi_terdaftar_yayasans.tujuan','!=', $user_wilayah->role_id)
                                ->where('rekomendasi_terdaftar_yayasans.createdby','=', auth::user()->id)
                                // ->where('rekomendasi_terdaftar_yayasans.petugas','!=', $user_wilayah->model_id)
                                ->where(function($query){
                                    $query->where('rekomendasi_terdaftar_yayasans.status_aksi', '=', 'Teruskan')
                                        ->orWhere('rekomendasi_terdaftar_yayasans.status_aksi', '=', 'kembalikan');
                                });
                })->distinct();
            }
            if ($user_wilayah->name_roles == 'Back Ofiice kelurahan' ) {
                // dd($user_wilayah->kelurahan_id);
               
                $query = DB::table('pengaduans')
                ->join('users', 'users.id', '=', 'pengaduans.createdby')
                ->join('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'pengaduans.id')
                // ->join('model_has_roles', 'model_has_roles.model_id', '=', 'pengaduans.tujuan')
                ->join('indonesia_villages as b', 'b.code', '=', 'pengaduans.id_kelurahan')
                ->select('pengaduans.*','b.name_village')
                ->orWhere(function($query) use ($user_wilayah) {
                    $query->where('pengaduans.id_kelurahan', $user_wilayah->kelurahan_id)
                                ->where('log_pengaduan.tujuan','!=', $user_wilayah->role_id)
                                // ->where('log_pengaduan.created_by','=', auth::user()->id)
                                // ->where('pengaduans.petugas','!=', $user_wilayah->model_id)
                                ->where(function($query){
                                    $query->where('pengaduans.status_aksi', '=', 'Teruskan')
                                        ->orWhere('pengaduans.status_aksi', '=', 'kembalikan');
                                });
                })->distinct();
            }
            if ($user_wilayah->name_roles == 'Back Ofiice Kota' ) {
                // dd( $user_wilayah->role_id);
                $query = DB::table('pengaduans')
                ->join('users', 'users.id', '=', 'pengaduans.createdby')
                ->join('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'pengaduans.id')
                // ->join('model_has_roles', 'model_has_roles.model_id', '=', 'pengaduans.tujuan')
                ->join('indonesia_villages as b', 'b.code', '=', 'pengaduans.id_kelurahan')
                ->select('pengaduans.*','b.name_village')
                ->orWhere(function($query) use ($user_wilayah) {
                    $query->where('pengaduans.id_kelurahan', $user_wilayah->kelurahan_id)
                                ->where('log_pengaduan.tujuan','!=', $user_wilayah->role_id)
                                ->where('log_pengaduan.created_by','=', auth::user()->id)
                                // // ->where('pengaduans.petugas','!=', $user_wilayah->model_id)
                                ->where(function($query){
                                    $query->where('pengaduans.status_aksi', '=', 'Teruskan')
                                        ->orWhere('pengaduans.status_aksi', '=', 'kembalikan');
                                });
                })->distinct();
            }
            if ($user_wilayah->name_roles == 'supervisor' ) {
                // dd($user_wilayah);
                $query = DB::table('pengaduans')
                ->join('users', 'users.id', '=', 'pengaduans.createdby')
                ->join('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'pengaduans.id')
                // ->join('model_has_roles', 'model_has_roles.model_id', '=', 'pengaduans.tujuan')
                ->join('indonesia_villages as b', 'b.code', '=', 'pengaduans.id_kelurahan')
                ->select('pengaduans.*','b.name_village')
                ->orWhere(function($query) use ($user_wilayah) {
                    $query->where('pengaduans.id_kelurahan', $user_wilayah->kelurahan_id)
                                ->where('log_pengaduan.tujuan','!=', $user_wilayah->role_id)
                                ->where('log_pengaduan.created_by','=', auth::user()->id)
                                // // ->where('pengaduans.petugas','!=', $user_wilayah->model_id)
                                ->where(function($query){
                                    $query->where('pengaduans.status_aksi', '=', 'Teruskan')
                                        ->orWhere('pengaduans.status_aksi', '=', 'kembalikan');
                                });
                })->distinct();
            }
            if ($user_wilayah->name_roles == 'kepala bidang' ) {
                //  dd(auth::user()->id);
                 $query = DB::table('pengaduans')
                 ->join('users', 'users.id', '=', 'pengaduans.createdby')
                 ->join('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'pengaduans.id')
                //  ->join('model_has_roles', 'model_has_roles.model_id', '=', 'pengaduans.tujuan')
                 ->join('indonesia_villages as b', 'b.code', '=', 'pengaduans.id_kelurahan')
                 ->join('indonesia_districts as d', 'd.code', '=', 'pengaduans.id_kecamatan')
                 ->select('pengaduans.*','b.name_village')
                 ->orWhere(function($query) use ($user_wilayah) {
                     $query->where('pengaduans.id_kelurahan', $user_wilayah->kelurahan_id)
                                 ->where('log_pengaduan.tujuan','!=', $user_wilayah->role_id)
                                 ->where('log_pengaduan.created_by','=', auth::user()->id)
                                 // ->where('pengaduans.petugas','!=', $user_wilayah->model_id)
                                 ->where(function($query){
                                     $query->where('pengaduans.status_aksi', '=', 'Teruskan')
                                         ->orWhere('pengaduans.status_aksi', '=', 'kembalikan');
                                 });
                 })->distinct();
       
            }
            if ($request->has('search') && !empty($request->search['value'])) {
                $search = $request->search['value'];
                $query = DB::table('pengaduans')
                ->join('users', 'users.id', '=', 'pengaduans.createdby')
                ->join('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'pengaduans.id')
                // ->join('model_has_roles', 'model_has_roles.model_id', '=', 'pengaduans.tujuan')
                ->join('indonesia_villages as b', 'b.code', '=', 'pengaduans.id_kelurahan')
                ->join('indonesia_districts as d', 'd.code', '=', 'pengaduans.id_kecamatan')
                ->select('pengaduans.*','b.name_village','d.name_districts','log_pengaduan.tujuan','log_pengaduan.petugas' )
                ->where(function($query) use ($search) {
                    $query->where('pengaduans.no_pendaftaran', 'like', "%$search%");
                });
            
            }
        $total_filtered_items = $query->count();
        if ($request->has('order')) {
            $order_column = $request->order[0]['column'];
            $order_direction = $request->order[0]['dir'];
            $query->orderBy($request->input('columns.' . $order_column . '.data'), $order_direction);
        }
        $data = $query->paginate($request->input('length'));

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
            ->join('users', 'users.id', '=', 'pengaduans.createdby')
            ->join('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'pengaduans.id')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'pengaduans.tujuan')
            ->join('indonesia_villages as b', 'b.code', '=', 'pengaduans.id_kelurahan')
            ->select('pengaduans.*','b.name_village');
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
            if ($user_wilayah->name_roles == 'fasilitator' ) {
                $query = DB::table('pengaduans')
                        ->join('users', 'users.id', '=', 'pengaduans.createdby')
                        ->join('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'pengaduans.id')
                        ->join('indonesia_villages as b', 'b.code', '=', 'pengaduans.id_kelurahan')
                        ->select('pengaduans.*','b.name_village','log_pengaduan.tujuan','log_pengaduan.petugas' )
                        ->orWhere(function($query) use ($user_wilayah) {
                            $query->where('pengaduans.id_kelurahan', $user_wilayah->kelurahan_id)
                                        ->where('log_pengaduan.tujuan','=', $user_wilayah->role_id)
                                        ->where('log_pengaduan.created_by','!=', $user_wilayah->model_id)
                                        ->where(function($query){
                                            $query->where('pengaduans.status_aksi', '=', 'Tolak')
                                                ->orWhere('pengaduans.status_aksi', '=', 'Selesai');
                                        });
                        })->distinct();
            }elseif ($user_wilayah->name_roles == 'Front Office Kelurahan' ) {
                //  dd($user_wilayah->role_id);
                $query = DB::table('pengaduans')
                    ->join('users', 'users.id', '=', 'pengaduans.createdby')
                    ->join('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'pengaduans.id')
                    ->join('indonesia_villages', 'indonesia_villages.code', '=', 'pengaduans.id_kelurahan')
                    ->join('indonesia_districts as d', 'd.code', '=', 'pengaduans.id_kecamatan')
                    ->select('pengaduans.*','d.name_districts','indonesia_villages.name_village','log_pengaduan.tujuan','log_pengaduan.petugas' )
                    ->orWhere(function($query) use ($user_wilayah) {
                        $query->where('pengaduans.id_kelurahan', $user_wilayah->kelurahan_id)
                                    ->where('log_pengaduan.tujuan','=', $user_wilayah->role_id)
                                    ->where('log_pengaduan.created_by','!=', $user_wilayah->model_id)
                                    ->where(function($query){
                                        $query->where('pengaduans.status_aksi', '=', 'Tolak')
                                            ->orWhere('pengaduans.status_aksi', '=', 'Selesai');
                                    });
                    });

            }elseif ($user_wilayah->name_roles == 'Front Office kota' ) {
                //  dd($user_wilayah->role_id);
                $query = DB::table('pengaduans')
                    ->join('users', 'users.id', '=', 'pengaduans.createdby')
                    ->join('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'pengaduans.id')
                    ->join('indonesia_villages', 'indonesia_villages.code', '=', 'pengaduans.id_kelurahan')
                    ->join('indonesia_districts as d', 'd.code', '=', 'pengaduans.id_kecamatan')
                    ->select('pengaduans.*','d.name_districts','indonesia_villages.name_village','log_pengaduan.tujuan','log_pengaduan.petugas' )
                    ->orWhere(function($query) use ($user_wilayah) {
                        $query->where('pengaduans.id_kelurahan', $user_wilayah->kelurahan_id)
                                    ->where('log_pengaduan.tujuan','=', $user_wilayah->role_id)
                                    ->where('log_pengaduan.created_by','!=', $user_wilayah->model_id)
                                    ->where(function($query){
                                        $query->where('pengaduans.status_aksi', '=', 'Tolak')
                                            ->orWhere('pengaduans.status_aksi', '=', 'Selesai');

                        });
                    })->distinct();
            }elseif ($user_wilayah->name_roles == 'Back Ofiice kelurahan' ) {
                // dd($user_wilayah);
                $query = DB::table('pengaduans')
                        ->join('users', 'users.id', '=', 'pengaduans.createdby')
                        ->join('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'pengaduans.id')
                        // ->join('model_has_roles', 'model_has_roles.model_id', '=', 'pengaduans.tujuan')
                        ->join('indonesia_villages as b', 'b.code', '=', 'pengaduans.id_kelurahan')
                        ->select('pengaduans.*','b.name_village','log_pengaduan.tujuan','log_pengaduan.petugas' )
                        ->orWhere(function($query) use ($user_wilayah) {
                            $query->where('pengaduans.id_kelurahan', $user_wilayah->kelurahan_id)
                                         ->where('log_pengaduan.tujuan','!=', $user_wilayah->role_id)
                                         ->where('log_pengaduan.created_by','=', auth::user()->id)
                                         ->where(function($query){
                                             $query->where('pengaduans.status_aksi', '=', 'Tolak')
                                                   ->orWhere('pengaduans.status_aksi', '=', 'Selesai');
                                         });
                        })->distinct();
                // dd($query); 
            }elseif ($user_wilayah->name_roles == 'supervisor' ) {
                // dd($user_wilayah);
                $query = DB::table('pengaduans')
                ->join('users', 'users.id', '=', 'pengaduans.createdby')
                ->join('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'pengaduans.id')
                // ->join('model_has_roles', 'model_has_roles.model_id', '=', 'pengaduans.tujuan')
                ->join('indonesia_villages as b', 'b.code', '=', 'pengaduans.id_kelurahan')
                ->select('pengaduans.*','b.name_village','log_pengaduan.tujuan','log_pengaduan.petugas' )
                ->orWhere(function($query) use ($user_wilayah) {
                    $query->where('pengaduans.id_kelurahan', $user_wilayah->kelurahan_id)
                                 ->where('log_pengaduan.tujuan','!=', $user_wilayah->role_id)
                                 ->where('log_pengaduan.created_by','=', auth::user()->id)
                                 ->where(function($query){
                                     $query->where('pengaduans.status_aksi', '=', 'Tolak')
                                           ->orWhere('pengaduans.status_aksi', '=', 'Selesai');
                                 });
                })->distinct();
               
            }elseif ($user_wilayah->name_roles == 'Back Ofiice Kota' ) {
                // dd($user_wilayah->role_id);
                $query = DB::table('pengaduans')
                        ->join('users', 'users.id', '=', 'pengaduans.createdby')
                        ->join('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'pengaduans.id')
                        // ->join('model_has_roles', 'model_has_roles.model_id', '=', 'pengaduans.tujuan')
                        ->join('indonesia_villages as b', 'b.code', '=', 'pengaduans.id_kelurahan')
                        ->select('pengaduans.*','b.name_village','log_pengaduan.tujuan','log_pengaduan.petugas' )
                        ->orWhere(function($query) use ($user_wilayah) {
                            $query->where('pengaduans.id_kelurahan', $user_wilayah->kelurahan_id)
                                         ->where('log_pengaduan.tujuan','!=', $user_wilayah->role_id)
                                         ->where('log_pengaduan.created_by','=', auth::user()->id)
                                         ->where(function($query){
                                             $query->where('pengaduans.status_aksi', '=', 'Tolak')
                                                   ->orWhere('pengaduans.status_aksi', '=', 'Selesai');
                                         });
                        })->distinct();
                    }elseif ($user_wilayah->name_roles == 'kepala bidang' ) {
                        // dd($user_wilayah);
                        $query = DB::table('pengaduans')
                                ->join('users', 'users.id', '=', 'pengaduans.createdby')
                                ->join('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'pengaduans.id')
                                // ->join('model_has_roles', 'model_has_roles.model_id', '=', 'pengaduans.tujuan')
                                ->join('indonesia_villages as b', 'b.code', '=', 'pengaduans.id_kelurahan')
                                ->select('pengaduans.*','b.name_village','log_pengaduan.tujuan','log_pengaduan.petugas' )
                                ->orWhere(function($query) use ($user_wilayah) {
                                    $query->where('pengaduans.id_kelurahan', $user_wilayah->kelurahan_id)
                                                 ->where('log_pengaduan.tujuan','=', $user_wilayah->role_id)
                                                 ->where('log_pengaduan.petugas','=', $user_wilayah->model_id)
                                                 ->where(function($query){
                                                     $query->where('pengaduans.status_aksi', '=', 'Tolak')
                                                           ->orWhere('pengaduans.status_aksi', '=', 'Selesai');
                                                 });
                                });
                            }
           
        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $query = DB::table('pengaduans')
            ->join('users', 'users.id', '=', 'pengaduans.createdby')
            ->join('wilayahs', 'wilayahs.createdby', '=', 'users.id')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'pengaduans.tujuan')
            ->join('indonesia_villages as b', 'b.code', '=', 'pengaduans.id_kelurahan')
            ->select('pengaduans.*','b.name_village')
            ->where(function($query) use ($search) {
                $query->where('pengaduans.no_pendaftaran', 'like', "%$search%");
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
    public function prelistPage(Request $request){
        return view('pengaduans.index');
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
            'no_kis',
            'nama',
            'tgl_lahir',
            'alamat',
            'telp',
            'status_data',
            'email'
        ];

        // $query = Prelist::where('status_data', 'prelistdtks');
        $query = DB::table('prelist')
            ->join('indonesia_districts as a', 'a.code', '=', 'prelist.id_kecamatan')
            ->join('indonesia_villages as b', 'b.code', '=', 'prelist.id_kelurahan')
            ->select('prelist.*','a.name_districts','b.name_village');
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
                'no_kis' => $item->no_kis,
                'nama' => $item->nama,
                'tgl_lahir' => $item->tgl_lahir,
                'alamat' => $item->alamat,
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
    public function detail_pengaduan($id)
    {
        $data2 = DB::table('pengaduans as w')->select(
            'w.*',
            'b.name_village',
            'prov.name_prov',
            'kota.name_cities',
            'kecamatan.name_districts',
            // 'w.status_wilayah',
        )
        ->leftjoin('indonesia_provinces as prov', 'prov.code', '=', 'w.id_provinsi')
        ->leftjoin('indonesia_cities as kota', 'kota.code', '=', 'w.id_kabkot')
        ->leftjoin('indonesia_districts as kecamatan', 'kecamatan.code', '=', 'w.id_kecamatan')
        ->leftjoin('indonesia_villages as b', 'b.code', '=', 'w.id_kelurahan')
        ->where('w.id', $id)->first();
        $data = [
            'data' => $data2
            // 'data' => $data2
          ];
        return response()->json($data);
    }
    public function log_detail_pengaduan(Request $request, $id)
    {
        $user_name = Auth::user()->name;
            $query = DB::table('pengaduans')
                // ->join('users', 'users.id', '=', 'pengaduans.createdby')
                ->join('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'pengaduans.id')
                ->select('pengaduans.*');
    
            // dd($user_wilayah);
                // Add where conditions based on user's wilayah data

        
        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $query = DB::table('pengaduans')
            // ->join('users', 'users.id', '=', 'pengaduans.createdby')
            ->join('log_pengaduan', 'log_pengaduan.id_trx_pengaduan', '=', 'pengaduans.id')
            ->select('pengaduans.*')
            ->where(function($query) use ($search) {
                $query->where('pengaduans.no_pendaftaran', 'like', "%$search%");
            });
        
        }
        
        // Get total count of filtered items
        $total_filtered_items = $query->count();
        // dd($total_filtered_items);
        // Add ordering
        if ($request->has('order')) {
            $order_column = $request->order[0]['column'];
            $order_direction = $request->order[0]['dir'];
            $query->orderBy($request->input('columns.' . $order_column . '.data'), $order_direction);
        }
        // Get paginated data
        // dd($query->paginate());
        // $data = $query->paginate($request->input('length'));
        // dd($data);
        // mengubah data JSON menjadi objek PHP
        $data = DB::table('log_pengaduan')
        ->join('users as a', 'a.id', '=', 'log_pengaduan.created_by')
        // ->join('users as b', 'b.id', '=', 'pengaduans.createdby')
        ->join('pengaduans', 'pengaduans.id', '=', 'log_pengaduan.id_trx_pengaduan')
        ->select('a.name', 'pengaduans.status_aksi','pengaduans.tl_file','pengaduans.tl_catatan','pengaduans.created_at')
        // ->select('a.name')
        ->where('log_pengaduan.id_trx_pengaduan',$id)->get();
        // dd($data);
        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => Pengaduan::count(),
            'recordsFiltered' => $total_filtered_items,
            'data' => $data,
        ]);
    }
}
