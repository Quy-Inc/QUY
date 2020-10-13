<?php

use Illuminate\Database\Seeder;
use Modules\pekerjaanortu\models\Pekerjaanortu;
class PekerjaanTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('pekerjaanortu')->delete();

     $pekerjaan = [
        ["pekerjaan"=>"Belum / Tidak Bekerja"],
        ["pekerjaan"=>"Mengurus Rumah Tangga"],
        ["pekerjaan"=>"Pelajar / Mahasiswa"],
        ["pekerjaan"=>"Pensiunan"],
        ["pekerjaan"=>"Pegawai Negeri Sipil"],
        ["pekerjaan"=>"Tentara Nasional Indonesia"],
        ["pekerjaan"=>"Kepolisian RI"],
        ["pekerjaan"=>"Perdagangan"],
        ["pekerjaan"=>"Petani / Pekebun"],
        ["pekerjaan"=>"Peternak"],
        ["pekerjaan"=>"Nelayan / Perikanan"],
        ["pekerjaan"=>"Industri"],
        ["pekerjaan"=>"Konstruksi"],
        ["pekerjaan"=>"Transportasi"],
        ["pekerjaan"=>"Karyawan Swasta"],
        ["pekerjaan"=>"Karyawan BUMN"],
        ["pekerjaan"=>"Karyawan BUMD"],
        ["pekerjaan"=>"Karyawan Honorer"],
        ["pekerjaan"=>"Buruh Harian Lepas"],
        ["pekerjaan"=>"Buruh Tani / Perkebunan"],
        ["pekerjaan"=>"Buruh Nelayan / Perikanan"],
        ["pekerjaan"=>"Buruh Peternakan"],
        ["pekerjaan"=>"Pembantu Rumah Tangga"],
        ["pekerjaan"=>"Tukang Cukur"],
        ["pekerjaan"=>"Tukang Listrik"],
        ["pekerjaan"=>"Tukang Batu"],
        ["pekerjaan"=>"Tukang Kayu"],
        ["pekerjaan"=>"Tukang Sol Sepatu"],
        ["pekerjaan"=>"Tukang Las / Pandai Besi"],
        ["pekerjaan"=>"Tukang Jahit"],
        ["pekerjaan"=>"Penata Rambut"],
        ["pekerjaan"=>"Penata Rias"],
        ["pekerjaan"=>"Penata Busana"],
        ["pekerjaan"=>"Mekanik"],
        ["pekerjaan"=>"Tukang Gigi"],
        ["pekerjaan"=>"Seniman"],
        ["pekerjaan"=>"Tabib"],
        ["pekerjaan"=>"Paraji"],
        ["pekerjaan"=>"Perancang Busana"],
        ["pekerjaan"=>"Penterjemah"],
        ["pekerjaan"=>"Imam Masjid"],
        ["pekerjaan"=>"Pendeta"],
        ["pekerjaan"=>"Pastur"],
        ["pekerjaan"=>"Wartawan"],
        ["pekerjaan"=>"Ustadz / Mubaligh"],
        ["pekerjaan"=>"Juru Masak"],
        ["pekerjaan"=>"Promotor Acara"],
        ["pekerjaan"=>"Anggota DPR-RI"],
        ["pekerjaan"=>"Anggota DPD"],
        ["pekerjaan"=>"Anggota BPK"],
        ["pekerjaan"=>"Presiden"],
        ["pekerjaan"=>"Wakil Presiden"],
        ["pekerjaan"=>"Anggota Mahkamah Konstitusi"],
        ["pekerjaan"=>"Anggota Kabinet / Kementerian"],
        ["pekerjaan"=>"Duta Besar"],
        ["pekerjaan"=>"Gubernur"],
        ["pekerjaan"=>"Wakil Gubernur"],
        ["pekerjaan"=>"Bupati"],
        ["pekerjaan"=>"Wakil Bupati"],
        ["pekerjaan"=>"Walikota"],
        ["pekerjaan"=>"Wakil Walikota"],
        ["pekerjaan"=>"Anggota DPRD Propinsi"],
        ["pekerjaan"=>"Anggota DPRD Kabupaten / Kota"],
        ["pekerjaan"=>"Dosen"],
        ["pekerjaan"=>"Guru"],
        ["pekerjaan"=>"Pilot"],
        ["pekerjaan"=>"Pengacara"],
        ["pekerjaan"=>"Notaris"],
        ["pekerjaan"=>"Arsitek"],
        ["pekerjaan"=>"Akuntan"],
        ["pekerjaan"=>"Konsultan"],
        ["pekerjaan"=>"Dokter"],
        ["pekerjaan"=>"Bidan"],
        ["pekerjaan"=>"Perawat"],
        ["pekerjaan"=>"Apoteker"],
        ["pekerjaan"=>"Psikiater / Psikolog"],
        ["pekerjaan"=>"Penyiar Televisi"],
        ["pekerjaan"=>"Penyiar Radio"],
        ["pekerjaan"=>"Pelaut"],
        ["pekerjaan"=>"Peneliti"],
        ["pekerjaan"=>"Sopir"],
        ["pekerjaan"=>"Pialang"],
        ["pekerjaan"=>"Paranormal"],
        ["pekerjaan"=>"Pedagang"],
        ["pekerjaan"=>"Perangkat Desa"],
        ["pekerjaan"=>"Kepala Desa"],
        ["pekerjaan"=>"Biarawati"],
        ["pekerjaan"=>"Wiraswasta"],
     ];

     Pekerjaanortu::insert($pekerjaan);
    }
}
