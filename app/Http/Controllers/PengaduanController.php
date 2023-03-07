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
        // if($request->ajax()){
           
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
    public function store(CreatePengaduanRequest $request)
    {
        $input = $request->all();

        $pengaduan = $this->pengaduanRepository->create($input);

        Flash::success('Pengaduan saved successfully.');

        return redirect(route('pengaduans.index'));
    }

    /**
     * Display the specified Pengaduan.
     */
    public function show($id)
    {
        $pengaduan = $this->pengaduanRepository->find( (int)$id);

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
    public function update($id, UpdatePengaduanRequest $request)
    {
        $pengaduan = $this->pengaduanRepository->find($id);

        if (empty($pengaduan)) {
            Flash::error('Pengaduan not found');

            return redirect(route('pengaduans.index'));
        }

        $pengaduan = $this->pengaduanRepository->update($request->all(), $id);

        Flash::success('Pengaduan updated successfully.');

        return redirect(route('pengaduans.index'));
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

            return redirect(route('pengaduans.index'));
        }

        $this->pengaduanRepository->delete($id);

        Flash::success('Pengaduan deleted successfully.');

        return redirect(route('pengaduans.index'));
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
    
        $query = Pengaduan::where('id_alur', '1');
    
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
                'no_pendaftaran'=> $item->no_pendaftaran,
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
    
        $query = Pengaduan::where('id_alur', '36');
    
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
                'no_pendaftaran'=> $item->no_pendaftaran,
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
    
        $query = Pengaduan::where('id_alur', '36');
    
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
                'no_pendaftaran'=> $item->no_pendaftaran,
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
    
        $query = Pengaduan::where('id_alur', '36');
    
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
                'no_pendaftaran'=> $item->no_pendaftaran,
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

    public function search(Request $request)
    {
        $query = $request->input('query');
        $data = Pengaduan::where('name', 'like', '%' . $query . '%')
            ->orWhere('status', 'like', '%' . $query . '%')
            ->paginate(10);
        return view('pengaduans.index', compact('data'));
    }
}