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

<?foreach($arResult["ITEMS"] as $arItem):?>
    <?php 
	/*
	echo "<pre>";
    echo $arItem['ID'];
    print_r($arItem['DATA']);
    echo "</pre>";
	*/
	?>
<?endforeach;?>	

<?php
	$day_of_the_week = array(
		"0" => "Воскресенье",
		"1" => "Понедельник",
		"2" => "Вторник",
		"3" => "Среда",
		"4" => "Четверг",
		"5" => "Пятница",
		"6" => "Суббота"
	);
	
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

	<section class="matches"> 
		<div class="container">
			<div class="swiper matches-slider">
				<div class="swiper-wrapper">
				
				<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
				<?php
					$itemProp = array();
					$res = CIBlockElement::GetProperty(10,  $arItem['ID'] , "sort", "asc", array());
					while ($ob = $res->GetNext())
					{
						$itemProp[$ob['CODE']]['VALUE'] = $ob['VALUE'];
						$itemProp[$ob['CODE']]["VALUE_ENUM"] = $ob['VALUE_ENUM'];
					}
					
						
					//var_dump($itemProp['DATE']['VALUE']);

					$date = DateTime::createFromFormat('d.m.Y', explode(" ", $itemProp['DATE']['VALUE'])[0]);
                    $time = substr(explode(" ", $itemProp['DATE']['VALUE'])[1], 0, -3);
					$n = date("w", mktime(0,0,0,$date->format('m'),$date->format('d'),$date->format('Y')));



					$team1Prop = array();
					$res = CIBlockElement::GetProperty(1,  $arItem['DATA']['TEAM1']['ID'] , "sort", "asc", array());
					while ($ob = $res->GetNext())
					{
						$team1Prop[$ob['CODE']]['VALUE'] = $ob['VALUE'];
						$team1Prop[$ob['CODE']]["VALUE_ENUM"] = $ob['VALUE_ENUM'];
					}
					
					
					
					$team2Prop = array();
					$res = CIBlockElement::GetProperty(1,  $arItem['DATA']['TEAM2']['ID'] , "sort", "asc", array());
					while ($ob = $res->GetNext())
					{
						$team2Prop[$ob['CODE']]['VALUE'] = $ob['VALUE'];
						$team2Prop[$ob['CODE']]["VALUE_ENUM"] = $ob['VALUE_ENUM'];
					}
				?>

					<? if($date->format('Y') == 2024): ?>
					<a href="<?= $arItem['DETAIL_PAGE_URL']?>" data-date_game="<?= $date->format('m') ?>.<?= $date->format('d')?>.<?= $date->format('Y')?>"  data-date_game2="<?= $date->format('d')?>.<?= $date->format('m') ?>.<?= $date->format('Y')?>"  class="swiper-slide">
						<div class="swiper-slide__wrapper" >
							<p class="swiper-slide__date">
								<?= $date->format('d')?> <?= $months_array[$date->format('m')] ?>, <?= $time ?><?//= $day_of_the_week[$n] ?>
							</p>
							<div class="swiper-slide__row">
								<div class="swiper-slide__left">
									<div class="swiper-slide__team">
										<img src="<?= $arItem['DATA']['TEAM1']['IMG'] ? $arItem['DATA']['TEAM1']['IMG'] : '/images/logo.png' ?>" alt="team">
									</div>
									<p class="swiper-slide__name"><?= $team1Prop['SHORT_NAME']['VALUE'] ?></p>
								</div>
							
									<?$dateM = new DateTime();
//$arItem["PROPERTIES"]["DATE"]["VALUE"]
//print_r($dateM->format('Y.m.d H:i:s'));print_r($date->format('Y.m.d H:i:s'));
									if($dateM->format('Y.m.d H:i:s') >= $date->format('Y.m.d H:i:s') && $arItem["PROPERTIES"]["GAME_OVER"]["VALUE"]!="Да") {?>
											<!-- <p class ="calendar-single__date calendar-place" style="color:red">LIVE</p> -->
											<div class ="live">
									<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" 
								xmlns:xlink="http://www.w3.org/1999/xlink" 
								x="0px" y="0px" viewBox="0 0 122.88 69.01" 
								style="enable-background:new 0 0 122.88 69.01" 
								xml:space="preserve">
<style type="text/css">
<![CDATA[
	.st0{fill-rule:evenodd;clip-rule:evenodd;fill:#E74040;}
	.st1{fill:#242424;}
]]>
</style>
<g>
<path class="st0" d="M6.78,9.11H91.9c-0.15,0.81-0.25,1.65-0.3,2.49c-0.27,5.16,1.57,9.95,4.77,13.51 c3.06,3.4,7.37,5.69,12.26,6.12c0.34,0.05,0.69,0.08,1.05,0.08V31.3c0.73,0.02,1.45,0.01,2.16-0.05v30.98 c0,3.72-3.06,6.78-6.78,6.78H6.78C3.06,69.01,0,65.96,0,62.23V15.88C0,12.16,3.05,9.11,6.78,9.11L6.78,9.11L6.78,9.11z M110.97,0.02c6.94,0.37,12.26,6.29,11.89,13.23c-0.37,6.94-6.29,12.26-13.23,11.89c-6.94-0.37-12.26-6.29-11.89-13.23 C98.11,4.98,104.03-0.35,110.97,0.02L110.97,0.02z M110.71,4.71c2.18,0.12,4.1,1.1,5.45,2.6c1.35,1.5,2.12,3.51,2.01,5.69 c-0.12,2.18-1.1,4.1-2.6,5.45c-1.5,1.35-3.51,2.13-5.69,2.01c-2.18-0.12-4.11-1.1-5.45-2.6c-1.35-1.5-2.12-3.51-2.01-5.69 c0.12-2.18,1.1-4.11,2.6-5.45C106.53,5.37,108.54,4.59,110.71,4.71L110.71,4.71z M28.15,22.07v27.19h5.63v6.79h-15V22.07H28.15 L28.15,22.07L28.15,22.07z M46.4,22.07v33.98h-9.36V22.07H46.4L46.4,22.07L46.4,22.07z M73.28,22.07l-4.73,33.98H54.39l-5.42-33.98 h9.86c1.11,9.37,1.92,17.3,2.43,23.78c0.5-6.55,1.02-12.36,1.54-17.44l0.62-6.34H73.28L73.28,22.07L73.28,22.07z M75.86,22.07 h15.59v6.79h-6.22v6.49h5.82v6.44h-5.82v7.48h6.86v6.79H75.86V22.07L75.86,22.07L75.86,22.07z"/><path class="st1" d="M110.56,7.69c2.7,0.14,4.77,2.45,4.63,5.14c-0.14,2.7-2.45,4.77-5.14,4.63c-2.7-0.14-4.77-2.45-4.63-5.14 S107.86,7.55,110.56,7.69L110.56,7.69z"/></g></svg>
								</div>
                                                                <?}?>
								<div class="swiper-slide__center score">
									<p class="score__common"><?= $arItem['DATA']['RESULT']['TOTAL'] ?>
                                                                        <?if ($arItem['DATA']['RESULT']['B']) {?>
                                                                            Б
                                                                        <?} else if ($arItem['DATA']['RESULT']['OT']){?>
                                                                            ОТ
                                                                        <?}?>
                                                                        </p>
									
										<div class="score__times">
											<p class="score__first-time"><?= $arItem['DATA']['RESULT'][1] ?></p>
											<p class="score__second-time"><?= $arItem['DATA']['RESULT'][2] ?></p>
											<p class="score__first-time"><?= $arItem['DATA']['RESULT'][3] ?></p>
                                                                                        <p class="score__first-time"><?= $arItem['DATA']['RESULT']['OT'] ?></p>
											<p class="score__second-time"><?= $arItem['DATA']['RESULT']["B"] ?></p>
										</div>
									
								</div>
								<div class="swiper-slide__right">
									<div class="swiper-slide__team">
										<img src="<?= $arItem['DATA']['TEAM2']['IMG'] ? $arItem['DATA']['TEAM2']['IMG'] : '/images/logo.png' ?>" alt="team">
									</div>
									<p class="swiper-slide__name"><?= $team2Prop['SHORT_NAME']['VALUE'] ?></p>
								</div>
							</div>
						</div>
					</a>
				<?endif;?>
				<?endforeach;?>
					
				</div>
			</div>
			<div class="matches-prev">
				<svg width="12" height="24" viewBox="0 0 12 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M10.4713 24L12 22.2482L2.98088 12L12 1.75183L10.4713 2.6728e-07L-1.18021e-06 12L10.4713 24Z"
						  fill="#888E9B"/>
				</svg>
			</div>
			<div class="matches-next">
				<svg width="12" height="24" viewBox="0 0 12 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1.52866 24L1.72293e-07 22.2482L9.01912 12L2.18812e-06 1.75183L1.52866 2.6728e-07L12 12L1.52866 24Z"
						  fill="#888E9B"/>
				</svg>
			</div>
		</div>
	</section>

    