<x-cetak.cetak-style></x-cetak.cetak-style>
{{-- <link rel="stylesheet" href="{{ asset('/') }}assets/css/babeng.css" /> --}}

<body>
<x-cetak.cetak-kop></x-cetak.cetak-kop>

    <h5 class="text-center" >CATATAN PRESTASI SISWA</h5>



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
        <h5>{{ $loop->index+1 }}.  {{ $item->prestasi }}</h5>
        <p><strong >Tanggal  : </strong> <span>{{ $item->tanggal?Fungsi::tanggalindo(date('Y-m-d', strtotime($item->tanggal))):"-"}}</span></p>
        <p><strong >Teknik Belajar  : </strong> <span>{{ $item->teknikbelajar }}</span></p>
        <p><strong >Saran Belajar   : </strong> <span>{{ $item->saranabelajar }}</span></p>
        <p><strong >Penunjang Belajar  : </strong> <span>{{ $item->penunjangbelajar }}</span></p>
        <p><strong >Kesimpulan dan Saran   : </strong> <span>{{ $item->kesimpulandansaran }}</span></p>

    </div>
      @endforeach
  </div>
</body>
