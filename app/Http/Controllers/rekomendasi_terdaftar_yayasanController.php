<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createrekomendasi_terdaftar_yayasanRequest;
use App\Http\Requests\Updaterekomendasi_terdaftar_yayasanRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\logYayasan;
use App\Models\Prelist;
use App\Models\rekomendasi_terdaftar_yayasan;
use App\Models\Roles;
use App\Repositories\rekomendasi_terdaftar_yayasanRepository;
use Illuminate\Http\Request;
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
}
