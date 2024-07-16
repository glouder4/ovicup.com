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

 <?php
	$months_array = array(
    "01" => "января",
    "02" => "февраля",
	"03" => "марта",
	"04" => "апреля",
	"05" => "мая",
	"06" => "июня",
	"07" => "июля",
	"08" => "августа",
	"09" => "сентября",
	"10" => "октября",
	"11" => "ноября",
	"12" => "декабря"
);
?>

 <div class="pages__tab-row players__tab-row">
	<div class="tab-tour__tabs tab-card__tabs tabs-players">
        <?$rcup = "cup=".$GLOBALS['cupFilter']['PROPERTY_CUP'];?>
		<a href="/players/?<?=$rcup?>" class="tab-tour-tab tab-card-tab tab-card-js <?=(!$GLOBALS['cupFilter']['PROPERTY_ROLE'])?"active":""?>">Все</a>
		<a href="/players/?role=bombardir&<?=$rcup?>" class="tab-tour-tab tab-card-tab tab-card-js <?=($GLOBALS['cupFilter']['PROPERTY_ROLE'] == "bombardir")?"active":""?>">Бомбардиры</a>
		<a href="/players/?role=sniper&<?=$rcup?>" class="tab-tour-tab tab-card-tab tab-card-js <?=($GLOBALS['cupFilter']['PROPERTY_ROLE'] == "sniper")?"active":""?>">Снайперы</a>
		<a href="/players/?role=assistant&<?=$rcup?>" class="tab-tour-tab tab-card-tab tab-card-js <?=($GLOBALS['cupFilter']['PROPERTY_ROLE'] == "assistant")?"active":""?>">Ассистенты</a>
                <a href="/players/?role=defender&<?=$rcup?>" class="tab-tour-tab tab-card-tab tab-card-js <?=($GLOBALS['cupFilter']['PROPERTY_ROLE'] == "defender")?"active":""?>">Защитники</a>
		<a href="/players/?role=keeper&<?=$rcup?>" class="tab-tour-tab tab-card-tab tab-card-js <?=($GLOBALS['cupFilter']['PROPERTY_ROLE'] == "keeper")?"active":""?>">Вратари</a>
		<!--<a href="/players/?role=bombardir&<?=$rcup?>" class="tab-tour-tab tab-card-tab tab-card-js">Защитники</a>-->
	</div>
	
	<!--
	<div class ="tourney-list-wrapper calendar-list">
		<div class = "tab-card-tab tab-tourneys">
			<?foreach($arResult['CUP'] as $CUP) { ?>
				<?php if ($CUP['ID'] == $GLOBALS['cupFilter']['PROPERTY_CUP']) { ?>
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
			<?foreach($arResult['CUP'] as $CUP) { ?>
				<a value="<?= $CUP['ID'] ?>" <?= ($CUP['ID'] == $GLOBALS['gamesFilter']['PROPERTY_CUP']) ? "selected" : "" ?> href="?cup=<?= $CUP['ID'] ?>" ><?= $CUP["NAME"] ?></a>
			<? } ?>

			<script>
				BX.bind(BX('cup'), 'change', function () {
					location.href = '?cup=' + this.options[this.selectedIndex].value;
				});
			</script>
		</div>    
	</div>
	-->
	
	
</div>
<form class = "search-row">
	<input name="search" type="search" placeholder ="Поиск по фамилии" value="<?=$GLOBALS['playersFilter']['PROPERTY_FIRST_NAME']?>"></input> <input type ="submit" class ="search-button" value ="Найти"></input>
</form>


<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>

 
<div class="tab-content-js active">
	<div class ="players-tabulation main-tabulation">
		<div class = "tabulation-wrapper">
			<table class = "table-professionals table-players">
				<tr class ="table-info-row">
					<td class ="click-to-sort">
						Фамилия Имя 
						<svg xmlns="http://www.w3.org/2000/svg" width="14" height="8" viewBox="0 0 14 8" fill="none">
							<path d="M-6.8212e-08 1.39172L1.0219 0.5L7 5.76115L12.9781 0.5L14 1.39172L7 7.5L-6.8212e-08 1.39172Z" fill="#888E9B"/>
						</svg>   
					</td>
					<td>
						Клуб
					</td>
					<td>
						№ 
					</td>
					<td>
						Амплуа
					</td>
                                    <?if ($_REQUEST['role'] == 'keeper') {?>
                                    <td>
                                        Пр.
                                    </td>
                                    <?} else if(!empty($_REQUEST['role'])){?>
					<td>
						Г+П
					</td>
					<td>
						О
					</td>
                                    <?}?>
				</tr>
			
			</table>
			<table class ="table-players-bottom">
			
			<?foreach($arResult["ITEMS"] as $arItem):?>
			
				<?php 
					$input = $arItem["PROPERTIES"]["DATE_BIRTH"]["VALUE"];
					$date = DateTime::createFromFormat('d.m.Y', $input); 
				?>
				
				
				<?php 
					//задаем переменные
					$month = $date->format('m'); //месяц от 1 до 12
					$day = $date->format('d'); //день от 1 до 31
					$year = $date->format('Y'); //год
					$hour = 0; //час от 0 до 23
					$minute = 0; //минуты от 0 до 59
					$second = 0; //секунды от 0 до 59
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
					
					
			$club_item = array();
			$res = CIBlockElement::GetProperty(1, $arItem["DISPLAY_PROPERTIES"]['TEAM']["VALUE"] , "sort", "asc", array());

			while ($ob = $res->GetNext())
			{
				//$club_item[] = $ob;
				$club_item[$ob['CODE']]['VALUE'] = $ob['VALUE'];
				$club_item[$ob['CODE']]["VALUE_ENUM"] = $ob['VALUE_ENUM'];
			}
			
			$resClub = CIBlockElement::GetByID($arItem["DISPLAY_PROPERTIES"]['TEAM']["VALUE"]);
			$club_el = $resClub->GetNext();
			
				?> 
				

				<tr class ="table-professionals-player">
					<td class ="professional-portrait assistant-one">
						<a href ="<?=$arItem["DETAIL_PAGE_URL"]?>"> <img src = "<?= $arItem["PREVIEW_PICTURE"]["SRC"] ? $arItem["PREVIEW_PICTURE"]["SRC"] : '/images/logo.png' ?>" alt ="player"> </a>
						<a href ="<?=$arItem["DETAIL_PAGE_URL"]?>" class ="professional-name"><?echo $arItem["NAME"]?></a>
					</td>
					<td class ="professional-portrait team">
						<img src = "<?= CFile::GetPath($club_el["PREVIEW_PICTURE"]) ?  CFile::GetPath($club_el["PREVIEW_PICTURE"]) : '/images/logo.png' ?>" alt ="player">
						<div class ="team-info">
							<p class ="team-name"><?= $arItem["DISPLAY_PROPERTIES"]['TEAM']["DISPLAY_VALUE"] ?></p>
							<p class ="team-city"><?= $club_item['CITY']['VALUE'] ?></p>
						</div>
					
					</td>
					<td><?= $arItem["PROPERTIES"]["NUMBER"]["VALUE"] ?></td>
					<td><?= $arItem["PROPERTIES"]["ROLE"]["VALUE"] ?></td>
					<?if ($_REQUEST['role'] == 'keeper') {?>
                                        <td><?= $arItem['MISSED'] ?></td>
                                        <?} else {?>
                                        <td><?= $arItem['SCORED'] . ' + ' . $arItem['ASSIST'] ?> </td>
					<td><?= $arItem['SCORE'] ?></td>
                                        <?}?>
				</tr>
				
			<?endforeach;?>

				
			</table>
		</div>
	</div>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>




