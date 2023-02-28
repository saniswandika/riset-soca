<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createrekomendasi_pengumpulan_undian_berhadiahRequest;
use App\Http\Requests\Updaterekomendasi_pengumpulan_undian_berhadiahRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\rekomendasi_pengumpulan_undian_berhadiahRepository;
use Illuminate\Http\Request;
use Flash;

class rekomendasi_pengumpulan_undian_berhadiahController extends AppBaseController
{
    /** @var rekomendasi_pengumpulan_undian_berhadiahRepository $rekomendasiPengumpulanUndianBerhadiahRepository*/
    private $rekomendasiPengumpulanUndianBerhadiahRepository;

    public function __construct(rekomendasi_pengumpulan_undian_berhadiahRepository $rekomendasiPengumpulanUndianBerhadiahRepo)
    {
        $this->rekomendasiPengumpulanUndianBerhadiahRepository = $rekomendasiPengumpulanUndianBerhadiahRepo;
    }

    /**
     * Display a listing of the rekomendasi_pengumpulan_undian_berhadiah.
     */
    public function index(Request $request)
    {
        $rekomendasiPengumpulanUndianBerhadiahs = $this->rekomendasiPengumpulanUndianBerhadiahRepository->paginate(10);

        return view('rekomendasi_pengumpulan_undian_berhadiahs.index')
            ->with('rekomendasiPengumpulanUndianBerhadiahs', $rekomendasiPengumpulanUndianBerhadiahs);
    }

    /**
     * Show the form for creating a new rekomendasi_pengumpulan_undian_berhadiah.
     */
    public function create()
    {
        return view('rekomendasi_pengumpulan_undian_berhadiahs.create');
    }

    /**
     * Store a newly created rekomendasi_pengumpulan_undian_berhadiah in storage.
     */
    public function store(Createrekomendasi_pengumpulan_undian_berhadiahRequest $request)
    {
        $input = $request->all();

        $rekomendasiPengumpulanUndianBerhadiah = $this->rekomendasiPengumpulanUndianBerhadiahRepository->create($input);

        Flash::success('Rekomendasi Pengumpulan Undian Berhadiah saved successfully.');

        return redirect(route('rekomendasi_pub.index'));
    }

    /**
     * Display the specified rekomendasi_pengumpulan_undian_berhadiah.
     */
    public function show($id)
    {
        $rekomendasiPengumpulanUndianBerhadiah = $this->rekomendasiPengumpulanUndianBerhadiahRepository->find($id);

        if (empty($rekomendasiPengumpulanUndianBerhadiah)) {
            Flash::error('Rekomendasi Pengumpulan Undian Berhadiah not found');

            return redirect(route('rekomendasi_pub.index'));
        }

        return view('rekomendasi_pengumpulan_undian_berhadiahs.show')->with('rekomendasiPengumpulanUndianBerhadiah', $rekomendasiPengumpulanUndianBerhadiah);
    }

    /**
     * Show the form for editing the specified rekomendasi_pengumpulan_undian_berhadiah.
     */
    public function edit($id)
    {
        $rekomendasiPengumpulanUndianBerhadiah = $this->rekomendasiPengumpulanUndianBerhadiahRepository->find($id);

        if (empty($rekomendasiPengumpulanUndianBerhadiah)) {
            Flash::error('Rekomendasi Pengumpulan Undian Berhadiah not found');

            return redirect(route('rekomendasi_pub.index'));
        }

        return view('rekomendasi_pengumpulan_undian_berhadiahs.edit')->with('rekomendasiPengumpulanUndianBerhadiah', $rekomendasiPengumpulanUndianBerhadiah);
    }

    /**
     * Update the specified rekomendasi_pengumpulan_undian_berhadiah in storage.
     */
    public function update($id, Updaterekomendasi_pengumpulan_undian_berhadiahRequest $request)
    {
        $rekomendasiPengumpulanUndianBerhadiah = $this->rekomendasiPengumpulanUndianBerhadiahRepository->find($id);

        if (empty($rekomendasiPengumpulanUndianBerhadiah)) {
            Flash::error('Rekomendasi Pengumpulan Undian Berhadiah not found');

            return redirect(route('rekomendasi_pub.index'));
        }

        $rekomendasiPengumpulanUndianBerhadiah = $this->rekomendasiPengumpulanUndianBerhadiahRepository->update($request->all(), $id);

        Flash::success('Rekomendasi Pengumpulan Undian Berhadiah updated successfully.');

        return redirect(route('rekomendasi_pub.index'));
    }

    /**
     * Remove the specified rekomendasi_pengumpulan_undian_berhadiah from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rekomendasiPengumpulanUndianBerhadiah = $this->rekomendasiPengumpulanUndianBerhadiahRepository->find($id);

        if (empty($rekomendasiPengumpulanUndianBerhadiah)) {
            Flash::error('Rekomendasi Pengumpulan Undian Berhadiah not found');

            return redirect(route('rekomendasi_pub.index'));
        }

        $this->rekomendasiPengumpulanUndianBerhadiahRepository->delete($id);

        Flash::success('Rekomendasi Pengumpulan Undian Berhadiah deleted successfully.');

        return redirect(route('rekomendasi_pub.index'));
    }
}
