<!DOCTYPE html>

<head>
    <title>Permohonan Layanan - Yayasan</title>
    <meta charset="utf-8">
    <style>
        #judul {
            text-align: center;
        }

        #judul {
            margin: 5px 0;
        }

        #halaman {
            width: auto;
            height: auto;
            position: absolute;
            border: 0px solid;
            padding-top: 30px;
            padding-left: 30px;
            padding-right: 30px;
            padding-bottom: 80px;
        }
    </style>


</head>

<body>
    <div id=halaman>

        <h4 id=judul>SISTEM LAYANAN RUJUKAN TERPADU</h4>
        <h4 id=judul>PUSKESOS SLRT BANDUNG</h4>
        <h4 id=judul>DINAS SOSIAL KOTA BANDUNG</h4>
        <hr>
        <p>
            
                <table>
                    <tr>
                        <td style="width: 30%;">Hari, Tanggal Pelaporan</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 65%;">{{ date('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td style="width: 30%;">Petugas</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 65%;">{{ $rekomendasi_terdaftar_yayasans->petugas }}</td>
                    </tr>
                    <tr>
                        <td style="width: 30%; vertical-align: top;">No. Permohonan</td>
                        <td style="width: 5%; vertical-align: top;">:</td>
                        <td style="width: 65%;">{{ $rekomendasi_terdaftar_yayasans->no_pendaftaran }}</td>
                    </tr>
                </table>


                <br>
                <table>
                    <tr>
                        <td style="width: 30%;">Nama Pelapor</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 65%;">{{ $rekomendasi_terdaftar_yayasans->nama_pel }}</td>
                    </tr>
                    <tr>
                        <td style="width: 30%;">NIK Pelapor</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 65%;">{{ $rekomendasi_terdaftar_yayasans->nik_pel }}</td>
                    </tr>
                    <tr>
                        <td style="width: 30%; vertical-align: top;">Alamat Pelapor</td>
                        <td style="width: 5%; vertical-align: top;">:</td>
                        <td style="width: 65%;">{{ $rekomendasi_terdaftar_yayasans->alamat_pel }}</td>
                    </tr>
                </table>
                <br>
        <table border="1">
            <tr>
                <th width="30%">No</th>
                <th width="100%">Lembaga</th>
                <th width="100%">Ketua</th>
                <th width="100%">NIK</th>
                <th width="100%">Nama Terlapor</th>
                <th width="100%">Status</th>
                <th width="100%">Tujuan</th>

            </tr>
          
                <tr>
                    <td>{{$rekomendasi_terdaftar_yayasans->id}}</td>
                    <td>{{$rekomendasi_terdaftar_yayasans->nama_lembaga}}</td>
                    <td>{{$rekomendasi_terdaftar_yayasans->nama_ketua}}</td>
                    <td>{{$rekomendasi_terdaftar_yayasans->nik_ter}}</td>
                    <td>{{$rekomendasi_terdaftar_yayasans->nama_ter}}</td>
                    <td>{{$rekomendasi_terdaftar_yayasans->status}}</td>
                    <td>{{$rekomendasi_terdaftar_yayasans->name_roles}}</td>
                </tr>
          
            <!-- tambahkan baris sesuai kebutuhan -->
        </table>
        <p></p>
        <table>
            <tr>
                <td style="width: 30%;">Lampiran</td>
            </tr>
            <tr>
                <td style="width: 30%;">-KTP</td>
            </tr>
            <tr>
                <td style="width: 30%;">-KK</td>
            </tr>
        </table>
    </div>

</body>

</html>
