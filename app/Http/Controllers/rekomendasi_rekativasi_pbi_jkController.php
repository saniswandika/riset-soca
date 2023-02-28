<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createrekomendasi_rekativasi_pbi_jkRequest;
use App\Http\Requests\Updaterekomendasi_rekativasi_pbi_jkRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\rekomendasi_rekativasi_pbi_jkRepository;
use Illuminate\Http\Request;
use Flash;

class rekomendasi_rekativasi_pbi_jkController extends AppBaseController
{
    /** @var rekomendasi_rekativasi_pbi_jkRepository $rekomendasiRekativasiPbiJkRepository*/
    private $rekomendasiRekativasiPbiJkRepository;

    public function __construct(rekomendasi_rekativasi_pbi_jkRepository $rekomendasiRekativasiPbiJkRepo)
    {
        $this->rekomendasiRekativasiPbiJkRepository = $rekomendasiRekativasiPbiJkRepo;
    }

    /**
     * Display a listing of the rekomendasi_rekativasi_pbi_jk.
     */
    public function index(Request $request)
    {
        $rekomendasiRekativasiPbiJks = $this->rekomendasiRekativasiPbiJkRepository->paginate(10);

        return view('rekomendasi_rekativasi_pbi_jks.index')
            ->with('rekomendasiRekativasiPbiJks', $rekomendasiRekativasiPbiJks);
    }

    /**
     * Show the form for creating a new rekomendasi_rekativasi_pbi_jk.
     */
    public function create()
    {
        return view('rekomendasi_rekativasi_pbi_jks.create');
    }

    /**
     * Store a newly created rekomendasi_rekativasi_pbi_jk in storage.
     */
    public function store(Createrekomendasi_rekativasi_pbi_jkRequest $request)
    {
        $input = $request->all();

        $rekomendasiRekativasiPbiJk = $this->rekomendasiRekativasiPbiJkRepository->create($input);

        Flash::success('Rekomendasi Rekativasi Pbi Jk saved successfully.');

        return redirect(route('rekomendasi_rekativasi_pbi_jks.index'));
    }

    /**
     * Display the specified rekomendasi_rekativasi_pbi_jk.
     */
    public function show($id)
    {
        $rekomendasiRekativasiPbiJk = $this->rekomendasiRekativasiPbiJkRepository->find($id);

        if (empty($rekomendasiRekativasiPbiJk)) {
            Flash::error('Rekomendasi Rekativasi Pbi Jk not found');

            return redirect(route('rekomendasi_rekativasi_pbi_jks.index'));
        }

        return view('rekomendasi_rekativasi_pbi_jks.show')->with('rekomendasiRekativasiPbiJk', $rekomendasiRekativasiPbiJk);
    }

    /**
     * Show the form for editing the specified rekomendasi_rekativasi_pbi_jk.
     */
    public function edit($id)
    {
        $rekomendasiRekativasiPbiJk = $this->rekomendasiRekativasiPbiJkRepository->find($id);

        if (empty($rekomendasiRekativasiPbiJk)) {
            Flash::error('Rekomendasi Rekativasi Pbi Jk not found');

            return redirect(route('rekomendasi_rekativasi_pbi_jks.index'));
        }

        return view('rekomendasi_rekativasi_pbi_jks.edit')->with('rekomendasiRekativasiPbiJk', $rekomendasiRekativasiPbiJk);
    }

    /**
     * Update the specified rekomendasi_rekativasi_pbi_jk in storage.
     */
    public function update($id, Updaterekomendasi_rekativasi_pbi_jkRequest $request)
    {
        $rekomendasiRekativasiPbiJk = $this->rekomendasiRekativasiPbiJkRepository->find($id);

        if (empty($rekomendasiRekativasiPbiJk)) {
            Flash::error('Rekomendasi Rekativasi Pbi Jk not found');

            return redirect(route('rekomendasi_rekativasi_pbi_jks.index'));
        }

        $rekomendasiRekativasiPbiJk = $this->rekomendasiRekativasiPbiJkRepository->update($request->all(), $id);

        Flash::success('Rekomendasi Rekativasi Pbi Jk updated successfully.');

        return redirect(route('rekomendasi_rekativasi_pbi_jks.index'));
    }

    /**
     * Remove the specified rekomendasi_rekativasi_pbi_jk from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rekomendasiRekativasiPbiJk = $this->rekomendasiRekativasiPbiJkRepository->find($id);

        if (empty($rekomendasiRekativasiPbiJk)) {
            Flash::error('Rekomendasi Rekativasi Pbi Jk not found');

            return redirect(route('rekomendasi_rekativasi_pbi_jks.index'));
        }

        $this->rekomendasiRekativasiPbiJkRepository->delete($id);

        Flash::success('Rekomendasi Rekativasi Pbi Jk deleted successfully.');

        return redirect(route('rekomendasi_rekativasi_pbi_jks.index'));
    }
}
