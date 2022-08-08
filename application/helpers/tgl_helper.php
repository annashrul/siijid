<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('tgl')){
	function date_indo($tgl){
		$ubah       = gmdate($tgl, time()+60*60*8);
		$pecah      = explode("-",$ubah);
		$tanggal    = $pecah[2];
		$bulan      = bulan($pecah[1]);
		$tahun      = $pecah[0];
		return $tanggal.' '.$bulan.' '.$tahun;
	}
}

if ( ! function_exists('bulan')){
	function bulan($bln){
		switch ($bln){
			case 1:
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	}
}


if ( ! function_exists('shortdate_indo')){
	function shortdate_indo($tgl){
		$ubah       = gmdate($tgl, time()+60*60*8);
		$pecah      = explode("-",$ubah);
		$tanggal    = $pecah[2];
		$bulan      = short_bulan($pecah[1]);
		$tahun      = $pecah[0];
		return $tanggal.'/'.$bulan.'/'.$tahun;
	}
}

if ( ! function_exists('short_bulan')){
	function short_bulan($bln){
		switch ($bln){
			case 1:
				return "01";
				break;
			case 2:
				return "02";
				break;
			case 3:
				return "03";
				break;
			case 4:
				return "04";
				break;
			case 5:
				return "05";
				break;
			case 6:
				return "06";
				break;
			case 7:
				return "07";
				break;
			case 8:
				return "08";
				break;
			case 9:
				return "09";
				break;
			case 10:
				return "10";
				break;
			case 11:
				return "11";
				break;
			case 12:
				return "12";
				break;
		}
	}
}


if ( ! function_exists('mediumdate_indo')){
	function mediumdate_indo($tgl){
		$ubah       = gmdate($tgl, time()+60*60*8);
		$pecah      = explode("-",$ubah);
		$tanggal    = $pecah[2];
		$bulan      = medium_bulan($pecah[1]);
		$tahun      = $pecah[0];
		return $tanggal.'-'.$bulan.'-'.$tahun;
	}
}

if ( ! function_exists('medium_bulan')){
	function medium_bulan($bln){
		switch ($bln){
			case 1:
				return "Jan";
				break;
			case 2:
				return "Feb";
				break;
			case 3:
				return "Mar";
				break;
			case 4:
				return "Apr";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Jun";
				break;
			case 7:
				return "Jul";
				break;
			case 8:
				return "Ags";
				break;
			case 9:
				return "Sep";
				break;
			case 10:
				return "Okt";
				break;
			case 11:
				return "Nov";
				break;
			case 12:
				return "Des";
				break;
		}
	}
}

//Long date indo Format
if ( ! function_exists('longdate_indo')){
	function longdate_indo($tanggal){
		$ubah   = gmdate($tanggal, time()+60*60*8);
		$pecah  = explode("-",$ubah);
		$tgl    = $pecah[2];
		$bln    = $pecah[1];
		$thn    = $pecah[0];
		$bulan  = bulan($pecah[1]);
		
		$nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
		$nama_hari = "";
		if($nama=="Sunday") {$nama_hari="Minggu";}
		else if($nama=="Monday") {$nama_hari="Senin";}
		else if($nama=="Tuesday") {$nama_hari="Selasa";}
		else if($nama=="Wednesday") {$nama_hari="Rabu";}
		else if($nama=="Thursday") {$nama_hari="Kamis";}
		else if($nama=="Friday") {$nama_hari="Jumat";}
		else if($nama=="Saturday") {$nama_hari="Sabtu";}
		return $nama_hari.','.$tgl.' '.$bulan.' '.$thn;
	}
}

if ( ! function_exists('hbt_indo')){
	function hbt_indo($tanggal){
		$ubah = gmdate($tanggal, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tgl = $pecah[2];
		$bln = $pecah[1];
		$thn = $pecah[0];
		$bulan = bulan($pecah[1]);
		
		$nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
		$nama_hari = "";
		if($nama=="Sunday") {$nama_hari="Minggu";}
		else if($nama=="Monday") {$nama_hari="Senin";}
		else if($nama=="Tuesday") {$nama_hari="Selasa";}
		else if($nama=="Wednesday") {$nama_hari="Rabu";}
		else if($nama=="Thursday") {$nama_hari="Kamis";}
		else if($nama=="Friday") {$nama_hari="Jumat";}
		else if($nama=="Saturday") {$nama_hari="Sabtu";}
		return $tgl.' '.$bulan.' '.$thn;
	}
}

function terbilang($x) {
	$abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	if ($x < 12)
		return " " . $abil[$x];
	elseif ($x < 20)
		return Terbilang($x - 10) . "belas";
	elseif ($x < 100)
		return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
	elseif ($x < 200)
		return " seratus" . Terbilang($x - 100);
	elseif ($x < 1000)
		return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
	elseif ($x < 2000)
		return " seribu" . Terbilang($x - 1000);
	elseif ($x < 1000000)
		return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
	elseif ($x < 1000000000)
		return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
}

function makeInt($angka){
	return $angka < -0.0000001 ? ceil($angka-0.0000001) : floor($angka+0.0000001);
}

function hijriahTBH($tanggal){
	$bulan = [
		"Muharram","Safar","Rabiul Awwal","Rabiul Akhir","Jumadil Awwal","Jumadil Akhir",
		"Rajab","Sya'ban","Ramadhan","Syawwal","Zulqaidah", "Zulhijjah"
	];
	$date = makeInt(substr($tanggal,8,2));
	$month = makeInt(substr($tanggal,5,2));
	$year = makeInt(substr($tanggal,0,4));
	if (($year>1582)||(($year == "1582") && ($month > 10))||(($year == "1582") && ($month=="10")&&($date >14))){
		$jd = makeInt((1461*($year+4800+makeInt(($month-14)/12)))/4)+
			makeInt((367*($month-2-12*(makeInt(($month-14)/12))))/12)-
			makeInt( (3*(makeInt(($year+4900+makeInt(($month-14)/12))/100))) /4)+$date-32075;
	}else{
		$jd = 367*$year-makeInt((7*($year+5001+makeInt(($month-9)/7)))/4)+makeInt((275*$month)/9)+$date+1729777;
	}
	$wd = $jd%7;
	$l = $jd-1948440+10632;
	$n=makeInt(($l-1)/10631);
	$l=$l-10631*$n+354;
	$z=(makeInt((10985-$l)/5316))*(makeInt((50*$l)/17719))+(makeInt($l/5670))*(makeInt((43*$l)/15238));
	$l=$l-(makeInt((30-$z)/15))*(makeInt((17719*$z)/50))-(makeInt($z/16))*(makeInt((15238*$z)/43))+29;
	$m=makeInt((24*$l)/709);
	$d=$l-makeInt((709*$m)/24);
	$y=30*$n+$z-30;
	$g = $m-1;
	
	return "$d $bulan[$g] $y H";
}
function hijriahTB($tanggal){
	$bulan = [
		"Muharram","Safar","Rabiul Awwal","Rabiul Akhir","Jumadil Awwal","Jumadil Akhir",
		"Rajab","Sya'ban","Ramadhan","Syawwal","Zulqaidah", "Zulhijjah"
	];
	$date = makeInt(substr($tanggal,8,2));
	$month = makeInt(substr($tanggal,5,2));
	$year = makeInt(substr($tanggal,0,4));
	if (($year>1582)||(($year == "1582") && ($month > 10))||(($year == "1582") && ($month=="10")&&($date >14))){
		$jd = makeInt((1461*($year+4800+makeInt(($month-14)/12)))/4)+
			makeInt((367*($month-2-12*(makeInt(($month-14)/12))))/12)-
			makeInt( (3*(makeInt(($year+4900+makeInt(($month-14)/12))/100))) /4)+
			$date-32075;
	}else{
		$jd = 367*$year-makeInt((7*($year+5001+makeInt(($month-9)/7)))/4)+makeInt((275*$month)/9)+$date+1729777;
	}
	$wd = $jd%7;
	$l = $jd-1948440+10632;
	$n=makeInt(($l-1)/10631);
	$l=$l-10631*$n+354;
	$z=(makeInt((10985-$l)/5316))*(makeInt((50*$l)/17719))+(makeInt($l/5670))*(makeInt((43*$l)/15238));
	$l=$l-(makeInt((30-$z)/15))*(makeInt((17719*$z)/50))-(makeInt($z/16))*(makeInt((15238*$z)/43))+29;
	$m=makeInt((24*$l)/709);
	$d=$l-makeInt((709*$m)/24);
	$y=30*$n+$z-30;
	$g = $m-1;
	
	return "$bulan[$g] $y H";
}
function hijriahT($tanggal){
	$bulan = [
		"Muharram","Safar","Rabiul Awwal","Rabiul Akhir","Jumadil Awwal","Jumadil Akhir",
		"Rajab","Sya'ban","Ramadhan","Syawwal","Zulqaidah", "Zulhijjah"
	];
	$date = makeInt(substr($tanggal,8,2));
	$month = makeInt(substr($tanggal,5,2));
	$year = makeInt(substr($tanggal,0,4));
	if (($year>1582)||(($year == "1582") && ($month > 10))||(($year == "1582") && ($month=="10")&&($date >14))){
		$jd = makeInt((1461*($year+4800+makeInt(($month-14)/12)))/4)+
			makeInt((367*($month-2-12*(makeInt(($month-14)/12))))/12)-
			makeInt( (3*(makeInt(($year+4900+makeInt(($month-14)/12))/100))) /4)+
			$date-32075;
	}else{
		$jd = 367*$year-makeInt((7*($year+5001+makeInt(($month-9)/7)))/4)+makeInt((275*$month)/9)+$date+1729777;
	}
	$wd = $jd%7;
	$l = $jd-1948440+10632;
	$n=makeInt(($l-1)/10631);
	$l=$l-10631*$n+354;
	$z=(makeInt((10985-$l)/5316))*(makeInt((50*$l)/17719))+(makeInt($l/5670))*(makeInt((43*$l)/15238));
	$l=$l-(makeInt((30-$z)/15))*(makeInt((17719*$z)/50))-(makeInt($z/16))*(makeInt((15238*$z)/43))+29;
	$m=makeInt((24*$l)/709);
	$d=$l-makeInt((709*$m)/24);
	$y=30*$n+$z-30;
	$g = $m-1;
	
	return "$y H";
}