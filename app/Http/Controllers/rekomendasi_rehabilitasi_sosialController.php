<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createrekomendasi_rehabilitasi_sosialRequest;
use App\Http\Requests\Updaterekomendasi_rehabilitasi_sosialRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\rekomendasi_rehabilitasi_sosialRepository;
use Illuminate\Http\Request;
use Flash;

class rekomendasi_rehabilitasi_sosialController extends AppBaseController
{
    /** @var rekomendasi_rehabilitasi_sosialRepository $rekomendasiRehabilitasiSosialRepository*/
    private $rekomendasiRehabilitasiSosialRepository;

    public function __construct(rekomendasi_rehabilitasi_sosialRepository $rekomendasiRehabilitasiSosialRepo)
    {
        $this->rekomendasiRehabilitasiSosialRepository = $rekomendasiRehabilitasiSosialRepo;
    }

    /**
     * Display a listing of the rekomendasi_rehabilitasi_sosial.
     */
    public function index(Request $request)
    {
        $rekomendasiRehabilitasiSosials = $this->rekomendasiRehabilitasiSosialRepository->paginate(10);

        return view('rekomendasi_rehabilitasi_sosials.index')
            ->with('rekomendasiRehabilitasiSosials', $rekomendasiRehabilitasiSosials);
    }

    /**
     * Show the form for creating a new rekomendasi_rehabilitasi_sosial.
     */
    public function create()
    {
        return view('rekomendasi_rehabilitasi_sosials.create');
    }

    /**
     * Store a newly created rekomendasi_rehabilitasi_sosial in storage.
     */
    public function store(Createrekomendasi_rehabilitasi_sosialRequest $request)
    {
        $input = $request->all();

        $rekomendasiRehabilitasiSosial = $this->rekomendasiRehabilitasiSosialRepository->create($input);

        Flash::success('Rekomendasi Rehabilitasi Sosial saved successfully.');

        return redirect(route('rekomendasi_rehabilitasi_sosials.index'));
    }

    /**
     * Display the specified rekomendasi_rehabilitasi_sosial.
     */
    public function show($id)
    {
        $rekomendasiRehabilitasiSosial = $this->rekomendasiRehabilitasiSosialRepository->find($id);

        if (empty($rekomendasiRehabilitasiSosial)) {
            Flash::error('Rekomendasi Rehabilitasi Sosial not found');

            return redirect(route('rekomendasi_rehabilitasi_sosials.index'));
        }

        return view('rekomendasi_rehabilitasi_sosials.show')->with('rekomendasiRehabilitasiSosial', $rekomendasiRehabilitasiSosial);
    }

    /**
     * Show the form for editing the specified rekomendasi_rehabilitasi_sosial.
     */
    public function edit($id)
    {
        $rekomendasiRehabilitasiSosial = $this->rekomendasiRehabilitasiSosialRepository->find($id);

        if (empty($rekomendasiRehabilitasiSosial)) {
            Flash::error('Rekomendasi Rehabilitasi Sosial not found');

            return redirect(route('rekomendasi_rehabilitasi_sosials.index'));
        }

        return view('rekomendasi_rehabilitasi_sosials.edit')->with('rekomendasiRehabilitasiSosial', $rekomendasiRehabilitasiSosial);
    }

    /**
     * Update the specified rekomendasi_rehabilitasi_sosial in storage.
     */
    public function update($id, Updaterekomendasi_rehabilitasi_sosialRequest $request)
    {
        $rekomendasiRehabilitasiSosial = $this->rekomendasiRehabilitasiSosialRepository->find($id);

        if (empty($rekomendasiRehabilitasiSosial)) {
            Flash::error('Rekomendasi Rehabilitasi Sosial not found');

            return redirect(route('rekomendasi_rehabilitasi_sosials.index'));
        }

        $rekomendasiRehabilitasiSosial = $this->rekomendasiRehabilitasiSosialRepository->update($request->all(), $id);

        Flash::success('Rekomendasi Rehabilitasi Sosial updated successfully.');

        return redirect(route('rekomendasi_rehabilitasi_sosials.index'));
    }

    /**
     * Remove the specified rekomendasi_rehabilitasi_sosial from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rekomendasiRehabilitasiSosial = $this->rekomendasiRehabilitasiSosialRepository->find($id);

        if (empty($rekomendasiRehabilitasiSosial)) {
            Flash::error('Rekomendasi Rehabilitasi Sosial not found');

            return redirect(route('rekomendasi_rehabilitasi_sosials.index'));
        }

        $this->rekomendasiRehabilitasiSosialRepository->delete($id);

        Flash::success('Rekomendasi Rehabilitasi Sosial deleted successfully.');

        return redirect(route('rekomendasi_rehabilitasi_sosials.index'));
    }
}
