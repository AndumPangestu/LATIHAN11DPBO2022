<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Buku.class.php");
include("includes/Author.class.php");
include("includes/Pinjam.class.php");
include("includes/Member.class.php");


$pinjam = new Pinjam($db_host, $db_user, $db_pass, $db_name);
$buku = new Buku($db_host, $db_user, $db_pass, $db_name);
$peminjam = new Member($db_host, $db_user, $db_pass, $db_name);

$pinjam->open();
$buku->open();
$peminjam->open();

$buku->getBuku();
$peminjam->getMember();
$pinjam->getPinjam();

$alert = null;

if (isset($_POST['add'])) {
    //memanggil add
    $pinjam->add($_POST);
    header("location:pinjam.php");
}

if (!empty($_GET['id_hapus'])) {
    //memanggil add
    $id = $_GET['id_hapus'];

    $pinjam->delete($id);
    header("location:pinjam.php");
}

if (!empty($_GET['id_edit'])) {
    //memanggil add
    $id = $_GET['id_edit'];

    $pinjam->statusPinjam($id);
    header("location:pinjam.php");
}

$databuku = null;
$datapeminjam = null;
$data = null;
$no = 1;

while (list($id, $judul, $penerbit, $deskripsi, $status, $id_peminjam) = $buku->getResult()) {
    $databuku .= "<option value='" . $id . "'>" . $judul . "</option>";
}

while (list($nim, $nama, $jurusan) = $peminjam->getResult()) {
    $datapeminjam .= "<option value='" . $nim . "'>" . $nama . "</option>
                ";
}

while (list($id, $dpeminjam, $dbuku, $status) = $pinjam->getResult()) {
    if ($status == "Sudah") {
        $data .= "<tr>
            <td>" . $no++ . "</td>
            <td>" . $dpeminjam . "</td>
            <td>" . $dbuku . "</td>
            <td>" . $status . "</td>
            <td>
            <a href='pinjam.php?id_hapus=" . $id . "' class='btn btn-danger' '>Hapus</a>
            </td>
            </tr>";
    } else {
        $data .= "<tr>
            <td>" . $no++ . "</td>
            <td>" . $dpeminjam . "</td>
            <td>" . $dbuku . "</td>
            <td>" . $status . "</td>
            <td>
            <a href='pinjam.php?id_edit=" . $id .  "' class='btn btn-warning' '>Edit</a>
            <a href='pinjam.php?id_hapus=" . $id . "' class='btn btn-danger' '>Hapus</a>
            </td>
            </tr>";
    }
}

$peminjam->close();
$buku->close();
$pinjam->close();
$tpl = new Template("templates/pinjam.html");
$tpl->replace("OPTION1", $datapeminjam);
$tpl->replace("OPTION2", $databuku);
$tpl->replace("DATA_TABEL", $data);
$tpl->write();
