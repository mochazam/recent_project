<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Method untuk ngecek apakah sudah login atau belum
 *
 * @return boolean
 */
function is_login()
{
    $CI =& get_instance();
    $CI->load->library('session');

    $sess_data = $CI->session->userdata('is_login');
    if (!empty($sess_data)) {
        return true;
    }

    return false;
}

/**
 * Fungsi yang bertugas redirect jika belum login
 */
function must_login()
{
    if (!is_login()) {
        redirect('login');
        die;
    }
}

/**
 * Method untuk ngecek apakah yang login itu admin atau bukan
 * @return boolean
 */
function is_admin()
{
    if (!is_login()) {
        return false;
    }

    $CI =& get_instance();
    $CI->load->library('session');

    $sess = $CI->session->userdata('is_login');
    if (!empty($sess['admin'])) {
        return true;
    }

    return false;
}

function cekAdminLogin() {
    if ($this->is_login() == TRUE) {
        if ($this->ci->session->userdata('level') != 1) {
            redirect('users/login');
        }
    } else {
        redirect('users/login');
    }
}

function rupiah($value = ''){
    if($value){
        $formated = str_replace(',', '.', number_format($value));
        return $formated;
    }else{
        return false;
    }
}

if ( ! function_exists('tgl_indo'))
{
  function tgl_indo($tgl)
  {
    $ubah = gmdate($tgl, time()+60*60*8);
    $pecah = explode("-",$ubah);
    $tanggal = $pecah[2];
    $bulan = bulan($pecah[1]);
    $tahun = $pecah[0];
    return $tanggal.' '.$bulan.' '.$tahun;
  }
}
if ( ! function_exists('bulan'))
{
  function bulan($bln)
  {
    switch ($bln)
    {
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
if ( ! function_exists('nama_hari'))
{
  function nama_hari($tanggal)
  {
    $ubah = gmdate($tanggal, time()+60*60*8);
    $pecah = explode("-",$ubah);
    $tgl = $pecah[2];
    $bln = $pecah[1];
    $thn = $pecah[0];
    $nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
    $nama_hari = "";
    if($nama=="Sunday") {$nama_hari="Minggu";}
    else if($nama=="Monday") {$nama_hari="Senin";}
    else if($nama=="Tuesday") {$nama_hari="Selasa";}
    else if($nama=="Wednesday") {$nama_hari="Rabu";}
    else if($nama=="Thursday") {$nama_hari="Kamis";}
    else if($nama=="Friday") {$nama_hari="Jumat";}
    else if($nama=="Saturday") {$nama_hari="Sabtu";}
    return $nama_hari;
  }
}
if ( ! function_exists('hitung_mundur'))
{
  function hitung_mundur($wkt)
  {
    $waktu=array(   365*24*60*60    => "tahun",
    30*24*60*60     => "bulan",
    7*24*60*60      => "minggu",
    24*60*60        => "hari",
    60*60           => "jam",
    60              => "menit",
    1               => "detik");
    $hitung = strtotime(gmdate ("Y-m-d H:i:s", time () +60 * 60 * 8))-$wkt;
    $hasil = array();
    if($hitung<5)
    {
      $hasil = 'kurang dari 5 detik yang lalu';
    }
    else
    {
      $stop = 0;
      foreach($waktu as $periode => $satuan)
      {
        if($stop>=6 || ($stop>0 && $periode<60)) break;
        $bagi = floor($hitung/$periode);
        if($bagi > 0)
        {
          $hasil[] = $bagi.' '.$satuan;
          $hitung -= $bagi*$periode;
          $stop++;
        }
        else if($stop>0) $stop++;
        }
        $hasil=implode(' ',$hasil).' yang lalu';
      }
    return $hasil;
    }

 function weightCount($getWeight) {

    // Mengambil total berat belanja
    $totalWeight = round($getWeight, 1);

    // Ambil angka dibelakang koma dari total berat belanja
    $limitWeight = explode('.', $totalWeight);

    // Default batas berat 1 Kg JNE, untuk mendapatkan berat 1 Kg apabila total belanja dibawah 1 Kg
    $firstLimit = 1.3;


    // Default batas berat toleransi dibelakang koma dari JNE
    // Jika ada perubahan dari JNE, tinggal disesuaikan
    $limitTolerance = 3;

    // Cek apabila total berat belanja dibawah 1 Kg
    if ( $totalWeight < $firstLimit ) {

        // Berat masih masuk 1 Kg
        $weight = 1;

    } else {

        // Proses pembulatan
        // Apabila angka di belakang koma dibawah 3, bulatkan kebawah. Apabila diatas 2 bulatkan angka keatas dan simpan ke variabel $weight
        $weight = ($limitWeight <= $limitTolerance) ? floor($totalWeight) : ceil($totalWeight); 

    }

    return $weight;

  }

  function terbilang($bilangan)
  {
    if($bilangan=='' || $bilangan==0)
            return "nol";
      $angka = array('0','0','0','0','0','0','0','0','0','0',
                     '0','0','0','0','0','0');
      $kata = array('','satu','dua','tiga','empat','lima',
                    'enam','tujuh','delapan','sembilan');
      $tingkat = array('','ribu','juta','milyar','triliun');
    
      $panjang_bilangan = strlen($bilangan);
    
      /* pengujian panjang bilangan */
      if ($panjang_bilangan > 15) {
        $kalimat = "Diluar Batas";
        return $kalimat;
      }
    
      /* mengambil angka-angka yang ada dalam bilangan,
         dimasukkan ke dalam array */
      for ($i = 1; $i <= $panjang_bilangan; $i++) {
        $angka[$i] = substr($bilangan,-($i),1);
      }
    
      $i = 1;
      $j = 0;
      $kalimat = "";
    
    
      /* mulai proses iterasi terhadap array angka */
      while ($i <= $panjang_bilangan) {
    
        $subkalimat = "";
        $kata1 = "";
        $kata2 = "";
        $kata3 = "";
    
        /* untuk ratusan */
        if ($angka[$i+2] != "0") {
          if ($angka[$i+2] == "1") {
            $kata1 = "seratus";
          } else {
            $kata1 = $kata[$angka[$i+2]] . " ratus";
          }
        }
    
        /* untuk puluhan atau belasan */
        if ($angka[$i+1] != "0") {
          if ($angka[$i+1] == "1") {
            if ($angka[$i] == "0") {
              $kata2 = "sepuluh";
            } elseif ($angka[$i] == "1") {
              $kata2 = "sebelas";
            } else {
              $kata2 = $kata[$angka[$i]] . " belas";
            }
          } else {
            $kata2 = $kata[$angka[$i+1]] . " puluh";
          }
        }
    
        /* untuk satuan */
        if ($angka[$i] != "0") {
          if ($angka[$i+1] != "1") {
            $kata3 = $kata[$angka[$i]];
          }
        }
    
        /* pengujian angka apakah tidak nol semua,
           lalu ditambahkan tingkat */
        if (($angka[$i] != "0") OR ($angka[$i+1] != "0") OR
            ($angka[$i+2] != "0")) {
          $subkalimat = "$kata1 $kata2 $kata3 " . $tingkat[$j] . " ";
        }
    
        /* gabungkan variabe sub kalimat (untuk satu blok 3 angka)
           ke variabel kalimat */
        $kalimat = $subkalimat . $kalimat;
        $i = $i + 3;
        $j = $j + 1;
    
      }
    
      /* mengganti satu ribu jadi seribu jika diperlukan */
      if (($angka[5] == "0") AND ($angka[6] == "0")) {
        $kalimat = str_replace("satu ribu","seribu",$kalimat);
      }
    
      return trim($kalimat);
  }


  
  function add_leading_zero($value, $threshold = 2) {
    return sprintf('%0' . $threshold . 's', $value);
  }

	function relative_time($datetime)
    {
        $CI =& get_instance();
        $CI->lang->load('date');

        if(!is_numeric($datetime))
        {
            $val = explode(" ",$datetime);
           $date = explode("-",$val[0]);
           $time = explode(":",$val[1]);
           $datetime = mktime($time[0],$time[1],$time[2],$date[1],$date[2],$date[0]);
        }

        $difference = time() - $datetime;
        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60","60","24","7","4.35","12","10");

        if ($difference > 0) 
        { 
            $ending = $CI->lang->line('date_ago');
        } 
        else 
        { 
            $difference = -$difference;
            $ending = $CI->lang->line('date_to_go');
        }
        for($j = 0; $difference >= $lengths[$j]; $j++)
        {
            $difference /= $lengths[$j];
        } 
        $difference = round($difference);

        if($difference != 1) 
        { 
            $period = strtolower($CI->lang->line('date_'.$periods[$j].'s'));
        } else {
            $period = strtolower($CI->lang->line('date_'.$periods[$j]));
        }

        return "$difference $period $ending";
    }

    function generateRandomCode($length = 8) {
        // Available characters
        $chars = '0123456789abcdefghjkmnoprstvwxyz';

        $Code = '';
        // Generate code
        for ($i = 0; $i < $length; ++$i) {
            $Code .= substr($chars, (((int) mt_rand(0, strlen($chars))) - 1), 1);
        }
        return strtoupper($Code);
    }  

    function tag_price($rupiah = '') {
		$rp = $rupiah;
		$str_len = strlen($rp);
		$acuan = $str_len - 3;
		//get 3 digit di belakang titik / ribuan
		$rear = substr($rp, -3);
		// get digit di depan titik
		$front = substr($rp, 0, $acuan);

		return '<span class="price">
				<span class="price-valuta">Rp.</span>
				<span itemprop="price" class="harga">'.$front.'.<span class="kecil">'.$rear.'</span>
				</span>
			  </span>';


	}
}