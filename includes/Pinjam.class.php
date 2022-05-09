<?php

class Pinjam extends DB
{
    function getPinjam()
    {
        $query = "SELECT * FROM pinjam";
        return $this->execute($query);
    }

    function add($data)
    {
        $peminjam = $data['peminjam'];
        $buku = $data['buku'];

        $query = "insert into pinjam values ('', '$peminjam', '$buku', 'Belum')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function delete($id)
    {

        $query = "delete FROM pinjam WHERE id = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function statusPinjam($id)
    {

        $status = "Sudah";
        $query = "update pinjam set status = '$status' where id = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }
}
