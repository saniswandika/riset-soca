<div class="card-body p-0">
    <div class="table-responsive">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                    type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Draft</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                    type="button" role="tab" aria-controls="profile-tab-pane"
                    aria-selected="false">Diproses</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane"
                    type="button" role="tab" aria-controls="contact-tab-pane"
                    aria-selected="false">Dikembalikan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane"
                    type="button" role="tab" aria-controls="disabled-tab-pane"
                    aria-selected="false">Selesai</button>
            </li>
        </ul>
        {{-- Draft --}}
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                tabindex="0">
                {!! Form::open(array('url' => '/search', 'method' => 'post')) !!}
                <div class="mt-4">
                    <input type="text" name="q" placeholder="Cari Nomor Pendaftaran">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
                {!! Form::close() !!}
                {{-- <input id="myInput" type="text" placeholder="Search.." class="mt-4"> --}}
                <table class="table table-bordered mt-2" id="pengaduans-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Pendaftaran</th>
                            <th>Tgl Pendaftaran</th>
                            <th>Layanan</th>
                            <th>Faskesos</th>
                            <th>Terlapor</th>
                            <th>NIK Terlapor</th>
                            <th>No.KK Terlapor</th>
                            <th>Sektor Program</th>
                            <th>Program</th>
                            <th>Catatan</th>
                            <th>Status</th>
                            <th>Durasi (hari)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach ($pengaduans as $pengaduan)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $pengaduan->no_pendaftaran }}</td>
                                <td>{{ $pengaduan->created_at }}</td>
                                <td>{{ $pengaduan->id_provinsi }}</td>
                                <td>{{ $pengaduan->id_kabkot }}</td>
                                <td>{{ $pengaduan->id_kecamatan }}</td>
                                <td>{{ $pengaduan->id_kelurahan }}</td>
                                <td>{{ $pengaduan->jenis_pelapor }}</td>
                                <td>{{ $pengaduan->ada_nik }}</td>
                                <td>{{ $pengaduan->nik }}</td>
                                <td>{{ $pengaduan->no_kk }}</td>
                                <td>{{ $pengaduan->no_kis }}</td>
                                <td>{{ $pengaduan->nama }}</td>

                                <td style="width: 120px">
                                    {!! Form::open(['route' => ['pengaduans.destroy', $pengaduan->id], 'method' => 'delete']) !!}
                                    <div class='btn-group'>
                                        <a href="{{ route('pengaduans.show', [$pengaduan->id]) }}"
                                            class='btn btn-default btn-xs'>
                                            <i class="far fa-eye"></i>
                                        </a>
                                        <a href="{{ route('pengaduans.edit', [$pengaduan->id]) }}"
                                            class='btn btn-default btn-xs'>
                                            <i class="far fa-edit"></i>
                                        </a>
                                        {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-xs',
                                            'onclick' => "return confirm('Are you sure?')",
                                        ]) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Draft --}}

            {{-- Diproses --}}
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                tabindex="0">
                <input id="myInput2" type="text" placeholder="Search.." class="mt-4">
                <table class="table table-bordered mt-2" id="pengaduans-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Pendaftaran</th>
                            <th>Tgl Pendaftaran</th>
                            <th>Layanan</th>
                            <th>Faskesos</th>
                            <th>Terlapor</th>
                            <th>NIK Terlapor</th>
                            <th>No.KK Terlapor</th>
                            <th>Sektor Program</th>
                            <th>Program</th>
                            <th>Catatan</th>
                            <th>Status</th>
                            <th>Durasi (hari)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="myTable2">
                        @foreach ($pengaduans as $pengaduan)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $pengaduan->no_pendaftaran }}</td>
                                <td>{{ $pengaduan->created_at }}</td>
                                <td>{{ $pengaduan->id_provinsi }}</td>
                                <td>{{ $pengaduan->id_kabkot }}</td>
                                <td>{{ $pengaduan->id_kecamatan }}</td>
                                <td>{{ $pengaduan->id_kelurahan }}</td>
                                <td>{{ $pengaduan->jenis_pelapor }}</td>
                                <td>{{ $pengaduan->ada_nik }}</td>
                                <td>{{ $pengaduan->nik }}</td>
                                <td>{{ $pengaduan->no_kk }}</td>
                                <td>{{ $pengaduan->no_kis }}</td>
                                <td>{{ $pengaduan->nama }}</td>

                                <td style="width: 120px">
                                    {!! Form::open(['route' => ['pengaduans.destroy', $pengaduan->id], 'method' => 'delete']) !!}
                                    <div class='btn-group'>
                                        <a href="{{ route('pengaduans.show', [$pengaduan->id]) }}"
                                            class='btn btn-default btn-xs'>
                                            <i class="far fa-eye"></i>
                                        </a>
                                        <a href="{{ route('pengaduans.edit', [$pengaduan->id]) }}"
                                            class='btn btn-default btn-xs'>
                                            <i class="far fa-edit"></i>
                                        </a>
                                        {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-xs',
                                            'onclick' => "return confirm('Are you sure?')",
                                        ]) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Diproses --}}

            {{-- Dikembalikan --}}
            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
                tabindex="0">
                <input id="myInput3" type="text" placeholder="Search.." class="mt-4">
                <table class="table table-bordered mt-2" id="pengaduans-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Pendaftaran</th>
                            <th>Tgl Pendaftaran</th>
                            <th>Layanan</th>
                            <th>Faskesos</th>
                            <th>Terlapor</th>
                            <th>NIK Terlapor</th>
                            <th>No.KK Terlapor</th>
                            <th>Sektor Program</th>
                            <th>Program</th>
                            <th>Catatan</th>
                            <th>Status</th>
                            <th>Durasi (hari)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="myTable3">
                        @foreach ($pengaduans as $pengaduan)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $pengaduan->no_pendaftaran }}</td>
                                <td>{{ $pengaduan->created_at }}</td>
                                <td>{{ $pengaduan->id_provinsi }}</td>
                                <td>{{ $pengaduan->id_kabkot }}</td>
                                <td>{{ $pengaduan->id_kecamatan }}</td>
                                <td>{{ $pengaduan->id_kelurahan }}</td>
                                <td>{{ $pengaduan->jenis_pelapor }}</td>
                                <td>{{ $pengaduan->ada_nik }}</td>
                                <td>{{ $pengaduan->nik }}</td>
                                <td>{{ $pengaduan->no_kk }}</td>
                                <td>{{ $pengaduan->no_kis }}</td>
                                <td>{{ $pengaduan->nama }}</td>

                                <td style="width: 120px">
                                    {!! Form::open(['route' => ['pengaduans.destroy', $pengaduan->id], 'method' => 'delete']) !!}
                                    <div class='btn-group'>
                                        <a href="{{ route('pengaduans.show', [$pengaduan->id]) }}"
                                            class='btn btn-default btn-xs'>
                                            <i class="far fa-eye"></i>
                                        </a>
                                        <a href="{{ route('pengaduans.edit', [$pengaduan->id]) }}"
                                            class='btn btn-default btn-xs'>
                                            <i class="far fa-edit"></i>
                                        </a>
                                        {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-xs',
                                            'onclick' => "return confirm('Are you sure?')",
                                        ]) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Dikembalikan --}}

            {{-- Selesai --}}
            <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab"
                tabindex="0">
                <input id="myInput4" type="text" placeholder="Search.." class="mt-4">
                <table class="table table-bordered mt-2" id="pengaduans-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Pendaftaran</th>
                            <th>Tgl Pendaftaran</th>
                            <th>Layanan</th>
                            <th>Faskesos</th>
                            <th>Terlapor</th>
                            <th>NIK Terlapor</th>
                            <th>No.KK Terlapor</th>
                            <th>Sektor Program</th>
                            <th>Program</th>
                            <th>Catatan</th>
                            <th>Status</th>
                            <th>Durasi (hari)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="myTable4">
                        @foreach ($pengaduans as $pengaduan)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $pengaduan->no_pendaftaran }}</td>
                                <td>{{ $pengaduan->created_at }}</td>
                                <td>{{ $pengaduan->id_provinsi }}</td>
                                <td>{{ $pengaduan->id_kabkot }}</td>
                                <td>{{ $pengaduan->id_kecamatan }}</td>
                                <td>{{ $pengaduan->id_kelurahan }}</td>
                                <td>{{ $pengaduan->jenis_pelapor }}</td>
                                <td>{{ $pengaduan->ada_nik }}</td>
                                <td>{{ $pengaduan->nik }}</td>
                                <td>{{ $pengaduan->no_kk }}</td>
                                <td>{{ $pengaduan->no_kis }}</td>
                                <td>{{ $pengaduan->nama }}</td>

                                <td style="width: 120px">
                                    {!! Form::open(['route' => ['pengaduans.destroy', $pengaduan->id], 'method' => 'delete']) !!}
                                    <div class='btn-group'>
                                        <a href="{{ route('pengaduans.show', [$pengaduan->id]) }}"
                                            class='btn btn-default btn-xs'>
                                            <i class="far fa-eye"></i>
                                        </a>
                                        <a href="{{ route('pengaduans.edit', [$pengaduan->id]) }}"
                                            class='btn btn-default btn-xs'>
                                            <i class="far fa-edit"></i>
                                        </a>
                                        {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-xs',
                                            'onclick' => "return confirm('Are you sure?')",
                                        ]) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Selesai --}}

        </div>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $pengaduans])
        </div>
    </div>
    {!! $pengaduans->links() !!}
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    $(document).ready(function() {
        $("#myInput2").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable2 tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    $(document).ready(function() {
        $("#myInput3").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable3 tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    $(document).ready(function() {
        $("#myInput4").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable4 tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
