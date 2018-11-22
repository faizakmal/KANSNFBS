<?php

include '../../database/connect.php';

$email= $_GET['id'];

$sql = "SELECT
    datadiri_alumni.email,
    datadiri_alumni.nama,
    datadiri_alumni.alamat,
    datadiri_alumni.noHP,
    datadiri_alumni.angkatan,
    datadiri_alumni.lulusan,
    datadiri_alumni.pekerjaan,
    datadiri_alumni.image,
    pendidikan_alumni.strata,
    pendidikan_alumni.universitas,
    pendidikan_alumni.fakultas,
    pendidikan_alumni.jurusan,
    pendidikan_alumni.tahunMasuk,
    pekerjaan_alumni.namaPerusahaan,
    pekerjaan_alumni.jenisPerusahaan,
    pekerjaan_alumni.divisiPerusahaan,
    pekerjaan_alumni.tahunBekerja,
    mediasosial_alumni.facebook,
    mediasosial_alumni.twitter,
    mediasosial_alumni.lineid,
    mediasosial_alumni.instagram,
    mediasosial_alumni.whatsapp,
    mediasosial_alumni.linkedin,
    datadiri_alumni.tempat_lahir,
    datadiri_alumni.tanggal_lahir,
    user.name,
    datadiri_alumni.provinsi,
    datadiri_alumni.kabupaten,
    datadiri_alumni.kecamatan
FROM
    user,
    datadiri_alumni,
    pendidikan_alumni,
    pekerjaan_alumni,
    mediasosial_alumni
WHERE
    datadiri_alumni.email = user.email AND pendidikan_alumni.email = user.email AND pekerjaan_alumni.email = user.email AND mediasosial_alumni.email = user.email AND user.email = '$email'";

	$result = mysqli_query($conn, $sql);
	if ($data = mysqli_fetch_array ($result)) {
		$email = $data[0];
		$name = $data[1];
		$alamat = $data[2];
		$noHP = $data[3];
		$angkatan = $data[4];
		$lulusan = $data[5];
		$pekerjaan = $data[6];
		$image = $data[7];
		$strata = $data[8];
		$universitas = $data[9];
		$fakultas = $data[10];
		$jurusan = $data[11];
		$tahunMasuk = $data[12];
		$namaPerusahaan = $data[13];
		$jenisPerusahaan = $data[14];
		$divisiPerusahaan = $data[15];
		$tahunPerusahaan = $data[16];
		$facebook = $data[17];
		$twitter = $data[18];
		$line = $data[19];
		$instagram = $data[20];
		$whatsapp = $data[21];
		$linkedin = $data[22];
		$tempatlahir = $data[23];
		$tanggallahir = $data[24];
		$namapanggilan = $data[25];
		$provinsi = $data[26];
		$kabupaten = $data[27];
		$kecamatan = $data[28];
	}

	else {

	echo "data tidak ditemukan";

	}
