<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?php
	$months_array = array(
    "01" => "января",
    "02" => "февраля",
	"03" => "марта",
	"04" => "апреля",
	"05" => "мая",
	"06" => "июня",
	"07" => "июля",
	"08" => "августа",
	"09" => "сентября",
	"10" => "октября",
	"11" => "ноября",
	"12" => "декабря"
);
?>


<div class="translation">
<?php if ($arResult["PROPERTIES"]["DATE_VIDEO"]["VALUE"]) {
	$input = $arResult["PROPERTIES"]["DATE_VIDEO"]["VALUE"];
	$date = DateTime::createFromFormat('d.m.Y', $input); ?>
	<p class="translation__date"><?=$date->format('d') . ' ' . $months_array[$date->format('m')] . ' ' . $date->format('Y') ?></p>
<?php } ?>

	<div class="translation__video" >
		<center>			
			<iframe src='<?= ($arResult["PROPERTIES"]["GALLERY_VIDEO"]["FILE_VALUE"]["SRC"]) ? $arResult["PROPERTIES"]["GALLERY_VIDEO"]["FILE_VALUE"]["SRC"] : link_youtube($arResult["PROPERTIES"]["VIDEO_LINK"]["VALUE"]) ?>' width="1300px" height="900px" frameBorder="0" allow="clipboard-write; autoplay" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
		</center>
	</div>
	
    <div class="translation-social">
		<script src="https://yastatic.net/share2/share.js"></script>
		<div class="ya-share2" data-curtain data-size="l" data-services="vkontakte,odnoklassniki,telegram,whatsapp"></div>
	</div>

</div>