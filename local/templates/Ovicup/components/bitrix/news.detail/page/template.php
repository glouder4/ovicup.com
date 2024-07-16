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


<section  class ="about-text-block">
	<div class ="container">
		<div class="about-wrapper">
		
		
			<div class ="about-left">
				<p class ="about-text">
					<span>
						<?= $arResult["PREVIEW_TEXT"]?>
					</span>
				</p>
				
				
				<p class ="about-text">
					<?= $arResult["DETAIL_TEXT"]?>
				</p>
				
				
			</div>
			
			
			<div class ="about-right">
				<?php foreach ($arResult["PROPERTIES"]['IMAGE']['VALUE'] as $arImage) {?>
					
						<img data-fancybox="gallery2" data-src ="<?=CFile::GetPath($arImage)?>" src="<?=CFile::GetPath($arImage)?>" alt ="about-image">
					
				<?php }?>
			</div>
			
			
		</div>
	 
	</div>
	
</section>

		