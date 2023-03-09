<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePengaduanRequest;
use App\Http\Requests\UpdatePengaduanRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PengaduanRepository;
use Illuminate\Http\Request;
use app\Models\Pengaduan;
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
        // dd($wilayah);
        return view('pengaduans.create', compact('wilayah'));
    }

    /**
     * Store a newly created Pengaduan in storage.
     */
    public function store(Request $request)
    {
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
        $data['keluhan_tipe'] = $request->get('keluhan_tipe');
        $data['keluhan_id_program'] = $request->get('keluhan_id_program');
        $data['keluhan_detail']  = $request->get('keluhan_detail');
        // $data['keluhan_foto']  = $request->get('detail_pengaduan');
        // $data['tl_catatan']  = $request->get('detail_pengaduan');
        // $data['tl_file']  = $request->get('detail_pengaduan');
        $data['no_dtks']  = $request->get('no_dtks');
        $data['diteruskan'] = $request->get('diteruskan');
        $data['status_data'] = 'diproses';
        $data['createdby']  = Auth::user()->name;
        $data['updatedby']  = Auth::user()->name;
        if($data['nik'] == null){
            $data['prelist_dtks'] = '1';
           
            $data['status_data'] = 'draft';
        };
        // dd($data);   
        $data->save();
        return redirect('pengaduans')->withSuccess('Data Berhasil Disimpan');
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

        return view('pengaduans.show')->with('pengaduan', $pengaduan);
    }

    /**
     * Show the form for editing the specified Pengaduan.
     */
    public function edit($id)
    {
        $pengaduan = $this->pengaduanRepository->find($id);

        if (empty($pengaduan)) {
            Flash::error('Pengaduan not found');

            return redirect(route('pengaduans.index'));
        }

        return view('pengaduans.edit')->with('pengaduan', $pengaduan);
    }

    /**
     * Update the specified Pengaduan in storage.
     */
    public function update(Request $request)
    {
        $pengaduan = Pengaduan::find($request->hidden_id);

        $pengaduan->id_provinsi = $request->get('id_provinsi');
        $pengaduan->id_kabkot = $request->get('id_kabkot');
        $pengaduan->id_kecamatan = $request->get('id_kecamatan');
        $pengaduan->id_kelurahan = $request->get('id_kelurahan');
        $pengaduan->jenis_pelapor = $request->get('jenis_pelaporan');
        $pengaduan->ada_nik = $request->get('memiliki_nik');
        $pengaduan->nik = $request->get('nik');
        $pengaduan->no_kk = $request->get('no_kk');
        $pengaduan->no_kis = $request->get('no_kis');
        $pengaduan->nama = $request->get('nama');
        $pengaduan->tgl_lahir = $request->get('tempat_lahir');
        $pengaduan->alamat = $request->get('alamat');
        $pengaduan->telp = $request->get('telpon');
        $pengaduan->email = $request->get('email');
        $pengaduan->hubungan_terlapor = $request->get('hubungan_terlapor');
        $pengaduan->file_penunjang = $request->get('file_penunjang');
        $pengaduan->keluhan_tipe = $request->get('Progam_pengaduan');
        $pengaduan->keluhan_id_program = $request->get('Progam_pengaduan');
        $pengaduan->keluhan_detail = $request->get('detail_pengaduan');
        $pengaduan->keluhan_foto = $request->get('detail_pengaduan');
        $pengaduan->tl_catatan = $request->get('detail_pengaduan');
        $pengaduan->tl_file = $request->get('detail_pengaduan');
        $pengaduan->ada_dtks = $request->get('no_dtks');
        $pengaduan->createdby = Auth::user()->name;
        $pengaduan->updatedby = Auth::user()->name;

        $pengaduan->save();

        return redirect('pengaduans')->withSuccess('Data Berhasil Diubah');
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
            'keluhan_id_program',
            'keluhan_detail',
            'tl_catatan',
            'createdby',
        ];

        $query = Pengaduan::where('status_data', 'draft');

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
                'keluhan_id_program' => $item->keluhan_id_program,
                'keluhan_detail' => $item->keluhan_detail,
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
        
        
        $columns = [
            // daftar kolom yang akan ditampilkan pada tabel
            'no_pendaftaran',
            'created_at',
            'jenis_pelapor',
            'nik',
            'no_kk',
            'nama',
            'id_kelurahan',
            'keluhan_id_program',
            'keluhan_detail',
            'tl_catatan',
            'createdby',
        ];

        $query = Pengaduan::where('status_data', 'diproses');

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
                'keluhan_id_program' => $item->keluhan_id_program,
                'keluhan_detail' => $item->keluhan_detail,
                'tl_catatan' => $item->tl_catatan,
                'createdby' => $item->createdby,
                'created_at' => $item->created_at,
            ];
        }

        // mengembalikan data dalam format JSON
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => Pengaduan::count(),
            'recordsFiltered' => $data->total(),
            'data' => $formattedData,
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
            'keluhan_id_program',
            'keluhan_detail',
            'tl_catatan',
            'createdby',
        ];

        $query = Pengaduan::where('status_data', 'dikembalikan');

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
                'keluhan_id_program' => $item->keluhan_id_program,
                'keluhan_detail' => $item->keluhan_detail,
                'tl_catatan' => $item->tl_catatan,
                'createdby' => $item->createdby,
                'created_at' => $item->created_at,
            ];
        }

        // mengembalikan data dalam format JSON
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => Pengaduan::count(),
            'recordsFiltered' => $data->total(),
            'data' => $formattedData,
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
            'keluhan_id_program',
            'keluhan_detail',
            'tl_catatan',
            'createdby',
        ];

        $query = Pengaduan::where('status_data', 'selesai');

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
                'keluhan_id_program' => $item->keluhan_id_program,
                'keluhan_detail' => $item->keluhan_detail,
                'tl_catatan' => $item->tl_catatan,
                'createdby' => $item->createdby,
                'created_at' => $item->created_at,
            ];
        }

        // mengembalikan data dalam format JSON
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => Pengaduan::count(),
            'recordsFiltered' => $data->total(),
            'data' => $formattedData,
        ]);
    }
     public function prelistDTKS(Request $request)
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
            'keluhan_id_program',
            'keluhan_detail',
            'tl_catatan',
            'createdby',
            'prelist_dtks'
        ];

        $query = Pengaduan::where('prelist_dtks', '1');


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
                'keluhan_id_program' => $item->keluhan_id_program,
                'keluhan_detail' => $item->keluhan_detail,
                'tl_catatan' => $item->tl_catatan,
                'createdby' => $item->createdby,
                'created_at' => $item->created_at,
                 'prelist_dtks' => $item->prelist_dtks,
            ];
        }

        // mengembalikan data dalam format JSON
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => Pengaduan::count(),
            'recordsFiltered' => $data->total(),
            'data' => $formattedData,
        ]);
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