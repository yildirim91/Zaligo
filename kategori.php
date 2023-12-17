<?
session_start();
set_time_limit(950); 
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

$ayar = mysql_fetch_array(mysql_query("SELECT * FROM ayar"));
$kat = mysql_fetch_array(mysql_query("SELECT * FROM kategori where self='".$id."'"));
$urunNum = mysql_num_rows(mysql_query("SELECT * from urun where kid = '".$kat["id"]."' group by urunad"));

//para birimi
function paraT($veri = 0){
$veri    =    number_format($veri,2,".",",");
return $veri;
}

//filtrele
if($_POST["sort"]==1) {
$_SESSION["sorting"]="1";
$_SESSION["sortla"]=$sart="order by indirimlifiyat desc";
}else if($_POST["sort"]==2) {
$sart="order by indirimlifiyat asc";
$_SESSION["sorting"]="2";
$_SESSION["sortla"]=$sart="order by indirimlifiyat asc";
}else if($_POST["sort"]==3) {
$sart="order by id desc";
$_SESSION["sorting"]="3";
$_SESSION["sortla"]=$sart="order by id desc";
}
?>
<!doctype html>
<html lang="tr" class="no-js">
<head>

<meta charset="utf-8">
<title><?=$kat["baslik"];?> - <?=$ayar["title"];?></title>
<meta name="keywords" content="<?=$kat["baslik"];?>,moderne, wohneinrichtung, kostenloser versand, 30 tage rückgaberecht" /> 
<meta name="description" content="<?=$kat["baslik"];?>, Moderne Wohneinrichtung für alle Wohnbereiche erhalten Sie hier bei Zaligo. Kostenloser Versand & 30 Tage Rückgaberecht"/>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<link rel="icon" href="img/favicon.png" type="image/png">
<link href="all.css" rel="stylesheet">
<link href="css/base.css" rel="stylesheet">
<script type="text/javascript" src="jquery/jquery-1.7.min.js"></script>
<script type="text/javascript" src="jquery/modernizr.custom.js"></script>
<link href="https://fonts.googleapis.com/css?family=Catamaran:300,400,500,600,700,800,900|Exo:400,500,600,700,800,900|Kalam:400,700|Open+Sans:300,400,600,700,800&amp;subset=latin-ext" rel="stylesheet">
<script type='text/javascript' src="jquery/codex-fly.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.sepete-tasi').on('click',function(){
        $('html, body').animate({
            'scrollTop' : $(".sepet").position().top
        });
        var itemImg = $(this).parent().find('img').eq(0);
        flyToElement($(itemImg), $('.sepet'));
    });
});

$(window).focus(function() {
document.title = 'Sch\u00f6n, dass du zur\u00fcck bist. \ud83d\ude0d';
setTimeout(function(){ document.title = '<?=$kat["baslik"];?> - Zaligo © Home & Living'; }, 3000);

})
.blur(function() {
document.title = 'Wo bist du hin? \ud83d\ude22';
setTimeout(function(){ document.title = 'Komm zur\u00fcck \u2639\ufe0f'; }, 3000);
});
</script>
<style>
.owl-pagination {
	display:none;
}
</style>
</head>

<body>

<!--kupon-->
<div class="kuponBg-2">
<div class="kupIc">
<div class="blink">5€ GUTSCHEIN</div><div>CODE : ZALCUP05</div>
</div>
</div>
<div class="uzat"></div>
<!--kupon-->

<? include("init/head.php"); ?>

<!--sayfa-nav-->
<div class="sNav">
<div class="cont">
<a href="index.php">Home</a> <i class="fa fa-angle-right"></i> <a href="javascript:voit(0);">Produkte</a><i class="fa fa-angle-right"></i> <a href="<?=$kat["self"];?>.html"><strong><?=$kat["baslik"];?></strong></a>
</div>
</div>
<!--sayfa-nav-->


<!--bnd-->
<div class="blackfriday_2"><div class="cont"><div class="mind"><img src="img/blackfriday3.png" alt="Black Friday"><img src="img/black-arrow.png" alt="blackfriday" id="barr" class="blink"></div><span>guter Monat, beste Angebote!</span></div></div>
<div class="indirimBand">
<div><strong>Jetzt bıs zu 66% Rabatt </strong><br/>
auf alle Produkte</div>
</div>
<div class="kargoYok" id="kYokTip">
<section class="animated swing"><div>Versandkosten <br/><span>frei!</span>  </div></section>
</div>
<!--bnd-->



<div class="katLine">
<div><?=$kat["baslik_2"];?></div>
<span><strong><?=$urunNum;?></strong> Artikel</span>
</div>

<!--servis-->
<div class="servisBg">
<div class="cont">

<ul class="servis-list">
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

<br/>

<!--filtreleme-->
<div class="cont">
<div class="filtreBg">
<form method="post">
<label <? $idal=$_SESSION["sorting"]; if($idal==2) echo 'id="sortip"'; ?>><i class="fa fa-chevron-up"></i>&nbsp;<input type="radio" name="sort" value="2" <? $idal=$_SESSION["sorting"]; if($idal==2) echo 'checked'; ?> onChange="submit();"> Preis aufsteigend</label>&nbsp;
<label <? $idal=$_SESSION["sorting"]; if($idal==1) echo 'id="sortip"'; ?>><i class="fa fa-chevron-down"></i>&nbsp;<input type="radio" name="sort" value="1" <? $idal=$_SESSION["sorting"]; if($idal==1) echo 'checked'; ?> onChange="submit();"> Preis absteigend</label>&nbsp;
<label <? $idal=$_SESSION["sorting"]; if($idal==3) echo 'id="sortip"'; ?>><i class="fa fa-refresh"></i>&nbsp;<input type="radio" name="sort" value="3" <? $idal=$_SESSION["sorting"]; if($idal==3) echo 'checked'; ?> onChange="submit();"> neu hinzugefügt</label>
</form>
</div>
<!--kupon-->
<div class="kuponBg-3">
<div class="kupIc">
<div class="blink">5€ GUTSCHEIN</div><div>CODE : ZALCUP05</div>
</div>
</div>
<!--kupon-->
</div>
<!--filtreleme-->

<div class="clear"></div>

<div class="cont">
<div id="form-al"></div>

<!--sol-->
<div class="katSol">

<? if($_GET["Grosse"] or $_GET["Farbe"]) { ?>
<div class="fBas"><strong>Filtern</strong> nach <i class="fa fa-angle-down"></i></div>
<? if($_GET["Grosse"]) {?> <div class="fList"><strong>Größe :</strong> <?=ucwords($_GET["Grosse"]);?> <a href="<?=$kat["self"];?>.html?Grosse=&Farbe=<?=$_GET["Farbe"];?>&S=<?=$_GET["S"];?>"><i class="fa fa-close"></i> </a></div><? } ?>
<? if($_GET["Farbe"]) {?> <div class="fList"><strong>Farbe :</strong> <?=ucwords($_GET["Farbe"]);?> <a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=&S=<?=$_GET["S"];?>"><i class="fa fa-close"></i> </a> </div><? } ?>
<br/><br/>
<? } ?>

<? if($kat["id"]=="6" or $kat["id"]=="18" or $kat["id"]=="19") { ?>
<div class="fBas"><strong>Größe</strong> <i class="fa fa-angle-down"></i></div>
<div class="filternBg">
<?
$result=mysql_query("SELECT * from olculer");
while($row=mysql_fetch_array($result)){
$olcuNum = mysql_num_rows(mysql_query("SELECT olcu,urunad from urun where olcu = '".$row["olcu"]."' group by urunad"));
?>
<div><a href="<?=$kat["self"];?>.html?Grosse=<?=$row["olcu"];?>&Farbe=<?=$_GET["Farbe"];?>" <? if($_GET["Grosse"]==$row["olcu"]) { echo 'style="color:#b30000;"'; } ?>><input type="checkbox" onChange="submit();" id="olcu" name="olcu[]" <? if($_GET["Grosse"]==$row["olcu"]) { echo 'checked'; } ?> value="<?=$row["olcu"];?>"> <?=$row["olcu"];?> (<?=$olcuNum;?>)</a></div>
<? } ?>
</div>
<br/>
<? } ?>
<div class="fBas"><strong>Farbe</strong>  <i class="fa fa-angle-down"></i></div>

<div class="filternR">
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=blau"><div style="background-color:blue;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=türkis"><div style="background-color:turquoise;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=aqua"><div style="background-color:#5cb0d7;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=grün"><div style="background-color:green;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=gelb"><div style="background-color:yellow;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=gold"><div style="background-color:gold;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=orange"><div style="background-color:orange;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=rot"><div style="background-color:red;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=rosa"><div style="background-color:pink;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=violett"><div style="background-color:purple;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=creme"><div style="background-color:#d8c6ac;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=braun"><div style="background-color:brown;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=schwarz"><div style="background-color:black;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=grau"><div style="background-color:gray;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=silber"><div style="background-color:silver;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=multi"><div style="background-image:url(img/multi-farbe.png);"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=Weiß"><div style="background-color:white;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=beige"><div style="background-color:beige;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=anthrazit"><div style="background-color:#50565d;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=taupe"><div style="background-color:#ab9790;"></div></a>
</div>

</div>
<!--sol-->

<!--mobil-filtre-->
<div class="mobFiltre">
<? if($_GET["Grosse"] or $_GET["Farbe"]) { ?>
<div class="fBas"><strong>Filtern</strong> nach <i class="fa fa-angle-down"></i></div>
<? if($_GET["Grosse"]) {?> <div class="fList"><strong>Größe :</strong> <?=ucwords($_GET["Grosse"]);?> <a href="<?=$kat["self"];?>.html?Grosse=&Farbe=<?=$_GET["Farbe"];?>&S=<?=$_GET["S"];?>"><i class="fa fa-close"></i> </a></div><? } ?>
<? if($_GET["Farbe"]) {?> <div class="fList"><strong>Farbe :</strong> <?=ucwords($_GET["Farbe"]);?> <a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=&S=<?=$_GET["S"];?>"><i class="fa fa-close"></i> </a> </div><? } ?>
<br/><br/>
<? } ?>
<!--olcu-->

<? if($kat["id"]=="6" or $kat["id"]=="18" or $kat["id"]=="19") { ?>
<button class="accordion"><strong>Größe</strong> <i class="fa fa-angle-down"></i></button>
<div class="panel">
<div class="filternBg">
<?
$result=mysql_query("SELECT * from olculer");
while($row=mysql_fetch_array($result)){
$olcuNum = mysql_num_rows(mysql_query("SELECT olcu,urunad from urun where olcu = '".$row["olcu"]."' group by urunad"));
?>
<div><a href="<?=$kat["self"];?>.html?Grosse=<?=$row["olcu"];?>&Farbe=<?=$_GET["Farbe"];?>" <? if($_GET["Grosse"]==$row["olcu"]) { echo 'style="color:#b30000;"'; } ?>><input type="checkbox" onChange="submit();" id="olcu" name="olcu[]" <? if($_GET["Grosse"]==$row["olcu"]) { echo 'checked'; } ?> value="<?=$row["olcu"];?>"> <?=$row["olcu"];?> (<?=$olcuNum;?>)</a></div>
<? } ?>
</div>
</div>
<? } ?>
<!--olcu-->

<!--renk-->
<button class="accordion"><strong>Farbe</strong> <i class="fa fa-angle-down"></i></button>
<div class="panel">
<div class="filternR">
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=blau"><div style="background-color:blue;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=türkis"><div style="background-color:turquoise;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=aqua"><div style="background-color:#5cb0d7;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=grün"><div style="background-color:green;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=gelb"><div style="background-color:yellow;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=gold"><div style="background-color:gold;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=orange"><div style="background-color:orange;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=rot"><div style="background-color:red;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=rosa"><div style="background-color:pink;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=violett"><div style="background-color:purple;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=creme"><div style="background-color:#d8c6ac;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=braun"><div style="background-color:brown;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=schwarz"><div style="background-color:black;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=grau"><div style="background-color:gray;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=silber"><div style="background-color:silver;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=multi"><div style="background-image:url(img/multi-farbe.png);"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=Weiß"><div style="background-color:white;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=beige"><div style="background-color:beige;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=anthrazit"><div style="background-color:#50565d;"></div></a>
<a href="<?=$kat["self"];?>.html?Grosse=<?=$_GET["Grosse"];?>&Farbe=taupe"><div style="background-color:#ab9790;"></div></a>
</div>
</div>
<!--renk-->

</div>
<!--mobil-filtre-->

<!--sag-->
<div class="katSag">
<ul class="urun-list">

<?
// sayfa cevir
if($_SESSION["sortla"]) {
$sart2=$_SESSION["sortla"];
}else{
$sart2="order by id desc";
}

$kisiBul = temizle($_SERVER['HTTP_USER_AGENT']);
include('functions/sayfa.class.php');

$fiko = $_GET["Grosse"];
$hiko = $_GET["Farbe"];

$query=("SELECT id,urunad,urunkod,satisfiyat,kid,kapak,indirimlifiyat,takip,uvp,olcu from urun where kid = '".$kat["id"]."' and olcu REGEXP '^($fiko)' and renk LIKE '%$hiko%' group by urunad $sart2");

$resimcek = mysql_query($query);
$total_records = mysql_num_rows($resimcek); 
$scroll_page = 15; 
$per_page = 40; 
$current_page = $_GET['S']; 
$pager_url = $kat["self"].'.html?Grosse='.$_GET["Grosse"].'&Farbe='.$_GET["Farbe"].'&S='; 
$inactive_page_tag = 'id="current_page"'; 
$previous_page_text = '&lt; Önceki Sayfa'; 
$next_page_text = 'Sonraki Sayfa &gt;'; 
$first_page_text = '&lt;&lt; Ilk Sayfa'; 
$last_page_text = 'Son Sayfa &gt;&gt;'; 
$pager_url_last = ''; 
$kgPagerOBJ =new kgPager();
$kgPagerOBJ -> pager_set($pager_url, $total_records, $scroll_page, $per_page, $current_page, $inactive_page_tag, $previous_page_text, $next_page_text, $first_page_text, $last_page_text, $pager_url_last);

$result=mysql_query($query." LIMIT ".$kgPagerOBJ -> start.", ".$kgPagerOBJ -> per_page);
if(mysql_num_rows($result)==0) print '<br/><div class="sncYok">In dieser Kategorie befinden sich derzeit keine Artikel.<br/>Bitte versuchen sie es zu einem späteren Zeitpunkt.<br/> <i class="fa fa-refresh"></i></div>';
while($row=mysql_fetch_array($result)){
	
//group by '".substr($row["urunkod"], 0, 5)."'
$kids = mysql_fetch_array(mysql_query("SELECT * FROM kategori where id='".$row["kid"]."'"));
$stk = mysql_fetch_array(mysql_query("SELECT * FROM stok where urun='".$row["urunkod"]."'"));
?>

<?
$uvp = mysql_fetch_array(mysql_query("SELECT * FROM uvp where urun='".$row["urunkod"]."'"));

//yüzde_2
$alfiyat = $row["indirimlifiyat"];
$uvpfiyat = $row["uvp"];
$totaluvp = $uvpfiyat - $alfiyat;

 $a = $row["uvp"];
 $b = $totaluvp;
// $b $a nın yüzde kaçıdır;
 $c = $a / 100;

$uvpyuzde = floor($b / $c); 
?>
 <!--1-->

<li>
<form id="sepetForm">

<input name="id" value="<?=$row["id"];?>" type="hidden" />
<input name="urunid" id="<?=$row["id"];?>_urunid" value="<?=$row["id"];?>" type="hidden" />
<input name="satisfiyat" id="<?=$row["id"];?>_satisfiyat" value="<?=$row["satisfiyat"];?>" type="hidden" />

<div class="favYeni">
<input name="marketid" id="<?=$row["id"];?>_marketid" class="css-checkbox" value="<?=$row["id"];?>" type="checkbox" <? $varmi = mysql_num_rows(mysql_query("select * from favori where marketid='".$row["id"]."' and uyeid='".$kisiBul."'"));if ($varmi > 0){ ?>checked<?}?>>
<label for="<?=$row["id"];?>_marketid" class="css-label" onclick="cart('<?=$row["id"];?>')"></label>
</div>

<a href="<?=$kids["self"];?>/<?=urlcevir($row["urunad"]);?>/<?=$row["id"];?>.html">
<?if($row["takip"]==01) {?><div class="yeni">NEU!</div><? }elseif($row["takip"]==02) { ?><div class="yeni">NEU!</div><? } ?>




<? 
//hemtextilien
if($kat["id"]==7 or $kat["id"]==9 or $kat["id"]==10) { ?>

<div class="mobR">
<center><img src="timthumb.php?h=280&src=<?=$ayar["base"];?>img/urun/product_code-<?=$row["urunkod"];?>---<?=$row["kapak"];?>.jpg" alt="<?=$row["urunad"];?>"></center>
</div>


<? }else{ ?>
<? if($row["kid"]==6) {?>
<div class="mobR">
<center><img src="timthumb.php?h=280&src=<?=$ayar["base"];?>img/urun/<?=urlcevir($row["urunad"]);?>-1.jpg" onmousemove="this.src='timthumb.php?h=280&src=<?=$ayar["base"];?>img/urun/<?=urlcevir($row["urunad"]);?>-4.jpg'" onmouseout="this.src='timthumb.php?h=280&src=<?=$ayar["base"];?>img/urun/<?=urlcevir($row["urunad"]);?>-1.jpg'" alt="<?=$row["urunad"];?>"></center>
</div>
<?}else{?>
<div class="mobR">
<center><img src="timthumb.php?h=280&src=<?=$ayar["base"];?>img/urun/<?=urlcevir($row["urunad"]);?>-1.jpg"alt="<?=$row["urunad"];?>"></center>
</div>
<?}?>
<? } ?>


<div class="uListInfo"><? if($kat["id"]==7 or $kat["id"]==9 or $kat["id"]==10) { ?><?=$row["olcu"];?><?}else{?><?=$row["urunkod"];?><?}?></div>
<div class="uListAd"><?=$row["urunad"];?></div>

</a>
<div class="indirim"><?=$uvpyuzde;?>%</div>
<div class="eskiFiyat">UVP <br/><?=paraT($row["uvp"]);?>€</div>
<div class="uListFiyat">
<div><? $metin = paraT($row["indirimlifiyat"]); $kes = explode(".",$metin); echo $kes[0]; ?>.</div>
<div><?=substr($row["indirimlifiyat"], -2);?><br/>€</div>
</div>

<div class="uListAlt">

<? if($stk["stok"] > 0) { ?>
<!--adet-->
<div class="adet-spinner adetArttir non">
<a href="javascript:void(0)" class="minus"><i class="fa fa-minus"></i></a>
<input type="text" name="adet" id="<?=$row["id"];?>_adet" value="1">
<a href="javascript:void(0)" class="plus"><i class="fa fa-plus" onchange="submit()"></i></a>
 </div>
<!--adet-->
<? }else{ ?>
<div class="stkYok non">Nicht Auf Lager</div>
<? } ?>
</div>

<? if($stk["stok"] > 0) { ?>
<a href="javascript:voit(0);" class="sepete-tasi non" onclick="sepetCek('<?=$row["id"];?>')"><i class="fa fa-shopping-cart"></i> </a>
<? } ?>
</form>
</li>

<!--1-->
<? } ?>

</ul>
<?
//sayfalama 
echo '<div class="pag"><ul class="pagination"><li><a href="#" style="color:#c00e0e;">«</a></li>';
echo $kgPagerOBJ -> page_links;
echo '<li><a href="#" style="color:#c00e0e;">»</a></li></ul></div>';
?>

</div>
<!--sag-->


</div>

</div>



<? include("init/foot.php"); ?>
<script src="jquery/owl.carousel.min.js"></script>
<script type="text/javascript" src="jquery/adetSpin.js"></script>
<script type="text/javascript" src="jquery/accordion.js"></script>
<script type="text/javascript">
jQuery(document).ready(function ($) {
$(".adetArttir").adetSpin({inputWidth: 30}).css("border-color", "#ccc");
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
if($(window).width() < 1555){
$("#owl-sec-kat1").owlCarousel({
items : 5,
navigation : true,
autoPlay: 4500,
slideSpeed : 400,
autoplay:false,
autoplayTimeout:5000,
autoplayHoverPause:false
});
} else {
$("#owl-sec-kat1").owlCarousel({
items : 6,
navigation : true,
autoPlay: 4500,
slideSpeed : 400,
autoplay:false,
autoplayTimeout:5000,
autoplayHoverPause:false
});
};
</script>

</body>
</html>