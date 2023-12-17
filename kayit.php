<?
session_start();
$uyeGiris = $_SESSION["uye"];
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
ob_start("ob_gzhandler");
}
else {
ob_start();
}
include("functions/ayar.php");
include("functions/class.php");
$ayar = mysql_fetch_array(mysql_query("SELECT * FROM ayar"));

if($uyeGiris){
header("Location:index.html");
};
?>
<!doctype html>
<html lang="tr" class="no-js">
<head>

<meta charset="utf-8">
<title>Registrieren - <?=$ayar["title"];?></title>
<meta name="keywords" content="<?=$ayar['meta'];?>" /> 
<meta name="description" content="<?=$ayar["aciklama"];?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<link rel="icon" href="img/favicon.png" type="image/png">
<link href="all.css" rel="stylesheet">
<link href="css/base.css" rel="stylesheet">
<script type="text/javascript" src="jquery/jquery-1.7.min.js"></script>
<script type="text/javascript" src="jquery/modernizr.custom.js"></script>
<link href="https://fonts.googleapis.com/css?family=Catamaran:300,400,500,600,700,800,900|Exo:400,500,600,700,800,900|Kalam:400,700|Open+Sans:300,400,600,700,800&amp;subset=latin-ext" rel="stylesheet">
<style>
.bultenSol, .bultenSag {
	display:none;
}
</style>
</head>

<body>

<? include("init/head.php"); ?>

<!--sayfa-nav-->
<div class="sNav">
<div class="cont">
<a href="index.html">Home</a> <i class="fa fa-angle-right"></i> <a href="registrieren.html"><strong>Registrieren</strong></a>
</div>
</div>
<!--sayfa-nav-->




<div class="katLine">
<div>Regıstrıeren</div>
</div>

<!--kayit-->
<div class="formBg">
<div id="uyari-form"></div>
<form id="uyeForm">


<input name="tip" type="hidden" value="1">

Andere&nbsp; 
<select name="cinsiyet">
<option value="0">*</option>
<option value="1">Frau</option>
<option value="2">Herr</option>
</select>

<input name="ad" type="text" placeholder="Vorname *">
<input name="soyad" type="text" placeholder="Nachname *">
<input name="email" type="text" placeholder="E-Mail Adresse *">
<input name="sifre" type="password" placeholder="Passwort *">


<div class="kSoz">
<label>
<input name="onay" type="checkbox" value="1" style="float:left; width:20px; cursor:pointer;">  
Ja, ich stimme den <strong><a href="agb.html" target="_blank" title="AGB">AGB</a></strong> und den <strong><a href="datenschutz.html" target="_blank" title="Datenschutz">Datenschutz­bestimmungen</a></strong> zu.
</label>
</div>

<div class="kSoz">
<label>
<input type="checkbox" name="reklam" value="1" style="float:left; width:20px; cursor:pointer;">  
Ja, bitte informieren Sie mich per Newsletter über exklusive Rabatt-Aktionen, aktuelle Events und neue Wohntrends bei <strong style="color:#db1700;">Zaligo.</strong>
</label>
</div>

<div class="msjBut trans" onClick="form();"><i class="fa fa-check-square-o"></i> <strong>Kundenkonto</strong> Anlegen</div>
</form>

<div class="vy" style="display:none;">oder</div>
<div class="faceBut"><i class="fa fa-facebook"></i> Einloggen mit <strong>Facebook</strong></div>




</div>
<!--kayit-->


<? include("init/foot.php"); ?>


<script type="text/javascript">
//top-menu
$(function(){
$("#MenuAc span").click(function () {

	var div = $(".top-menu");		
	$(".top-opened").not(div).stop(true , true).slideUp().removeClass("top-opened");		
	if(div.hasClass("top-opened")){div.removeClass("top-opened"); }else {div.addClass("top-opened")};
		
	if ($(".top-search-icon").hasClass("top-search-close")) {
		$(".top-search-icon").removeClass('top-search-close');
	}
	$(".top-menu").stop(true , true).slideToggle();
		
	return false;
		
	});
});
//kayıt
function form(){
$('#uyari-form').slideDown('slow');
$("#uyari-form").html('<img src="img/yukleniyor.gif" alt="Yükleniyor">');
$.ajax({
type:'POST',
url:'functions/kayit.php',
data:$('#uyeForm').serialize(),
success:function(cevap){  
$("#uyari-form").html(cevap)
}
})
}
$(document).ready(function() {
//sayfa_karart
$("#menuAc, #menuAc1, #menuAc2, #menuAc3").hover(
function(){
    $(".menuOvery").css("display", "block");
},
function(){
    $(".menuOvery").css("display", "none");
}
);
});
</script>
</body>
</html>