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


<tr class="tabulation-tour__names tabulation-tour__grid tabulation-tour__grid7">
	<th class="">Матч</th>
	<th class="">Дата</th>
	<th class="">Команда А</th>
	<th class="">Счет</th>
	<th class="">Команда Б</th>
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
			  
			<tr class="tabulation-tour__grid tabulation-tour__grid7">
                <td class="tabulation-tour__place">
                    <? switch ($arItem['PROPERTIES']['STAGE']['VALUE_ENUM']) {
                        case '1/4 Финала':
                            echo '1/4';
                            break;
                        case '1/2 Финала':
                            echo '1/2';
                            break;
                        case 'Финал':
                            echo 'Ф';
                            break;
                        case '1/4 Финала «золотого» плей-офф':
                            echo '1/4';
                            break;
                        case '1/2 Финала «золотого» плей-офф':
                            echo '1/2';
                            break;
                        case '1/4 Финала «серебряного» плей-офф':
                            echo '1/4';
                            break;
                        case '1/2 Финала «серебряного» плей-офф':
                            echo '1/2';
                            break;
                    }?>
                        
                </th>
				<td class="tabulation-tour__matches"><a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= explode(" ", $arItem['PROPERTIES']['DATE']['VALUE'])[0] ?> </a></td>
				<td class="tabulation-tour__team">
					<div class="tabulation-tour-team__img">
						<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><img src="<?= $arItem['DATA']['TEAM1']['IMG'] ? $arItem['DATA']['TEAM1']['IMG'] : '/images/logo.png' ?>" alt="team"></a>
					</div>
					<div class="tabulation-tour-team__right">
						<p class="tabulation-tour-team__team"><a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['DATA']['TEAM1']['NAME'] ?></a></p>
						<p class="tabulation-tour-team__city"><?= $itemPropTeam1["CITY"]['VALUE'] ?></p>
					</div>
				</td>
				<td class="tabulation-tour__pucks"><a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= str_replace(':', ' : ', $arItem['DATA']['RESULT']['TOTAL']) ?></a></td>
				<td class="tabulation-tour__team">
					<div class="tabulation-tour-team__img">
						<a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><img src="<?= $arItem['DATA']['TEAM2']['IMG'] ? $arItem['DATA']['TEAM2']['IMG'] : '/images/logo.png' ?>" alt="team"></a>
					</div>
					<div class="tabulation-tour-team__right">
						<p class="tabulation-tour-team__team"><a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['DATA']['TEAM2']['NAME'] ?></a></p>
						<p class="tabulation-tour-team__city"><?= $itemPropTeam2["CITY"]['VALUE'] ?></p>
					</div>
				</td>
			</tr>
			
		<?endforeach;?>