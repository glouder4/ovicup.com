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


<section class="translations main__section translations-page">
	
	<div class="translations__cards">
	
	<?if($arParams["DISPLAY_TOP_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?><br />
	<?endif;?>
	
	<?foreach($arResult["ITEMS"] as $arItem):?>

		<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="translations-card" >
			<div class="translations-card__img">
				<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"] ? $arItem["PREVIEW_PICTURE"]["SRC"] : (( (strpos($arItem["PROPERTIES"]["VIDEO_LINK"]["VALUE"], "www.youtube.com") !== false) && $arItem["PROPERTIES"]["VIDEO_LINK"]["VALUE"]) ? 'https://i.ytimg.com/vi/' . explode("www.youtube.com/embed/", $arItem["PROPERTIES"]["VIDEO_LINK"]["VALUE"])[1] . '/maxresdefault.jpg' : '/images/logo.png') ?>" alt="translation">
			</div>
			<div class="translations-card__bottom">
				<?php if ($arItem["PROPERTIES"]["DATE_VIDEO"]["VALUE"]) {
					$input = $arItem["PROPERTIES"]["DATE_VIDEO"]["VALUE"];
					$date = DateTime::createFromFormat('d.m.Y', $input); ?>
					<p class="translations-card__date"><?=$date->format('d') . ' ' . $months_array[$date->format('m')] . ' ' . $date->format('Y') ?></p>
				<?php } ?>
				<h4 class="translations-card__title"><?=$arItem["NAME"]?>
				</h4>
			</div>
			<div class="news-card__bottom">
				<?php if ($arItem["PROPERTIES"]["DATE_VIDEO"]["VALUE"]) {
					$input = $arItem["PROPERTIES"]["DATE_VIDEO"]["VALUE"];
					$date = DateTime::createFromFormat('d.m.Y', $input); ?>
					<p class="news-card__date"><?=$date->format('d') . ' ' . $months_array[$date->format('m')] . ' ' . $date->format('Y') ?></p>
				<?php } ?>
				<h4 class="news-card__title"><?=$arItem["NAME"]?>
				</h4>
			</div>
		</a>
		
	<?endforeach;?>
		
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>
		
	</div>
</section>




