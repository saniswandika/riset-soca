<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createrekomendasi_keringanan_pbbRequest;
use App\Http\Requests\Updaterekomendasi_keringanan_pbbRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\rekomendasi_keringanan_pbbRepository;
use Illuminate\Http\Request;
use Flash;

class rekomendasi_keringanan_pbbController extends AppBaseController
{
    /** @var rekomendasi_keringanan_pbbRepository $rekomendasiKeringananPbbRepository*/
    private $rekomendasiKeringananPbbRepository;

    public function __construct(rekomendasi_keringanan_pbbRepository $rekomendasiKeringananPbbRepo)
    {
        $this->rekomendasiKeringananPbbRepository = $rekomendasiKeringananPbbRepo;
    }

    /**
     * Display a listing of the rekomendasi_keringanan_pbb.
     */
    public function index(Request $request)
    {
        $rekomendasiKeringananPbbs = $this->rekomendasiKeringananPbbRepository->paginate(10);

        return view('rekomendasi_keringanan_pbbs.index')
            ->with('rekomendasiKeringananPbbs', $rekomendasiKeringananPbbs);
    }

    /**
     * Show the form for creating a new rekomendasi_keringanan_pbb.
     */
    public function create()
    {
        return view('rekomendasi_keringanan_pbbs.create');
    }

    /**
     * Store a newly created rekomendasi_keringanan_pbb in storage.
     */
    public function store(Createrekomendasi_keringanan_pbbRequest $request)
    {
        $input = $request->all();

        $rekomendasiKeringananPbb = $this->rekomendasiKeringananPbbRepository->create($input);

        Flash::success('Rekomendasi Keringanan Pbb saved successfully.');

        return redirect(route('rekomendasi_keringanan_pbbs.index'));
    }

    /**
     * Display the specified rekomendasi_keringanan_pbb.
     */
    public function show($id)
    {
        $rekomendasiKeringananPbb = $this->rekomendasiKeringananPbbRepository->find($id);

        if (empty($rekomendasiKeringananPbb)) {
            Flash::error('Rekomendasi Keringanan Pbb not found');

            return redirect(route('rekomendasi_keringanan_pbbs.index'));
        }

        return view('rekomendasi_keringanan_pbbs.show')->with('rekomendasiKeringananPbb', $rekomendasiKeringananPbb);
    }

    /**
     * Show the form for editing the specified rekomendasi_keringanan_pbb.
     */
    public function edit($id)
    {
        $rekomendasiKeringananPbb = $this->rekomendasiKeringananPbbRepository->find($id);

        if (empty($rekomendasiKeringananPbb)) {
            Flash::error('Rekomendasi Keringanan Pbb not found');

            return redirect(route('rekomendasi_keringanan_pbbs.index'));
        }

        return view('rekomendasi_keringanan_pbbs.edit')->with('rekomendasiKeringananPbb', $rekomendasiKeringananPbb);
    }

    /**
     * Update the specified rekomendasi_keringanan_pbb in storage.
     */
    public function update($id, Updaterekomendasi_keringanan_pbbRequest $request)
    {
        $rekomendasiKeringananPbb = $this->rekomendasiKeringananPbbRepository->find($id);

        if (empty($rekomendasiKeringananPbb)) {
            Flash::error('Rekomendasi Keringanan Pbb not found');

            return redirect(route('rekomendasi_keringanan_pbbs.index'));
        }

        $rekomendasiKeringananPbb = $this->rekomendasiKeringananPbbRepository->update($request->all(), $id);

        Flash::success('Rekomendasi Keringanan Pbb updated successfully.');

        return redirect(route('rekomendasi_keringanan_pbbs.index'));
    }

    /**
     * Remove the specified rekomendasi_keringanan_pbb from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rekomendasiKeringananPbb = $this->rekomendasiKeringananPbbRepository->find($id);

        if (empty($rekomendasiKeringananPbb)) {
            Flash::error('Rekomendasi Keringanan Pbb not found');

            return redirect(route('rekomendasi_keringanan_pbbs.index'));
        }

        $this->rekomendasiKeringananPbbRepository->delete($id);

        Flash::success('Rekomendasi Keringanan Pbb deleted successfully.');

        return redirect(route('rekomendasi_keringanan_pbbs.index'));
    }
}
