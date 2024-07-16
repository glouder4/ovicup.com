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
<div class="main-tabulation">
	<div class="main-tabulation__content tab-content-js active">
		<table class="tournament">
			<tbody>
				<tr class="tournament__row">
					<th class="tournament__number">М</th>
					<th class="tournament__team">Команда</th>
					<th class="tournament__games">И</th>
					<th class="tournament__wins">В</th>
                                        <th class="tournament__wins">ВО</th>
					<th class="tournament__bullet-win">ВБ</th>
					<th class="tournament__bullet-lose">ПБ</th>
                                        <th class="tournament__lose">ПО</th>
					<th class="tournament__lose">П</th>
					<th class="tournament__scored-pucks">ШЗ</th>
					<th class="tournament__missed-pucks">ШП</th>
					<th class="tournament__total-pucks">+/-</th>
					<th class="tournament__points">О</th>
				</tr>
				
				<?foreach($arResult["ITEMS"] as $arItem){?>
					<tr class="tournament__row">
						<td class="tournament__number"><?= ++$n ?></td>
						<td class="tournament__team tournament-team">
							<div class="tournament-team__logo">
								<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ? $arItem["PREVIEW_PICTURE"]["SRC"] : '/images/logo.png' ?>" alt="team"></a>
							</div>
							<div class="tournament-team__text">
								<div class="tournament-team__name"><a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a></div>
								<div class="tournament-team__city"><?= $arItem['PROPERTIES']['CITY']['VALUE'] ?></div>
							</div>
						</td>
						<td class="tournament__games"><?= $arItem['RESULT_CUP']['GAMES'] ?></td>
						<td class="tournament__bullet-win"><?= $arItem['RESULT_CUP']['V'] ?></td>
                                                <td class="tournament__bullet-win"><?= $arItem['RESULT_CUP']['VO'] ?></td>
						<td class="tournament__bullet-lose"><?= $arItem['RESULT_CUP']['VB'] ?></td>
						<td class="tournament__lose"><?= $arItem['RESULT_CUP']['PB'] ?></td>
                                                <td class="tournament__lose"><?= $arItem['RESULT_CUP']['PO'] ?></td>
						<td class="tournament__scored-pucks"><?= $arItem['RESULT_CUP']['P'] ?></td>
						<td class="tournament__missed-pucks"><?= $arItem['RESULT_CUP']['SCORED'] ?></td>
						<td class="tournament__total-pucks"><?= $arItem['RESULT_CUP']['MISSED'] ?></td>
						<td class="tournament__wins"><?= $arItem['RESULT_CUP']['DIFF'] ?></td>
						<td class="tournament__points"><?= $arItem['RESULT_CUP']['SCORE'] ?></td>
					</tr>
				<?}?>        
				
			</tbody>
		</table>
	</div>
</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
