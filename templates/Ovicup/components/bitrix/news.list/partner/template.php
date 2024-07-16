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


<section class="partners">

	<div class="swiper partners-slider">
		<div class="swiper-wrapper">
			
			<?foreach($arResult["ITEMS"] as $arItem):?>
			
				<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
					<a <?=$arItem["CODE"] ? 'href="'.$arItem["CODE"].'"' : ''?> class="swiper-slide swiper-slide-partners">
						<div class="swiper-slide__wrapper">
							<img class="partner__img" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="partner">
							<div class="partner__text"><?=$arItem["NAME"]?></div>
						</div>
					</a>
				
				<?endif?>
			
			<?endforeach;?>
			
		</div>
	</div>
	<div class="partners-prev">
		<svg width="12" height="24" viewBox="0 0 12 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M10.4713 24L12 22.2482L2.98088 12L12 1.75183L10.4713 2.6728e-07L-1.18021e-06 12L10.4713 24Z"
				fill="#888E9B"/>
		</svg>
	</div>
	<div class="partners-next">
		<svg width="12" height="24" viewBox="0 0 12 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M1.52866 24L1.72293e-07 22.2482L9.01912 12L2.18812e-06 1.75183L1.52866 2.6728e-07L12 12L1.52866 24Z"
				fill="#888E9B"/>
		</svg>
	</div>

</section>