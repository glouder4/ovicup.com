<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="header-bottom__row">
	<a href="/" class="header-bottom__logo">
		<img src="/images/logo.png" alt="logo">
	</a>


<?if (!empty($arResult)):?>


<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<a class="header-bottom__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>

		<?else:?>
			<a class="header-bottom__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
				
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<a class="header-bottom__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
			<?else:?>
				<a class="header-bottom__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<a class="header-bottom__link" href="" ><?=$arItem["TEXT"]?></a>
			<?else:?>
				<a class="header-bottom__link" href=""><?=$arItem["TEXT"]?></a>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("", ($previousLevel-1) );?>
<?endif?>


<?endif?>

</div>