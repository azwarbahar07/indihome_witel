<?php
 require_once '../../koneksi.php';

 $id_sales = $_GET["id_sales"];
 $query = "SELECT * FROM tb_sales WHERE id_sales = '$id_sales' ";
 $result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
if ($row){
    $array = $row;
    echo json_encode(array("kode" => 1, "result_sales_id" => $array));
} else{
    echo json_encode(array("kode" => 0, "pesan" => "Data Akun tidak ditemukan"));
}

?>