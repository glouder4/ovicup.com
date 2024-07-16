<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>


<section class="news news--main news-page">
	
	<?if($arParams["DISPLAY_TOP_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?><br />
	<?endif;?>
	
	<? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		
		<?php  if ( $key%4 == 0 ):?>
			<div class="news__row">
		<?php endif; ?>
		
			<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="news-card">
				<img class="news-card__img" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="news">
				<div class="news-card__bottom">
					<p class="news-card__date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></p>
					<h4 class="news-card__title"><?=$arItem["NAME"] ?></h4>
					<div class="news-card__button button">Подробнее
					</div>
				</div>

			</a>
		
		<?php  if ($arResult["ITEMS"][$key+1]):?>
			<?php  if (($key+1)%4 == 0) :?>
				</div>
			<?php endif; ?>
		<?php else: ?>
			</div>
		<?php endif; ?>
		
		
	<? endforeach; ?>
	
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>
	
</section>
			