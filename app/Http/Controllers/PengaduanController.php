<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePengaduanRequest;
use App\Http\Requests\UpdatePengaduanRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PengaduanRepository;
use Illuminate\Http\Request;
use app\Models\Pengaduan;
use Flash;

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
        // $pengaduans = pengaduan::where([
        //     ['no_pendaftaran', '!=', Null],
        //     [function ($query) use ($request) {
        //         if (($s = $request->s)) {
        //             $query->orWhere('name', 'LIKE', '%' . $s . '%')
        //                 ->orWhere('email', 'LIKE', '%' . $s . '%')
        //                 ->get();
        //         }
        //     }]
        // ])->paginate(5);

        $pengaduans = pengaduan::latest()->paginate(5);

        return view('pengaduans.index', compact('pengaduans'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new Pengaduan.
     */
    public function create()
    {
        return view('pengaduans.create');
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
    public function draft()
    {
        $pengaduans = Pengaduan::latest()->paginate(5);
        return view('pengaduans.index', compact('pengaduans'));
    }

    public function diproses()
    {
        $pengaduans = Pengaduan::latest()->paginate(5);
        return view('pengaduans.index', compact('pengaduans'));
    }

    public function dikembalikan()
    {
        $pengaduans = Pengaduan::latest()->paginate(5);
        return view('pengaduans.index', compact('pengaduans'));
    }

    public function selesai()
    {
        $pengaduans = Pengaduan::latest()->paginate(5);
        return view('pengaduans.index', compact('pengaduans'));
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