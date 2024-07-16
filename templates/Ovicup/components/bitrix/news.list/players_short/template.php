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

$n = 0;
?>

<tr class="tabulation-player__group">
	<th class="tabulation-player__matches">М</th>
	<th class="tabulation-player__person">Игрок</th>
        <?if ($arParams['FILTER_NAME'] == "Keeper") {?>
        <th class="tabulation-player__points">ПШ</th>
        <?} else if ($arParams['FILTER_NAME'] == "Sniper") {?>
        <th class="tabulation-player__points">Г</th>
        
        <?} else {?>
	<th class="tabulation-player__points">О</th>
        <?}?>
</tr>													

			
<?foreach($arResult["ITEMS"] as $arItem):?>

	<?// переменные
	//$arItem['SCORE'] заработанные очки
	//$arItem['SCORED'] забил
	//$arItem['ASSIST'] ассистент
	//$arItem['KEEP'] отбил шайб
	//при равенстве показателей в том числе нули сортировка по умолчанию
	//выводятся 5 лучших игроков, кол-во в компоненте не менять
	?>
			
	<?php 
		$input = $arItem["PROPERTIES"]["DATE_BIRTH"]["VALUE"];
		$date = DateTime::createFromFormat('d.m.Y', $input); 
	?>
	
	
	<?php 
		//задаем переменные
		/*$month = $date->format('m'); //месяц от 1 до 12
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
		//echo "Прошло уже более ".(int)$final_years." лет.";*/

	?> 


	<tr class="tabulation-player__group">
		<td class="tabulation-player__matches"><?= ++$n ?></td>
		<td class="tabulation-player__person tabulation-player-person">
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="tabulation-player__link">
				<div class="tabulation-player-person__img">
					<img height="90" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ? $arItem["PREVIEW_PICTURE"]["SRC"] : "/images/logo.png"?>" alt="player">
				</div>
				<div class="tabulation-player-person__right">
					<div class="tabulation-player-person__name">
						<?= $arItem["NAME"]?>
					</div>
					<div class="tabulation-player-person__bottom">
						<div class ="tabulation-left">
							<?if($arItem['TEAM_IMG']) {?>
								<img src="<?=$arItem['TEAM_IMG']?>" alt="team">
							<?} else {?>
							<img src="/images/logo.png" alt="team">
                                                    <?}?>
							<p class="tabulation-player-person__team">
								
							</p>
						</div>
						  
						<p class="tabulation-player-person__position">
							<?= $arItem["PROPERTIES"]["ROLE"]["VALUE"] ?>
						</p>
					</div>
				</div>
			</a>
		</td>
		<td class="tabulation-player__points tabulation-player-points">
			<?if ($arParams['FILTER_NAME'] != "Keeper") {?>
				<p class="tabulation-player-points__amount"><?= $arItem['SCORE'] ?></p>
			<?} else {?>
				<p class="tabulation-player-points__amount"><?= $arItem['MISSED']?></p>
			<?}?>
			<?if ($arParams['FILTER_NAME'] != "Keeper"  && $arParams['FILTER_NAME'] != "Sniper") {?>
                               <p class="tabulation-player-points__calculation"><?= $arItem['SCORED'] . ' + ' . $arItem['ASSIST'] ?>
				</p> 
                        <?}?>
		</td>
	</tr>
	
<?endforeach;?>

	