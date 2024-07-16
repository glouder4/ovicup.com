<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<div class="museum">

	<?if($arParams["DISPLAY_TOP_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?><br />
	<?endif;?>
	
	<?php 
		$i = 0;
	?>

	<? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
	
	<?php if ( ($i%6) == 0): ?>
		<div class="museum-row">
	<?php endif; ?>

			<div class="museum-card">
				<div class="museum-card__image">
					<a href='<?= $arItem["DETAIL_PAGE_URL"] ?>'><img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="picture"></a>
				</div>
				<h4 class="museum-card__title"><a href='<?= $arItem["DETAIL_PAGE_URL"] ?>'><?=$arItem["NAME"] ?></a></h4>
			</div>
			
	<?php if ( !$arResult["ITEMS"][$key+1] || (($i+1)%6 == 0) ): ?>
		</div>
	<?php endif; ?>
	
	<?php $i++; ?>
	
	<? endforeach; ?>
	
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>

	
</div>

			