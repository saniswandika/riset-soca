<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createrekomendasi_admin_kependudukanRequest;
use App\Http\Requests\Updaterekomendasi_admin_kependudukanRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\rekomendasi_admin_kependudukanRepository;
use Illuminate\Http\Request;
use Flash;

class rekomendasi_admin_kependudukanController extends AppBaseController
{
    /** @var rekomendasi_admin_kependudukanRepository $rekomendasiAdminKependudukanRepository*/
    private $rekomendasiAdminKependudukanRepository;

    public function __construct(rekomendasi_admin_kependudukanRepository $rekomendasiAdminKependudukanRepo)
    {
        $this->rekomendasiAdminKependudukanRepository = $rekomendasiAdminKependudukanRepo;
    }

    /**
     * Display a listing of the rekomendasi_admin_kependudukan.
     */
    public function index(Request $request)
    {
        $rekomendasiAdminKependudukans = $this->rekomendasiAdminKependudukanRepository->paginate(10);

        return view('rekomendasi_admin_kependudukans.index')
            ->with('rekomendasiAdminKependudukans', $rekomendasiAdminKependudukans);
    }

    /**
     * Show the form for creating a new rekomendasi_admin_kependudukan.
     */
    public function create()
    {
        return view('rekomendasi_admin_kependudukans.create');
    }

    /**
     * Store a newly created rekomendasi_admin_kependudukan in storage.
     */
    public function store(Createrekomendasi_admin_kependudukanRequest $request)
    {
        $input = $request->all();

        $rekomendasiAdminKependudukan = $this->rekomendasiAdminKependudukanRepository->create($input);

        Flash::success('Rekomendasi Admin Kependudukan saved successfully.');

        return redirect(route('rekomendasi_admin_kependudukans.index'));
    }

    /**
     * Display the specified rekomendasi_admin_kependudukan.
     */
    public function show($id)
    {
        $rekomendasiAdminKependudukan = $this->rekomendasiAdminKependudukanRepository->find($id);

        if (empty($rekomendasiAdminKependudukan)) {
            Flash::error('Rekomendasi Admin Kependudukan not found');

            return redirect(route('rekomendasi_admin_kependudukans.index'));
        }

        return view('rekomendasi_admin_kependudukans.show')->with('rekomendasiAdminKependudukan', $rekomendasiAdminKependudukan);
    }

    /**
     * Show the form for editing the specified rekomendasi_admin_kependudukan.
     */
    public function edit($id)
    {
        $rekomendasiAdminKependudukan = $this->rekomendasiAdminKependudukanRepository->find($id);

        if (empty($rekomendasiAdminKependudukan)) {
            Flash::error('Rekomendasi Admin Kependudukan not found');

            return redirect(route('rekomendasi_admin_kependudukans.index'));
        }

        return view('rekomendasi_admin_kependudukans.edit')->with('rekomendasiAdminKependudukan', $rekomendasiAdminKependudukan);
    }

    /**
     * Update the specified rekomendasi_admin_kependudukan in storage.
     */
    public function update($id, Updaterekomendasi_admin_kependudukanRequest $request)
    {
        $rekomendasiAdminKependudukan = $this->rekomendasiAdminKependudukanRepository->find($id);

        if (empty($rekomendasiAdminKependudukan)) {
            Flash::error('Rekomendasi Admin Kependudukan not found');

            return redirect(route('rekomendasi_admin_kependudukans.index'));
        }

        $rekomendasiAdminKependudukan = $this->rekomendasiAdminKependudukanRepository->update($request->all(), $id);

        Flash::success('Rekomendasi Admin Kependudukan updated successfully.');

        return redirect(route('rekomendasi_admin_kependudukans.index'));
    }

    /**
     * Remove the specified rekomendasi_admin_kependudukan from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rekomendasiAdminKependudukan = $this->rekomendasiAdminKependudukanRepository->find($id);

        if (empty($rekomendasiAdminKependudukan)) {
            Flash::error('Rekomendasi Admin Kependudukan not found');

            return redirect(route('rekomendasi_admin_kependudukans.index'));
        }

        $this->rekomendasiAdminKependudukanRepository->delete($id);

        Flash::success('Rekomendasi Admin Kependudukan deleted successfully.');

        return redirect(route('rekomendasi_admin_kependudukans.index'));
    }
}
