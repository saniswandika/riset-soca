<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createrekomendasi_pengangkatan_anakRequest;
use App\Http\Requests\Updaterekomendasi_pengangkatan_anakRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\rekomendasi_pengangkatan_anakRepository;
use Illuminate\Http\Request;
use Flash;

class rekomendasi_pengangkatan_anakController extends AppBaseController
{
    /** @var rekomendasi_pengangkatan_anakRepository $rekomendasiPengangkatanAnakRepository*/
    private $rekomendasiPengangkatanAnakRepository;

    public function __construct(rekomendasi_pengangkatan_anakRepository $rekomendasiPengangkatanAnakRepo)
    {
        $this->rekomendasiPengangkatanAnakRepository = $rekomendasiPengangkatanAnakRepo;
    }

    /**
     * Display a listing of the rekomendasi_pengangkatan_anak.
     */
    public function index(Request $request)
    {
        $rekomendasiPengangkatanAnaks = $this->rekomendasiPengangkatanAnakRepository->paginate(10);

        return view('rekomendasi_pengangkatan_anaks.index')
            ->with('rekomendasiPengangkatanAnaks', $rekomendasiPengangkatanAnaks);
    }

    /**
     * Show the form for creating a new rekomendasi_pengangkatan_anak.
     */
    public function create()
    {
        return view('rekomendasi_pengangkatan_anaks.create');
    }

    /**
     * Store a newly created rekomendasi_pengangkatan_anak in storage.
     */
    public function store(Createrekomendasi_pengangkatan_anakRequest $request)
    {
        $input = $request->all();

        $rekomendasiPengangkatanAnak = $this->rekomendasiPengangkatanAnakRepository->create($input);

        Flash::success('Rekomendasi Pengangkatan Anak saved successfully.');

        return redirect(route('rekomendasi_pengangkatan_anaks.index'));
    }

    /**
     * Display the specified rekomendasi_pengangkatan_anak.
     */
    public function show($id)
    {
        $rekomendasiPengangkatanAnak = $this->rekomendasiPengangkatanAnakRepository->find($id);

        if (empty($rekomendasiPengangkatanAnak)) {
            Flash::error('Rekomendasi Pengangkatan Anak not found');

            return redirect(route('rekomendasi_pengangkatan_anaks.index'));
        }

        return view('rekomendasi_pengangkatan_anaks.show')->with('rekomendasiPengangkatanAnak', $rekomendasiPengangkatanAnak);
    }

    /**
     * Show the form for editing the specified rekomendasi_pengangkatan_anak.
     */
    public function edit($id)
    {
        $rekomendasiPengangkatanAnak = $this->rekomendasiPengangkatanAnakRepository->find($id);

        if (empty($rekomendasiPengangkatanAnak)) {
            Flash::error('Rekomendasi Pengangkatan Anak not found');

            return redirect(route('rekomendasi_pengangkatan_anaks.index'));
        }

        return view('rekomendasi_pengangkatan_anaks.edit')->with('rekomendasiPengangkatanAnak', $rekomendasiPengangkatanAnak);
    }

    /**
     * Update the specified rekomendasi_pengangkatan_anak in storage.
     */
    public function update($id, Updaterekomendasi_pengangkatan_anakRequest $request)
    {
        $rekomendasiPengangkatanAnak = $this->rekomendasiPengangkatanAnakRepository->find($id);

        if (empty($rekomendasiPengangkatanAnak)) {
            Flash::error('Rekomendasi Pengangkatan Anak not found');

            return redirect(route('rekomendasi_pengangkatan_anaks.index'));
        }

        $rekomendasiPengangkatanAnak = $this->rekomendasiPengangkatanAnakRepository->update($request->all(), $id);

        Flash::success('Rekomendasi Pengangkatan Anak updated successfully.');

        return redirect(route('rekomendasi_pengangkatan_anaks.index'));
    }

    /**
     * Remove the specified rekomendasi_pengangkatan_anak from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rekomendasiPengangkatanAnak = $this->rekomendasiPengangkatanAnakRepository->find($id);

        if (empty($rekomendasiPengangkatanAnak)) {
            Flash::error('Rekomendasi Pengangkatan Anak not found');

            return redirect(route('rekomendasi_pengangkatan_anaks.index'));
        }

        $this->rekomendasiPengangkatanAnakRepository->delete($id);

        Flash::success('Rekomendasi Pengangkatan Anak deleted successfully.');

        return redirect(route('rekomendasi_pengangkatan_anaks.index'));
    }
}
