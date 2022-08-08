<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: anash
 * Date: 22/11/2018
 * Time: 09.16
 */
if ( ! function_exists('rupiah')){
	function rupiah($field,$nol,$koma,$titik){
		$rupiah = number_format($field,$nol,$koma,$titik);
		return $rupiah;
	}
}
if ( ! function_exists('replace')){
	function replace($cari,$ganti,$var){
		$replace = str_replace($cari,$ganti,$var);
		return $replace;
	}
}
if ( ! function_exists('terbilang')){
	function terbilang($x){
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
}