<?php

namespace Database\Seeders;

use App\Models\Indikator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndikatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $indikators = [
            // ================= PRAMUBAKTI (1) =================
            ['kriteria_id' => 1, 'jabatan' => 1, 'indikator' => 'Pramubakti/Pramusaji memiliki inisiatif untuk melakukan pekerjaan tanpa menunggu perintah dari atasan/penerima layanan'],
            ['kriteria_id' => 2, 'jabatan' => 1, 'indikator' => 'Pramubakti/Pramusaji memiliki ide-ide baru dalam menyelesaikan tugas'],
            ['kriteria_id' => 3, 'jabatan' => 1, 'indikator' => 'Pramubakti/pramusaji mampu berkomunikasi (menyampaikan pendapat, berbicara, berargumen) secara jelas dan baik dengan orang lain (rekan, atasan, tamu yang dilayani)'],
            ['kriteria_id' => 4, 'jabatan' => 1, 'indikator' => 'Pramubakti/Pramusaji mudah menyesuaikan diri dengan perubahan lingkungan dan dinamika yang dihadapi, misalnya perubahan aturan kantor, permintaan mendadak dari pengguna layanan, perubahan lingkungan kerja, dsb.'],
            ['kriteria_id' => 5, 'jabatan' => 1, 'indikator' => 'Pramubakti/Pramusaji menunjukkan semangat kerja dan kemauan untuk bekerja, seperti datang lebih awal, selalu bersemangat, dsb.'],
            ['kriteria_id' => 6, 'jabatan' => 1, 'indikator' => 'Pramubakti/Pramusaji  memiliki hubungan kerja/ berinteraksi dengan rekan kerja maupun atasan dengan baik dalam melaksanakan tugas'],
            ['kriteria_id' => 7, 'jabatan' => 1, 'indikator' => 'Pramubakti/Pramusaji mampu melaksanakan tugas penyiapan jamuan secara mandiri tanpa pengawasan'],
            ['kriteria_id' => 8, 'jabatan' => 1, 'indikator' => 'Pramubakti/Pramusaji memahami cara penyimpanan dan penataan alat perlengkapan kerjanya dengan baik dan higienis'],
            ['kriteria_id' => 9, 'jabatan' => 1, 'indikator' => 'Pramubakti/Pramusaji mampu menyiapkan ruang dan menata konsumsi rapat sesuai instruksi'],

            // ================= TATA TEMPAT (2) =================
            ['kriteria_id' => 1, 'jabatan' => 2, 'indikator' => 'Petugas Tata Tempat memiliki inisiatif untuk melakukan pekerjaan tanpa menunggu perintah dari atasan/penerima layanan'],
            ['kriteria_id' => 2, 'jabatan' => 2, 'indikator' => 'Petugas Tata Tempat memiliki ide-ide baru dalam menyelesaikan tugas'],
            ['kriteria_id' => 3, 'jabatan' => 2, 'indikator' => 'Petugas Tata Tempat mampu berkomunikasi (menyampaikan pendapat, berbicara, berargumen) secara jelas dan baik dengan orang lain (rekan, atasan, dan pengguna layanan'],
            ['kriteria_id' => 4, 'jabatan' => 2, 'indikator' => 'Petugas Tata Tempat mudah menyesuaikan diri dengan perubahan lingkungan dan dinamika yang dihadapi, misalnya perubahan aturan kantor, perubahan lingkungan kerja, permintaan mendadak dari pengguna layanan, dsb.'],
            ['kriteria_id' => 5, 'jabatan' => 2, 'indikator' => 'Petugas Tata Tempat menunjukkan semangat kerja dan kemauan untuk bekerja, seperti datang lebih awal, selalu bersemangat, dsb.'],
            ['kriteria_id' => 6, 'jabatan' => 2, 'indikator' => 'Petugas Tata Tempat memiliki hubungan kerja/ berinteraksi dengan rekan kerja maupun atasan dengan baik dalam melaksanakan tugas'],
            ['kriteria_id' => 7, 'jabatan' => 2, 'indikator' => 'Petugas Tata Tempat mampu melaksanakan tugas penyiapan tata tempat secara mandiri tanpa pengawasan'],
            ['kriteria_id' => 8, 'jabatan' => 2, 'indikator' => 'Petugas Tata Tempat mampu melakukan pemasangan, perbaikan ringan, atau penggantian perlengkapan tata tempat secara mandiri (misal sarung kursi, rangkaian bunga, bendera, dsb)'],
            ['kriteria_id' => 9, 'jabatan' => 2, 'indikator' => 'Petugas Tata Tempat mampu mengatur dengan baik perlengkapan penunjang kegiatan (seperti kursi, sarung kursi, meja, taplak, pengharum ruangan, dsb) sesuai instruksi'],

            // ================= PENGEMUDI (3) =================
            ['kriteria_id' => 1, 'jabatan' => 3, 'indikator' => 'Pengemudi memiliki inisiatif untuk melakukan pekerjaan tanpa menunggu perintah dari atasan/penerima layanan'],
            ['kriteria_id' => 2, 'jabatan' => 3, 'indikator' => 'Pengemudi memiliki ide-ide baru dalam menyelesaikan tugas agar pelayanan menjadi lebih baik, misalnya efektif, efisien, dsb.'],
            ['kriteria_id' => 3, 'jabatan' => 3, 'indikator' => 'Pengemudi mampu berkomunikasi (menyampaikan pendapat, berbicara, berargumen) secara jelas dan baik dengan orang lain (rekan, atasan, dan pengguna layanan) sehingga pesan dapat diterima dengan baik tanpa menimbulkan kesalahan informasi maupun persepsi.'],
            ['kriteria_id' => 4, 'jabatan' => 3, 'indikator' => 'Pengemudi mudah menyesuaikan diri dengan perubahan lingkungan dan dinamika yang dihadapi, misalnya perubahan aturan kantor, perubahan lingkungan kerja, permintaan mendadak dari pengguna layanan, dsb.'],
            ['kriteria_id' => 5, 'jabatan' => 3, 'indikator' => 'Pengemudi menunjukkan semangat kerja dan kemauan untuk bekerja, seperti datang lebih awal, selalu bersemangat, semangat untuk mengembangkan diri, dsb.'],
            ['kriteria_id' => 6, 'jabatan' => 3, 'indikator' => 'Pengemudi memiliki hubungan kerja/ berinteraksi dengan rekan kerja maupun atasan dengan baik dalam melaksanakan tugas'],
            ['kriteria_id' => 7, 'jabatan' => 3, 'indikator' => 'Pengemudi mampu melaksanakan tugas secara mandiri tanpa pengawasan dan pendampingan terus menerus'],
            ['kriteria_id' => 8, 'jabatan' => 3, 'indikator' => 'Pengemudi memahami SOP keselamatan dan keamanan serta menerapkannya saat bertugas'],
            ['kriteria_id' => 9, 'jabatan' => 3, 'indikator' => 'Pengemudi menguasai sistem navigasi dan pengetahuan dasar berlalu lintas'],

            // ================= TEKNISI KENDARAAN (4) =================
            ['kriteria_id' => 1, 'jabatan' => 4, 'indikator' => 'Teknisi Kendaraan memiliki inisiatif untuk melakukan pekerjaan tanpa menunggu perintah dari atasan/penerima layanan'],
            ['kriteria_id' => 2, 'jabatan' => 4, 'indikator' => 'Teknisi Kendaraan memiliki ide-ide baru dalam menyelesaikan tugas'],
            ['kriteria_id' => 3, 'jabatan' => 4, 'indikator' => 'Teknisi Kendaraan mampu berkomunikasi (menyampaikan pendapat, berbicara, berargumen) secara jelas dan baik dengan orang lain (rekan, atasan, dan pengguna layanan'],
            ['kriteria_id' => 4, 'jabatan' => 4, 'indikator' => 'Teknisi Kendaraan mudah menyesuaikan diri dengan perubahan lingkungan dan dinamika yang dihadapi, misalnya perubahan aturan kantor, perubahan lingkungan kerja, permintaan mendadak dari pengguna layanan, dsb.'],
            ['kriteria_id' => 5, 'jabatan' => 4, 'indikator' => 'Teknisi Kendaraan menunjukkan semangat kerja dan kemauan untuk bekerja, seperti datang lebih awal, selalu bersemangat, dsb.'],
            ['kriteria_id' => 6, 'jabatan' => 4, 'indikator' => 'Teknisi Kendaraan memiliki hubungan kerja/ berinteraksi dengan rekan kerja maupun atasan dengan baik dalam melaksanakan tugas'],
            ['kriteria_id' => 7, 'jabatan' => 4, 'indikator' => 'Teknisi Kendaraan mampu melaksanakan tugas perbaikan atau servis kendaraan secara mandiri tanpa pengawasan'],
            ['kriteria_id' => 8, 'jabatan' => 4, 'indikator' => 'Teknisi Kendaraan memiliki Pengetahuan Mekanik, seperti memahami prinsip kerja mesin, sistem transmisi, sistem suspensi, dan sistem lainnya pada kendaraan.'],
            ['kriteria_id' => 9, 'jabatan' => 4, 'indikator' => 'Teknisi Kendaraan memiliki Keterampilan Perbaikan, seperti Mampu melakukan perbaikan dan penggantian komponen kendaraan dengan benar.'],

            // ================= STAF ADMINISTRASI (5) =================
            ['kriteria_id' => 1, 'jabatan' => 5, 'indikator' => 'Staf Admin memiliki inisiatif untuk melakukan pekerjaan tanpa menunggu perintah dari atasan/penerima layanan'],
            ['kriteria_id' => 2, 'jabatan' => 5, 'indikator' => 'Staf Admin memiliki ide-ide baru dalam menyelesaikan tugas'],
            ['kriteria_id' => 3, 'jabatan' => 5, 'indikator' => 'Staf Admin mampu berkomunikasi (menyampaikan pendapat, berbicara, berargumen) secara jelas dan baik dengan orang lain (rekan, atasan, dan pengguna layanan'],
            ['kriteria_id' => 4, 'jabatan' => 5, 'indikator' => 'Staf Admin mudah menyesuaikan diri dengan perubahan lingkungan dan dinamika yang dihadapi, misalnya perubahan aturan kantor, perubahan lingkungan kerja, permintaan mendadak dari pengguna layanan, dsb.'],
            ['kriteria_id' => 5, 'jabatan' => 5, 'indikator' => 'Staf Admin menunjukkan semangat kerja dan kemauan untuk bekerja, seperti datang lebih awal, selalu bersemangat, dsb.'],
            ['kriteria_id' => 6, 'jabatan' => 5, 'indikator' => 'Staf Admin memiliki hubungan kerja/ berinteraksi dengan rekan kerja maupun atasan dengan baik dalam melaksanakan tugas'],
            ['kriteria_id' => 7, 'jabatan' => 5, 'indikator' => 'Staf Admin mampu melaksanakan tugas administrasi perkantoran secara mandiri tanpa pengawasan'],
            ['kriteria_id' => 8, 'jabatan' => 5, 'indikator' => 'Staf Admin mampu menyelesaikan tugas dan perintah yang diberikan pimpinan secara baik, tertib administrasi, efisien, dan efektif.'],
            ['kriteria_id' => 9, 'jabatan' => 5, 'indikator' => 'Staf Admin mampu melakukan pengelolaan dokumen yang rapi, komunikasi yang lancar, dan dukungan administratif yang handal untuk kelancaran operasional kantor.'],

            // ================= TEKNISI KOMPUTER (6) =================
            ['kriteria_id' => 1, 'jabatan' => 6, 'indikator' => 'Teknisi Komputer memiliki inisiatif untuk melakukan pekerjaan tanpa menunggu perintah dari atasan/penerima layanan'],
            ['kriteria_id' => 2, 'jabatan' => 6, 'indikator' => 'Teknisi Komputer memiliki ide-ide baru dalam menyelesaikan tugas agar pelayanan menjadi lebih baik, misalnya efektif, efisien, dsb.'],
            ['kriteria_id' => 3, 'jabatan' => 6, 'indikator' => 'Teknisi Komputer mampu berkomunikasi (menyampaikan pendapat, berbicara, berargumen) secara jelas dan baik dengan orang lain (rekan, atasan, dan pengguna layanan) sehingga pesan dapat diterima dengan baik tanpa menimbulkan kesalahan informasi maupun persepsi, serta mudah dihubungi jika dibutuhkan.'],
            ['kriteria_id' => 4, 'jabatan' => 6, 'indikator' => 'Teknisi Komputer mudah menyesuaikan diri dengan perubahan lingkungan dan dinamika yang dihadapi, misalnya perubahan aturan kantor, perubahan lingkungan kerja, permintaan mendadak dari pengguna layanan, dsb.'],
            ['kriteria_id' => 5, 'jabatan' => 6, 'indikator' => 'Teknisi Komputer menunjukkan semangat kerja dan kemauan untuk bekerja, seperti datang lebih awal, selalu bersemangat, semangat untuk mengembangkan diri, dsb.'],
            ['kriteria_id' => 6, 'jabatan' => 6, 'indikator' => 'Teknisi Komputer memiliki hubungan kerja/ berinteraksi dengan rekan kerja maupun atasan dengan baik dalam melaksanakan tugas'],
            ['kriteria_id' => 7, 'jabatan' => 6, 'indikator' => 'Teknisi Komputer mampu melaksanakan tugas secara mandiri tanpa pengawasan dan pendampingan terus menerus'],
            ['kriteria_id' => 8, 'jabatan' => 6, 'indikator' => 'Teknisi Komputer mampu merakit, memperbaiki, dan merawat perangkat keras'],
            ['kriteria_id' => 9, 'jabatan' => 6, 'indikator' => 'Teknisi Komputer mampu melakukan instalasi serta troubleshooting sistem operasi dan aplikasi.'],

            // ================= PROGRAMMER (7) =================
            ['kriteria_id' => 1, 'jabatan' => 7, 'indikator' => 'Programmer memiliki inisiatif untuk melakukan pekerjaan tanpa menunggu perintah dari atasan/penerima layanan'],
            ['kriteria_id' => 2, 'jabatan' => 7, 'indikator' => 'Programmer memiliki ide-ide baru dalam menyelesaikan tugas agar pelayanan menjadi lebih baik, misalnya efektif, efisien, dsb.'],
            ['kriteria_id' => 3, 'jabatan' => 7, 'indikator' => 'Programmer mampu berkomunikasi (menyampaikan pendapat, berbicara, berargumen) secara jelas dan baik dengan orang lain (rekan, atasan, dan pengguna layanan) sehingga pesan dapat diterima dengan baik tanpa menimbulkan kesalahan informasi maupun persepsi, serta mudah dihubungi jika dibutuhkan.'],
            ['kriteria_id' => 4, 'jabatan' => 7, 'indikator' => 'Programmer mudah menyesuaikan diri dengan perubahan lingkungan dan dinamika yang dihadapi, misalnya perubahan aturan kantor, perubahan lingkungan kerja, permintaan mendadak dari pengguna layanan, dsb.'],
            ['kriteria_id' => 5, 'jabatan' => 7, 'indikator' => 'Programmer menunjukkan semangat kerja dan kemauan untuk bekerja, seperti datang lebih awal, selalu bersemangat, semangat untuk mengembangkan diri, dsb.'],
            ['kriteria_id' => 6, 'jabatan' => 7, 'indikator' => 'Programmer memiliki hubungan kerja/ berinteraksi dengan rekan kerja maupun atasan dengan baik dalam melaksanakan tugas'],
            ['kriteria_id' => 7, 'jabatan' => 7, 'indikator' => 'Programmer mampu melaksanakan tugas secara mandiri tanpa pengawasan dan pendampingan terus menerus'],
            ['kriteria_id' => 8, 'jabatan' => 7, 'indikator' => 'Programmer menguasai bahasa pemrograman dan logika algoritma.'],
            ['kriteria_id' => 9, 'jabatan' => 7, 'indikator' => 'Programmer mampu mengembangkan aplikasi dengan framework dan database'],

            // ================= JURU FOTO (8) =================
            ['kriteria_id' => 1, 'jabatan' => 8, 'indikator' => 'Juru Foto memiliki inisiatif untuk melakukan pekerjaan tanpa menunggu perintah dari atasan/penerima layanan'],
            ['kriteria_id' => 2, 'jabatan' => 8, 'indikator' => 'Juru Foto memiliki ide-ide baru dalam menghasilkan karya foto yang kreatif dan berkualitas'],
            ['kriteria_id' => 3, 'jabatan' => 8, 'indikator' => 'Juru Foto mampu berkomunikasi secara jelas dan baik dengan atasan, rekan kerja, maupun objek foto'],
            ['kriteria_id' => 4, 'jabatan' => 8, 'indikator' => 'Juru Foto mudah menyesuaikan diri dengan perubahan lingkungan kerja dan kebutuhan dokumentasi'],
            ['kriteria_id' => 5, 'jabatan' => 8, 'indikator' => 'Juru Foto menunjukkan semangat kerja dan kemauan untuk bekerja secara profesional'],
            ['kriteria_id' => 6, 'jabatan' => 8, 'indikator' => 'Juru Foto memiliki hubungan kerja yang baik dengan rekan kerja dan atasan'],
            ['kriteria_id' => 7, 'jabatan' => 8, 'indikator' => 'Juru Foto mampu melaksanakan tugas fotografi secara mandiri tanpa pengawasan'],
            ['kriteria_id' => 8, 'jabatan' => 8, 'indikator' => 'Juru Foto mampu mengoperasikan kamera dan peralatan fotografi dengan baik'],
            ['kriteria_id' => 9, 'jabatan' => 8, 'indikator' => 'Juru Foto mampu menghasilkan foto yang tajam, informatif, dan sesuai kebutuhan dokumentasi'],

            // ================= DESAINER GRAFIS (9) =================
            ['kriteria_id' => 1, 'jabatan' => 9, 'indikator' => 'Desainer Grafis memiliki inisiatif untuk melakukan pekerjaan tanpa menunggu perintah dari atasan/penerima layanan'],
            ['kriteria_id' => 2, 'jabatan' => 9, 'indikator' => 'Desainer Grafis memiliki ide-ide kreatif dan inovatif dalam menghasilkan desain'],
            ['kriteria_id' => 3, 'jabatan' => 9, 'indikator' => 'Desainer Grafis mampu berkomunikasi secara jelas dan baik terkait konsep desain dengan atasan dan rekan kerja'],
            ['kriteria_id' => 4, 'jabatan' => 9, 'indikator' => 'Desainer Grafis mudah menyesuaikan diri dengan perubahan kebutuhan desain dan arahan pimpinan'],
            ['kriteria_id' => 5, 'jabatan' => 9, 'indikator' => 'Desainer Grafis menunjukkan semangat kerja dan kemauan untuk menyelesaikan tugas tepat waktu'],
            ['kriteria_id' => 6, 'jabatan' => 9, 'indikator' => 'Desainer Grafis memiliki hubungan kerja yang baik dengan rekan kerja dan atasan'],
            ['kriteria_id' => 7, 'jabatan' => 9, 'indikator' => 'Desainer Grafis mampu melaksanakan tugas desain secara mandiri tanpa pengawasan'],
            ['kriteria_id' => 8, 'jabatan' => 9, 'indikator' => 'Desainer Grafis menguasai aplikasi desain grafis seperti Photoshop, Illustrator, atau sejenisnya'],
            ['kriteria_id' => 9, 'jabatan' => 9, 'indikator' => 'Desainer Grafis mampu menghasilkan desain yang komunikatif, estetis, dan sesuai kebutuhan'],

            // ================= PETUGAS KEBERSIHAN (10) =================
            ['kriteria_id' => 1, 'jabatan' => 10, 'indikator' => 'Petugas Kebersihan memiliki inisiatif untuk melakukan pekerjaan tanpa menunggu perintah dari atasan/penerima layanan'],
            ['kriteria_id' => 2, 'jabatan' => 10, 'indikator' => 'Petugas Kebersihan memiliki ide-ide dalam menjaga kebersihan lingkungan kerja agar lebih efektif'],
            ['kriteria_id' => 3, 'jabatan' => 10, 'indikator' => 'Petugas Kebersihan mampu berkomunikasi dengan baik dengan rekan kerja dan atasan'],
            ['kriteria_id' => 4, 'jabatan' => 10, 'indikator' => 'Petugas Kebersihan mudah menyesuaikan diri dengan perubahan lingkungan dan area kerja'],
            ['kriteria_id' => 5, 'jabatan' => 10, 'indikator' => 'Petugas Kebersihan menunjukkan semangat kerja dan kemauan untuk bekerja secara konsisten'],
            ['kriteria_id' => 6, 'jabatan' => 10, 'indikator' => 'Petugas Kebersihan memiliki hubungan kerja yang baik dengan rekan kerja dan atasan'],
            ['kriteria_id' => 7, 'jabatan' => 10, 'indikator' => 'Petugas Kebersihan mampu melaksanakan tugas kebersihan secara mandiri tanpa pengawasan'],
            ['kriteria_id' => 8, 'jabatan' => 10, 'indikator' => 'Petugas Kebersihan memahami penggunaan alat dan bahan kebersihan dengan benar'],
            ['kriteria_id' => 9, 'jabatan' => 10, 'indikator' => 'Petugas Kebersihan mampu menjaga kebersihan, kerapihan, dan kenyamanan lingkungan kerja'],

            // ================= PETUGAS TAMAN (11) =================
            ['kriteria_id' => 1, 'jabatan' => 11, 'indikator' => 'Petugas Taman memiliki inisiatif untuk melakukan pekerjaan tanpa menunggu perintah dari atasan/penerima layanan'],
            ['kriteria_id' => 2, 'jabatan' => 11, 'indikator' => 'Petugas Taman memiliki ide-ide dalam penataan dan perawatan taman agar terlihat indah dan rapi'],
            ['kriteria_id' => 3, 'jabatan' => 11, 'indikator' => 'Petugas Taman mampu berkomunikasi dengan baik dengan rekan kerja dan atasan'],
            ['kriteria_id' => 4, 'jabatan' => 11, 'indikator' => 'Petugas Taman mudah menyesuaikan diri dengan perubahan lingkungan dan kondisi cuaca'],
            ['kriteria_id' => 5, 'jabatan' => 11, 'indikator' => 'Petugas Taman menunjukkan semangat kerja dan kemauan untuk bekerja secara konsisten'],
            ['kriteria_id' => 6, 'jabatan' => 11, 'indikator' => 'Petugas Taman memiliki hubungan kerja yang baik dengan rekan kerja dan atasan'],
            ['kriteria_id' => 7, 'jabatan' => 11, 'indikator' => 'Petugas Taman mampu melaksanakan tugas perawatan taman secara mandiri tanpa pengawasan'],
            ['kriteria_id' => 8, 'jabatan' => 11, 'indikator' => 'Petugas Taman memahami teknik dasar perawatan tanaman dan taman'],
            ['kriteria_id' => 9, 'jabatan' => 11, 'indikator' => 'Petugas Taman mampu menjaga taman agar tetap bersih, rapi, dan terawat'],

            // ================= PETUGAS TEKNIS ME (12) =================
            ['kriteria_id' => 1, 'jabatan' => 12, 'indikator' => 'Petugas Teknisi ME memiliki inisiatif untuk melakukan pekerjaan tanpa menunggu perintah dari atasan/penerima layanan'],
            ['kriteria_id' => 2, 'jabatan' => 12, 'indikator' => 'Petugas Teknisi ME memiliki ide-ide baru dalam menyelesaikan tugas'],
            ['kriteria_id' => 3, 'jabatan' => 12, 'indikator' => 'Petugas Teknisi ME mampu berkomunikasi (menyampaikan pendapat, berbicara, berargumen) secara jelas dan baik dengan orang lain (rekan, atasan, dan pengguna layanan'],
            ['kriteria_id' => 4, 'jabatan' => 12, 'indikator' => 'Petugas Teknisi ME mudah menyesuaikan diri dengan perubahan lingkungan dan dinamika yang dihadapi, misalnya perubahan aturan kantor, perubahan lingkungan kerja, permintaan mendadak dari pengguna layanan, dsb.'],
            ['kriteria_id' => 5, 'jabatan' => 12, 'indikator' => 'Petugas Teknisi ME menunjukkan semangat kerja dan kemauan untuk bekerja, seperti datang lebih awal, selalu bersemangat, dsb.'],
            ['kriteria_id' => 6, 'jabatan' => 12, 'indikator' => 'Petugas Teknisi ME memiliki hubungan kerja/ berinteraksi dengan rekan kerja maupun atasan dengan baik dalam melaksanakan tugas'],
            ['kriteria_id' => 7, 'jabatan' => 12, 'indikator' => 'Petugas Teknisi ME mampu melaksanakan tugas perbaikan kerusakan (instalasi listrik/penerangan/AC/lift/telepon) secara mandiri tanpa pengawasan'],
            ['kriteria_id' => 8, 'jabatan' => 12, 'indikator' => 'Petugas Teknisi ME mampu melaksanakan arahan dan perintah pimpinan, koordinator/ pengawas teknisi ME serta user dengan respon yang cepat, tepat, baik, dan sopan'],
            ['kriteria_id' => 9, 'jabatan' => 12, 'indikator' => 'Petugas Teknisi ME mampu memastikan semua sistem dan peralatan mekanikal dan elektrikal di kantor beroperasi dengan baik dan aman. Ini mencakup pemeliharaan, perbaikan, dan instalasi berbagai sistem kelistrikan, serta memastikan ketersediaan dan keandalan operasionalnya'],

            // ================= KOORDINATOR & PENGAWAS (13) =================
            ['kriteria_id' => 1, 'jabatan' => 13, 'indikator' => 'Pengawas dan Koordinator memiliki inisiatif untuk melakukan pekerjaan tanpa menunggu perintah dari atasan/penerima layanan'],
            ['kriteria_id' => 2, 'jabatan' => 13, 'indikator' => 'Pengawas dan Koordinator memiliki ide-ide baru dalam menyelesaikan tugas'],
            ['kriteria_id' => 3, 'jabatan' => 13, 'indikator' => 'Pengawas dan Koordinator mampu berkomunikasi (menyampaikan pendapat, berbicara, berargumen) secara jelas dan baik dengan orang lain (rekan, atasan, dan pengguna layanan'],
            ['kriteria_id' => 4, 'jabatan' => 13, 'indikator' => 'Pengawas dan Koordinator mudah menyesuaikan diri dengan perubahan lingkungan dan dinamika yang dihadapi, misalnya perubahan aturan kantor, perubahan lingkungan kerja, permintaan mendadak dari pengguna layanan, dsb.'],
            ['kriteria_id' => 5, 'jabatan' => 13, 'indikator' => 'Pengawas dan Koordinator menunjukkan semangat kerja dan kemauan untuk bekerja, seperti datang lebih awal, selalu bersemangat, dsb.'],
            ['kriteria_id' => 6, 'jabatan' => 13, 'indikator' => 'Pengawas dan Koordinator memiliki hubungan kerja/ berinteraksi dengan rekan kerja maupun atasan dengan baik dalam melaksanakan tugas'],
            ['kriteria_id' => 7, 'jabatan' => 13, 'indikator' => 'Pengawas dan Koordinator mampu melaksanakan tugas mengkoordinir dan mengawasi tenaga Outsourcing secara mandiri tanpa pengawasan'],
            ['kriteria_id' => 8, 'jabatan' => 13, 'indikator' => 'Pengawas dan Koordinator mampu melakukan koordinasi dan pemantauan, serta pengawasan kerja operasional petugas/tim (kebersihan, taman, dan ME)'],
            ['kriteria_id' => 9, 'jabatan' => 13, 'indikator' => 'Pengawas dan Koordinator mampu menggerakkan dan memberi motivasi kerja kepada petugas/tim untuk bekerja secara baik, efektif, dan efisien'],

            // ================= RESEPSIONIS (14) =================
            ['kriteria_id' => 1, 'jabatan' => 14, 'indikator' => 'Staf Resepsionis memiliki inisiatif untuk melakukan pekerjaan tanpa menunggu perintah dari atasan/penerima layanan'],
            ['kriteria_id' => 2, 'jabatan' => 14, 'indikator' => 'Staf Resepsionis memiliki ide-ide baru dalam menyelesaikan tugas'],
            ['kriteria_id' => 3, 'jabatan' => 14, 'indikator' => 'Staf Resepsionis mampu berkomunikasi, berinteraksi, dan membangun hubungan baik dengan orang lain serta menciptakan kesan pertama yang positif sehingga tamu merasa diterima dan dihargai'],
            ['kriteria_id' => 4, 'jabatan' => 14, 'indikator' => 'Staf Resepsionis mudah menyesuaikan diri dengan perubahan lingkungan dan dinamika yang dihadapi, misalnya perubahan aturan kantor, perubahan lingkungan kerja, permintaan mendadak dari pengguna layanan, dsb.'],
            ['kriteria_id' => 5, 'jabatan' => 14, 'indikator' => 'Staf Resepsionis menunjukkan semangat kerja dan kemauan untuk bekerja, seperti datang lebih awal, selalu bersemangat, dsb.'],
            ['kriteria_id' => 6, 'jabatan' => 14, 'indikator' => 'Staf Resepsionis memiliki hubungan kerja/berinteraksi dengan rekan kerja maupun atasan dengan baik dalam melaksanakan tugas'],
            ['kriteria_id' => 7, 'jabatan' => 14, 'indikator' => 'Staf Resepsionis mampu melaksanakan tugas penerimaan tamu secara profesional secara mandiri tanpa pengawasan'],
            ['kriteria_id' => 8, 'jabatan' => 14, 'indikator' => 'Staf Resepsionis mampu menghadapi berbagai situasi dan menemukan solusi dengan cepat dan tepat untuk masalah tamu atau situasi yang tidak nyaman'],
            ['kriteria_id' => 9, 'jabatan' => 14, 'indikator' => 'Staf Resepsionis mampu mengelola tugas secara bersamaan (multitasking) dan menyampaikan informasi dengan jelas, ramah, dan profesional baik secara verbal maupun tertulis'],

            // ================= TEKNISI JARINGAN (15) =================
            ['kriteria_id' => 1, 'jabatan' => 15, 'indikator' => 'Teknisi Jaringan memiliki inisiatif untuk melakukan pekerjaan tanpa menunggu perintah dari atasan/penerima layanan'],
            ['kriteria_id' => 2, 'jabatan' => 15, 'indikator' => 'Teknisi Jaringan memiliki ide-ide baru dalam menyelesaikan tugas agar pelayanan menjadi lebih baik, misalnya efektif, efisien, dsb.'],
            ['kriteria_id' => 3, 'jabatan' => 15, 'indikator' => 'Teknisi Jaringan mampu berkomunikasi (menyampaikan pendapat, berbicara, berargumen) secara jelas dan baik dengan orang lain (rekan, atasan, dan pengguna layanan) sehingga pesan dapat diterima dengan baik tanpa menimbulkan kesalahan informasi maupun persepsi, serta mudah dihubungi jika dibutuhkan.'],
            ['kriteria_id' => 4, 'jabatan' => 15, 'indikator' => 'Teknisi Jaringan mudah menyesuaikan diri dengan perubahan lingkungan dan dinamika yang dihadapi, misalnya perubahan aturan kantor, perubahan lingkungan kerja, permintaan mendadak dari pengguna layanan, dsb.'],
            ['kriteria_id' => 5, 'jabatan' => 15, 'indikator' => 'Teknisi Jaringan menunjukkan semangat kerja dan kemauan untuk bekerja, seperti datang lebih awal, selalu bersemangat, semangat untuk mengembangkan diri, dsb.'],
            ['kriteria_id' => 6, 'jabatan' => 15, 'indikator' => 'Teknisi Jaringan memiliki hubungan kerja/berinteraksi dengan rekan kerja maupun atasan dengan baik dalam melaksanakan tugas'],
            ['kriteria_id' => 7, 'jabatan' => 15, 'indikator' => 'Teknisi Jaringan mampu melaksanakan tugas secara mandiri tanpa pengawasan dan pendampingan terus menerus'],
            ['kriteria_id' => 8, 'jabatan' => 15, 'indikator' => 'Teknisi Jaringan mampu melakukan konfigurasi dan pemeliharaan jaringan (router, switch, firewall)'],
            ['kriteria_id' => 9, 'jabatan' => 15, 'indikator' => 'Teknisi Jaringan mampu melakukan troubleshooting konektivitas dan keamanan jaringan'],


            // ================= UMUM (16) =================
            ['kriteria_id' => 10, 'jabatan' => 16, 'indikator' => 'Rendahnya frekuensi mangkir dan/atau izin dalam jam kerja untuk urusan non kedinasan.'],
            ['kriteria_id' => 11, 'jabatan' => 16, 'indikator' => 'Menunjukkan komitmen yang tinggi terhadap pengembangan diri dan institusi.'],
            ['kriteria_id' => 12, 'jabatan' => 16, 'indikator' => 'Penampilan fisik (cara berpakaian) yang selalu rapi dan sesuai aturan.'],
            ['kriteria_id' => 13, 'jabatan' => 16, 'indikator' => 'Kemampuan dalam menerapkan standar perilaku yang sesuai dengan norma adat, agama, dan etika instansi dalam berinteraksi dengan semua pihak.'],
            ['kriteria_id' => 14, 'jabatan' => 16, 'indikator' => 'Menyampaikan segala sesuatu dan berperilaku secara apa adanya (truthfully)'],
            ['kriteria_id' => 14, 'jabatan' => 16, 'indikator' => 'Konsistensi antara ucapan dan tindakan.'],
            ['kriteria_id' => 15, 'jabatan' => 16, 'indikator' => 'Menjalankan perintah atasan dengan segala upaya.'],
            ['kriteria_id' => 15, 'jabatan' => 16, 'indikator' => 'Tidak membantah, menolak, atau melakukan pembangkangan terhadap perintah atasan.'],
            ['kriteria_id' => 15, 'jabatan' => 16, 'indikator' => 'Bangga dengan pekerjaannya dan bersungguh-sungguh penuh terhadap penyelesaian pekerjaannya.'],
        ];


        foreach ($indikators as $key => $value) {
            Indikator::create([
                'kriteria_id' => $value['kriteria_id'],
                'jabatan_id' => $value['jabatan'],
                'deskripsi' => $value['indikator'],
            ]);
        }
    }
}
