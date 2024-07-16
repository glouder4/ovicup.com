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
$themeClass = isset($arParams['TEMPLATE_THEME']) ? ' bx-'.$arParams['TEMPLATE_THEME'] : '';
CUtil::InitJSCore(['fx', 'ui.fonts.opensans']);
?>



<?php 
	$input = $arResult["DISPLAY_PROPERTIES"]["DATE_BIRTH"]["VALUE"];
	$date = DateTime::createFromFormat('d.m.Y', $input); 
?>


<?php 
	//задаем переменные
	if($date) {
	$month = $date->format('m'); //месяц от 1 до 12
	$day = $date->format('d'); //день от 1 до 31
	$year = $date->format('Y'); //год
	$hour = 0; //час от 0 до 23
	$minute = 0; //минуты от 0 до 59
	$second = 0; //секунды от 0 до 59
	}
	//часы, минуты и секунды указывать не обязательно, 
	//поэтому у меня они равны 0, 0, 0 - что соответстует 12 часам ночи ровно
	//(если, конечно, вам не нужна переделяная точность до часа, минуты, секунды)
	 
	//формируем unix-число нужной даты на основе заданных выше переменных
	$get_past_time = mktime($hour, $minute, $second, $month, $day, $year);
	 
	//получаем unix-число текущей даты
	$get_current_time = time();
	 
	//выполняем математику: вычитаем из $get_current_time число $get_past_time 
	//и перегоняем полученный результат в секундах в годы
	//(1 минута = 60 секунд, 1 час = 60 минут, 1 сутки = 24 часа, 1 год = 365 дней)
	//на основе этого получается, что секунды нужно делить на 60*60*24*365
	$math_years = ($get_current_time - $get_past_time)/(60*60*24*365);
	 
	//получаенное не целое число лет округляем в меньшую сторону,
	//так как нам нужно знать полное количество лет
	$final_years = floor($math_years);
	 
	//все, количество лет с отпределенной даты получено
	//и находится в переменной $final_years - можно выводить
	//echo "Прошло уже более ".(int)$final_years." лет.";
        
        //клуб игрока
        //$arResult['CLUB'] - ['ID'],['NAME'],['PROPERTY_CUP_VALUE'],['IMG'] IMG - ссылка на эиюлнему клуба 

?> 
				

<div class="player">
	<div class="player-card">
		<div class="player-card-left">
			<div class="player-card-left__photo">
				<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"] ? $arResult["DETAIL_PICTURE"]["SRC"] : '/images/logo.png' ?>" alt="team">
			</div>
			<div class="player-card-left__text">
				<p class="player-card-left__name">
					<?= $arResult["NAME"] ?>
				</p>
				<p class="player-card-left__position">
					<span><?= $arResult["DISPLAY_PROPERTIES"]["ROLE"]["VALUE"]?> </span><span><?= $arResult["DISPLAY_PROPERTIES"]["NUMBER"]["VALUE"] ? '№' . $arResult["DISPLAY_PROPERTIES"]["NUMBER"]["VALUE"] : ''?></span>
				</p>
			</div>
		</div>
      
		<div class="player-card-center">
		<?php if ($arResult['CLUB']['NAME']) : ?>
			<div class="player-card__column">
				<p class="player-card__title">Клуб</p>
				<p class="player-card__text"><?= $arResult['DISPLAY_PROPERTIES']['TEAM']['DISPLAY_VALUE'] ?></p>
			</div>
		<?php endif; ?>
		<?php if ($arResult["DISPLAY_PROPERTIES"]["DATE_BIRTH"]["VALUE"]) : ?>
			<div class="player-card__column">
				<p class="player-card__title">Дата рождения</p>
				<p class="player-card__text"><?= $arResult["DISPLAY_PROPERTIES"]["DATE_BIRTH"]["VALUE"]?></p>
			</div>
		<?php endif; ?>
		<?php if ((int)$final_years) : ?>
			<div class="player-card__column">
				<p class="player-card__title">Возраст</p>
				<p class="player-card__text"><?= (int)$final_years ?> лет</p>
			</div>
		<?php endif; ?>
		</div>
		<div class="player-card-right">
		<?php if ($arResult["DISPLAY_PROPERTIES"]["GRIP"]["VALUE"]) : ?>
			<div class="player-card__column">
				<p class="player-card__title">Хват</p>
				<p class="player-card__text"><?= $arResult["DISPLAY_PROPERTIES"]["GRIP"]["VALUE"]?></p>
			</div>
		<?php endif; ?>
		<?php if ($arResult["DISPLAY_PROPERTIES"]["HEIGHT"]["VALUE"]) : ?>
			<div class="player-card__column">
				<p class="player-card__title">Рост</p>
				<p class="player-card__text"><?= $arResult["DISPLAY_PROPERTIES"]["HEIGHT"]["VALUE"]?></p>
			</div>
		<?php endif; ?>
		<?php if ($arResult["DISPLAY_PROPERTIES"]["WEIGHT"]["VALUE"]) : ?>
			<div class="player-card__column">
				<p class="player-card__title">Вес</p>
				<p class="player-card__text"><?= $arResult["DISPLAY_PROPERTIES"]["WEIGHT"]["VALUE"]?></p>
			</div>
		<?php endif; ?>
		</div>
	</div>
</div>	



<?php //echo "<pre>"; print_r($arResult['STATS']); echo "</pre>";?>

<div class="glossary-row single-player-row">
	<h1 class="title-page">Статистика — полевой игрок</h1>
	<div class="glossary-row__button">
		<div class="glossary-row__icon">
			<svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M8.82353 9.91177C8.49866 9.91177 8.23529 10.1751 8.23529 10.5C8.23529 10.8249 8.49866 11.0882 8.82353 11.0882H9.41177V14.6176H8.82353C8.49866 14.6176 8.23529 14.881 8.23529 15.2059C8.23529 15.5308 8.49866 15.7941 8.82353 15.7941H11.1765C11.5013 15.7941 11.7647 15.5308 11.7647 15.2059C11.7647 14.881 11.5013 14.6176 11.1765 14.6176H10.5882V10.5C10.5882 10.1751 10.3249 9.91177 10 9.91177H8.82353Z" fill="#888E9B"/>
				<path d="M11.1765 6.97059C11.1765 7.62034 10.6497 8.14706 10 8.14706C9.35025 8.14706 8.82353 7.62034 8.82353 6.97059C8.82353 6.32084 9.35025 5.79412 10 5.79412C10.6497 5.79412 11.1765 6.32084 11.1765 6.97059Z" fill="#888E9B"/>
				<path fill-rule="evenodd" clip-rule="evenodd" d="M10 0.5C4.47715 0.5 0 4.97715 0 10.5C0 16.0228 4.47715 20.5 10 20.5C15.5228 20.5 20 16.0228 20 10.5C20 4.97715 15.5228 0.5 10 0.5ZM1.17647 10.5C1.17647 5.6269 5.1269 1.67647 10 1.67647C14.8731 1.67647 18.8235 5.6269 18.8235 10.5C18.8235 15.3731 14.8731 19.3235 10 19.3235C5.1269 19.3235 1.17647 15.3731 1.17647 10.5Z" fill="#888E9B"/>
			</svg>
		</div>
		<div class="glossary-row-button__text">Глоссарий</div>
	</div>
</div>
<div class="glossary">
	<div class="glossary-columns">
		<div class="glossary-column">
			<p class="glossary__row">
				<span>И —</span>кол-во проведённых игр
			</p>
		</div>
		<div class="glossary-column">
			<p class="glossary__row">
				<span>О —</span>кол-во очков в турнире
			</p>
		</div>
		<div class="glossary-column">
			<p class="glossary__row">
				<span>Ш —</span>кол-во забитых шайб
			</p>
		</div>
		<div class="glossary-column">
			<p class="glossary__row">
				<span>П —</span>кол-во поражений
			</p>
		</div>
	</div>
</div>
<div class ="players-tabulation main-tabulation player-tab-1">
	<div class = "tabulation-wrapper">
		<table class = "table-professionals table-player">
			<tr class ="table-info-row">
				<td class ="click-to-sort">
					Команда 
				</td>
				<td>
					Амплуа
				</td>
				<td>
					И
				</td>
				<td>
					О
				</td>
				<td>
					О Ср
				</td>
				<td>
					Ш
				</td>
				<td>
					П
				</td>
			</tr>
		   
		</table>
		<?php
			$club_item = array();
			$res = CIBlockElement::GetProperty(1, $arResult['CLUB']['ID'] , "sort", "asc", array());

			while ($ob = $res->GetNext())
			{
				//$club_item[] = $ob;
				$club_item[$ob['CODE']]['VALUE'] = $ob['VALUE'];
				$club_item[$ob['CODE']]["VALUE_ENUM"] = $ob['VALUE_ENUM'];
			}
			
			
			$resClub = CIBlockElement::GetByID($arResult['CLUB']['ID']);
			$club_el = $resClub->GetNext();
	
		?>
		<table class ="table-player-bottom">
			<tr class ="table-professionals-player player-row">
				<td class ="professional-portrait team">
					<a href="<?= $club_el['DETAIL_PAGE_URL'] ?>">
						<img src = "<?= $arResult['CLUB']['IMG'] ? $arResult['CLUB']['IMG'] : '/images/logo.png'?>" alt ="player">
					</a>
					<div class ="team-info">
						<p class ="team-name"><?= $arResult['CLUB']['NAME'] ?></p>
						<p class ="team-city"><?= $club_item['CITY']['VALUE'] ?></p>
					</div>
				</td>
				<td><?= $arResult["DISPLAY_PROPERTIES"]["ROLE"]["VALUE"]?></td>
				<td><?= ($arResult['STATS']["GAMES_TOTAL"]>0)?$arResult['STATS']["GAMES_TOTAL"]:0?></td>
				<td><?= $arResult['STATS']["SCORED"] + $arResult['STATS']["ASSISTANT"] + $arResult['STATS']["ASSISTANT2"]?></td>
				<td><?= ($arResult['STATS']["SCORED"]>0)?number_format($arResult['STATS']["GAMES_TOTAL"] / $arResult['STATS']["SCORED"], 2, ',', ''):0  ?></td>
				<td><?= ($arResult['STATS']["SCORED"]>0)?$arResult['STATS']["SCORED"]:0?></td>
				<td><?= $arResult['STATS']["ASSISTANT"] + $arResult['STATS']["ASSISTANT2"]?> </td>
			</tr>
		</table>
	</div>
</div>

<?php if ($arResult['STATS']["GAMES"]) :?>
<div class="glossary-row single-player-row-2">
	<h1 class="title-page">Статистика матчей — полевой игрок</h1>
	<div class="glossary-row__button">
		<div class="glossary-row__icon">
			<svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M8.82353 9.91177C8.49866 9.91177 8.23529 10.1751 8.23529 10.5C8.23529 10.8249 8.49866 11.0882 8.82353 11.0882H9.41177V14.6176H8.82353C8.49866 14.6176 8.23529 14.881 8.23529 15.2059C8.23529 15.5308 8.49866 15.7941 8.82353 15.7941H11.1765C11.5013 15.7941 11.7647 15.5308 11.7647 15.2059C11.7647 14.881 11.5013 14.6176 11.1765 14.6176H10.5882V10.5C10.5882 10.1751 10.3249 9.91177 10 9.91177H8.82353Z" fill="#888E9B"/>
				<path d="M11.1765 6.97059C11.1765 7.62034 10.6497 8.14706 10 8.14706C9.35025 8.14706 8.82353 7.62034 8.82353 6.97059C8.82353 6.32084 9.35025 5.79412 10 5.79412C10.6497 5.79412 11.1765 6.32084 11.1765 6.97059Z" fill="#888E9B"/>
				<path fill-rule="evenodd" clip-rule="evenodd" d="M10 0.5C4.47715 0.5 0 4.97715 0 10.5C0 16.0228 4.47715 20.5 10 20.5C15.5228 20.5 20 16.0228 20 10.5C20 4.97715 15.5228 0.5 10 0.5ZM1.17647 10.5C1.17647 5.6269 5.1269 1.67647 10 1.67647C14.8731 1.67647 18.8235 5.6269 18.8235 10.5C18.8235 15.3731 14.8731 19.3235 10 19.3235C5.1269 19.3235 1.17647 15.3731 1.17647 10.5Z" fill="#888E9B"/>
			</svg>
		</div>
		<div class="glossary-row-button__text">Глоссарий</div>
	</div>
</div>
<div class="glossary">
	<div class="glossary-columns">
		<div class="glossary-column">
			<p class="glossary__row">
				<span>Ш —</span>кол-во забитых шайб
			</p>
		</div>
		<div class="glossary-column">
			<p class="glossary__row">
				<span>П —</span>кол-во поражений
			</p>
		</div>
		<div class="glossary-column">
			<p class="glossary__row">
				<span>О —</span>кол-во очков в турнире
			</p>
		</div>
	</div>
</div>
<div class ="players-tabulation main-tabulation">
	<div class = "tabulation-wrapper">
		<table class = "table-professionals table-player-second">
			<tr class ="table-info-row second-row">
				<td >
					Дата
				</td>
				<td>
					Команда А
				</td>
				<td>
					Счет
				</td>
				<td>
					Команда Б
				</td>
				<td>
					Ш
				</td>
				<td>
				   П 
				</td>
				<td>
				   О
				</td>
			</tr>
		   
		</table>
		<table class ="table-player-bottom player-bottom-second">
		
		<?foreach($arResult['STATS']["GAMES"] as $key=>$arItem):?>
			<?php 
				$itemProp = array();
				$res = CIBlockElement::GetProperty(10, $key, "sort", "asc", array());

				while ($ob = $res->GetNext())
				{
					//$itemProp[] = $ob;
					$itemProp[$ob['CODE']]['VALUE'] = $ob['VALUE'];
					$itemProp[$ob['CODE']]["VALUE_ENUM"] = $ob['VALUE_ENUM'];
				}
				//var_dump($itemProp);
			?>
			
			<?php
			
				$resGame = CIBlockElement::GetByID($key);
				$game_el = $resGame->GetNext();
			
			
				$resTeam1 = CIBlockElement::GetByID($itemProp['TEAM1']["VALUE"]);
				$team1 = $resTeam1->GetNext();
				
				$itemPropTeam1 = array();
				$res = CIBlockElement::GetProperty(1, $itemProp['TEAM1']["VALUE"], "sort", "asc", array());
				while ($ob = $res->GetNext())
				{
					//$itemPropTeam1[] = $ob;
					$itemPropTeam1[$ob['CODE']]['VALUE'] = $ob['VALUE'];
					$itemPropTeam1[$ob['CODE']]["VALUE_ENUM"] = $ob['VALUE_ENUM'];
				}
				
				
				$resTeam2 = CIBlockElement::GetByID($itemProp['TEAM2']["VALUE"]);
				$team2 = $resTeam2->GetNext();
				
				$itemPropTeam2 = array();
				$res = CIBlockElement::GetProperty(1, $itemProp['TEAM2']["VALUE"], "sort", "asc", array());
				while ($ob = $res->GetNext())
				{
					//$itemPropTeam2[] = $ob;
					$itemPropTeam2[$ob['CODE']]['VALUE'] = $ob['VALUE'];
					$itemPropTeam2[$ob['CODE']]["VALUE_ENUM"] = $ob['VALUE_ENUM'];
				}
			?>

				
			<tr class ="table-professionals-player player-row-second">
				
				<td>
					<a href='<?= $game_el['DETAIL_PAGE_URL']?>'>
						<?= explode(" ", $itemProp["DATE"]["VALUE"])[0] ?>
					</a>
				</td>
				<td class ="professional-portrait team">
					<a href='<?= $game_el['DETAIL_PAGE_URL']?>'><img src = "<?= CFile::GetPath($team1["PREVIEW_PICTURE"]) ? CFile::GetPath($team1["PREVIEW_PICTURE"]) : '/images/logo.png' ?>" alt ="player"></a>
					<a href='<?= $game_el['DETAIL_PAGE_URL']?>'>
						<div class ="team-info">
							<p class ="team-name"><?= $team1['NAME']?></p>
							<p class ="team-city"><?= $itemPropTeam1["CITY"]["VALUE"]?></p>
						</div>
					</a>
				</td>
				<td>
					<a href='<?= $game_el['DETAIL_PAGE_URL']?>'>
					<!-- <p style="color:red">LIVE</p> -->
                                            <?$dateM = new DateTime();
                                            if($dateM->format('d.m.Y H:i:s') >= $itemProp['DATE']['VALUE'] && $itemProp['GAME_OVER']['VALUE_ENUM']!="Да") {?>
                                                <div class ="live">
																		<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 122.88 69.01" style="enable-background:new 0 0 122.88 69.01" xml:space="preserve"><style type="text/css"><![CDATA[
																	.st0{fill-rule:evenodd;clip-rule:evenodd;fill:#E74040;}
																	.st1{fill:#242424;}
																]]></style><g><path class="st0" d="M6.78,9.11H91.9c-0.15,0.81-0.25,1.65-0.3,2.49c-0.27,5.16,1.57,9.95,4.77,13.51 c3.06,3.4,7.37,5.69,12.26,6.12c0.34,0.05,0.69,0.08,1.05,0.08V31.3c0.73,0.02,1.45,0.01,2.16-0.05v30.98 c0,3.72-3.06,6.78-6.78,6.78H6.78C3.06,69.01,0,65.96,0,62.23V15.88C0,12.16,3.05,9.11,6.78,9.11L6.78,9.11L6.78,9.11z M110.97,0.02c6.94,0.37,12.26,6.29,11.89,13.23c-0.37,6.94-6.29,12.26-13.23,11.89c-6.94-0.37-12.26-6.29-11.89-13.23 C98.11,4.98,104.03-0.35,110.97,0.02L110.97,0.02z M110.71,4.71c2.18,0.12,4.1,1.1,5.45,2.6c1.35,1.5,2.12,3.51,2.01,5.69 c-0.12,2.18-1.1,4.1-2.6,5.45c-1.5,1.35-3.51,2.13-5.69,2.01c-2.18-0.12-4.11-1.1-5.45-2.6c-1.35-1.5-2.12-3.51-2.01-5.69 c0.12-2.18,1.1-4.11,2.6-5.45C106.53,5.37,108.54,4.59,110.71,4.71L110.71,4.71z M28.15,22.07v27.19h5.63v6.79h-15V22.07H28.15 L28.15,22.07L28.15,22.07z M46.4,22.07v33.98h-9.36V22.07H46.4L46.4,22.07L46.4,22.07z M73.28,22.07l-4.73,33.98H54.39l-5.42-33.98 h9.86c1.11,9.37,1.92,17.3,2.43,23.78c0.5-6.55,1.02-12.36,1.54-17.44l0.62-6.34H73.28L73.28,22.07L73.28,22.07z M75.86,22.07 h15.59v6.79h-6.22v6.49h5.82v6.44h-5.82v7.48h6.86v6.79H75.86V22.07L75.86,22.07L75.86,22.07z"/><path class="st1" d="M110.56,7.69c2.7,0.14,4.77,2.45,4.63,5.14c-0.14,2.7-2.45,4.77-5.14,4.63c-2.7-0.14-4.77-2.45-4.63-5.14 S107.86,7.55,110.56,7.69L110.56,7.69z"/></g></svg>
																	</div>
                                            <?}?>
                                                <?= str_replace(':', ' : ', $arItem['RESULT'])?> <?if($arItem['BULLIT']){echo "СБ";} else if($arItem['OVERTIME']) {echo "ОТ";}?>
					</a>
				</td>
				<td class ="professional-portrait team">
					<a href='<?= $game_el['DETAIL_PAGE_URL']?>'><img src = "<?= CFile::GetPath($team2["PREVIEW_PICTURE"])  ? CFile::GetPath($team2["PREVIEW_PICTURE"])  : '/images/logo.png' ?>" alt ="player"></a>
					<a href='<?= $game_el['DETAIL_PAGE_URL']?>'>
						<div class ="team-info">
							<p class ="team-name"><?= $team2['NAME']?></p>
							<p class ="team-city"><?= $itemPropTeam2["CITY"]["VALUE"]?></p>
						</div>
					</a>
				</td>
				<td>
					<a href='<?= $game_el['DETAIL_PAGE_URL']?>'>
						<?= ($arItem["SCORED"])?$arItem["SCORED"]:0?>
					</a>
				</td>
				<td>
					<a href='<?= $game_el['DETAIL_PAGE_URL']?>'>
						<?= $arItem["ASSISTANT"] + $arItem["ASSISTANT2"] ?>
					</a>
				</td>
				<td>
					<a href='<?= $game_el['DETAIL_PAGE_URL']?>'>
						<?= $arItem["SCORED"] + $arItem["ASSISTANT"] + $arItem["ASSISTANT2"] ?>
					</a>
				</td>
			</tr>
		<?endforeach;?>

		</table>
	</div>
</div>
<?php endif; ?>



<script type="text/javascript">
	BX.ready(function() {
		var slider = new JCNewsSlider('<?=CUtil::JSEscape($this->GetEditAreaId($arResult['ID']));?>', {
			imagesContainerClassName: 'news-detail-slider-container',
			leftArrowClassName: 'news-detail-slider-arrow-container-left',
			rightArrowClassName: 'news-detail-slider-arrow-container-right',
			controlContainerClassName: 'news-detail-slider-control'
		});
	});
</script>
