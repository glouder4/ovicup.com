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


<section class="photo-gallery main__section">
	<div class="title__head">
		<h2 class="photo-gallery__title title">Фотогалерея</h2>
		<a class="photo-gallery link link--right" href="/press-center/gallery/">Все фото</a>
	</div>
	
	
	<div class="photo-gallery__cards">
	
	<?foreach($arResult["ITEMS"] as $arItem):?>

		<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="photo-gallery-card">
			<div class="photo-gallery__top">
				<span></span>
				<span></span>
			</div>
			<div class="photo-gallery-card__img">
				<img src="<?=CFile::GetPath($arItem["PROPERTIES"]["GALLERY_IMAGE"]["VALUE"][0])?>" alt="photo">
			</div>
			<div class="photo-gallery-card__bottom">
				<p class="photo-gallery-card__amount"><?= count($arItem["PROPERTIES"]["GALLERY_IMAGE"]["VALUE"]) ?> фото</p>
				<h4 class="photo-gallery-card__title"><?= $arItem["NAME"]?></h4>
			</div>
		</a>
		
	<?endforeach;?>

	</div>
	
</section>