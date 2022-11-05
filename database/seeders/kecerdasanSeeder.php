<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kecerdasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kecerdasanmajemuk')->truncate();

        $datas = [
            (object)[
                'nama' => 'Kecerdasan Linguistik',
                'visual' => 'Suka belajar memperhatikan dan me-
                ngamati cara menyebutkan suatu kata
                tertentu melalui bentuk ekspresi wajah
                yg ditangkap(usahakan variasi ekspresi
                wajah fleksibel, kommbinatif supaya
                dapat/mudah diterima), bentuk tulisan
                yg ditangkap sangat bervariasi bentuk
                dan warna.',
                'auditif' => 'Suka dan sering belajar bercerita/-
                ngobrol dg mengelustrasikan kata-2
                yg menarik, lembut, memberi rasa
                senang,riang gembira,ada rasa humor
                atau lucu, rasa tenang, rasa tentram
                dan damai, tetapi tidak mengurangi
                bobot kualitas dari makna yang di-
                ceritakan dan dibicarakan.',
                'kinestetik' => 'Saat mengungkapkan kata-kata sering dan
                suka diikuti dengan menggunakan gerakan-
                gerakan  anggota fisik tertentu bisa dibantu
                dengan alat peraga sebagai simbol untuk
                memperjelas ungkapan kata. Ekspresi
                gerakan biasanya lebih menunjukkan
                variatif, kombinatif dari arah pembicaraan
                yang dituju.',
            ],
            (object)[
                'nama' => 'Kecerdasan Logis - Matematis',
                'visual' => 'Suka belajar menunjukkan gambar-gambar
                bentuk diagram di ikuti dengan perhitungan
                sebagai ungkapan  argumentasi yang di-
                sampaikan dari hasil analisa secara logika
                dan rasional.',
                'auditif' => 'Suka berbicara dalam menyampaikan riset.
                pendapat dan argumentasi secara  tepat
                dan benar berdasarkan hasil pemikiran
                kritis dan menggunakan daya nalar yg kuat
                melalui hasil analisa yang matang dari
                berbagai uji riset',
                'kinestetik' => 'Suka menyampaikan setiap pendapat dan
                argumentasinya melalui pembuktian  demon-
                trasi peraga dengan gerakan kecepatan, kete-
                patan ketelitian dan perhitungan yang matang
                melalui analisa  riset',
            ],
            (object)[
                'nama' => 'Kecerdasan Spasial',
                'visual' => 'Suka belajar menunjukkan gambar-2 pada
                anak melalui desain, coretan, pola/bentuk
                posisi letak berbeda yg menunjukkan kesan
                berfikir secara sistematis.',
                'auditif' => 'Suka belajar menyampaikan melalui ber-
                bicara dan bercerita dengan menggambar-
                kan obyek tentang cirri-ciri  fisik secara
                praktis jelas.',
                'kinestetik' => 'Suka belajar menggunakan imajinasi gambar
                dengan mengilustrasikan melalui peraga dan
                gerakan fisik secara ritsmit, runtut/teratur dan
                sistematis dalam segala deminsi letak/ruang dan
                waktu.',
            ],
            (object)[
                'nama' => 'Kecerdasan Musikal',
                'visual' => 'Suka belajar menyampaikan suatu ide/gaga-
                san saat melihat pertunjukan ekspresi visual
                melihat  tayangan atau pentas seni  menya-
                nyi lagu dengan irama dan melodi yg mem-
                beri pesona menyenangkan dan terkesan dpt
                membangkitkan semangat.',
                'auditif' => 'Suka dan sering belajar dengan  memper-
                dengarkan musik dan lagu serta mampu
                menyanyi secara baik dan benar. Mampu
                menulis dan menggubah lagu, menciptakan
                lagu-2 baru. Terkesan dapat membangkit-
                kan memory dan gairah bersemangat.',
                'kinestetik' => 'Suka belajar sambil bernyanyi dengan bereks-
                presi  menggerakkan tangannya dan seluruh
                anggota tubuhnya  mengikuti irama lagu yang
                memberi daya kekuatan berfikir dan membang-
                kitkan gairah semangat belajar.',
            ],
            (object)[
                'nama' => 'Kecerdasan Kinetik',
                'visual' => 'Suka  dan sering belajar mengamati gerakan
                gerakan melalui gambar, pengamatan lang-
                sung dan film terkesan adanya peniruan pem-
                belajaran langsung dan pengembangan ide-2
                untuk menciptakan kreasi-2 baru dalam olah
                fisik.',
                'auditif' => 'Sering dan suka belajar memahami sertiap
                instruksi/petunjuk perintah langsung dan
                melalui membaca langsung  untuk diprak-
                tekkan/memperagakan gerakan badannya
                dalam mengikuti pelatihan olah fisik.',
                'kinestetik' => 'Sering dan suka belajar dengan menggunakan
                olah fisik untuk melatih ketrampilan gerakan
                otot halus dan kasar untuk mengembangkan
                talenta yang terkait dengan bidang keolah
                ragaan dan seni tari.',
            ],
            (object)[
                'nama' => 'Kecerdasan Interpersonal',
                'visual' => 'Suka belajar dan sering  mengajak berko-
                munikasi  melalui media komunikasi  cetak
                dan media  elektronika (telepon/HP/dan
                dunia maya) dan melihat langsung ikut peran
                serta  kegiatan organisasi masyarakat.',
                'auditif' => 'Suka belajar dan sering melakukan kegia-
                tan diskusi kelompok, debat dan memba-
                ngun kerja sama yang baik, toleransi untuk
                mencari prestasi dan keberhasilan kemaju-
                an bersama.',
                'kinestetik' => 'Suka belajar dan sering membuat planing kerja
                sama kelompok dengan menerapkan kerja nyata
                di lapangan dalam kegiatan sosial berupa pelatih-
                an ketrampilan -2. ',
            ],
            (object)[
                'nama' => 'Kecerdasan Intrapersonal',
                'visual' => 'Suka belajar dan sering mengamati berbagai
                macam ekspresi emosi,di sekitarnya  seperti
                tertawa riang, menangis sedih, dll. baik utk
                membangun strategi dan semangat belajar
                atau kerja.',
                'auditif' => 'Suka belajar dan sering Membaca buku -
                buku tentang sikap dan perwatakan
                manusia serta  mendengarkan cerita karak-
                ter org bijak sebagai pengetahuan dan
                pengalaman  membangun karakter yang
                baik.',
                'kinestetik' => 'Suka belajar dan sering melakukan relaksasi
                emosi dengan menyalurkan ke hoby olah fisik
                melalui olah raga, seni tari untuk membangun
                energi emosi positif yang memberikan rasa
                tenang, nyaman, senang, gembira, semangat.dll.',
            ],
            (object)[
                'nama' => 'Kecerdasan Natural',
                'visual' => 'Suka belajar dan sering melihat dan  meng-
                amati berbagai flora dan fauna yang ada di
                sekitarnya yang dapat memberi rasa nyaman,
                menyenangkan sebagai upaya menumbuhkan
                kecintaan dan semangat utk berprestasi serta
                memberdayakan lingkungan sekitarnya.',
                'auditif' => 'Sering dan suka belajar mendiskusikan
                tentang pelestarian alam sekitarnya serta
                berupaya memainkan gagasan/ menyalur-
                kan ide-2  untuk membuat karya tulis
                ilmiah yang berkaitan dengan membuat
                budidaya pengembangan bibit-2 unggul.',
                'kinestetik' => 'Sering dan suka belajar melakukan praktek
                pemeliharaan dan perawatan, pembudidayaan,
                serta melakukan  riset ilmiah pembuatan pem-
                bibitan unggul mencari fariitas /species baru.',
            ],
            // (object)[
            //     'nama' => 'Kecerdasan Eksistensial/Moral',
            //     'visual' => 'Suka belajar dan sering melihat dan  meng-
            //     amati berbagai flora dan fauna yang ada di
            //     sekitarnya yang dapat memberi rasa nyaman,
            //     menyenangkan sebagai upaya menumbuhkan
            //     kecintaan dan semangat utk berprestasi serta
            //     memberdayakan lingkungan sekitarnya.',
            //     'auditif' => 'Sering dan suka belajar mendiskusikan
            //     tentang pelestarian alam sekitarnya serta
            //     berupaya memainkan gagasan/ menyalur-
            //     kan ide-2  untuk membuat karya tulis
            //     ilmiah yang berkaitan dengan membuat
            //     budidaya pengembangan bibit-2 unggul.',
            //     'kinestetik' => 'Sering dan suka belajar melakukan praktek
            //     pemeliharaan dan perawatan, pembudidayaan,
            //     serta melakukan  riset ilmiah pembuatan pem-
            //     bibitan unggul mencari fariitas /species baru.',
            // ],

        ];

        foreach ($datas as $data) {
            DB::table('kecerdasanmajemuk')->insert([
                'nama' => $data->nama,
                'visual' => $data->visual,
                'auditif' => $data->auditif,
                'kinestetik' => $data->kinestetik,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
