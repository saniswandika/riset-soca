<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createrekomendasi_terdaftar_dtksRequest;
use App\Http\Requests\Updaterekomendasi_terdaftar_dtksRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\rekomendasi_terdaftar_dtksRepository;
use Illuminate\Http\Request;
use Flash;

class rekomendasi_terdaftar_dtksController extends AppBaseController
{
    /** @var rekomendasi_terdaftar_dtksRepository $rekomendasiTerdaftarDtksRepository*/
    private $rekomendasiTerdaftarDtksRepository;

    public function __construct(rekomendasi_terdaftar_dtksRepository $rekomendasiTerdaftarDtksRepo)
    {
        $this->rekomendasiTerdaftarDtksRepository = $rekomendasiTerdaftarDtksRepo;
    }

    /**
     * Display a listing of the rekomendasi_terdaftar_dtks.
     */
    public function index(Request $request)
    {
        $rekomendasiTerdaftarDtks = $this->rekomendasiTerdaftarDtksRepository->paginate(10);

        return view('rekomendasi_terdaftar_dtks.index')
            ->with('rekomendasiTerdaftarDtks', $rekomendasiTerdaftarDtks);
    }

    /**
     * Show the form for creating a new rekomendasi_terdaftar_dtks.
     */
    public function create()
    {
        return view('rekomendasi_terdaftar_dtks.create');
    }

    /**
     * Store a newly created rekomendasi_terdaftar_dtks in storage.
     */
    public function store(Createrekomendasi_terdaftar_dtksRequest $request)
    {
        $input = $request->all();

        $rekomendasiTerdaftarDtks = $this->rekomendasiTerdaftarDtksRepository->create($input);

        Flash::success('Rekomendasi Terdaftar Dtks saved successfully.');

        return redirect(route('rekomendasi_terdaftar_dtks.index'));
    }

    /**
     * Display the specified rekomendasi_terdaftar_dtks.
     */
    public function show($id)
    {
        $rekomendasiTerdaftarDtks = $this->rekomendasiTerdaftarDtksRepository->find($id);

        if (empty($rekomendasiTerdaftarDtks)) {
            Flash::error('Rekomendasi Terdaftar Dtks not found');

            return redirect(route('rekomendasi_terdaftar_dtks.index'));
        }

        return view('rekomendasi_terdaftar_dtks.show')->with('rekomendasiTerdaftarDtks', $rekomendasiTerdaftarDtks);
    }

    /**
     * Show the form for editing the specified rekomendasi_terdaftar_dtks.
     */
    public function edit($id)
    {
        $rekomendasiTerdaftarDtks = $this->rekomendasiTerdaftarDtksRepository->find($id);

        if (empty($rekomendasiTerdaftarDtks)) {
            Flash::error('Rekomendasi Terdaftar Dtks not found');

            return redirect(route('rekomendasi_terdaftar_dtks.index'));
        }

        return view('rekomendasi_terdaftar_dtks.edit')->with('rekomendasiTerdaftarDtks', $rekomendasiTerdaftarDtks);
    }

    /**
     * Update the specified rekomendasi_terdaftar_dtks in storage.
     */
    public function update($id, Updaterekomendasi_terdaftar_dtksRequest $request)
    {
        $rekomendasiTerdaftarDtks = $this->rekomendasiTerdaftarDtksRepository->find($id);

        if (empty($rekomendasiTerdaftarDtks)) {
            Flash::error('Rekomendasi Terdaftar Dtks not found');

            return redirect(route('rekomendasi_terdaftar_dtks.index'));
        }

        $rekomendasiTerdaftarDtks = $this->rekomendasiTerdaftarDtksRepository->update($request->all(), $id);

        Flash::success('Rekomendasi Terdaftar Dtks updated successfully.');

        return redirect(route('rekomendasi_terdaftar_dtks.index'));
    }

    /**
     * Remove the specified rekomendasi_terdaftar_dtks from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rekomendasiTerdaftarDtks = $this->rekomendasiTerdaftarDtksRepository->find($id);

        if (empty($rekomendasiTerdaftarDtks)) {
            Flash::error('Rekomendasi Terdaftar Dtks not found');

            return redirect(route('rekomendasi_terdaftar_dtks.index'));
        }

        $this->rekomendasiTerdaftarDtksRepository->delete($id);

        Flash::success('Rekomendasi Terdaftar Dtks deleted successfully.');

        return redirect(route('rekomendasi_terdaftar_dtks.index'));
    }
}
