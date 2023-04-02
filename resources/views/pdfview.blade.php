<!DOCTYPE html>

<head>
    <title>RESI-Pengaduan</title>
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
                        <td style="width: 65%;">{{ $pengaduan->petugas }}</td>
                    </tr>
                    <tr>
                        <td style="width: 30%; vertical-align: top;">No. Pengaduan</td>
                        <td style="width: 5%; vertical-align: top;">:</td>
                        <td style="width: 65%;">{{ $pengaduan->no_pendaftaran }}</td>
                    </tr>
                </table>


                <br>
                <table>
                    <tr>
                        <td style="width: 30%;">Nama Pelapor</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 65%;">{{ $pengaduan->nama }}</td>
                    </tr>
                    <tr>
                        <td style="width: 30%;">NIK Pelapor</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 65%;">{{ $pengaduan->nik }}</td>
                    </tr>
                    <tr>
                        <td style="width: 30%; vertical-align: top;">Alamat Pelapor</td>
                        <td style="width: 5%; vertical-align: top;">:</td>
                        <td style="width: 65%;">-</td>
                    </tr>
                </table>
                <br>
        <table border="1">
            <tr>
                <th width="30%">No</th>
                <th width="100%">Level Program</th>
                <th width="100%">Sektor Program</th>
                <th width="100%">Nama Program</th>
                <th width="100%">Ringkasan Pengaduan</th>
                <th width="100%">Detail Pengaduan</th>

            </tr>
          
                <tr>
                    <td>1</td>
                    <td>{{$pengaduan->level_program}}</td>
                    <td>{{$pengaduan->sektor_program}}</td>
                    <td>{{$pengaduan->id_program_sosial}}</td>
                    <td>{{$pengaduan->ringkasan_pengaduan}}</td>
                    <td>{{$pengaduan->detail_pengaduan}}</td>
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
