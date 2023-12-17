<?
error_reporting(0);
session_start();
$uyeGiris = $_SESSION["uye"];

$id = $_GET["id"];
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
ob_start("ob_gzhandler");
}
else {
ob_start();
}
include("functions/ayar.php");
include("functions/class.php");
$kisiBul = temizle($_SERVER['HTTP_USER_AGENT']);
$ayar = mysql_fetch_array(mysql_query("SELECT * FROM ayar"));
$uruns = mysql_fetch_array(mysql_query("SELECT * from urun where id = '".$id."'"));
$kat = mysql_fetch_array(mysql_query("SELECT * FROM kategori where id='".$uruns["kid"]."'"));
$stk = mysql_fetch_array(mysql_query("SELECT * FROM stok where urun='".$uruns["urunkod"]."'"));
$uvp = mysql_fetch_array(mysql_query("SELECT * FROM uvp where urun='".$uruns["urunkod"]."'"));
//para birimi
function paraT($veri = 0){
$veri    =    number_format($veri,2,",",".");
return $veri;
}
//para birimi2
function paraV($veri2 = 0){
$veri2    =    number_format($veri2,2,".",",");
return $veri2;
}
//son gezilenler
$brow_id = temizle($_SERVER['HTTP_USER_AGENT']);
$son_ge = mysql_query("INSERT INTO son_gezilenler (uyeid,urunid) VALUES('".$brow_id."','".$uruns["id"]."')");


?>
<!doctype html>
<html lang="tr" class="no-js">
<head>

<meta charset="utf-8">
<title><?=$uruns["urunad"];?> - <?=$kat["baslik"];?> - <?=$ayar["title"];?></title>
<meta name="keywords" content="<?=$uruns["arama"];?>" /> 
<meta name="description" content="<?=$uruns["urunad"];?> - <?=$kat["baslik"];?>, Moderne Wohneinrichtung für alle Wohnbereiche erhalten Sie hier bei Zaligo."/>
<base href="<?=$ayar["base"];?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<meta property="og:site_name" content="https://zaligo.de">
<meta property="og:title" content="<?=$uruns["urunad"];?> - <?=$kat["baslik"];?>">
<meta property="og:description" content="<?=$uruns["urunad"];?> - <?=$kat["baslik"];?>, Moderne Wohneinrichtung für alle Wohnbereiche erhalten Sie hier bei Zaligo.">
<meta property="og:type" content="article">
<meta property="og:image" content="https://zaligo.de/img/urun/product_code-<?=$uruns["urunkod"];?>---01.jpg"> 
<meta property="og:url" content="https://zaligo.de/<?=$kat["self"];?>/<?=urlcevir($uruns["urunad"]);?>/<?=$uruns["id"];?>.html">
<link rel="icon" href="img/favicon.png" type="image/png">
<link href="all.css" rel="stylesheet">
<link href="css/base.css" rel="stylesheet">
<link href="css/nivo-lightbox.css" rel="stylesheet" type="text/css">
<link href="css/jquery.notify.css" rel="stylesheet" type="text/css">
<link href="css/themes/default/default.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="jquery/jquery-1.7.min.js"></script>
<script type="text/javascript" src="jquery/modernizr.custom.js"></script>
<link href="https://fonts.googleapis.com/css?family=Catamaran:300,400,500,600,700,800,900|Exo:400,500,600,700,800,900|Kalam:400,700|Open+Sans:300,400,600,700,800&amp;subset=latin-ext" rel="stylesheet">
<script src="jquery/nivo-lightbox.js"></script>
<script type="text/javascript" src="jquery/jquery.notify.min.js"></script>
<script type='text/javascript' src="jquery/codex-fly.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('a').nivoLightbox();
});
//notify
$(document).ready(function(e) {
$('#sepet-alert').on('click', function(){
notify({
type: "alert", 
title: "<strong><a href='warenkorb.html' style='color:#fff;'>Warenkorb</a></strong>",
message: "Produkt wurde in den Warenkorb gelegt",
position: {
x: "right", 
y: "top" 
},
icon: '<img src="img/sepet.png" />', 
size: "normal", 
overlay: false, 
closeBtn: true, 
overflowHide: false, 
spacing: 20,
theme: "default", 
autoHide: true, 
delay: 11500, 
onShow: null, 
onClick: null,
onHide: null,
template: '<div class="notify"><div class="notify-text"></div></div>'
});
});

});
//sepet_tasi
$(document).ready(function(){
$('.sepete-tasi').on('click',function(){
$('html, body').animate({
'scrollTop' : $(".sepet").position().top
});
var itemImg = $(this).parent().find('img').eq(0);
flyToElement($(itemImg), $('.sepet'));
});
});
//title
$(window).focus(function() {
document.title = 'Sch\u00f6n, dass du zur\u00fcck bist. \ud83d\ude0d';
setTimeout(function(){ document.title = '<?=$uruns["urunad"];?> - <?=$kat["baslik"];?> - Zaligo © Home & Living'; }, 3000);
})
.blur(function() {
document.title = 'Wo bist du hin? \ud83d\ude22';
setTimeout(function(){ document.title = 'Komm zur\u00fcck \u2639\ufe0f'; }, 3000);
});
</script>
</head>

<body>

<?
//link_kontrol
if($uruns) {
}else{
	$ceks = $_GET["bid"];
	$urun_bul = mysql_fetch_array(mysql_query("SELECT * from urun where self like '%$ceks%'"));
	$kid_bul = mysql_fetch_array(mysql_query("SELECT * from kategori where id = '".$urun_bul["kid"]."'"));
	$kidle=urlcevir($kid_bul["baslik"]);
	
	header("Location: https://zaligo.de/".$kidle."/".urlcevir($urun_bul["urunad"])."/".$urun_bul["id"].".html");
}
?>

<? include("init/head.php"); ?>


<!--sayfa-nav-->
<div class="sNav">
<div class="cont">
<a href="index.html">Home</a><i class="fa fa-angle-right"></i> 
<a href="<?=$kat["self"];?>.html"><?=$kat["baslik"];?></a> <i class="fa fa-angle-right"></i>  <a href="<?=$kat["self"];?>/<?=urlcevir($uruns["urunad"]);?>/<?=$uruns["id"];?>.html"><strong><?=$uruns["urunad"];?></strong></a> 
</div>
</div>
<!--sayfa-nav-->

<!--bnd-->
<div class="blackfriday_2"><div class="cont"><div class="mind"><img src="img/blackfriday.png" alt="Black Friday"><img src="img/black-arrow.png" alt="blackfriday" id="barr" class="blink"></div><span>guter Monat, beste Angebote!</span></div></div>
<div class="indirimBand">
<div><strong>Jetzt bıs zu 66% Rabatt </strong><br/>
auf alle <?=$kat["baslik"];?></div>
</div>

<!--preisalarm-->
<? rand(0,12)."<br>"; ?>
<? if($stk["stok"] > 0) { ?>
<? if($stk["stok"] < 20) { ?>
<div class="fiyatAlarm">
<div class="alarmBas"><strong>PREIS</strong>ALARM <i class="fa fa-info blink"></i> <div class="alarmBg"><?=$uruns["indirimlifiyat"];?>€</div></div>
<span>letzten  <strong><?=$stk["stok"];?> Artikel</strong> zu diesem Preis!</span>
</div>
<? } ?>
<? } ?>
<!--preisalarm-->

<!--bnd-->
<div class="clear"></div><div class="bosCek"></div>
<div class="cont">

<!--sol-->
<div class="urunSol">
<div class="geriDon trans"><a href="javascript:history.back(-1);" title="Zürück"><i class="fa fa-angle-left"></i> Zürück</a> </div>

<?
$ilk_kod = substr($uruns["urunkod"], 0, 5);
$ikinci_kod = substr($uruns["urunkod"], 6, 15);
?>

<?
$bul      = array("-8","-");
$degistir = array("8","x");
if($uruns["kid"]==6) {

$hals = substr($uruns["urunkod"], 0, 5);
}else{
$hals = $uruns["urunkod"];
}
$kpk_resim = mysql_fetch_array(mysql_query("select kapak,urunkod from urun where urunkod like '%$hals%' order by id asc"));


?>

<!--resim-->
<div class="urunSolSag">
<?if($uruns["takip"]==01) {?><div class="yeni">NEU!</div><? } ?>

<? if($uruns["kid"]==7 or $uruns["kid"]==9 or $uruns["kid"]==10) { ?>
<a data-lightbox-gallery="gallery1" href="img/urun/product_code-<?=$uruns["urunkod"];?>---<?=$uruns["kapak"];?>.jpg" title="<?=$uruns["urunad"];?>">
<img src="timthumb.php?w=550&src=<?=$ayar["base"];?>img/urun/product_code-<?=$uruns["urunkod"];?>---<?=$uruns["kapak"];?>.jpg" alt="<?=$uruns["urunad"];?>">
</a>
<? }else{ ?>
<a data-lightbox-gallery="gallery1" href="img/urun/<?=urlcevir($uruns["urunad"]);?>-1.jpg" title="<?=$uruns["urunad"];?>">
<img src="timthumb.php?w=400&src=<?=$ayar["base"];?>img/urun/<?=urlcevir($uruns["urunad"]);?>-1.jpg" alt="<?=$uruns["urunad"];?>">
</a>
<? } ?>
</div>

<div class="urunSolIc">
<div class="dedInfo">Mehr Ansıchten</div><br/>


<? if($uruns["kid"]==7 or $uruns["kid"]==9 or $uruns["kid"]==10) { ?>


<?php if ( file_exists( "img/urun/product_code-".$uruns["urunkod"]."---01.jpg" ) ) { ?>
<a data-lightbox-gallery="gallery1" href="img/urun/product_code-<?=$uruns["urunkod"];?>---01.jpg" title="<?=$uruns["urunad"];?>"><img src="img/urun/product_code-<?=$uruns["urunkod"];?>---01.jpg" alt="<?=$uruns["urunad"];?>"></a>
<? } ?>

<?php if ( file_exists( "img/urun/product_code-".$uruns["urunkod"]."---02.jpg" ) ) { ?>
<a data-lightbox-gallery="gallery1" href="img/urun/product_code-<?=$uruns["urunkod"];?>---02.jpg" title="<?=$uruns["urunad"];?>"><img src="img/urun/product_code-<?=$uruns["urunkod"];?>---02.jpg" alt="<?=$uruns["urunad"];?>"></a>
<? } ?>

<?php if ( file_exists( "img/urun/product_code-".$uruns["urunkod"]."---03.jpg" ) ) { ?>
<a data-lightbox-gallery="gallery1" href="img/urun/product_code-<?=$uruns["urunkod"];?>---03.jpg" title="<?=$uruns["urunad"];?>"><img src="img/urun/product_code-<?=$uruns["urunkod"];?>---03.jpg" alt="<?=$uruns["urunad"];?>"></a>
<? } ?>

<?php if ( file_exists( "img/urun/product_code-".$uruns["urunkod"]."---04.jpg" ) ) { ?>
<a data-lightbox-gallery="gallery1" href="img/urun/product_code-<?=$uruns["urunkod"];?>---04.jpg" title="<?=$uruns["urunad"];?>"><img src="img/urun/product_code-<?=$uruns["urunkod"];?>---04.jpg"  alt="<?=$uruns["urunad"];?>"></a>
<? } ?>

<?php if ( file_exists( "img/urun/product_code-".$uruns["urunkod"]."---05.jpg" ) ) { ?>
<a data-lightbox-gallery="gallery1" href="img/urun/product_code-<?=$uruns["urunkod"];?>---05.jpg" title="<?=$uruns["urunad"];?>"><img src="img/urun/product_code-<?=$uruns["urunkod"];?>---05.jpg"  alt="<?=$uruns["urunad"];?>"></a>
<? } ?>

<? }else{ ?>

<?php if ( file_exists( "img/urun/".urlcevir($uruns["urunad"])."-3.jpg" ) ) { ?><a data-lightbox-gallery="gallery1" href="img/urun/<?=urlcevir($uruns["urunad"]);?>-3.jpg" title="<?=$uruns["urunad"];?>"><img src="img/urun/<?=urlcevir($uruns["urunad"]);?>-3.jpg" alt="<?=$uruns["urunad"];?>"></a><? } ?>
<?php if ( file_exists( "img/urun/".urlcevir($uruns["urunad"])."-4.jpg" ) ) { ?><a data-lightbox-gallery="gallery1" href="img/urun/<?=urlcevir($uruns["urunad"]);?>-4.jpg" title="<?=$uruns["urunad"];?>"><img src="img/urun/<?=urlcevir($uruns["urunad"]);?>-4.jpg" alt="<?=$uruns["urunad"];?>"></a><? } ?>
<?php if ( file_exists( "img/urun/".urlcevir($uruns["urunad"])."-1.jpg" ) ) { ?><a data-lightbox-gallery="gallery1" href="img/urun/<?=urlcevir($uruns["urunad"]);?>-1.jpg" title="<?=$uruns["urunad"];?>"><img src="img/urun/<?=urlcevir($uruns["urunad"]);?>-1.jpg" alt="<?=$uruns["urunad"];?>"></a><? } ?>
<?php if ( file_exists( "img/urun/".urlcevir($uruns["urunad"])."-2.jpg" ) ) { ?><a data-lightbox-gallery="gallery1" href="img/urun/<?=urlcevir($uruns["urunad"]);?>-2.jpg" title="<?=$uruns["urunad"];?>"><img src="img/urun/<?=urlcevir($uruns["urunad"]);?>-2.jpg" alt="<?=$uruns["urunad"];?>"></a><? } ?>


<? } ?>
</div>
<!--resim-->


</div>
<!--sol-->
<?
//yüzde
function yuzdeHesaplama($sayi,$yuzde){ 
    return ($sayi*$yuzde)/100;
  } 
$sonRakam = yuzdeHesaplama($uruns["satisfiyat"],5);
//yüzde_2
$alfiyat = $uruns["indirimlifiyat"];
$uvpfiyat = $uruns["uvp"];
$totaluvp = $uvpfiyat - $alfiyat;

 $a = $uruns["uvp"];
 $b = $totaluvp;
// $b $a nın yüzde kaçıdır;
 $c = $a / 100;

$uvpyuzde = floor($b / $c); 
?>





<!--sag-->
<div class="urunSag">

<!--kupon-->
<div class="kuponBg">
<div class="kupIc">
<div class="blink">5€ GUTSCHEIN</div><div>CODE : ZALCUP05</div>
</div>
</div>
<!--kupon-->


<? if($uyeGiris==1) {?>
<?=paraT($uruns["alisfiyat"]);?>€ <br/>
<? }else if($uyeGiris==8) { ?>
<?=paraT($uruns["alisfiyat"]);?>€ <br/>
<? } ?>




<h1 class="urunBas"><?=$uruns["urunad"];?></h1>
<div class="urunInfo">Artikel nr: <?=$uruns["urunkod"];?></div>


<!--timer-->
<div class="timerBg"><div>nur für <strong>kurze Zeit!</strong></div></div>
<div id="countdown_container">
	<div id="countdown_timer"></div>
	<div style="clear:both"></div>
</div>
<div class="clear"></div>
<!--timer-->


<div class="uEskiFiyat">UVP <?=paraT($uruns["uvp"]);?>€</div>
<div class="fiyatInfo">Sie sparen -<?=$uvpyuzde;?>% (<?=paraT($totaluvp);?> €)</div>

<div class="urunFiyat"><?=paraT($uruns["indirimlifiyat"]);?><span>€</span></div>
<div class="urunKdv">*inkl. MwSt.</div>

<!--kargo-->
<div class="urunInfoBg">
<div class="urunInfoIc">
<div><i class="fa fa-auto"></i>Kostenloser Versand <img src="img/ucretsiz-kargo.png" alt="Kostenloser Versand"></div>
</div>
</div>
<!--kargo-->



<?
//kargo_hesap
$kargo_limit=100;
$mevcut_fiyat = $uruns["indirimlifiyat"];
$kargo_toparla = $kargo_limit - $mevcut_fiyat;
?>


<? if($uruns["indirimlifiyat"] < 100) { ?>
<div style="display:none;">
<center><img src="img/title.png" title="Ayrac"></center>
<div class="urunKdv" id="kTip"><i class="fa fa-info"></i> Wenn sie noch für <?=$kargo_toparla;?>€ einkaufen<br/><strong style="letter-spacing:1px;">sparen sie die Versandkosten</strong></div>
</div>
<? } ?>


<!--olcu-->
<? if($uruns["kid"]==6){ ?>
<div class="olcu">
<?
$bul      = array("-8","-");
$degistir = array("8","x");
$hals = substr($uruns["urunkod"], 0, 5);
$sql_res=mysql_query("select id,urunad,urunkod,kid,olcu from urun where urunkod like '%$hals%' ");
while($row=mysql_fetch_array($sql_res)){
$kids = mysql_fetch_array(mysql_query("SELECT * FROM kategori where id='".$row["kid"]."'"));
?>
<div <? if($row["id"]==$id) {?> style="font-weight:bold; border-color:#ac1111; "<? } ?>>
<a href="<?=$kids["self"];?>/<?=urlcevir($row["urunad"]);?>/<?=$row["id"];?>.html" <? if($row["id"]==$id) {?> <? } ?>>
<?=str_replace(" ", "", $row["olcu"]);?>
</a>
</div>
<? } ?>
</div>
<div class="clear"></div>
<? }else if($uruns["kid"]==18){ ?>
<div class="olcu">
<?
$bul      = array("-8","-");
$degistir = array("8","x");
$hals = substr($uruns["urunkod"], 0, 5);
$sql_res=mysql_query("select id,urunad,urunkod,kid,olcu from urun where urunkod like '%$hals%' ");
while($row=mysql_fetch_array($sql_res)){
$kids = mysql_fetch_array(mysql_query("SELECT * FROM kategori where id='".$row["kid"]."'"));
?>
<div <? if($row["id"]==$id) {?> style="font-weight:bold; border-color:#ac1111; "<? } ?>>
<a href="<?=$kids["self"];?>/<?=urlcevir($row["urunad"]);?>/<?=$row["id"];?>.html" <? if($row["id"]==$id) {?> <? } ?>>
<?=str_replace(" ", "", $row["olcu"]);?>
</a>
</div>
<? } ?>
</div>
<div class="clear"></div>
<? }else if($uruns["kid"]==19){ ?>
<div class="olcu">
<?
$bul      = array("-8","-");
$degistir = array("8","x");
$hals = substr($uruns["urunkod"], 0, 5);
$sql_res=mysql_query("select id,urunad,urunkod,kid,olcu from urun where urunkod like '%$hals%' ");
while($row=mysql_fetch_array($sql_res)){
$kids = mysql_fetch_array(mysql_query("SELECT * FROM kategori where id='".$row["kid"]."'"));
?>
<div <? if($row["id"]==$id) {?> style="font-weight:bold; border-color:#ac1111; "<? } ?>>
<a href="<?=$kids["self"];?>/<?=urlcevir($row["urunad"]);?>/<?=$row["id"];?>.html" <? if($row["id"]==$id) {?> <? } ?>>
<?=str_replace(" ", "", $row["olcu"]);?>
</a>
</div>
<? } ?>
</div>

<? }else if($uruns["kid"]==10){ ?>
<div class="olcu">
<?
$bul      = array("-8","-");
$degistir = array("8","x");
$hals = substr($uruns["urunkod"], 0, 5);
$sql_res=mysql_query("select id,urunad,urunkod,kid,olcu from urun where urunkod like '%$hals%' ");
while($row=mysql_fetch_array($sql_res)){
$kids = mysql_fetch_array(mysql_query("SELECT * FROM kategori where id='".$row["kid"]."'"));
?>
<div <? if($row["id"]==$id) {?> style="font-weight:bold; border-color:#ac1111; "<? } ?>>
<a href="<?=$kids["self"];?>/<?=urlcevir($row["urunad"]);?>/<?=$row["id"];?>.html" <? if($row["id"]==$id) {?> <? } ?>>
<?=str_replace(" ", "", $row["olcu"]);?>
</a>
</div>
<? } ?>
</div>
<div class="clear"></div>

<? }else if($uruns["kid"]==9){ ?>
<div class="olcu">
<?
$bul      = array("-8","-");
$degistir = array("8","x");
$hals = substr($uruns["urunkod"], 0, 5);
$sql_res=mysql_query("select id,urunad,urunkod,kid,olcu from urun where urunkod like '%$hals%' ");
while($row=mysql_fetch_array($sql_res)){
$kids = mysql_fetch_array(mysql_query("SELECT * FROM kategori where id='".$row["kid"]."'"));
?>
<div <? if($row["id"]==$id) {?> style="font-weight:bold; border-color:#ac1111; "<? } ?>>
<a href="<?=$kids["self"];?>/<?=urlcevir($row["urunad"]);?>/<?=$row["id"];?>.html" <? if($row["id"]==$id) {?> <? } ?>>
<?=str_replace(" ", "", $row["olcu"]);?>
</a>
</div>
<? } ?>
</div>
<div class="clear"></div>
<? } ?>
<!--olcu-->

<br/>

<!--stok-->
<div class="gonderim">
<span>Lieferzeit: 2 - 5 Werktage</span>
<? if($stk["stok"] > 0) { ?>
<div> Auf Lager</div>
<? }else{ ?>
<div style="background-color:#777;">Ausverkauft</div>
<? } ?>
</div>
<!--stok-->

<div class="clear"></div>

<!--sepet-->
<form id="sepetForm">
<input name="id" value="<?=$uruns["id"];?>" type="hidden" />
<input name="urunid" id="<?=$uruns["id"];?>_urunid" value="<?=$uruns["id"];?>" type="hidden" />
<input name="satisfiyat" id="<?=$uruns["id"];?>_satisfiyat" value="<?=$uruns["indirimlifiyat"];?>" type="hidden" />

<!--sepet-->
<?
if($stk["stok"] > 0) {
?>
<div class="urunSepet">
 <!--adet-->
<div class="adet-spinner adetArttir">
<a href="javascript:void(0)" class="minus"><i class="fa fa-minus"></i></a>
<input type="text" name="adet" id="<?=$uruns["id"];?>_adet" value="1">
<a href="javascript:void(0)" class="plus"><i class="fa fa-plus" onchange="submit()"></i></a>
 &nbsp; &nbsp;
 <span class="trans"><a href="javascript:voit(0);" onclick="sepetCek('<?=$uruns["id"];?>')" id="sepet-alert">In den Warenkorb <i class="fa fa-shopping-cart" style="color:#fff;"></i></a></span>
 </div>
<!--adet-->
 </div>
<!--sepet-->
<? } ?>
</form>
<!--sepet-->

<!--ozellikler-->
<div class="avantajlar">
<? if($uruns["ozellik1"]) {?><div><i class="fa fa-check"></i> <?=$uruns["ozellik1"];?></div><? } ?>
<? if($uruns["ozellik2"]) {?><div><i class="fa fa-check"></i> <?=$uruns["ozellik2"];?></div><? } ?>
<? if($uruns["ozellik3"]) {?><div><i class="fa fa-check"></i> <?=$uruns["ozellik3"];?></div><? } ?>
<? if($uruns["ozellik4"]) {?><div><i class="fa fa-check"></i> <?=$uruns["ozellik4"];?></div><? } ?>
<? if($uruns["ozellik5"]) {?><div><i class="fa fa-check"></i> <?=$uruns["ozellik5"];?></div><? } ?>
<? if($uruns["ozellik6"]) {?><div><i class="fa fa-check"></i> <?=$uruns["ozellik6"];?></div><? } ?>
<? if($uruns["ozellik7"]) {?><div><i class="fa fa-check"></i> <?=$uruns["ozellik7"];?></div><? } ?>
</div>
<!--ozellikler-->


<div class="diger_u">
<div class="dBas"> &nbsp; &nbsp; andere <strong>Optionen</strong> <i class="fa fa-angle-down"></i></div>
<!--diger_urun-->
<?
$myvalue = $uruns["urunad"];
$result=split(" ",$myvalue);

if($uruns["kid"]==6){
$hals = $result[0]." ".$result[1];
}elseif($uruns["kid"]==18){
$hals = $result[0]." ".$result[1];
}elseif($uruns["kid"]==19){
$hals = $result[0]." ".$result[1];
}else{
$hals = $result[0]." ".$result[1];
}

$sql_res=mysql_query("select id,urunad,urunkod,kid,renk,kapak from urun where urunad like '%$hals%' group by urunad");
while($row=mysql_fetch_array($sql_res)){
$kids = mysql_fetch_array(mysql_query("SELECT * FROM kategori where id='".$row["kid"]."'"));
?>
<div>
<a href="<?=$kids["self"];?>/<?=urlcevir($row["urunad"]);?>/<?=$row["id"];?>.html" <? if($row["id"]==$id) {?> <? } ?> title="<?=$row["renk"];?>">


<div class="diger_R" <? if($row["id"]==$id) {?> style="font-weight:bold; border-color:#b30000; "<? } ?>>

<? 
//heimtextilien
if($uruns["kid"]==7 or $uruns["kid"]==9 or $uruns["kid"]==10) { ?>
<img src="timthumb.php?h=70&w=60&src=<?=$ayar["base"];?>img/urun/product_code-<?=$row["urunkod"];?>---<?=$row["kapak"];?>.jpg" title="<?=$row["renk"];?>"><br/>
<? }else{ ?>
<img src="timthumb.php?h=70&w=60&src=<?=$ayar["base"];?>img/urun/<?=urlcevir($row["urunad"]);?>-1.jpg" title="<?=$row["renk"];?>"><br/>
<? } ?>

</div>

</a>
</div>
<? } ?>
<!--diger_urun-->
<div class="clear"></div>
</div>


</div>
<!--sag-->


<div class="clear"></div>

</div>
<!--servis-->
<div class="servisBg-2">
<div class="cont" id="ss">

<ul class="servis-list" style="height:80px;">
<li>
<div class="num">1</div>
<div class="sBas">Kostenlose Lıeferung <img src="img/ucretsiz-kargo.png" class="blink"></div>
<div class="sInfo">innerhalb deutschlands!</div>
</li>

<li>
<div class="num">2</div>
<div class="sBas">30 Tage Rückgaberecht</div>
<div class="sInfo">kostenfreies!</div>
</li>

<li>
<div class="num">3</div>
<div class="sBas">Bestpreıs-Garantıe</div>
<div class="sInfo">inklusive lieferung!</div>
</li>

</div>
</div>
<!--servis-->


<!--alt-->
<div class="line1"></div>

<div class="cont">

<!--sol-->
<div class="urunSol" style="margin-top:-21px;">

<div class="urunSoru off">
<a href="anfrageformular.html?uid=<?=$uruns["id"];?>" title="Fragen zum Artikel"><span>Fragen zum Artıkel <i class="fa fa-question"></i></span></a>
<div>Wir helfen Ihnen gerne weiter</div>
</div>

<div class="uKapak">
<div id="kip"><img src="img/kapak-vec.png" alt="Zaligo" ></div>

<? 
//heimtextilien
if($uruns["kid"]==7 or $uruns["kid"]==9 or $uruns["kid"]==10) { ?>
<img src="img/urun/product_code-<?=$uruns["urunkod"];?>---<?=$uruns["kapak"];?>.jpg" alt="<?=$uruns["urunad"];?>">
<? }else{ ?>
<img src="img/urun/<?=urlcevir($uruns["urunad"]);?>-2.jpg" alt="<?=$uruns["urunad"];?>">
<? } ?>
</div>

</div>
<!--sol-->


<!--sag-->
<div class="urunSag" style="margin-top:-21px;">
<div data-tabs class="tabs">    

   
   <div class="tab" <? if($uruns["kid"]==7) { ?>style="display:none;"<? } ?>">
      <input type="radio" name="tabgroup" id="tab-1" checked>
      <label for="tab-1">Zusatzinformation</label>
      <div class="tab__content">

<? if($uruns["renk"]) {?><div class="uOz"> <div>Farbe </div> <?=$uruns["renk"];?></div><? } ?>
<? if($uruns["olcu"]) {?><div class="uOz"> <div>Größe </div> <?=$uruns["olcu"];?></div><? } ?>
<? if($uruns["stil"]) {?><div class="uOz"> <div>  Stil </div> <?=$uruns["stil"];?></div><? } ?>
<? if($uruns["kg"]) {?><div class="uOz"> <div>Gewicht </div> <?=$uruns["kg"];?></div><? } ?>
<? if($uruns["haliyukseklik"]) {?><div class="uOz"> <div>Gesamthöhe </div> <?=$uruns["haliyukseklik"];?></div><? } ?>
<? if($uruns["materyal"]) {?><div class="uOz"> <div> Material </div> <?=$uruns["materyal"];?></div><? } ?>
<? if($uruns["halialti"]) {?><div class="uOz"> <div>Rücken </div> <?=$uruns["halialti"];?></div><? } ?>
<? if($uruns["cinsi"]) {?><div class="uOz"> <div>Material </div> <?=$uruns["cinsi"];?></div><? } ?>
<? if($uruns["soket"]) {?><div class="uOz"> <div> Lampenfassung </div> <?=$uruns["soket"];?></div><? } ?>
<? if($uruns["guc"]) {?><div class="uOz"> <div> Max. Leistung </div> <?=$uruns["guc"];?></div><? } ?>
<? if($uruns["kablouzunluk"]) {?><div class="uOz"> <div> Kabellänge </div> <?=$uruns["kablouzunluk"];?></div><? } ?>
<? if($uruns["imalat"]) {?><div class="uOz"> <div> Herstellungsart </div> <?=$uruns["imalat"];?></div><? } ?>
<? if($uruns["mensei"]) {?><div class="uOz"> <div> Herstellungsort </div> <?=$uruns["mensei"];?></div><? } ?>
<? if($uruns["montaj"]) {?><div class="uOz"> <div> Selbstmontage </div> <?=$uruns["montaj"];?></div><? } ?>
<? if($uruns["yukkapasitesi"]) {?><div class="uOz"> <div>  Max. Tragkraft </div> <?=$uruns["yukkapasitesi"];?></div><? } ?>
<? if($uruns["teslim"]) {?><div class="uOz"> <div>   Lieferumfang</div> <?=$uruns["teslim"];?></div><? } ?>
<? if($uruns["motto"]) {?><div class="uOz"> <div>  Besonderheiten </div> <?=$uruns["motto"];?></div><? } ?>
<? if($uruns["marka"]) {?><div class="uOz"> <div>  Marke </div> <?=$uruns["marka"];?></div><? } ?>
      </div> 
   </div>
   
   
   <div class="tab">
      <input type="radio" name="tabgroup" id="tab-2" <? if($uruns["kid"]==7) { ?>checked<? } ?>>
      <label for="tab-2">Beschreibung</label>
      <div class="tab__content" style="margin-top:-10px;">
	 
<?
$metin = str_replace("**", "<br/>", $uruns["aciklama"]);
echo str_replace(".", ".<br/><br/>", $metin);
?>



      </div> 
   </div>

</div>

<!--tag-sistemi-->
<div class="tagBg" style="display:none;">
<?
function rakamTemizle($text) {
    $search = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
    $text = str_replace($search, "", $text);
    return $text;
}
$bul = array(' ','.');
$yap = array(', ','');
$yazix = str_replace($bul,$yap,str_replace('/','',rakamTemizle($uruns["urunad"])));

$etiketler = explode(',', $yazix);
foreach( $etiketler as $anahtar => $deger ){
echo '<div class="tags"><a href="'.$ayar["self"].'tag.html?a='.trim($deger).'" title="'.trim($deger).'">'.trim($deger).'</a></div>';
}

?>
</div>
<!--tag-sistemi-->

</div>

</div>
<!--alt-->


<div class="clear"></div>



<div style="margin-top:-50px;">
<? include("init/foot.php"); ?>
</div>

<script type="text/javascript" src="jquery/adetSpin.js"></script>
<script type="text/javascript">
//adet
jQuery(document).ready(function ($) {
$(".adetArttir").adetSpin({inputWidth: 30}).css("border-color", "#ccc");
$(".adetArttir2").adetSpin({inputWidth: 30}).css("border-color", "#ccc");
});
//favori
function cart(id) {
var ele=document.getElementById(id);
var marketid=document.getElementById(id+"_marketid").value;
$.ajax({
type:'post',
 url:'ajax/favori.php',
data:{
id:id,
marketid:marketid
},
success:function(response) {
$('#form-al').html(response);
}
});
}
//sepet
function sepetCek(id) {
var ele=document.getElementById(id);
var id=document.getElementById(id+"_urunid").value;
var adet=document.getElementById(id+"_adet").value;
var satisfiyat=document.getElementById(id+"_satisfiyat").value;
$.ajax({
type:'post',
 url:'ajax/sepet-al.php',
data:{
id:id,
adet:adet,
satisfiyat:satisfiyat
},
success:function(response) {
$('#form-al').html(response);
}
});
}
//sepet_2
function sepetCek2(id) {
var ele=document.getElementById(id);
var id=document.getElementById(id+"_urunid").value;
var adet=document.getElementById(id+"_adet").value;
var satisfiyat=document.getElementById(id+"_satisfiyat").value;
$.ajax({
type:'post',
 url:'ajax/sepet-al.php',
data:{
id:id,
adet:adet,
satisfiyat:satisfiyat
},
success:function(response) {
$('#form-al').html(response);
}
});
}
//arama
$(function(){
$(".search").keyup(function() 
{ 
var searchid = $(this).val();
var dataString = 'search='+ searchid;
if(searchid!='')
{
$.ajax({
type: "POST",
url: "ajax/ara.php",
data: dataString,
cache: false,
success: function(html)
{
$("#result").html(html).show();
}
});
}return false;
});

jQuery("#result").live("click",function(e){ 
var $clicked = $(e.target);
var $name = $clicked.find('.name').html();
var decoded = $("<div/>").html($name).text();
$('#searchid').val(decoded);
});
jQuery(document).live("click", function(e) { 
var $clicked = $(e.target);
if (! $clicked.hasClass("search")){
jQuery("#result").fadeOut(); 
}
});
$('#searchid').click(function(){
jQuery("#result").fadeIn();
});
});

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

//tab
(function($, document) {
let height = -1;
$('.tab__content').each(function() {
height = height > $(this).outerHeight() ? height : $(this).outerHeight();
$(this).css('position', 'absolute');
});
$('[data-tabs]').css('min-height', height + 40 + 'px');
}

(jQuery, document));

//timer
var countDownDate = new Date("2022/11/25 12:00:00").getTime(); 
var dayText	= "Tag";
var hourText	= "Stunde";
var minuteText	= "Minute";
var secondText	= "Sekunde";
if (countDownDate){ 
	var x = setInterval(function() { 
		var now = new Date().getTime(); 
		var distance = countDownDate - now; 
		if (distance < 0) { 
			clearInterval(x); 
			$("#countdown_timer").html("Geri sayım yapılacak ileri bir tarih yoktur");
		}else { 
			
			var days = Math.floor(distance / (1000 * 60 * 60 * 24)),
				hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
				minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)),
				seconds = Math.floor((distance % (1000 * 60)) / 1000),
				days = (days?'<div><div>'+days+'</div><div>'+dayText+'</div></div>':''), 
				hours = (hours?'<div><div>'+hours+'</div><div>'+hourText+'</div></div>':''),
				minutes = (minutes?'<div><div>'+minutes+'</div><div>'+minuteText+'</div></div>':''), 
				seconds = (seconds?'<div><div>'+seconds+'</div><div>'+secondText+'</div></div>':''); 
			document.getElementById("countdown_timer").innerHTML = days + hours + minutes + seconds; 
		}
	}, 1000); //1 saniyede bir sayaç güncellenecek
}

</script>
</body>
</html>