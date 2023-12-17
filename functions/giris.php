<?
session_start();
date_default_timezone_set('Europe/Istanbul');

//TARİH
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
'Wednesday' => 'Çarsamba',
'Thursday' => 'Perşembe',
'Friday' => 'Cuma',
'Saturday' => 'Cumartesi',
'Sunday' => 'Pazar',
);


if ($_POST){
if($_POST["email"]=="" or $_POST["sifre"]=="") {
echo "
<div class='uyari'><i class='fa fa-info'></i> Bitte alle Pflichtfelder ausfüllen.</div>";
}else{

$email = $_POST['email'];
if (filter_var($email, FILTER_VALIDATE_EMAIL) ){ 

// dogru ise giris yap
include("../functions/ayar.php");
$email = mysql_real_escape_string($_POST["email"]);
$sifre  = mysql_real_escape_string(md5($_POST["sifre"]));

  $sorgu = mysql_query(" SELECT * FROM uye WHERE email='".$email."' and sifre='".$sifre."'");
  $detay = mysql_fetch_array($sorgu);
  $kontrol = mysql_num_rows($sorgu);

  if($kontrol > 0){
  $yazar = mysql_fetch_array($sorgu);	
  $_SESSION["uye"]=$detay["id"];
  $uid = $detay["id"]; 
  $tarih = strtr(date("d F Y"), $tarihgoster);
  $saat =  date("H:i:s");
  $ip = $_SERVER["REMOTE_ADDR"];
  
  $yazdir = mysql_query("INSERT INTO uye_loglari (uid,tarih,saat,ip) VALUES('$uid','$tarih','$saat','$ip')");
  $guncel = mysql_query("UPDATE uye SET son_giris='".$tarih."' WHERE id='".$uid."'");
  
//yönlendirme
echo '<script>setTimeout(function (){
window.location.replace("index.html?Giris=Ok");
},0000);</script>';

  
}else{
    echo"<div class='uyari'><i class='fa fa-info'></i> Ihre Anmeldedaten sind <strong>ungültig.</strong></div>";
};

} else {
   print "<div class='uyari'><i class='fa fa-info'></i> > Bitte geben Sie eine <strong>gültige E-Mail-Adresse</strong> ein</div>";
} }
 




}
?>