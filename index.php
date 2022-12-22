<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "phpcrud";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$id                = "";
$nama_depan        = "";
$nama_belakang     = "";
$nim               = "";
$prodi             = "";
$alamat            = "";
$jenis_kelamin     = "";
$no_telepon        = "";
$email             = "";
$hoby              = "";
$angkatan          = "";
$success           = "";
$error             = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from mahasiswa where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $success = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    echo $id;
    $sql1       = "select * from mahasiswa where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $var_dump         = mysqli_fetch($q1);
    print_r($var_dump);
    die();
    $id                  = NULL;
    $nama_depan          = $var_dump ['nama_depan'];
    $nama_belakang       = $var_dump ['nama_belakang'];
    $nim                 = $var_dump ['nim'];
    $prodi               = $var_dump ['prodi'];
    $alamat              = $var_dump ['alamat'];
    $jenis_kelamin       = $var_dump ['jenis_kelamin'];
    $no_telepon          = $var_dump ['no_telepon'];
    $email               = $var_dump ['email'];
    $hoby                = $var_dump ['hoby'];
    $angkatan            = $var_dump ['angkatan'];
    

    if ($nim == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $id                   = NULL;
    $nama_depan           = $_POST['nama_depan'];
    $nama_belakang        = $_POST['nama_belakang'];
    $nim                  = $_POST['nim'];
    $prodi                = $_POST['prodi'];
    $alamat               = $_POST['alamat'];
    $jenis_kelamin        = $_POST['jenis_kelamin'];
    $no_telepon           = $_POST['no_telepon'];
    $email                = $_POST['email'];
    $hoby                 = $_POST['hoby'];
    $angkatan             = $_POST['angkatan'];
   
    

    if ($nama_depan && $nama_belakang && $nim && $prodi && $alamat && $jenis_kelamin && $no_telepon && $email && $hoby && $angkatan) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update mahasiswa set nama_depan='$nama_depan',nama_belakang='$nama_belakang',nim = '$nim', prodi='$prodi',alamat = '$alamat',jenis_kelamin='$jenis_kelamin',no_telepon='$no_telepon',email='$email',hoby='$hoby',angkatan='$angkatan' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $success = "Data berhasil perbarui";
            } else {
                $error  = "Data gagal di perbarui";
            }
        } else { //untuk insert
            $sql1   = "insert into mahasiswa(id,nama_depan,nama_belakang,nim,prodi,alamat,jenis_kelamin,no_telepon,email,hoby,angkatan) values ('$id','$nama_depan','$nama_belakang','$nim','$prodi','$alamat','$jenis_kelamin','$no_telepon','$email','$hoby','$angkatan')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $success     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan data yang diinginkan!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa ITERA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Buat / Ubah Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");//5 : detik
                }
                ?>
                <?php
                if ($success) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $success ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Depan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_depan" name="nama_depan" value="<?php echo $nama_depan ?>">
                        </div>
                    </div> 

                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Belakang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" value="<?php echo $nama_belakang ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="Program Studi" class="col-sm-2 col-form-label">Program Studi</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="prodi" id="prodi">
                                <option value="">- Pilih Program Studi -</option>
                                <option value="Teknik Informatika" <?php if ($prodi == "Teknik Informatika") echo "selected" ?>>Teknik Informatika</option>
                                <option value="Teknik Elektro" <?php if ($prodi == "Teknik Elektro") echo "selected" ?>>Teknik Elektro</option>
                                <option value="Teknik Kimia" <?php if ($prodi == "Teknik Kimia") echo "selected" ?>>Teknik Kimia</option>
                                <option value="Teknik Fisika" <?php if ($prodi == "Teknik Fisika") echo "selected" ?>>Teknik Fisika</option>
                                <option value="Teknik Sipil" <?php if ($prodi == "Teknik Sipil") echo "selected" ?>>Teknik Sipil</option>
                                <option value="Farmasi" <?php if ($prodi == "Farmasi") echo "selected" ?>>Farmasi</option>
                                <option value="Arsitektur" <?php if ($prodi == "Arsitektur") echo "selected" ?>>Arsitektur</option>
                                <option value="Teknik Geologi" <?php if ($prodi == "Teknik Geologi") echo "selected" ?>>Teknik Geologi</option>
                                <option value="Teknik Geomatika" <?php if ($prodi == "Teknik Geomatika") echo "selected" ?>>Teknik Geomatika</option>
                                <option value="Teknik Perkeretaapian" <?php if ($prodi == "Teknik Perkeretaapian") echo "selected" ?>>Teknik Perkeretaapian</option>  
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                        </div>
                     </div>
                     <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="<?php echo $jenis_kelamin ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">No Telepon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="<?php echo $no_telepon ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $email?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">Hoby</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="hoby" name="hoby" value="<?php echo $hoby ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">Angkatan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="angkatan" name="angkatan" value="<?php echo $angkatan ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Mahasiswa ITERA
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Depan</th>
                            <th scope="col">Nama belakang</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Prodi</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">No Telepon</th>
                            <th scope="col">Email</th>
                            <th scope="col">Hoby</th>
                            <th scope="col">Angkatan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from mahasiswa order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                             print_r($r2);
                             die(); 
                            $id                  = $r2['id'];
                            $nama_depan          = $r2['nama_depan'];
                            $nama_belakang       = $r2['nama_belakang'];
                            $nim                 = $r2['nim'];
                            $prodi               = $r2['prodi'];
                            $alamat              = $r2['alamat'];
                            $jenis_kelamin       = $r2['jenis_kelamin'];
                            $no_telepon          = $r2['no_telepon'];
                            $email               = $r2['email'];
                            $hoby                = $r2['hoby'];
                            $angkatan            = $r2['angkatan'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nama_depan?></td>
                                <td scope="row"><?php echo $nama_belakang?></td>
                                <td scope="row"><?php echo $nim ?></td>
                                <td scope="row"><?php echo $prodi?></td>                                
                                <td scope="row"><?php echo $alamat ?></td>
                                <td scope="row"><?php echo $jenis_kelamin ?></td>
                                <td scope="row"><?php echo $no_telepon?></td>
                                <td scope="row"><?php echo $email?></td>
                                <td scope="row"><?php echo $hoby?></td>
                                <td scope="row"><?php echo $angkatan?></td>
                                <td scope="row">
                                    <a href="index.php?op=edit&id=1<?php echo $id ?>"><button type="button" class="btn btn-warning">Ubah</button></a>
                                    <a href="index.php?op=delete&id=1<?php echo $id?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Hapus</button></a>            
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</body>

</html>
