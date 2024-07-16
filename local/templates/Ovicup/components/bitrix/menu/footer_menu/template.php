<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<div class="footer__links">
<?
foreach($arResult as $arItem):?>
	
	<a class="footer__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>

<?endforeach?>

</div>

<?endif?>

