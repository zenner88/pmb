<?php

include "../../../config/koneksi.php";

$pil_1 = $_GET['pil_1'];
$query = mysql_query("SELECT biaya FROM t_jurusan WHERE KodeJrsn = '{$pil_1}'");
$cities = array();
if ($query) {
    while ($r = mysql_fetch_object($query)) {
	$data = array(
	    'nominal' => $r->biaya
	);
	array_push($cities, $data);
    }
} else {
    $cities = array('Kesalahan' => 'Data Jurusan Tidak Ditemukan dengan kode jurusan ' . $pil_1);
}

echo json_encode($cities);
?>