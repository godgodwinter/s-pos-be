<x-cetak.cetak-style></x-cetak.cetak-style>
{{-- <link rel="stylesheet" href="{{ asset('/') }}assets/css/babeng.css" /> --}}

<body>
<x-cetak.cetak-kop></x-cetak.cetak-kop>

    <h5 class="text-center" >CATATAN KASUS SISWA</h5>



    <table width="50%" class="table table-sm table-light">
        <tr>
            <th width="80px">Nama</th>
            <th width="4%">:</th>
            <th>Nama Siswa</th>
        </tr>
        <tr>
            <th width="80px">Sekolah</th>
            <th width="4%">:</th>
            <th>Sekolah </th>
        </tr>
        <tr>
            <th width="80px">Kelas</th>
            <th width="4%">:</th>
            <th>Kelas </th>
        </tr>
    </table>

  <div class="py-4 px-2">
      @for ($i = 0; $i <10 ; $i++)
      <div class="py-2 px-1" >
        <h5>1. Catatan</h5>
        <p><strong >Tanggal Catatan : </strong> <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla odit quas dolorem soluta veritatis. Recusandae quisquam voluptate aperiam quibusdam, velit sint, reprehenderit quia consequatur culpa dignissimos labore explicabo vel impedit.</span></p>
        <p>Tanggal Catatan</p>
    </div>
      @endfor
  </div>
</body>
