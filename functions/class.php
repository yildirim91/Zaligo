<?
//self link
function urlcevir($s){
    $tr = array('ş','Ş','ı','İ','ğ','Ğ','ü','Ü','ö','Ö','ç','Ç','amp');
    // Türkçe karakterlerin çevirlecegi karakterler
    $en = array('s','s','i','i','g','g','u','u','o','o','c','c',' ');
    $s = str_replace($tr,$en,$s);
    $s = strtolower($s);
    $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '-', $s);
    $s = preg_replace('/[^%a-z0-9 _-]/', '-', $s);
    $s = preg_replace('/\s+/', '-', $s);
    $s = preg_replace('|-+|', '-', $s);
    $s = str_replace("--","-",$s);
    $s = trim($s, '-');
    return $s;
}
// temizle
function temizle($veri)
{
$veri =str_replace("(","",$veri);
$veri =str_replace("/","",$veri);
$veri =str_replace(" ","",$veri);
$veri =str_replace(";","",$veri);
$veri =str_replace(":","",$veri);
$veri =str_replace(")","",$veri);
$veri =str_replace(".","",$veri);
$veri =str_replace(">","",$veri);
$veri =str_replace("*","",$veri);
$veri =str_replace("And","",$veri);
$veri =str_replace("'","",$veri);
$veri =str_replace("chr(34)","",$veri);
$veri =str_replace("chr(39)","",$veri);
return $veri;
}

//kelime kısalt
function kisalt($metin, $uzunluk){
  	// substr ile belirlenen uzunlukta kesiyoruz
        $metin = substr($metin, 0, $uzunluk)."...";
	// kesilen metindeki son kelimeyi buluyoruz
        $metin_son = strrchr($metin, " ");
	// son kelimeyi " ..." ile değiştiriyoruz
        $metin = str_replace($metin_son,"", $metin);
        
        return $metin;
}

// büyük küçük harf
function kelime_buyult($deger)
{
$deger = str_replace("ç","Ç",$deger);
$deger = str_replace("ğ","Ğ",$deger);
$deger = str_replace("ı","I",$deger);
$deger = str_replace("i","İ",$deger);
$deger = str_replace("ö","Ö",$deger);
$deger = str_replace("ü","Ü",$deger);
$deger = str_replace("ş","Ş",$deger);

$deger = strtoupper($deger);
$deger = trim($deger);

return $deger;
}
function kelime_kucult($deger)
{
$deger = str_replace("Ç","ç",$deger);
$deger = str_replace("Ğ","ğ",$deger);
$deger = str_replace("I","ı",$deger);
$deger = str_replace("İ","i",$deger);
$deger = str_replace("Ö","ö",$deger);
$deger = str_replace("Ü","ü",$deger);
$deger = str_replace("Ş","ş",$deger);

$deger = strtolower($deger);
$deger = trim($deger);

return $deger;
} 
function kelime_bir($deger)
{
$deger = split(" ",trim($deger));
$deger_tr = "";

for($x=0; $x < count($deger); $x++)
{
$deger_bas = substr($deger[$x],0,1);
$deger_son = substr($deger[$x],1);
$deger_bas = erguner_buyult($deger_bas);

$deger_tr .= $deger_bas.$deger_son." ";
}

$deger_tr = trim($deger_tr);

return $deger_tr;
}
// tarih fonksiyonu
$tarihgoster = array(
'January' => 'Ocak',
'February' => 'Şubat',
'March' => 'Mart',
'April' => 'Nisan',
'May' => 'Mayıs',
'June' => 'Haziran',
'July' => 'Temmuz',
'August' => 'Ağustos',
'September' => 'Eylül',
'October' => 'Ekim',
'November' => 'Kasım',
'December' => 'Aralık',
'Monday' => 'Pazartesi',
'Tuesday' => 'Salı',
'Wednesday' => 'Çarşamba',
'Thursday' => 'Perşembe',
'Friday' => 'Cuma',
'Saturday' => 'Cumartesi',
'Sunday' => 'Pazar',
);



//IP
function GetIP(){
	if(getenv("HTTP_CLIENT_IP")) {
 		$ip = getenv("HTTP_CLIENT_IP");
 	} elseif(getenv("HTTP_X_FORWARDED_FOR")) {
 		$ip = getenv("HTTP_X_FORWARDED_FOR");
 		if (strstr($ip, ',')) {
 			$tmp = explode (',', $ip);
 			$ip = trim($tmp[0]);
 		}
 	} else {
 	$ip = getenv("REMOTE_ADDR");
 	}
	return $ip;
}

//KDV
function kdv_ekle($tutar,$oran){
$kdv = $tutar * ($oran / 100);
$ytutar = $tutar + $kdv;
return $ytutar;
}
function kdv_cikar($tutar,$oran){
$ytutar = $tutar / (1 + ($oran/100));
return $ytutar;
}

//Sepet
function sepettekiUrunler() {
$cart = $_SESSION['cart'];
  if (!$cart) {
  return '0';
  } else {
  // Parse the cart session variable
  $items = explode(',',$cart);
  $s = (count($items) > 1) ? ' ':'';
  return ''.count($items).'';
}
}

//Aranan Kelimeler
function vurgula($metin, $kelimeler, $renk = '#FFFF00')
{
if(is_array($kelimeler))
{
foreach($kelimeler as $k => $kelime)
{
$desen[$k] = "/\b($kelime)\b/is";
$degistir[$k] = '<font style="background-color:'.$renk.'; color:#252525;">\\1</font>';
}
}  else {
$desen = "/\b($kelimeler)\b/is";
$degistir = '<font style="background-color:'.$renk.'; color:#252525;">\\1</font>';
}
return preg_replace($desen,$degistir,$metin);
}
?>