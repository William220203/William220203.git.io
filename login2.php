<pre>
<?php

$koneksi = mysqli_connect('localhost','root','mysql', 'kelas2022');
if (!$koneksi) die("koneksi gagal");

$username = $_POST['username'];
$pwd = hash('sha256', $_POST['pwd']);

$kueri = "SELECT * FROM users WHERE username='$username' AND pwd='$pwd'"; 
//echo $kueri;
$baca = $koneksi->query($kueri);

//print_r($baca);
if ($baca->num_rows==0) echo "user tidak eksis";
	else
	while($baris = $baca->fetch_assoc()) {
		//print_r($baris);
		$realname = $baris['realname'];
		echo "Selamat datang, $realname!<br>";
		$idx = $baris['idx'];
		update_online($koneksi, $idx);
		}


function update_online($koneksi, $idx) {
	
	$kueri2 = "DELETE FROM online WHERE idx=$idx";
	$koneksi->query($kueri2);
	$t = date("Y-m-d H:i:s");
	$kueri2 = "INSERT INTO online (idx,waktu,status) VALUES($idx,'$t',1)";
	$koneksi->query($kueri2);
	
	}


?>



