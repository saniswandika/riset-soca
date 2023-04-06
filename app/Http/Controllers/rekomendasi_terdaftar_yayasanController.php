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

        if ($request->file('filektp') != null) {
            $filektp = $request->file('filektp');
            $nama_filektp = time() . "_" . $filektp->getClientOriginalName();
            $tujuan = 'upload/ktp/';
            $filektp->move($tujuan, $nama_filektp);
        } elseif ($request->filektp != null) {
            $nama_filektp = $getdata->nama_filektp;
        } else {
            $nama_filektp = null;
        }

        //programtahunan
        if ($request->file('filekk') != null) {
            $filekk = $request->file('filekk');
            $nama_filekk = time() . "." . $filekk->getClientOriginalName();
            $tujuan = 'upload/kk/';
            $filekk->move($tujuan, $nama_filekk);
        } elseif ($request->filekk != null) {
            $nama_filekk = $getdata->nama_filekk;
        } else {
            $nama_filekk = null;
        }

        //silabus
        if ($request->file('suket') != null) {
            $suket = $request->file('suket');
            $nama_filesuket = time() . "." . $suket->getClientOriginalName();
            $tujuan = 'upload/suket/';
            $suket->move($tujuan, $nama_filesuket);
        } elseif ($request->suket != null) {
            $nama_filesuket = $getdata->suket;
        } else {
            $nama_filesuket = null;
        }

        //kkm
        if ($request->file('draftfrom') != null) {
            $draftfrom = $request->file('draftfrom');
            $nama_filedraftfrom = time() . "." . $draftfrom->getClientOriginalName();
            $tujuan = 'upload/draftFrom/';
            $draftfrom->move($tujuan, $nama_filedraftfrom);
        } elseif ($request->draftfrom != null) {
            $nama_filedraftfrom = $getdata->draftfrom;
        } else {
            $nama_filedraftfrom = null;
        }

        $data = new rekomendasi_terdaftar_yayasan();
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
        // $data['alamat'] = $request->get('alamat');
        $data['telp'] = $request->get('telpon');
        $data['alamat'] = $request->get('alamat');
        $data['filektp'] = $nama_filektp;
        $data['filekk'] = $nama_filekk;
        $data['suket'] = $nama_filesuket;
        $data['draftfrom']  = $nama_filedraftfrom;
        $data['catatan']  = $request->get('catatan');
        // $data['tl_file']  = $request->get('catatan');
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
        $logpengaduan['file_pendukung'] = $request->get('file_pendukung');
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
        if ($request->file('filektp') != null) {
            $filektp = $request->file('filektp');
            $nama_filektp = time() . "_" . $filektp->getClientOriginalName();
            $tujuan = 'upload/ktp/';
            $filektp->move($tujuan, $nama_filektp);
            $data['filektp'] = $nama_filektp;
        } elseif ($request->filektp != null) {
            $data['filektp'] = $getdata->nama_filektp;
        }

        //programtahunan
        if ($request->file('filekk') != null) {
            $filekk = $request->file('filekk');
            $nama_filekk = time() . "." . $filekk->getClientOriginalName();
            $tujuan = 'upload/kk/';
            $filekk->move($tujuan, $nama_filekk);
            $data['filekk'] = $nama_filekk;
        } elseif ($request->filekk != null) {
            $data['filekk'] = $getdata->nama_filekk;
        }

        //silabus
        if ($request->file('suket') != null) {
            $suket = $request->file('suket');
            $nama_filesuket = time() . "." . $suket->getClientOriginalName();
            $tujuan = 'upload/suket/';
            $suket->move($tujuan, $nama_filesuket);
            $data['suket'] = $nama_filesuket;
        } elseif ($request->suket != null) {
            $data['suket'] = $getdata->suket;
        }

        //kkm
        if ($request->file('draftfrom') != null) {
            $draftfrom = $request->file('draftfrom');
            $nama_filedraftfrom = time() . "." . $draftfrom->getClientOriginalName();
            $tujuan = 'upload/draftFrom/';
            $draftfrom->move($tujuan, $nama_filedraftfrom);
            $data['draftfrom'] = $nama_filedraftfrom;
        } elseif ($request->draftfrom != null) {
            $data['draftfrom'] = $getdata->draftfrom;
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
