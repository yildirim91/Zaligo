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
<title>Einloggen - <?=$ayar["title"];?></title>
<meta name="keywords" content="<?=$ayar['meta'];?>" /> 
<meta name="description" content="<?=$ayar["aciklama"];?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<link rel="icon" href="img/favicon.png" type="image/png">
<link href="all.css" rel="stylesheet">
<link href="css/base.css" rel="stylesheet">
<link href="css/animated.css" rel="stylesheet">
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
<a href="index.html">Home</a> <i class="fa fa-angle-right"></i> <a href="einloggen.html"><strong>Einloggen</strong></a>
</div>
</div>
<!--sayfa-nav-->



<? if($_GET["user"]==1) {?>
<!--giris-->
<div class="logBg">
<!--sol-->
<div class="logSol animated flash" style=" border:solid 1px #ccc;">
<div class="but-2 trans"><a href="gast.html">Als <strong>Gast</strong> zur Kasse gehen <i class="fa fa-angle-right"></i></a></div>
<span>oder</span>
<div class="but-2 trans" style="border-color:#ccc;"><a href="registrieren.html"> Neu bei Zaligo? <strong>Jetzt registrieren</strong></a></div>
</div>
<!--sol-->
<!--sag-->
<div class="logSag">
<div class="katLine">
<div>Eınloggen</div>
</div>

<div id="uyari-form"></div>
<form id="girisForm">

<input name="email" type="text" placeholder="E-Mail Adresse"><br/>
<input name="sifre" type="password"  placeholder="Passwort"><br/>

<div class="kSoz">
<div>Passwort vergessen?</div>
<label>
<input type="checkbox" name="onay" value="1" checked style="float:left; width:20px; cursor:pointer;">  
Merken
</label>
</div>
<div class="msjBut trans" onClick="form();"><i class="fa fa-sign-in"></i> <strong>Einloggen</strong></div>
</form>
</div>
<!--sag-->


</div>
<!--giris-->
<? }else{ ?>
<!--giris-->
<div class="katLine">
<div>Eınloggen</div>
</div>
<div class="formBg">
<div id="uyari-form"></div>
<form id="girisForm">

<input name="email" type="text" placeholder="E-Mail Adresse"><br/>
<input name="sifre" type="password"  placeholder="Passwort"><br/>

<div class="kSoz">
<div>Passwort vergessen?</div>
<label>
<input type="checkbox" name="onay" value="1" checked style="float:left; width:20px; cursor:pointer;">  
Merken
</label>
</div>
<div class="msjBut trans" onClick="form();"><i class="fa fa-sign-in"></i> <strong>Einloggen</strong></div>
</form>

<div class="oder">oder</div>
<div class="but-2 trans" style="border-color:#ccc;"><a href="registrieren.html"><i class="fa fa-angle-right"></i> Neu bei Zaligo? <strong>Jetzt registrieren</strong></a></div>


</div>
<!--giris-->
<? } ?>



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
//giriş
function form(){
$('#uyari-form').slideDown('slow');
$("#uyari-form").html('<img src="img/yukleniyor.gif" alt="Yükleniyor">');
$.ajax({
type:'POST',
url:'functions/giris.php',
data:$('#girisForm').serialize(),
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
