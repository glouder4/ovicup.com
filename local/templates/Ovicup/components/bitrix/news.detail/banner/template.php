<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
//$this->setFrameMode(true);
?>

<!-- <div class="main--gray"> -->

	<section class="banner" style="background: url(<?=$arResult["DETAIL_PICTURE"]["SRC"]?>) no-repeat center;">
		<div class="container">
			<div class="banner__row">
				<div class="banner__left"></div>
				<div class="banner__right">
					<h1 class="banner__title"><?= ($arResult["PROPERTIES"]["IMAGE_HEADER"]["VALUE"]) ? htmlspecialchars_decode($arResult["PROPERTIES"]["IMAGE_HEADER"]["VALUE"]["TEXT"]) : ''?></h1>
					<p class="banner__text"><?= ($arResult["PROPERTIES"]["IMAGE_TEXT"]["VALUE"]) ? htmlspecialchars_decode($arResult["PROPERTIES"]["IMAGE_TEXT"]["VALUE"]["TEXT"]) : ''?></p>
					
					<?php if ($arResult["PROPERTIES"]["IMAGE_LINK"]["VALUE"]) :?>
						<a href="<?=$arResult["PROPERTIES"]["IMAGE_LINK"]["VALUE"]?>" class="banner-button red-button">
							<?=$arResult["PROPERTIES"]["IMAGE_LINK_TEXT"]["VALUE"]?>
						</a>
					<?php endif; ?>
					
					
					 
					<br>
					<?php //if ( explode("?", $_SERVER["REQUEST_URI"])[0] == '/' ): ?>
						<!--<a href="/forma-zakaza/" class="banner-button red-button">
							Заказать билеты
						</a>-->
					<?php //endif; ?>
					

				</div>
			</div>
		</div>
	</section>
	
<!--</div>	-->
		