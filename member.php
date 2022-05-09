<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Buku.class.php");
include("includes/Author.class.php");
include("includes/Member.class.php");

$member = new Member($db_host, $db_user, $db_pass, $db_name);

$member->open();



$status = false;
$alert = null;

$id_update = -1;


if (isset($_POST['add'])) {

    //memanggil add
    $member->add($_POST);
    header("location:member.php");
}

if (!empty($_GET['id_hapus'])) {
    //memanggil add
    $id = $_GET['id_hapus'];

    $member->delete($id);
    header("location:member.php");
}

if (!empty($_GET['id_edit'])) {

    $id_update = $_GET['id_edit'];
    // $member->update($id);
    // header("location:member.php");
}



if (isset($_POST['update'])) {

    $member->update($_POST);
    // header("location:member.php");
}

$data = null;
$no = 1;

$member->getMember();

while (list($nim, $nama, $jurusan) = $member->getResult()) {

    $data .= "<tr>
            <td>" . $no++ . "</td>
            <td>" . $nim . "</td>
            <td>" . $nama . "</td>
            <td>" . $jurusan . "</td>
            <td>
            <a href='member.php?id_edit=" . $nim .  "' class='btn btn-warning' '>Edit</a>
            <a href='member.php?id_hapus=" . $nim . "' class='btn btn-danger' '>Hapus</a>
            </td>
            </tr>";
}

$tpl = new Template("templates/member.html");
$tpl->replace("DATA_TABEL", $data);

if ($id_update > -1) {

    $member->getOneMember($id_update);

    $upnim = null;
    $upnama = null;
    $upjurusan = null;

    while (list($nim, $nama, $jurusan) = $member->getResult()) {
        $upnim = 'value="' .  $nim . '"';
        $upnama = 'value="' .  $nama . '"';
        $upjurusan = 'value="' .  $jurusan . '"';
    }


    $tpl->replace("SETDIS", "disabled readonly");
    $tpl->replace("VALNIM", $upnim);
    $tpl->replace("VALNAMA", $upnama);
    $tpl->replace("VALJURUSAN", $upjurusan);


    $bnama = '<button type="submit" name="update" class="btn btn-primary mt-3">Update</button>';
    $tpl->replace("TOMBOL", $bnama);
    $nnama = 'name="tnim"';
    $tpl->replace("NANIM", $nnama);
} else {
    $bnama = '<button type="submit" name="add" class="btn btn-primary mt-3">Add</button>';
    $tpl->replace("TOMBOL", $bnama);
    $nnama = 'name=""';
    $tpl->replace("NANIM", $nnama);
}

$member->close();


$tpl->write();
