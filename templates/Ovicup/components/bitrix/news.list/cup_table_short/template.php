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

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
        
		
		
<?php
/*foreach($arResult["ITEMS"] as $arItem){ 
	echo $arItem['NAME'];
    var_dump($arItem['RESULT_CUP']);
    echo '<br>';
}*/
?>        
     
<?php 
	$n = 0;
?>


<tr class="tabulation-tour__names tabulation-tour__grid">
	<th>М</th>
	<th>Команда</th>
	<th>И</th>
	<th>Ш</th>
	<th>О</th>
</tr>

<?foreach($arResult["ITEMS"] as $arItem){?>
	<tr class="tabulation-tour__grid">
		<td class="tabulation-tour__place"><?= ++$n ?></td>
		<td class="tabulation-tour__team">
		<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="tabulation-tour-team">
			<div class="tabulation-tour-team__img">
				<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ? $arItem["PREVIEW_PICTURE"]["SRC"] : '/images/logo.png' ?>" alt="team">
			</div>
			<div class="tabulation-tour-team__right">
				<p class="tabulation-tour-team__team"><?= $arItem['NAME'] ?></p>
				<p class="tabulation-tour-team__city"><?= $arItem['PROPERTIES']['CITY']['VALUE'] ?></p>
			</div>
		</a>
		</td>
		<td class="tabulation-tour__matches"><?= $arItem['RESULT_CUP']['GAMES'] ?></td>
		<td class="tabulation-tour__pucks"><?= $arItem['RESULT_CUP']['SCORED'] ? $arItem['RESULT_CUP']['SCORED'] : '0' ?> : <?= $arItem['RESULT_CUP']['MISSED'] ? $arItem['RESULT_CUP']['MISSED'] : '0' ?></td>
		<td class="tabulation-tour__points"><?= $arItem['RESULT_CUP']['SCORE'] ?></td>
	</tr>
<?}?>       

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
