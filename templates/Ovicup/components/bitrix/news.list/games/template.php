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

<div class="pages__tab-row">
	<div class="tab-tour__tabs tab-card__tabs">
	
	<? //стадии ?>
	<? foreach ($arResult['CUP'][$GLOBALS['gamesFilter']['PROPERTY_CUP']]['GROUP'] as  $GROUP) { ?>  
		<div class="tab-tour-tab tab-card-tab cup-<?=$key?> tab-card-js <?= ($GROUP['ID'] == $GLOBALS['gamesFilter']['PROPERTY_GROUP']) ? "active" : "" ?> "><a href="?cup=<?= $GLOBALS['gamesFilter']['PROPERTY_CUP'] ?>&group=<?= $GROUP['ID'] ?>" ><?= $GROUP["NAME"] ?></a></div>
	<? } ?>
	<div class="tab-tour-tab tab-card-tab tab-card-js <?= ($_REQUEST['stage'] == 'pf') ? "active" : "" ?> "><a href="?cup=<?= $GLOBALS['gamesFilter']['PROPERTY_CUP'] ?>&stage=pf" >Плэй-офф</a></div>



	</div>
	
	
	<div class ="tourney-list-wrapper calendar-list">
		<div class = "tab-card-tab tab-tourneys">
			<?foreach($arResult['CUP'] as $CUP) { ?>
				<?php if ($CUP['ID'] == $GLOBALS['gamesFilter']['PROPERTY_CUP']) { ?>
				<p><span class ="tab-card-tab__textcontent"><?= $CUP["NAME"] ?></span>
					<svg width="15" height="8" viewBox="0 0 15 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0.207031 1.39172L1.22893 0.5L7.20703 5.76115L13.1851 0.5L14.207 1.39172L7.20703 7.5L0.207031 1.39172Z" fill="white"/>
					</svg>
				</p>
				<?php } ?>
			<? } ?>
		</div>
		
		<div class ="ajax-list" id="cup">  
			<? //турниры?>
			<?foreach($arResult['CUP'] as $key=> $CUP) { ?>
				<a value="<?= $CUP['ID'] ?>" <?= ($CUP['ID'] == $GLOBALS['gamesFilter']['PROPERTY_CUP']) ? "selected" : "" ?> href="?cup=<?= $CUP['ID'] ?>" ><?= $CUP["NAME"] ?></a>
			<? } ?>

			<script>
				BX.bind(BX('cup'), 'change', function () {
					location.href = '?cup=' + this.options[this.selectedIndex].value;
				});
			</script>
		</div>    
	</div>

	
	
</div>




<div class="tab-content-js  active">
	<div class ="main-tabulation">
	
	<?if($arParams["DISPLAY_TOP_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?><br />
	<?endif;?>

		<table class="calendar <?if (!$_REQUEST['stage'] == 'pf') { ?>calendar-cup<?}?>">
			<tbody>
			<tr class="calendar__row ">
				<?if ($_REQUEST['stage'] == 'pf') { ?>
					<th class="calendar__number">Матч</th>
				<?}?>
				<th class="calendar__date">Дата, время</th>
				<th class="calendar__team calendar-team">Команда А</th>
				<th class="calendar__score">Счет</th>
				<th class="calendar__team calendar-team">Команда Б</th>
				<th class="calendar__place">Арена</th>
			</tr>
		
		<?foreach($arResult["ITEMS"] as $arItem):?>
		
		<?php
			$itemPropTeam1 = array();
			$res = CIBlockElement::GetProperty(1, $arItem['DATA']['TEAM1']['ID'] , "sort", "asc", array());
			while ($ob = $res->GetNext())
			{
				$itemPropTeam1[$ob['CODE']]['VALUE'] = $ob['VALUE'];
				$itemPropTeam1[$ob['CODE']]["VALUE_ENUM"] = $ob['VALUE_ENUM'];
			}
			
			$itemPropTeam2 = array();
			$res = CIBlockElement::GetProperty(1, $arItem['DATA']['TEAM2']['ID'] , "sort", "asc", array());
			while ($ob = $res->GetNext())
			{
				$itemPropTeam2[$ob['CODE']]['VALUE'] = $ob['VALUE'];
				$itemPropTeam2[$ob['CODE']]["VALUE_ENUM"] = $ob['VALUE_ENUM'];
			}

		?>
			  
			<tr class="calendar__row">
				<?if ($_REQUEST['stage'] == 'pf') { ?>
					<th class="calendar__number"><?= $arItem['PROPERTIES']['STAGE']['VALUE_ENUM'] ?></th>
				<?}?>
				
				<?php $time = explode(" ", $arItem["PROPERTIES"]["DATE"]["VALUE"])[1];?>
				<td class="calendar__date"><a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= explode(" ", $arItem["PROPERTIES"]["DATE"]["VALUE"])[0] . ' ' . explode(":", $time)[0] . ":" . explode(":", $time)[1] ?> МСК</a></td>
				<td class="calendar__team calendar-team">
					<div class="calendar-team__logo">
						<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><img src="<?= $arItem['DATA']['TEAM1']['IMG'] ? $arItem['DATA']['TEAM1']['IMG'] : '/images/logo.png' ?>" alt="team"></a>
					</div>
					<div class="calendar-team__right">
						<div class="calendar-team__name"><a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['DATA']['TEAM1']['NAME'] ?></a></div>
						<div class="calendar-team__city"><?= $itemPropTeam1["CITY"]['VALUE'] ?></div>
					</div>
				</td>
				<td class="calendar__score">
                                    <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                                        <?= str_replace(':', ' : ', $arItem['DATA']['RESULT']['TOTAL']) ?>
                                        <?if ($arItem['DATA']['RESULT']['B']) {?>
                                            Б
                                        <?} else if ($arItem['DATA']['RESULT']['OT']) {?>
                                            ОТ
                                        <?}?>
                                    </a>
                                </td>
				<td class="calendar__team calendar-team">
					<div class="calendar-team__logo">
						<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><img src="<?= $arItem['DATA']['TEAM2']['IMG'] ? $arItem['DATA']['TEAM2']['IMG'] : '/images/logo.png' ?>" alt="team"></a>
					</div>
					<div class="calendar-team__right">
						<div class="calendar-team__name"><a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['DATA']['TEAM2']['NAME'] ?></a></div>
						<div class="calendar-team__city"><?= $itemPropTeam2["CITY"]['VALUE'] ?></div>
					</div>
				</td>
				<td class="calendar__place">
					<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['PROPERTIES']['ARENA']['VALUE_ENUM'] ?></a>
				</td>
			</tr>
			
		<?endforeach;?>
			
			</tbody>
		</table>
		
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>

	</div>
</div>