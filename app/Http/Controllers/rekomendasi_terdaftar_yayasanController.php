<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createrekomendasi_terdaftar_yayasanRequest;
use App\Http\Requests\Updaterekomendasi_terdaftar_yayasanRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\rekomendasi_terdaftar_yayasanRepository;
use Illuminate\Http\Request;
use Flash;

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
        return view('rekomendasi_terdaftar_yayasans.create');
    }

    /**
     * Store a newly created rekomendasi_terdaftar_yayasan in storage.
     */
    public function store(Createrekomendasi_terdaftar_yayasanRequest $request)
    {
        $input = $request->all();

        $rekomendasiTerdaftarYayasan = $this->rekomendasiTerdaftarYayasanRepository->create($input);

        Flash::success('Rekomendasi Terdaftar Yayasan saved successfully.');

        return redirect(route('rekomendasi_terdaftar_yayasans.index'));
    }

    /**
     * Display the specified rekomendasi_terdaftar_yayasan.
     */
    public function show($id)
    {
        $rekomendasiTerdaftarYayasan = $this->rekomendasiTerdaftarYayasanRepository->find($id);

        if (empty($rekomendasiTerdaftarYayasan)) {
            Flash::error('Rekomendasi Terdaftar Yayasan not found');

            return redirect(route('rekomendasi_terdaftar_yayasans.index'));
        }

        return view('rekomendasi_terdaftar_yayasans.show')->with('rekomendasiTerdaftarYayasan', $rekomendasiTerdaftarYayasan);
    }

    /**
     * Show the form for editing the specified rekomendasi_terdaftar_yayasan.
     */
    public function edit($id)
    {
        $rekomendasiTerdaftarYayasan = $this->rekomendasiTerdaftarYayasanRepository->find($id);

        if (empty($rekomendasiTerdaftarYayasan)) {
            Flash::error('Rekomendasi Terdaftar Yayasan not found');

            return redirect(route('rekomendasi_terdaftar_yayasans.index'));
        }

        return view('rekomendasi_terdaftar_yayasans.edit')->with('rekomendasiTerdaftarYayasan', $rekomendasiTerdaftarYayasan);
    }

    /**
     * Update the specified rekomendasi_terdaftar_yayasan in storage.
     */
    public function update($id, Updaterekomendasi_terdaftar_yayasanRequest $request)
    {
        $rekomendasiTerdaftarYayasan = $this->rekomendasiTerdaftarYayasanRepository->find($id);

        if (empty($rekomendasiTerdaftarYayasan)) {
            Flash::error('Rekomendasi Terdaftar Yayasan not found');

            return redirect(route('rekomendasi_terdaftar_yayasans.index'));
        }

        $rekomendasiTerdaftarYayasan = $this->rekomendasiTerdaftarYayasanRepository->update($request->all(), $id);

        Flash::success('Rekomendasi Terdaftar Yayasan updated successfully.');

        return redirect(route('rekomendasi_terdaftar_yayasans.index'));
    }

    /**
     * Remove the specified rekomendasi_terdaftar_yayasan from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rekomendasiTerdaftarYayasan = $this->rekomendasiTerdaftarYayasanRepository->find($id);

        if (empty($rekomendasiTerdaftarYayasan)) {
            Flash::error('Rekomendasi Terdaftar Yayasan not found');

            return redirect(route('rekomendasi_terdaftar_yayasans.index'));
        }

        $this->rekomendasiTerdaftarYayasanRepository->delete($id);

        Flash::success('Rekomendasi Terdaftar Yayasan deleted successfully.');

        return redirect(route('rekomendasi_terdaftar_yayasans.index'));
    }
}
