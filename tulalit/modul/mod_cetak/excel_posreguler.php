<?php
include '../../../config/koneksi.php';

// Ambil data mahasiswa dari kelas dan jurusan yang dipilih
/* mysql_query("SET @i = 0");
$select = "SELECT @i := @i + 1 AS No, a.npm AS NPM, b.n_lengkap AS Nama, b.n_jns_kelamin AS Jenis_Kelamin
		FROM t_kelas a
		LEFT JOIN t_calon_mahasiswa b ON b.i_registrasi = a.i_registrasi
		WHERE a.nujur = '$jur' AND a.kelas = '$kelas'
		ORDER BY b.n_lengkap ASC"; */
mysql_query("SET @i = 0");
$select = "SELECT @i := @i + 1 AS No, i_registrasi AS No_PIN_PMB, n_lengkap AS Nama_Calon_Mahasiswa, n_jns_kelamin AS Jenis_Kelamin, i_telp AS No_Telepon, i_hp AS No_HP, n_email AS Email FROM t_calon_mahasiswa WHERE c_jalur='reguler' ORDER BY i_registrasi ASC";

//$qj = mysql_query("SELECT a.KodeJrsn FROM t_jurusan a WHERE a.Id = $jur");
//$rj = mysql_fetch_array($qj);

$export = mysql_query ($select) or die ( "Sql error : " . mysql_error( ) );

$fields = mysql_num_fields ($export);

for ( $i = 0; $i < $fields; $i++ )
{
    $header .= mysql_field_name( $export , $i ) . "\t";
}

while( $row = mysql_fetch_row( $export ) )
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $data .= trim( $line ) . "\n";
}
$data = str_replace( "\r" , "" , $data );

if ( $data == "" )
{
    $data = "\n(0) Records Found!\n";                        
}

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=CalonMahasiswaReguler_".date('d-M-Y').".xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
?>