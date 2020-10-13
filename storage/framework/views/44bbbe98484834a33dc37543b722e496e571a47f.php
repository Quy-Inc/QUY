<?
$id = request('data');
$Detail = new \Modules\pendaftaran\models\Pendaftaran;
$getDetail = $Detail::where("_id",$id)
                ->with('jurusan')
                ->with('tahun_ajaran')
                ->with('agama_siswa')
                ->get()->first();
?>



<style>
.panel-heading {
    font-weight: bold;
}

span.text {
    display: inline-block;
    width: 50%;
    font-weight: bold;
}
</style>

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">Data Calon Siswa</div>
            <!-- List group -->
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="text">Kode Pendaftaran</span> :
                    <?php echo e($getDetail->kode_pendaftaran); ?>

                </li>

                <li class="list-group-item">
                    <span class="text">Nama calon Siswa</span> :
                    <?php echo e($getDetail->nama_lengkap); ?>

                </li>

                <li class="list-group-item">
                    <span class="text">Jenis Kelamin</span> :
                    <?php echo e(($getDetail->jenis_kelamin == 1)?"Laki-laki":"Perempuan"); ?>

                </li>

                <li class="list-group-item">
                    <span class="text">Tempat & Tanggal Lahir</span> :
                    <?php echo e($getDetail->tempat_lahir); ?>, <?php echo e($getDetail->tgl_lahir); ?>

                </li>

                <li class="list-group-item">
                    <span class="text">Agama</span> :
                    <?php echo e($getDetail->agama_siswa->agama); ?>

                </li>

                <li class="list-group-item">
                    <span class="text">Alamat</span> :
                    <?php echo e($getDetail->alamat); ?>

                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-success">
            <div class="panel-heading">Data Pendidikan</div>
            <!-- List group -->
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="text">Sekolah Asal</span> :
                    <?php echo e($getDetail->asal_sekolah); ?>

                </li>

                <li class="list-group-item">
                    <span class="text">Tahun Ajaran</span> :
                    <?php echo e($getDetail->tahun_ajaran->tahun_ajaran); ?>

                </li>

                <li class="list-group-item">
                    <span class="text">Jurusan Yang dipilih</span> :
                    <?php echo e($getDetail->jurusan->jurusan); ?>

                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading">Data Orang tua/Wali</div>
            <!-- List group -->
            <ul class="list-group">
                <li class="list-group-item">
                    <span class="text">Nama Orang tua/Wali</span> :
                    <?php echo e($getDetail->nama_ortu); ?>

                </li>

                <li class="list-group-item">
                    <span class="text">Alamat Orang Tua/Wali</span> :
                    <?php echo e($getDetail->alamat_ortu); ?>

                </li>

                <li class="list-group-item">
                    <span class="text">No Hp Orang tua/Wali</span> :
                    <?php echo e($getDetail->no_hp_ortu); ?>

                </li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-5">
        <div class="panel panel-warning">
            <div class="panel-heading">Dokumen Persyaratan</div>

            <ul class="list-group">

                <li class="list-group-item">
                    <span class="text">Pas Photo</span>
                    <img src="public/files/<?php echo e($getDetail->pasphoto); ?>" width="100px" height="100">
                </li>

                <li class="list-group-item">
                    <span class="text">Kartu Keluarga</span>
                    <img src="public/files/<?php echo e($getDetail->kartu_keluarga); ?>" width="100px" height="100">
                </li>

            </ul>
        </div>
    </div>
</div>