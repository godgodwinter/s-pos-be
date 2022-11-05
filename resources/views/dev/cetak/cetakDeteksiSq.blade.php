<x-cetak.cetak-style2></x-cetak.cetak-style2>
{{-- <link rel="stylesheet" href="{{ asset('/') }}assets/css/babeng.css" /> --}}
<style>
    .meter {
        height: 14px;
        /* Can be anything */
        position: relative;
        background: #555;
        -moz-border-radius: 25px;
        -webkit-border-radius: 25px;
        border-radius: 25px;
        padding: 2px;
        -webkit-box-shadow: inset 0 -1px 1px rgba(255, 255, 255, 0.3);
        -moz-box-shadow: inset 0 -1px 1px rgba(255, 255, 255, 0.3);
        box-shadow: inset 0 -1px 1px rgba(255, 255, 255, 0.3);
    }

    .meter>span {
        display: block;
        height: 100%;
        -webkit-border-top-right-radius: 8px;
        -webkit-border-bottom-right-radius: 8px;
        -moz-border-radius-topright: 8px;
        -moz-border-radius-bottomright: 8px;
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
        -webkit-border-top-left-radius: 20px;
        -webkit-border-bottom-left-radius: 20px;
        -moz-border-radius-topleft: 20px;
        -moz-border-radius-bottomleft: 20px;
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
        background-color: #f1a165;
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #f1a165), color-stop(1, #f36d0a));
        background-image: -webkit-linear-gradient(top, #f1a165, #f36d0a);
        background-image: -moz-linear-gradient(top, #f1a165, #f36d0a);
        background-image: -ms-linear-gradient(top, #f1a165, #f36d0a);
        background-image: -o-linear-gradient(top, #f1a165, #f36d0a);
        -webkit-box-shadow: inset 0 2px 9px rgba(255, 255, 255, 0.3), inset 0 -2px 6px rgba(0, 0, 0, 0.4);
        -moz-box-shadow: inset 0 2px 9px rgba(255, 255, 255, 0.3), inset 0 -2px 6px rgba(0, 0, 0, 0.4);
        position: relative;
        overflow: hidden;
    }
</style>

<body>
    <x-cetak.cetak-kop></x-cetak.cetak-kop>

    @php
        //data
        $dataTotalEq = (object) ['id' => 1, 'nama' => 'Total Eq', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null];
        $dataEq = [
            (object) ['id' => 1, 'nama' => 'KESADARAN EMOSI DIRI', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 2, 'nama' => 'EKSPRESI EMOSI', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 3, 'nama' => 'KESADARAN EMOSI ORANG LAIN', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 4, 'nama' => 'KREATIVITAS EMOSI DIRI', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 5, 'nama' => 'KETANGGUHAN ATAU KEGIGIHAN', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 6, 'nama' => 'HUBUNGAN ANTAR PRIBADI', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 7, 'nama' => 'KETIDAK PUASAN KONSTRUKTIF', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 8, 'nama' => 'SUDUT PANDANG', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 9, 'nama' => 'BELAS KASIHAN ATAU EMPATI', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 10, 'nama' => 'INSTUISI', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 11, 'nama' => 'INTENSIONALITAS', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 12, 'nama' => 'RADIUS KEPERCAYAAN', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 13, 'nama' => 'DAYA PRIBADI', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
        ];
        $dataTotalScq = (object) ['id' => 1, 'nama' => 'Total Scq', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null];
        $dataScq = [
            (object) ['id' => 1, 'nama' => 'MEMAHAMI ORANG LAIN', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 2, 'nama' => 'KEMAMPUAN SOSIAL', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 3, 'nama' => 'KETRAMPILAN MENJALIN HUBUNGAN', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 4, 'nama' => 'KEBERSAMAAN DAN KERJASAMA', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 5, 'nama' => 'KEPEDULIAN DAN TOLONG-MENOLONG', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 6, 'nama' => 'TOLERANSI', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 7, 'nama' => 'KEMAMPUAN KOMUNIKASI INTERAKTIF', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 8, 'nama' => 'HUBUNGAN INTERAKTIF', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 9, 'nama' => 'KESERASIAN DAN KEHARMONISAN', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
        ];
        $dataTotalSq = (object) ['id' => 1, 'nama' => 'Total Sq', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null];
        $dataSq = [
            (object) ['id' => 1, 'nama' => 'PERCAYA DIRI DAN YAKIN', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 2, 'nama' => 'HARGA DIRI', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 3, 'nama' => 'TANGGUNG JAWAB', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 4, 'nama' => 'KEADILAN', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 5, 'nama' => 'KEBIJAKSANAAN', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 6, 'nama' => 'JUJUR DAN TERBUKA', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 7, 'nama' => 'KEBERSAMAAN DAN KESETIAKAWANAN', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 8, 'nama' => 'RENDAH HATI', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 9, 'nama' => 'KEJERNIHAN HATI DAN PIKIRAN', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 10, 'nama' => 'KEBAIKAN DAN KEBAJIKAN', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 11, 'nama' => 'KETULUSAN DAN KEIKHLASAN', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 12, 'nama' => 'PENGORBANAN DAN MAAF', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
            (object) ['id' => 13, 'nama' => 'KETENTRAMAN DAN KEDAMAIAN', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null],
        ];
        $dataTotal = (object) ['id' => 1, 'nama' => 'Total', 'deteksi_nama' => null, 'deteksi_rank' => null, 'deteksi_score' => null, 'deteksi_keterangan' => null];

        // dd($deteksiList);

        foreach ($deteksiList as $key => $value) {
            foreach ($dataEq as $key => $data) {
                if ($value->deteksi_nama == $data->nama) {
                    $data->deteksi_score = $value->deteksi_score;
                    $data->deteksi_rank = $value->deteksi_rank;
                    $data->deteksi_keterangan = $value->deteksi_keterangan;
                }
            }
            foreach ($dataScq as $key => $data) {
                if ($value->deteksi_nama == $data->nama) {
                    $data->deteksi_score = $value->deteksi_score;
                    $data->deteksi_rank = $value->deteksi_rank;
                    $data->deteksi_keterangan = $value->deteksi_keterangan;
                }
            }
            foreach ($dataSq as $key => $data) {
                if ($value->deteksi_nama == $data->nama) {
                    $data->deteksi_score = $value->deteksi_score;
                    $data->deteksi_rank = $value->deteksi_rank;
                    $data->deteksi_keterangan = $value->deteksi_keterangan;
                }
            }
            if ($value->deteksi_nama == 'TOTAL EQ') {
                $dataTotalEq->deteksi_score = $value->deteksi_score;
                $dataTotalEq->deteksi_rank = $value->deteksi_rank;
                $dataTotalEq->deteksi_keterangan = $value->deteksi_keterangan;
            }
            if ($value->deteksi_nama == 'TOTAL SCQ') {
                $dataTotalScq->deteksi_score = $value->deteksi_score;
                $dataTotalScq->deteksi_rank = $value->deteksi_rank;
                $dataTotalScq->deteksi_keterangan = $value->deteksi_keterangan;
            }
            if ($value->deteksi_nama == 'TOTAL SQ') {
                $dataTotalSq->deteksi_score = $value->deteksi_score;
                $dataTotalSq->deteksi_rank = $value->deteksi_rank;
                $dataTotalSq->deteksi_keterangan = $value->deteksi_keterangan;
            }
            if ($value->deteksi_nama == 'TOTAL') {
                $dataTotal->deteksi_score = $value->deteksi_score;
                $dataTotal->deteksi_rank = $value->deteksi_rank;
                $dataTotal->deteksi_keterangan = $value->deteksi_keterangan;
            }
        }
    @endphp
    {{-- <table width="100%"  id="tableBiasa2"> --}}
    <div class="babeng-default">
        <center>
            <h4 class="text-center">DETEKSI KECERDASAN EMOSI, SOSIAL DAN SPIRITUAL </h4>
            {{-- <h4 class="text-center"> (EQ; Sc.Q; SQ)</h4>
            <h4 class="text-center">ASPEK - ASPEK KECERDASAN EQ; Sc.Q ; SQ</h4> --}}
        </center>
        <br>
        {{-- <table width="50%" class="table table-sm table-light" id="tableBiasa"> --}}
        <table width="50%" id="tableBiasa">
            <tr>
                <th width="100px">Nama</th>
                <th width="4%">:</th>
                <th>{{ $datasiswa->nama }}</th>
            </tr>
            <tr>
                <th width="100px">Umur</th>
                <th width="4%">:</th>
                <th>{{ $deteksi->umur ? $deteksi->umur : '-' }}</th>
            </tr>
            <tr>
                <th width="100px">Jenis Kelamin</th>
                <th width="4%">:</th>
                <th>{{ $datasiswa->jk }}</th>
            </tr>
            <tr>
                <th width="100px">Sekolah</th>
                <th width="4%">:</th>
                <th>{{ $datasiswa->sekolah_nama }} </th>
            </tr>
            <tr>
                <th width="100px">Kelas</th>
                <th width="4%">:</th>
                <th>{{ $datasiswa->kelas_nama }} </th>
            </tr>
        </table>

        {{-- <table width="100%" class="table table-sm table-light"> --}}

        <table width="100%" id="tableBiasa2">
            <thead>
                <tr>
                    <th width="1%">1.</th>
                    <th width="100px" class="align-left">EQ (Emotional Quotient)</th>
                    <th width="60px">{{ $dataTotalEq->deteksi_score }} %</th>
                    <th width="100px">Keterangan</th>
                    <th>{{ $dataTotalEq->deteksi_keterangan }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataEq as $key => $data)
                    <tr>
                        <th width="1%"></th>
                        <th width="300px">{{ $key + 1 }}. {{ $data->nama }}</th>
                        <th width="60px">{{ $data->deteksi_score }} %</th>
                        <th width="100px">{{ $data->deteksi_keterangan }}</th>
                        <th>
                            <div class="meter">
                                <span style="width: {{ $data->deteksi_score ? $data->deteksi_score : 0 }}%"></span>
                                <!-- I use my viewmodel in MVC to calculate the progress and then use @Model.progress to place it in my HTML with Razor -->
                            </div>

                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <table width="100%" class="table table-sm table-light"> --}}
        <table width="100%" id="tableBiasa2">
            <tr>
                <th width="1%">2.</th>
                <th width="100px">SCQ (Social Quotient)</th>
                <th width="60px">{{ $dataTotalScq->deteksi_score }} %</th>
                <th width="100px">Keterangan</th>
                <th>{{ $dataTotalScq->deteksi_keterangan }}</th>
            </tr>
            @foreach ($dataScq as $key => $data)
                <tr>
                    <th width="1%"></th>
                    <th width="300px">{{ $key + 1 }}. {{ $data->nama }}</th>
                    <th width="60px">{{ $data->deteksi_score }} %</th>
                    <th width="100px">{{ $data->deteksi_keterangan }}</th>
                    <th>
                        <div class="meter">
                            <span style="width: {{ $data->deteksi_score ? $data->deteksi_score : 0 }}%"></span>
                            <!-- I use my viewmodel in MVC to calculate the progress and then use @Model.progress to place it in my HTML with Razor -->
                        </div>

                    </th>
                </tr>
            @endforeach
        </table>
        {{-- <table width="100%" class="table table-sm table-light"> --}}
        <table width="100%" id="tableBiasa2">
            <tr>
                <th width="1%">3.</th>
                <th width="100px">SQ (Spiritual Quotient)</th>
                <th width="60px">{{ $dataTotalSq->deteksi_score }} %</th>
                <th width="100px">Keterangan</th>
                <th>{{ $dataTotalSq->deteksi_keterangan }}</th>
            </tr>
            @foreach ($dataSq as $key => $data)
                <tr>
                    <th width="1%"></th>
                    <th width="300px">{{ $key + 1 }}. {{ $data->nama }}</th>
                    <th width="60px">{{ $data->deteksi_score }} %</th>
                    <th width="100px">{{ $data->deteksi_keterangan }}</th>
                    <th>
                        <div class="meter">
                            <span style="width: {{ $data->deteksi_score ? $data->deteksi_score : 0 }}%"></span>
                            <!-- I use my viewmodel in MVC to calculate the progress and then use @Model.progress to place it in my HTML with Razor -->
                        </div>

                    </th>
                </tr>
            @endforeach
        </table>
        {{-- <table width="100%" class="table table-sm table-light">
        <tr>
            <th width="1%"></th>
            <th width="300px">TOTAL</th>
            <th width="60px">{{ $dataTotal->deteksi_score }} %</th>
            <th width="100px">Keterangan</th>
            <th>{{ $dataTotal->deteksi_keterangan }}</th>
        </tr>

    </table> --}}

        <table width="50%" class="table table-light" id="tableBiasa">
            <tr>
                <th width="3%"></th>
                <th width="40%" align="center">
                    {{-- <br>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <br><br><br><br><br><br><br><br> --}}
                    {{-- <hr style="width:70%; border-top:2px dotted; border-style: none none dotted;  "> --}}

                </th>

                <th width="24%"></th>

                <th width="50%" align="center">
                    <center>
                        Mengetahui <br>
                        Pimpinan YPMT
                        <br><br><br><br>

                        Drs. Yohanes Bambang RHP, Psi
                        <center>
                </th>
                <th width="3%"></th>

            </tr>

        </table>
    </div>
</body>
