<x-cetak.cetak-style></x-cetak.cetak-style>
{{-- <link rel="stylesheet" href="{{ asset('/') }}assets/css/babeng.css" /> --}}

<body>
<x-cetak.cetak-kop></x-cetak.cetak-kop>

    <h5 class="text-center" >CATATAN PENGEMBANGANDIRI SISWA</h5>



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
        <h5>{{ $loop->index+1 }}.  {{ $item->idedanimajinasi }}</h5>
        <p><strong >Tanggal  : </strong> <span>{{ $item->tanggal?Fungsi::tanggalindo(date('Y-m-d', strtotime($item->tanggal))):"-"}}</span></p>
        <p><strong >Ketrampilan  : </strong> <span>{{ $item->ketrampilan }}</span></p>
        <p><strong >Kreatif    : </strong> <span>{{ $item->kreatif }}</span></p>
        <p><strong >Organisasi    : </strong> <span>{{ $item->organisasi }}</span></p>
        <p><strong >Kelanjutan Studi    : </strong> <span>{{ $item->kelanjutanstudi }}</span></p>
        <p><strong >Hobi    : </strong> <span>{{ $item->hobi }}</span></p>
        <p><strong >Cita - cita    : </strong> <span>{{ $item->citacita }}</span></p>
        <p><strong >Kemampuan Khusus    : </strong> <span>{{ $item->kemampuankhusus }}</span></p>
        <p><strong >Keterangan    : </strong> <span>{{ $item->keterangan }}</span></p>

    </div>
      @endforeach
  </div>
</body>
