<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createrekomendasi_bantuan_pendidikanRequest;
use App\Http\Requests\Updaterekomendasi_bantuan_pendidikanRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\rekomendasi_bantuan_pendidikanRepository;
use Illuminate\Http\Request;
use Flash;

class rekomendasi_bantuan_pendidikanController extends AppBaseController
{
    /** @var rekomendasi_bantuan_pendidikanRepository $rekomendasiBantuanPendidikanRepository*/
    private $rekomendasiBantuanPendidikanRepository;

    public function __construct(rekomendasi_bantuan_pendidikanRepository $rekomendasiBantuanPendidikanRepo)
    {
        $this->rekomendasiBantuanPendidikanRepository = $rekomendasiBantuanPendidikanRepo;
    }

    /**
     * Display a listing of the rekomendasi_bantuan_pendidikan.
     */
    public function index(Request $request)
    {
        $rekomendasiBantuanPendidikans = $this->rekomendasiBantuanPendidikanRepository->paginate(10);

        return view('rekomendasi_bantuan_pendidikans.index')
            ->with('rekomendasiBantuanPendidikans', $rekomendasiBantuanPendidikans);
    }

    /**
     * Show the form for creating a new rekomendasi_bantuan_pendidikan.
     */
    public function create()
    {
        return view('rekomendasi_bantuan_pendidikans.create');
    }

    /**
     * Store a newly created rekomendasi_bantuan_pendidikan in storage.
     */
    public function store(Createrekomendasi_bantuan_pendidikanRequest $request)
    {
        $input = $request->all();

        $rekomendasiBantuanPendidikan = $this->rekomendasiBantuanPendidikanRepository->create($input);

        Flash::success('Rekomendasi Bantuan Pendidikan saved successfully.');

        return redirect(route('rekomendasi_bantuan_pendidikans.index'));
    }

    /**
     * Display the specified rekomendasi_bantuan_pendidikan.
     */
    public function show($id)
    {
        $rekomendasiBantuanPendidikan = $this->rekomendasiBantuanPendidikanRepository->find($id);

        if (empty($rekomendasiBantuanPendidikan)) {
            Flash::error('Rekomendasi Bantuan Pendidikan not found');

            return redirect(route('rekomendasi_bantuan_pendidikans.index'));
        }

        return view('rekomendasi_bantuan_pendidikans.show')->with('rekomendasiBantuanPendidikan', $rekomendasiBantuanPendidikan);
    }

    /**
     * Show the form for editing the specified rekomendasi_bantuan_pendidikan.
     */
    public function edit($id)
    {
        $rekomendasiBantuanPendidikan = $this->rekomendasiBantuanPendidikanRepository->find($id);

        if (empty($rekomendasiBantuanPendidikan)) {
            Flash::error('Rekomendasi Bantuan Pendidikan not found');

            return redirect(route('rekomendasi_bantuan_pendidikans.index'));
        }

        return view('rekomendasi_bantuan_pendidikans.edit')->with('rekomendasiBantuanPendidikan', $rekomendasiBantuanPendidikan);
    }

    /**
     * Update the specified rekomendasi_bantuan_pendidikan in storage.
     */
    public function update($id, Updaterekomendasi_bantuan_pendidikanRequest $request)
    {
        $rekomendasiBantuanPendidikan = $this->rekomendasiBantuanPendidikanRepository->find($id);

        if (empty($rekomendasiBantuanPendidikan)) {
            Flash::error('Rekomendasi Bantuan Pendidikan not found');

            return redirect(route('rekomendasi_bantuan_pendidikans.index'));
        }

        $rekomendasiBantuanPendidikan = $this->rekomendasiBantuanPendidikanRepository->update($request->all(), $id);

        Flash::success('Rekomendasi Bantuan Pendidikan updated successfully.');

        return redirect(route('rekomendasi_bantuan_pendidikans.index'));
    }

    /**
     * Remove the specified rekomendasi_bantuan_pendidikan from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rekomendasiBantuanPendidikan = $this->rekomendasiBantuanPendidikanRepository->find($id);

        if (empty($rekomendasiBantuanPendidikan)) {
            Flash::error('Rekomendasi Bantuan Pendidikan not found');

            return redirect(route('rekomendasi_bantuan_pendidikans.index'));
        }

        $this->rekomendasiBantuanPendidikanRepository->delete($id);

        Flash::success('Rekomendasi Bantuan Pendidikan deleted successfully.');

        return redirect(route('rekomendasi_bantuan_pendidikans.index'));
    }
}
