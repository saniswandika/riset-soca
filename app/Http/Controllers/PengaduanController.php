<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePengaduanRequest;
use App\Http\Requests\UpdatePengaduanRequest;
use App\Http\Controllers\AppBaseController;
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
        $userid = Auth::user()->id;
        $wilayah = DB::table('wilayahs as w')->select(
            'w.id',
            'b.name_village',
            'w.kelurahan_id',
            'w.kecamatan_id',
            'prov.name_prov',
            'kota.name_cities',
            'kecamatan.name_districts',
            'w.status_wilayah',
            'w.createdby',
        )
            ->leftjoin('indonesia_provinces as prov', 'prov.code', '=', 'w.province_id')
            ->leftjoin('indonesia_cities as kota', 'kota.code', '=', 'w.kota_id')
            ->leftjoin('indonesia_districts as kecamatan', 'kecamatan.code', '=', 'w.kecamatan_id')
            ->leftjoin('indonesia_villages as b', 'b.code', '=', 'w.kelurahan_id')
            ->where('status_wilayah', '1')
            ->where('w.createdby', $userid)->get();
        $alur = DB::table('alur')
            ->where('name', 'Draft')
            // ->where('name', 'supervisor')
            ->orWhere('name', 'Teruskan')
            ->get();
        $roleid = DB::table('roles')
                    ->where('name', 'Back Ofiice kelurahan')
                    // ->where('name', 'supervisor')
                    ->orWhere('name', 'supervisor')
                    ->get();
        $rolebackoffice = DB::table('roles')
                    ->where('name', 'Back Ofiice kelurahan')
                    // ->where('name', 'supervisor')
                    // ->orWhere('name', 'supervisor')
                    ->get();           
        $checkroles = DB::table('model_has_roles')
                ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                ->where('model_id','=', $userid)
                ->get();
        // $checkroles = DB::table('model_has_roles')->where('model_id','=', $userid);
        // dd($alur);
        return view('pengaduans.create', compact('wilayah', 'roleid','checkroles','rolebackoffice','alur'));
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
                $data['no_kis'] = $request->get('no_kis');
                $data['nama'] = $request->get('nama');
                $data['tgl_lahir'] = $request->get('tgl_lahir');
                $data['tempat_lahir'] = $request->get('tempat_lahir');
                $data['alamat'] = $request->get('alamat');
                $data['telp'] = $request->get('telpon');
                $data['email'] = $request->get('email');
                $data['hubungan_terlapor'] = $request->get('hubungan_terlapor');
                $data['kepesertaan_program'] = $request->get('kepesertaan_program');
                $data['kategori_pengaduan'] = $request->get('kategori_pengaduan');
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
                return redirect('pengaduans')->withSuccess('Data Berhasil Disimpan');
            } else {
                //nik ada, dtks tidak

                //cek apakah sudah ada
                $cek = Prelist::where('nik', '=', $request->get('nik'))->exists();
                if ($cek) {
                    return redirect('pengaduans')->withWarning('NIK Sudah Terdaftar Di Prelist');
                } else {
                    $data = new Prelist;
                    $data['id_provinsi'] = $request->get('id_provinsi');
                    $data['id_kabkot'] = $request->get('id_kabkot');
                    $data['id_kecamatan'] = $request->get('id_kecamatan');
                    $data['id_kelurahan'] = $request->get('id_kelurahan');
                    $data['nik'] = $request->get('nik');
                    $data['no_kk'] = $request->get('no_kk');
                    $data['no_kis'] = $request->get('no_kis');
                    $data['nama'] = $request->get('nama');
                    $data['tgl_lahir'] = $request->get('tgl_lahir');
                    $data['alamat'] = $request->get('alamat');
                    $data['telp'] = $request->get('telpon');
                    $data['email'] = $request->get('email');
                    $data['status_data'] = 'prelistdtks';

                    $data->save();
                    return redirect('pengaduans')->withSuccess('Data Berhasil Disimpan Di Prelist');
                }
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
            $data['no_kis'] = $request->get('no_kis');
            $data['nama'] = $request->get('nama');
            $data['tgl_lahir'] = $request->get('tgl_lahir');
            $data['alamat'] = $request->get('alamat');
            $data['telp'] = $request->get('telpon');
            $data['email'] = $request->get('email');
            $data['hubungan_terlapor'] = $request->get('hubungan_terlapor');
            $data['kepesertaan_program'] = $request->get('kepesertaan_program');
            $data['kategori_pengaduan'] = $request->get('kategori_pengaduan');
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
        $pengaduan = $this->pengaduanRepository->find((int) $id);

        if (empty($pengaduan)) {
            Flash::error('Pengaduan not found');

            return redirect(route('pengaduans.index'));
        }
        $roleid = DB::table('roles')
            ->where('name', 'Back Ofiice kelurahan')
            // ->where('name', 'supervisor')
            ->orWhere('name', 'supervisor')
            ->get();

        return view('pengaduans.show', compact('pengaduan', 'roleid'));
    }

    /**
     * Show the form for editing the specified Pengaduan.
     */
    public function edit($id)
    {
        $userid = Auth::user()->id;
        $wilayah = DB::table('wilayahs as w')->select(
            'w.id',
            'b.name_village',
            'w.kelurahan_id',
            'prov.name_prov',
            'kota.name_cities',
            'kecamatan.name_districts',
            'w.status_wilayah',
            'w.createdby',
        )
            ->leftjoin('indonesia_provinces as prov', 'prov.code', '=', 'w.province_id')
            ->leftjoin('indonesia_cities as kota', 'kota.code', '=', 'w.kota_id')
            ->leftjoin('indonesia_districts as kecamatan', 'kecamatan.code', '=', 'w.kecamatan_id')
            ->leftjoin('indonesia_villages as b', 'b.code', '=', 'w.kelurahan_id')
            ->where('status_wilayah', '1')
            ->where('w.createdby', $userid)->get();
        $roleid = DB::table('roles')
            ->where('name', 'Back Ofiice kelurahan')
            // ->where('name', 'supervisor')
            ->orWhere('name', 'supervisor')
            ->get();

        $pengaduan = $this->pengaduanRepository->find($id);
        return view('pengaduans.edit', compact('wilayah', 'pengaduan', 'roleid'));
    }

    /**
     * Update the specified Pengaduan in storage.
     */
    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::find($id);
        if ($request->get('nik') != null) {
            if ($request->get('no_dtks') != null) {
                
                // dd($pengaduan);
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
                $data['no_kis'] = $request->get('no_kis');
                $data['nama'] = $request->get('nama');
                $data['tgl_lahir'] = $request->get('tgl_lahir');
                $data['tempat_lahir'] = $request->get('tempat_lahir');
                $data['alamat'] = $request->get('alamat');
                $data['telp'] = $request->get('telpon');
                $data['email'] = $request->get('email');
                $data['hubungan_terlapor'] = $request->get('hubungan_terlapor');
                $data['kepesertaan_program'] = $request->get('kepesertaan_program');
                $data['kategori_pengaduan'] = $request->get('kategori_pengaduan');
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
                Pengaduan::where('id',$id)->update($data);

                return redirect('pengaduans')->withSuccess('Data Berhasil Diubah');
            } else {
                $cek = Prelist::where('nik', '=', $request->get('nik'))->exists();
                if ($cek) {
                    return redirect('pengaduans')->withWarning('NIK Sudah Terdaftar Di Prelist');
                } else {

                    $data['id_provinsi'] = $request->get('id_provinsi');
                    $data['id_kabkot'] = $request->get('id_kabkot');
                    $data['id_kecamatan'] = $request->get('id_kecamatan');
                    $data['id_kelurahan'] = $request->get('id_kelurahan');
                    $data['nik'] = $request->get('nik');
                    $data['no_kk'] = $request->get('no_kk');
                    $data['no_kis'] = $request->get('no_kis');
                    $data['nama'] = $request->get('nama');
                    $data['tgl_lahir'] = $request->get('tgl_lahir');
                    $data['alamat'] = $request->get('alamat');
                    $data['telp'] = $request->get('telpon');
                    $data['email'] = $request->get('email');
                    $data['status_data'] = 'prelistdtks';

                    Prelist::where('id',$id)->update($data);
                    return redirect('pengaduans')->withSuccess('Data Berhasil Disimpan Di Prelist');
                }
            }
        } else {
           
                // dd($pengaduan);
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
                $data['no_kis'] = $request->get('no_kis');
                $data['nama'] = $request->get('nama');
                $data['tgl_lahir'] = $request->get('tgl_lahir');
                $data['tempat_lahir'] = $request->get('tempat_lahir');
                $data['alamat'] = $request->get('alamat');
                $data['telp'] = $request->get('telpon');
                $data['email'] = $request->get('email');
                $data['hubungan_terlapor'] = $request->get('hubungan_terlapor');
                $data['kepesertaan_program'] = $request->get('kepesertaan_program');
                $data['kategori_pengaduan'] = $request->get('kategori_pengaduan');
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

                Pengaduan::where('id',$id)->update($data);

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

        $columns = [
            // daftar kolom yang akan ditampilkan pada tabel
            'no_pendaftaran',
            'created_at',
            'jenis_pelapor',
            'nik',
            'no_kk',
            'nama',
            'id_kelurahan',
            'kepesertaan_program',
            'ringkasan_pengaduan',
            'tl_catatan',
            'createdby',
        ];

        $query = Pengaduan::where('status_aksi', 1);

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
        $formattedData = [];
        foreach ($data as $item) {
            $formattedData[] = [
                'id' => $item->id,
                'no_pendaftaran' => $item->no_pendaftaran,
                'id_kelurahan' => $item->id_kelurahan,
                'jenis_pelapor' => $item->jenis_pelapor,
                'nik' => $item->nik,
                'no_kk' => $item->no_kk,
                'nama' => $item->nama,
                'kepesertaan_program' => $item->kepesertaan_program,
                'ringkasan_pengaduan' => $item->ringkasan_pengaduan,
                'tl_catatan' => $item->tl_catatan,
                'createdby' => $item->createdby,
                'created_at' => $item->created_at
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

    public function diproses(Request $request)
    {

        $query = DB::table('pengaduans')
            ->leftjoin('users', 'users.id', '=', 'pengaduans.tujuan')
            ->leftjoin('wilayahs', 'wilayahs.createdby', '=', 'pengaduans.tujuan')
            ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'pengaduans.tujuan')
            ->leftjoin('indonesia_villages as b', 'b.code', '=', 'pengaduans.id_kelurahan')
            ->select('pengaduans.*', 'b.name_village');
        // Get the authenticated user's ID and wilayah data
        $user_id = Auth::user()->id;
        $user_wilayah = DB::table('wilayahs')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'wilayahs.createdby')
            ->where('createdby', $user_id)
            ->where(function ($query) {
                $query->where('status_wilayah', 1);
            })
            ->get();
        // Add where conditions based on user's wilayah data
        foreach ($user_wilayah as $key => $value) {
            if ($value->role_id == 4 ) {
                $query->orWhere(function($query) use ($value) {
                    $query->where('pengaduans.id_kecamatan', $value->kecamatan_id)
                        ->where('pengaduans.tujuan', $value->role_id)
                        ->orWhere('model_has_roles.model_id', $value->role_id)
                        ->where(function($query) {
                            $query->where('wilayahs.status_wilayah', 1);
                        });
                });
            }
            $query->orWhere(function($query) use ($value) {
             
                $query->where('pengaduans.id_kelurahan', $value->kelurahan_id)
                    ->where('pengaduans.tujuan', $value->role_id)
                    ->Where('model_has_roles.role_id', $value->role_id)
                    ->where(function($query) {
                        $query->where('wilayahs.status_wilayah', 1);
                    });
            });
        }
        // Add searchable fields
        if ($request->filled('search')) {
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

    public function dikembalikan(Request $request)
    {
        $columns = [
            // daftar kolom yang akan ditampilkan pada tabel
            'no_pendaftaran',
            'created_at',
            'jenis_pelapor',
            'nik',
            'no_kk',
            'nama',
            'id_kelurahan',
            'kepesertaan_program',
            'ringkasan_pengaduan',
            'tl_catatan',
            'createdby',
        ];

        $query = Pengaduan::where('status_aksi', 4);

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
        $formattedData = [];
        foreach ($data as $item) {
            $formattedData[] = [
                'id' => $item->id,
                'no_pendaftaran' => $item->no_pendaftaran,
                'id_kelurahan' => $item->id_kelurahan,
                'jenis_pelapor' => $item->jenis_pelapor,
                'nik' => $item->nik,
                'no_kk' => $item->no_kk,
                'nama' => $item->nama,
                'kepesertaan_program' => $item->kepesertaan_program,
                'ringkasan_pengaduan' => $item->ringkasan_pengaduan,
                'tl_catatan' => $item->tl_catatan,
                'createdby' => $item->createdby,
                'created_at' => $item->created_at
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

    public function selesai(Request $request)
    {
        $columns = [
            // daftar kolom yang akan ditampilkan pada tabel
            'no_pendaftaran',
            'created_at',
            'jenis_pelapor',
            'nik',
            'no_kk',
            'nama',
            'id_kelurahan',
            'kepesertaan_program',
            'ringkasan_pengaduan',
            'tl_catatan',
            'createdby',
        ];

        $query = Pengaduan::where('status_aksi', 1);

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
        $formattedData = [];
        foreach ($data as $item) {
            $formattedData[] = [
                'id' => $item->id,
                'no_pendaftaran' => $item->no_pendaftaran,
                'id_kelurahan' => $item->id_kelurahan,
                'jenis_pelapor' => $item->jenis_pelapor,
                'nik' => $item->nik,
                'no_kk' => $item->no_kk,
                'nama' => $item->nama,
                'kepesertaan_program' => $item->kepesertaan_program,
                'ringkasan_pengaduan' => $item->ringkasan_pengaduan,
                'tl_catatan' => $item->tl_catatan,
                'createdby' => $item->createdby,
                'created_at' => $item->created_at
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
        $query = Prelist::where('status_data', 'prelistdtks');
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
        $formattedData = [];
        foreach ($data as $item) {
            $formattedData[] = [
                'id_provinsi' => $item->id_provinsi,
                'id_kabkot' => $item->id_kabkot,
                'id_kecamatan' => $item->id_kecamatan,
                'id_kelurahan' => $item->id_kelurahan,
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