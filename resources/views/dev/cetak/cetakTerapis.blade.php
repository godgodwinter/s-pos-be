<x-cetak.cetak-style></x-cetak.cetak-style>
{{-- <link rel="stylesheet" href="{{ asset('/') }}assets/css/babeng.css" /> --}}

<body>
<x-cetak.cetak-kop></x-cetak.cetak-kop>

    <h4 class="text-center" >Terapis Karakter Positif</h4>

    <table width="50%" class="table table-sm table-light">
        <tr>
            <th width="80px">Nama</th>
            <th width="4%">:</th>
            <th>{{ $datasiswa->nama }}</th>
        </tr>
        <tr>
            <th width="80px">Sekolah</th>
            <th width="4%">:</th>
            <th>{{ $datasiswa->sekolah_nama}} </th>
        </tr>
        <tr>
            <th width="80px">Kelas</th>
            <th width="4%">:</th>
            <th>{{ $datasiswa->kelas_nama }} </th>
        </tr>
    </table>

  <div class="py-4 px-2">
      @foreach ($items as $item)
      <h5>{{ $loop->index+1 }}. {{ $item->label }}</h5>
      @forelse ( $item->data as $d)
      <div class="py-2 px-2" style="margin-left: 4px">

        <h5><strong># Nama Karakter :</strong> {{ ucfirst($d->kata) }}</h5>
        <div class="py-2 px-2" style="margin-left: 4px">
            <p><strong>Pemahaman dan Pengertian  :</strong> {{ $d->pemahaman }}</p>
            <p><strong>Tujuan dan Manfaat   :</strong> {{ $d->tujuandanmanfaat }}</p>
            <p><strong>Pembiasaan Sikap dan Penerapan   :</strong> {{ $d->pembiasaansikap }}</p>
        </div>

    </div>
      @empty

      @endforelse


      @endforeach
  </div>
</body>
