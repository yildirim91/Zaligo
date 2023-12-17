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
if($_POST["ad"]=="" or $_POST["soyad"]=="" or $_POST["email"]=="" or $_POST["sifre"]=="") {
echo "
<div class='uyari'><i class='fa fa-info'></i> Bitte alle Pflichtfelder ausfüllen.</div>";
}else{
include("../functions/ayar.php");
$email = $_POST['email'];
if (filter_var($email, FILTER_VALIDATE_EMAIL) ){ 
$emailvarmi = mysql_query('select * from uye order by id desc limit 1');
while ($rowemailvarmi = mysql_fetch_array($emailvarmi)){
if($rowemailvarmi['email'] != $email){
	
if($_POST["onay"]=="") {
echo "
<div class='uyari'><i class='fa fa-info'></i> Sie haben die Registrierungsvereinbarung <strong>nicht akzeptiert.</strong></div>";
}else{

//SQL
$ad = $_POST["ad"];
$soyad = $_POST["soyad"];
$email = $_POST["email"];
$sifre = md5($_POST["sifre"]);
$reklam = $_POST["reklam"];
$cinsiyet = $_POST["cinsiyet"];
$tarih = strtr(date("d F Y"), $tarihgoster);

$yazdir = mysql_query("INSERT INTO uye (ad,soyad,email,sifre,tarih,reklam,cinsiyet) VALUES('$ad','$soyad','$email','$sifre','$tarih','$reklam','$cinsiyet')");


if($yazdir) {

echo "
<style> .msjBut { display:none; } </style>
<div class='onay'><i class='fa fa-check'></i>Sie werden zur <strong>Hauptseite weitergeleitet.</strong> </div>
";

//otomatik giriş

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
  

}


}else{
	echo "Fatal Error!";
}


//yönlendirme
echo '<script>setTimeout(function (){
window.location.replace("einloggen.html");
},3000);</script>';

//onay
}
// Mail 


;}
else echo '<div class="uyari"><i class="fa fa-info"></i> Diese email Adresse ist <strong>bereits registriert.</strong> </div>'                
;}

} else {
   print '<div class="uyari"><i class="fa fa-info"></i> Bitte geben Sie eine <strong>gültige E-Mail-Adresse</strong> ein.</div>';
} }
 



}
?>