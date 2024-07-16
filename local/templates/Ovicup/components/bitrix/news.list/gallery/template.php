<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="photo-gallery-page photo-gallery__cards">

	<?if($arParams["DISPLAY_TOP_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?><br />
	<?endif;?>
	
	<? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
	
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		
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
				<h4 class="photo-gallery-card__title"><?=$arItem["NAME"] ?></h4>
			</div>
		</a>
	
	<? endforeach; ?>

	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>
	
</div>
			