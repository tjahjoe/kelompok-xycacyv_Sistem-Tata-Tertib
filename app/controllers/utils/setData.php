<?php
function setFirstnameAndLastname($data)
{
    $nama = $data["nama"];
    $pos = strrpos($nama, ' ');

    if ($pos) {
        $pos = $pos + 1;
    } else {
        $pos = 0;
    }

    $lastname = substr($nama, $pos);
    $firstname = $pos == 0 ? $nama : substr($nama, 0, strlen($nama) - strlen($lastname) - 1);

    $data['nama_awal'] = $firstname;
    $data['nama_akhir'] = $lastname;

    return $data;
}

function changeNameValue($datas)
{
    foreach ($datas as &$data) {
        $data['NIM'] = $data['nim'];
        $data['NAMA'] = $data['nama'];
        $data['TANGGAL'] = $data['tanggal'];
        $data['JUDUL MASALAH'] = $data['judulmasalah'];
        $data['TINGKAT'] = $data['tingkat'];
        $data['STATUS'] = $data['status'];

        unset($data['nim']);
        unset($data['nama']);
        unset($data['tanggal']);
        unset($data['judulmasalah']);
        unset($data['tingkat']);
        unset($data['status']);
    }

    return $datas;
}

function setArrayForImageName($data)
{
    $data['Bukti'] = $data['Bukti'] ? explode(",", $data['Bukti']) : false;
    return $data;
}

function setTingkatPelanggaranToSanksi($datas): mixed
{
    foreach ($datas as &$data) {
        $data['id_sanksi'] = $data['tingkat_pelanggaran'];
        switch ($data['id_sanksi']) {
            case 'I':
                $data['id_sanksi'] = 1;
                break;
            case 'II':
                $data['id_sanksi'] = 2;
                break;
            case 'III':
                $data['id_sanksi'] = 3;
                break;
            case 'IV':
                $data['id_sanksi'] = 4;
                break;
            case 'V':
                $data['id_sanksi'] = 5;
                break;
            default:
                $data['id_sanksi'] = 0;
                break;
        }
    }
    unset($data['tingkat_pelanggaran']);
    return $datas;
}
?>