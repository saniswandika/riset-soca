<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createrekomendasi_biaya_perawatanRequest;
use App\Http\Requests\Updaterekomendasi_biaya_perawatanRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\rekomendasi_biaya_perawatanRepository;
use Illuminate\Http\Request;
use Flash;

class rekomendasi_biaya_perawatanController extends AppBaseController
{
    /** @var rekomendasi_biaya_perawatanRepository $rekomendasiBiayaPerawatanRepository*/
    private $rekomendasiBiayaPerawatanRepository;

    public function __construct(rekomendasi_biaya_perawatanRepository $rekomendasiBiayaPerawatanRepo)
    {
        $this->rekomendasiBiayaPerawatanRepository = $rekomendasiBiayaPerawatanRepo;
    }

    /**
     * Display a listing of the rekomendasi_biaya_perawatan.
     */
    public function index(Request $request)
    {
        $rekomendasiBiayaPerawatans = $this->rekomendasiBiayaPerawatanRepository->paginate(10);

        return view('rekomendasi_biaya_perawatans.index')
            ->with('rekomendasiBiayaPerawatans', $rekomendasiBiayaPerawatans);
    }

    /**
     * Show the form for creating a new rekomendasi_biaya_perawatan.
     */
    public function create()
    {
        return view('rekomendasi_biaya_perawatans.create');
    }

    /**
     * Store a newly created rekomendasi_biaya_perawatan in storage.
     */
    public function store(Createrekomendasi_biaya_perawatanRequest $request)
    {
        $input = $request->all();

        $rekomendasiBiayaPerawatan = $this->rekomendasiBiayaPerawatanRepository->create($input);

        Flash::success('Rekomendasi Biaya Perawatan saved successfully.');

        return redirect(route('rekomendasi_biaya_perawatans.index'));
    }

    /**
     * Display the specified rekomendasi_biaya_perawatan.
     */
    public function show($id)
    {
        $rekomendasiBiayaPerawatan = $this->rekomendasiBiayaPerawatanRepository->find($id);

        if (empty($rekomendasiBiayaPerawatan)) {
            Flash::error('Rekomendasi Biaya Perawatan not found');

            return redirect(route('rekomendasi_biaya_perawatans.index'));
        }

        return view('rekomendasi_biaya_perawatans.show')->with('rekomendasiBiayaPerawatan', $rekomendasiBiayaPerawatan);
    }

    /**
     * Show the form for editing the specified rekomendasi_biaya_perawatan.
     */
    public function edit($id)
    {
        $rekomendasiBiayaPerawatan = $this->rekomendasiBiayaPerawatanRepository->find($id);

        if (empty($rekomendasiBiayaPerawatan)) {
            Flash::error('Rekomendasi Biaya Perawatan not found');

            return redirect(route('rekomendasi_biaya_perawatans.index'));
        }

        return view('rekomendasi_biaya_perawatans.edit')->with('rekomendasiBiayaPerawatan', $rekomendasiBiayaPerawatan);
    }

    /**
     * Update the specified rekomendasi_biaya_perawatan in storage.
     */
    public function update($id, Updaterekomendasi_biaya_perawatanRequest $request)
    {
        $rekomendasiBiayaPerawatan = $this->rekomendasiBiayaPerawatanRepository->find($id);

        if (empty($rekomendasiBiayaPerawatan)) {
            Flash::error('Rekomendasi Biaya Perawatan not found');

            return redirect(route('rekomendasi_biaya_perawatans.index'));
        }

        $rekomendasiBiayaPerawatan = $this->rekomendasiBiayaPerawatanRepository->update($request->all(), $id);

        Flash::success('Rekomendasi Biaya Perawatan updated successfully.');

        return redirect(route('rekomendasi_biaya_perawatans.index'));
    }

    /**
     * Remove the specified rekomendasi_biaya_perawatan from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rekomendasiBiayaPerawatan = $this->rekomendasiBiayaPerawatanRepository->find($id);

        if (empty($rekomendasiBiayaPerawatan)) {
            Flash::error('Rekomendasi Biaya Perawatan not found');

            return redirect(route('rekomendasi_biaya_perawatans.index'));
        }

        $this->rekomendasiBiayaPerawatanRepository->delete($id);

        Flash::success('Rekomendasi Biaya Perawatan deleted successfully.');

        return redirect(route('rekomendasi_biaya_perawatans.index'));
    }
}
