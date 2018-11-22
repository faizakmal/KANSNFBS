<?php

include '../../database/connect.php';

//create MySQL connection   
$sql = '
SELECT
    datadiri_alumni.nama,
    user.name,
    datadiri_alumni.tempat_lahir,
    datadiri_alumni.tanggal_lahir,
    datadiri_alumni.angkatan,
    datadiri_alumni.lulusan,
    datadiri_alumni.noHp,
    CONCAT(
        datadiri_alumni.alamat,
        ", ",
        districts.name,
        ", ",
        regencies.name,
        ", ",
        provinces.name
    ) AS alamat_lengkap,
    mediasosial_alumni.facebook,
    mediasosial_alumni.twitter,
    mediasosial_alumni.lineid,
    mediasosial_alumni.instagram,
    mediasosial_alumni.whatsapp,
    mediasosial_alumni.linkedin,
    datadiri_alumni.email,
    datadiri_alumni.pekerjaan,
    pendidikan_alumni.universitas,
    pendidikan_alumni.fakultas,
    pendidikan_alumni.jurusan,
    pendidikan_alumni.tahunMasuk,
    pendidikan_alumni.strata,
    pekerjaan_alumni.namaPerusahaan,
    pekerjaan_alumni.jenisPerusahaan,
    pekerjaan_alumni.divisiPerusahaan,
    pekerjaan_alumni.tahunBekerja
FROM
	`user`,
    `mediasosial_alumni`,
    `pendidikan_alumni`,
    `pekerjaan_alumni`,
    `datadiri_alumni`
    INNER JOIN districts ON datadiri_alumni.kecamatan = districts.id
    INNER JOIN regencies ON datadiri_alumni.kabupaten = regencies.id
    INNER JOIN provinces ON datadiri_alumni.provinsi = provinces.id
WHERE mediasosial_alumni.email = datadiri_alumni.email AND pendidikan_alumni.email = datadiri_alumni.email AND pekerjaan_alumni.email = datadiri_alumni.email AND user.email = datadiri_alumni.email
ORDER BY datadiri_alumni.nama
';

$result = mysqli_query($conn, $sql);
$output = '';

if(mysqli_num_rows($result) > 0){
    $output.= '
        <table class="table" bordered="1">
            <tr>
                <th>Nama Panjang</th>
                <th>Panggilan</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Angkatan</th>
                <th>Lulusan</th>
                <th>Nomor Handphone</th>
                <th>Alamat</th>
                <th>Facebook</th>
                <th>Twitter</th>
                <th>Line</th>
                <th>Instagram</th>
                <th>WhatsApp</th>
                <th>LinkedIn</th>
                <th>email</th>
                <th>Universitas</th>
                <th>Fakultas</th>
                <th>Jurusan</th>
                <th>Tahun Masuk</th>
                <th>Strata</th>
                <th>Nama Perusahaan</th>
                <th>Jenis Perusahaan</th>
                <th>Divisi Perusahaan</th>
                <th>Tahun Masuk Bekerja</th>
            </tr>
    ';
    while ($row = mysqli_fetch_array($result)) {
        $output.= '
            <tr>
                <td>'.$row["nama"].'</td>
                <td>'.$row["name"].'</td>
                <td>'.$row["tempat_lahir"].'</td>
                <td>'.$row["tanggal_lahir"].'</td>
                <td>'.$row["angkatan"].'</td>
                <td>'.$row["lulusan"].'</td>
                <td>'.$row["noHp"].'</td>
                <td>'.$row["alamat_lengkap"].'</td>
                <td>'.$row["facebook"].'</td>
                <td>'.$row["twitter"].'</td>
                <td>'.$row["lineid"].'</td>
                <td>'.$row["instagram"].'</td>
                <td>'.$row["whatsapp"].'</td>
                <td>'.$row["linkedin"].'</td>
                <td>'.$row["email"].'</td>
                <td>'.$row["pekerjaan"].'</td>
                <td>'.$row["universitas"].'</td>
                <td>'.$row["fakultas"].'</td>
                <td>'.$row["jurusan"].'</td>
                <td>'.$row["tahunmasuk"].'</td>
                <td>'.$row["strata"].'</td>
                <td>'.$row["namaPerusahaan"].'</td>
                <td>'.$row["jenisPerusahaan"].'</td>
                <td>'.$row["divisiPerusahaan"].'</td>
                <td>'.$row["tahunBekerja"].'</td>
            </tr>
        ';
    }
    $output.='</table>';
    header("Content-Type: applications/xls");
    header("Content-Disposition: attachment; filename=all_kans_database.xls");
    echo $output;
}

?>