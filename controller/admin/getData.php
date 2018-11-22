<?php
include '../../database/connect.php';

if (isset($_GET['province'])){
    $provinsi = $_GET['province'];
    $sql =  "SELECT regencies.id, regencies.name FROM regencies WHERE province_id = $provinsi";
    $result = mysqli_query($conn, $sql);
    
    $response = array();

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $row_data["ID"] = $row["id"];
            $row_data["NAME"] = $row["name"];
            array_push($response,$row_data);
        }
    } else {
        echo "0 results";
    }
    
    echo json_encode($response);
}else if(isset($_GET['kabupaten'])){
    $kabupaten = $_GET['kabupaten'];
    $sql =  "SELECT districts.id, districts.name FROM districts WHERE regency_id = $kabupaten ORDER BY name";
    $result = mysqli_query($conn, $sql);
    
    $response = array();

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $row_data["ID"] = $row["id"];
            $row_data["NAME"] = $row["name"];
            array_push($response,$row_data);
        }
    } else {
        echo "0 results";
    }
    
    echo json_encode($response);
}


?>