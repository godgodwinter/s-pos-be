<x-cetak.cetak-style></x-cetak.cetak-style>
{{-- <link rel="stylesheet" href="{{ asset('/') }}assets/css/babeng.css" /> --}}

<body>
<x-cetak.cetak-kop></x-cetak.cetak-kop>

    <h5 class="text-center" >CATATAN KASUS SISWA</h5>



    <table width="50%" class="table table-sm table-light">
        <tr>
            <th width="80px">Nama</th>
            <th width="4%">:</th>
            <th>{{ $datasiswa->nama }}</th>
        </tr>
        <tr>
            <th width="80px">Sekolah</th>
            <th width="4%">:</th>
            <th>{{ $datasiswa->sekolah?$datasiswa->sekolah->nama:'' }} </th>
        </tr>
        <tr>
            <th width="80px">Kelas</th>
            <th width="4%">:</th>
            <th>{{ $datasiswa->kelas?$datasiswa->kelas->nama:'' }} </th>
        </tr>
    </table>

  <div class="py-4 px-2">
      @foreach ($items as $item)
      <div class="py-2 px-1" >
        <h5>{{ $loop->index+1 }}. Nama Kasus : {{ $item->kasus }}</h5>
        <p><strong >Tanggal  : </strong> <span>{{ $item->tanggal?Fungsi::tanggalindo(date('Y-m-d', strtotime($item->tanggal))):"-"}}</span></p>
        <p><strong >Pengambilan data  : </strong> <span>{{ $item->pengambilandata }}</span></p>
        <p><strong >Sumber Kasus   : </strong> <span>{{ $item->sumberkasus }}</span></p>
        <p><strong >Golongan Kasus   : </strong> <span>{{ $item->golkasus }}</span></p>
        <p><strong >Penyebab Kasus   : </strong> <span>{{ $item->penyebabtimbulkasus }}</span></p>
        <p><strong >Teknik Konseling    : </strong> <span>{{ $item->teknikkonseling }}</span></p>
        <p><strong >Keberhasilan Penanganan Kasus   : </strong> <span>{{ $item->keberhasilanpenanganankasus }}</span></p>
        <p><strong >Keterangan   : </strong> <span>{{ $item->keterangan }}</span></p>

    </div>
      @endforeach
  </div>
</body>
