<x-cetak.cetak-style></x-cetak.cetak-style>
{{-- <link rel="stylesheet" href="{{ asset('/') }}assets/css/babeng.css" /> --}}

<body>
<x-cetak.cetak-kop></x-cetak.cetak-kop>

    <h4 class="text-center" >Klasifikasi Akademis dan Profesi</h4>



  <div class="py-4 px-2">
      @foreach ($items as $item)
      <h5>{{ $loop->index+1 }}. Bidang : {{ $item->bidang }}</h5>
<div class="py-2 px-2" style="margin-left: 4px">

    <p><strong>Akademis :</strong> {{ $item->akademis }}</p>
    <p><strong>Profesi :</strong> {{ $item->profesi }}</p>
    <p><strong>Nilai Standart :</strong> {{ $item->nilaistandart }}</p>
    <p><strong>IQ Standart :</strong> {{ $item->iqstandart }}</p>
    <p><strong>Jurusan dan Bidang Studi yang ditekuni :</strong> {{ $item->jurusandanbidangstudi }}</p>
    <p><strong>Pekerjaan dan Keterangan : </strong>{{ $item->pekerjaandanketerangan }}</p>

</div>

      @endforeach
  </div>
</body>
