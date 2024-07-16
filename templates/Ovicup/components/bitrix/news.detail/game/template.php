<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
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

$date = DateTime::createFromFormat('d.m.Y', explode(" ", $arResult["PROPERTIES"]["DATE"]["VALUE"])[0]);
$n = date("w", mktime(0, 0, 0, $date->format('m'), $date->format('d'), $date->format('Y')));

$itemPropTeam1 = array();
$res = CIBlockElement::GetProperty(1, $arResult['DATA']['TEAM1']['ID'], "sort", "asc", array());
while ($ob = $res->GetNext()) {
    $itemPropTeam1[$ob['CODE']]['VALUE'] = $ob['VALUE'];
    $itemPropTeam1[$ob['CODE']]["VALUE_ENUM"] = $ob['VALUE_ENUM'];
}
$resTeam1 = CIBlockElement::GetByID($arResult['DATA']['TEAM1']['ID']);
$team1 = $resTeam1->GetNext();

$itemPropTeam2 = array();
$res = CIBlockElement::GetProperty(1, $arResult['DATA']['TEAM2']['ID'], "sort", "asc", array());
while ($ob = $res->GetNext()) {
    $itemPropTeam2[$ob['CODE']]['VALUE'] = $ob['VALUE'];
    $itemPropTeam2[$ob['CODE']]["VALUE_ENUM"] = $ob['VALUE_ENUM'];
}

$resTeam2 = CIBlockElement::GetByID($arResult['DATA']['TEAM2']['ID']);
$team2 = $resTeam2->GetNext();
?>

<div class ="calendar-single__top">
    <div class ="calendar-single__team">
        <div class ="calendar-single__team-logo">
            <a href="<?= $team1['DETAIL_PAGE_URL'] ?>" >
                <img src = "<?= $arResult['DATA']["TEAM1"]["IMG"] ? $arResult['DATA']["TEAM1"]["IMG"] : '/images/logo.png' ?>" alt = "team-logo">
            </a>
        </div>
        <div class ="calendar-single__text-holder">
            <p class ="calendar-single__team-name">
                <a href="<?= $arResult['DETAIL_PAGE_URL'] ?>" >
<?= $arResult['DATA']["TEAM1"]["NAME"] ?>
                </a>
            </p>
            <p class ="single-team-city"><?= $itemPropTeam1['CITY']['VALUE'] ?></p>
        </div>

    </div>
	<?php $time = explode(" ", $arResult["PROPERTIES"]["DATE"]["VALUE"])[1];?>
    <div class ="calendar-single__data">
        <p class ="calendar-single__date"><?= $date->format('d') ?> <?= $months_array[$date->format('m')] ?>, <?= $day_of_the_week[$n] ?></p>
        <p class ="calendar-single__date calendar-time"><?= explode(":", $time)[0] . ":" . explode(":", $time)[1] ?> МСК</p>
        <p class ="calendar-single__date calendar-place"><?= $arResult["PROPERTIES"]["ARENA"]["VALUE"] ?></p>
        <?$dateM = new DateTime();
        if($dateM->format('Y.m.d H:i:s') >= $date->format('Y.m.d H:i:s') && $arResult["PROPERTIES"]["GAME_OVER"]["VALUE"]!="Да") {?>
        <!-- <p class ="calendar-single__date calendar-place" style="color:red">LIVE</p> -->
        <div class ="live live-tab">
								<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 122.88 69.01" style="enable-background:new 0 0 122.88 69.01" xml:space="preserve"><style type="text/css"><![CDATA[
	.st0{fill-rule:evenodd;clip-rule:evenodd;fill:#E74040;}
	.st1{fill:#242424;}
]]></style><g><path class="st0" d="M6.78,9.11H91.9c-0.15,0.81-0.25,1.65-0.3,2.49c-0.27,5.16,1.57,9.95,4.77,13.51 c3.06,3.4,7.37,5.69,12.26,6.12c0.34,0.05,0.69,0.08,1.05,0.08V31.3c0.73,0.02,1.45,0.01,2.16-0.05v30.98 c0,3.72-3.06,6.78-6.78,6.78H6.78C3.06,69.01,0,65.96,0,62.23V15.88C0,12.16,3.05,9.11,6.78,9.11L6.78,9.11L6.78,9.11z M110.97,0.02c6.94,0.37,12.26,6.29,11.89,13.23c-0.37,6.94-6.29,12.26-13.23,11.89c-6.94-0.37-12.26-6.29-11.89-13.23 C98.11,4.98,104.03-0.35,110.97,0.02L110.97,0.02z M110.71,4.71c2.18,0.12,4.1,1.1,5.45,2.6c1.35,1.5,2.12,3.51,2.01,5.69 c-0.12,2.18-1.1,4.1-2.6,5.45c-1.5,1.35-3.51,2.13-5.69,2.01c-2.18-0.12-4.11-1.1-5.45-2.6c-1.35-1.5-2.12-3.51-2.01-5.69 c0.12-2.18,1.1-4.11,2.6-5.45C106.53,5.37,108.54,4.59,110.71,4.71L110.71,4.71z M28.15,22.07v27.19h5.63v6.79h-15V22.07H28.15 L28.15,22.07L28.15,22.07z M46.4,22.07v33.98h-9.36V22.07H46.4L46.4,22.07L46.4,22.07z M73.28,22.07l-4.73,33.98H54.39l-5.42-33.98 h9.86c1.11,9.37,1.92,17.3,2.43,23.78c0.5-6.55,1.02-12.36,1.54-17.44l0.62-6.34H73.28L73.28,22.07L73.28,22.07z M75.86,22.07 h15.59v6.79h-6.22v6.49h5.82v6.44h-5.82v7.48h6.86v6.79H75.86V22.07L75.86,22.07L75.86,22.07z"/><path class="st1" d="M110.56,7.69c2.7,0.14,4.77,2.45,4.63,5.14c-0.14,2.7-2.45,4.77-5.14,4.63c-2.7-0.14-4.77-2.45-4.63-5.14 S107.86,7.55,110.56,7.69L110.56,7.69z"/></g></svg>
								</div>
        <?}?>
        <p class ="calendar-single__match-count">
<?= str_replace(':', ' : ', $arResult['DATA']['RESULT']['TOTAL']) ?> 
<? if ($arResult['DATA']['RESULT']['B']) { ?>
                Б
            <? } else if ($arResult['DATA']['RESULT']['OT']) { ?>
                ОТ
            <? } ?>
        </p>
        <div class ="calendar-single__match-stats">
            <p class ="calendar-single-stat">
            <?= $arResult['DATA']["RESULT"][1] ?>
            </p>
            <p class ="calendar-single-stat">
                <?= $arResult['DATA']["RESULT"][2] ?>
            </p>
            <p class ="calendar-single-stat">
                <?= $arResult['DATA']["RESULT"][3] ?>
            </p>
            <p class ="calendar-single-stat">
                <?= $arResult['DATA']["RESULT"]["OT"] ?>
            </p>
            <p class ="calendar-single-stat">
                <?= $arResult['DATA']["RESULT"]["B"] ?>
            </p>

        </div>
    </div>
    <div class ="calendar-single__team">
        <div class ="calendar-single__team-logo">
            <a href="<?= $team2['DETAIL_PAGE_URL'] ?>" >
                <img src = "<?= $arResult['DATA']["TEAM2"]["IMG"] ? $arResult['DATA']["TEAM2"]["IMG"] : '/images/logo.png' ?>" alt = "team-logo">
            </a>
        </div>
        <div class ="calendar-single__text-holder">
            <p class ="calendar-single__team-name">
                <a href="<?= $arResult['DETAIL_PAGE_URL'] ?>" >
<?= $arResult['DATA']["TEAM2"]["NAME"] ?>
                </a>
            </p>
            <p class ="single-team-city"><?= $itemPropTeam2['CITY']['VALUE'] ?></p>
        </div>

    </div>
</div>

<div class="title__head stats-head">
    <h2 class="title calendar-single-title">Статистика матча</h2>
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
			<p class="glossary__row">
				<span>П —</span>кол-во передач
			</p>
			<p class="glossary__row">
				<span>О —</span>кол-во очков в турнирной таблице
			</p>
			<p class="glossary__row">
				<span>ПШ —</span>пропущенные шайбы
			</p>
		</div>
		<div class="glossary-column">
			<p class="glossary__row">
				<span>-1 —</span> шайба забитая в меньшинстве без одного игрока на площадке
			</p>
			<p class="glossary__row">
				<span>-2 —</span>шайба забитая в меньшинстве без двух игроков на площад
			</p>
			<p class="glossary__row">
				<span>+1 —</span>шайба забитая в большинстве на одного игрока на площадке
			</p>
			<p class="glossary__row">
				<span>+2 —</span>шайба забитая в большинстве на двух игроков на площадке
			</p>
			<p class="glossary__row">
				<span>ПВ —</span>шайба забитая в пустые ворота
			</p>
		</div>
	</div>
</div>
				

<!-- Переключатель таблиц -->
<div class ="buttons-holder">
<?php if ($arResult["DATA"]["PROTOCOL"] || $arResult["PROPERTIES"]["VIDEO_GAME"]["VALUE"]) : ?>
        <div class ="tab-card-tab active">
            Игроки
        </div>
    <?php endif; ?>
<?php if ($arResult["DATA"]["PROTOCOL"]) : ?>
        <div class ="tab-card-tab">
            Протокол
        </div>
    <?php endif; ?>
<?php if ($arResult["PROPERTIES"]["VIDEO_GAME"]["VALUE"]) : ?>
        <div class ="tab-card-tab">
            Трансляция
        </div>
    <?php endif; ?>
</div>


<!-- Обертка таблиц -->
<div class ="calendar-single__tabs-holder">
    <!-- Игроки -->
    <div class ="calendar-single-tab tab-players active">
<?
$team1_filters = [];
foreach ($arResult['DATA']["PLAYERS"]["TEAM1"] as $key => $row) {
    $team1_filters[$row["ROLE"]][$key] = $row;

    $res_t1 = CIBlockElement::GetByID($key);
    $ar_res_t1[$row["ROLE"]][$key] = $res_t1->GetNext();
}

$team2_filters = [];
foreach ($arResult['DATA']["PLAYERS"]["TEAM2"] as $key => $row) {
    $team2_filters[$row["ROLE"]][$key] = $row;

    $res_t2 = CIBlockElement::GetByID($key);
    $ar_res_t2[$row["ROLE"]][$key] = $res_t2->GetNext();
}
?>


        <!-- Сторона игроков левая -->
        <div class ="calendar-single-team-side">

            <table class = "table-info">
                <tr class ="table-info-row">
                    <td>№</td>
                    <td>Фамилия, Имя</td>
                    <td>Ш</td>
                    <td>П</td>
                    <td>О</td>
                    <td>ПШ</td>
                </tr>
            </table>

<?php if ($team1_filters["Вратарь"]) : ?>
                <table class = "table-professionals goalkeepers">
                    <tr class ="table-professionals-title">
                    <div class ="table-professionals-logo">
                        <img src="<?= $arResult['DATA']["TEAM1"]["IMG"] ? $arResult['DATA']["TEAM1"]["IMG"] : '/images/logo.png' ?>" alt ="team-logo">
                        <p class ="table-professionals-profile">Вратари</p>
                        </tr>

    <? foreach ($team1_filters["Вратарь"] as $key => $arItem): ?>
                            <tr class ="table-professionals-player">
                                <td class ="professional-number"><?= $arItem["NUMBER"] ?></td>
                                <td class ="professional-portrait">
                                    <img src = "<?= CFile::GetPath($ar_res_t1["Вратарь"][$key]["PREVIEW_PICTURE"]) ? CFile::GetPath($ar_res_t1["Вратарь"][$key]["PREVIEW_PICTURE"]) : '/images/logo.png' ?>" alt ="player">
                                    <a href ="<?= $ar_res_t1["Вратарь"][$key]["DETAIL_PAGE_URL"] ?>" class ="professional-name"><?= $arItem["FIRST_NAME"] ?> <?= $arItem["NAME"] ?></a>
                                </td>
                                <td class ="professional-count count-first"> </td>
                                <td class ="professional-count count-second"> </td>
                                <td class ="professional-count count-third"> </td>
                                <td class ="professional-count count-third"><?= $arItem['MISSED']?> </td>
                            </tr>
    <? endforeach; ?>

                </table>
<?php endif; ?>

<?php if ($team1_filters["Защитник"]) : ?>
                <table class = "table-professionals defenders">
                    <tr class ="table-professionals-title">
                    <div class ="table-professionals-logo">
                        <img src="<?= $arResult['DATA']["TEAM1"]["IMG"] ? $arResult['DATA']['TEAM1']['IMG'] : '/images/logo.png' ?>" alt ="team-logo">
                        <p class ="table-professionals-profile">Защитники</p>
                        </tr>
                <? foreach ($team1_filters["Защитник"] as $key => $arItem): ?>
                            <tr class ="table-professionals-player">
                                <td class ="professional-number"><?= $arItem["NUMBER"] ?></td>
                                <td class ="professional-portrait">
                                    <img src = "<?= CFile::GetPath($ar_res_t1["Защитник"][$key]["PREVIEW_PICTURE"]) ? CFile::GetPath($ar_res_t1["Защитник"][$key]["PREVIEW_PICTURE"]) : '/images/logo.png' ?>" alt ="player">
                                    <a href ="<?= $ar_res_t1["Защитник"][$key]["DETAIL_PAGE_URL"] ?>" class ="professional-name"><?= $arItem["FIRST_NAME"] ?> <?= $arItem["NAME"] ?></a>
                                </td>
                                <td class ="professional-count count-first"> <?= ($arItem['SCORED'] > 0) ? $arItem['SCORED'] : 0 ?> </td>
                                <td class ="professional-count count-second"> <?= ($arItem['ASSISTANT']) ? $arItem['ASSISTANT'] : 0 ?></td>
                                <td class ="professional-count count-third"> <?= $arItem['SCORED'] + $arItem['ASSISTANT'] ?></td>
                            </tr>
    <? endforeach; ?>
                </table>
<?php endif; ?>

<?php if ($team1_filters["Нападающий"]) : ?>
                <table class = "table-professionals strikers">
                    <tr class ="table-professionals-title">
                    <div class ="table-professionals-logo">
                        <img src="<?= $arResult['DATA']["TEAM1"]["IMG"] ? $arResult['DATA']['TEAM1']['IMG'] : '/images/logo.png' ?>" alt ="team-logo">
                        <p class ="table-professionals-profile">Нападающие</p>
                        </tr>
                <? foreach ($team1_filters["Нападающий"] as $key => $arItem): ?>
                            <tr class ="table-professionals-player">
                                <td class ="professional-number"><?= $arItem["NUMBER"] ?></td>
                                <td class ="professional-portrait">
                                    <img src = "<?= CFile::GetPath($ar_res_t1["Нападающий"][$key]["PREVIEW_PICTURE"]) ? CFile::GetPath($ar_res_t1["Нападающий"][$key]["PREVIEW_PICTURE"]) : '/images/logo.png' ?>" alt ="player">
                                    <a href ="<?= $ar_res_t1["Нападающий"][$key]["DETAIL_PAGE_URL"] ?>" class ="professional-name"><?= $arItem["FIRST_NAME"] ?> <?= $arItem["NAME"] ?></a>
                                </td>
                                <td class ="professional-count count-first"> <?= ($arItem['SCORED'] > 0) ? $arItem['SCORED'] : 0 ?> </td>
                                <td class ="professional-count count-second"> <?= ($arItem['ASSISTANT']) ? $arItem['ASSISTANT'] : 0 ?></td>
                                <td class ="professional-count count-third"> <?= $arItem['SCORED'] + $arItem['ASSISTANT'] ?></td>
                            </tr>
    <? endforeach; ?>
                </table>
<?php endif; ?>

        </div>



        <!-- Сторона игроков правая -->
        <div class ="calendar-single-team-side">

            <table class = "table-info">
                <tr class ="table-info-row">
                    <td>№</td>
                    <td>Фамилия, Имя</td>
                    <td>Ш</td>
                    <td>П</td>
                    <td>О</td>
                    <td>ПШ</td>
                </tr>
            </table>

<?php if ($team2_filters["Вратарь"]) : ?>
                <table class = "table-professionals goalkeepers">
                    <tr class ="table-professionals-title">
                    <div class ="table-professionals-logo">
                        <img src="<?= $arResult['DATA']["TEAM2"]["IMG"] ? $arResult['DATA']['TEAM2']['IMG'] : '/images/logo.png' ?>" alt ="team-logo">
                        <p class ="table-professionals-profile">Вратари</p>
                        </tr>
                <? foreach ($team2_filters["Вратарь"] as $key => $arItem): ?>
                            <tr class ="table-professionals-player">
                                <td class ="professional-number"><?= $arItem["NUMBER"] ?></td>
                                <td class ="professional-portrait">
                                    <img src = "<?= CFile::GetPath($ar_res_t2["Вратарь"][$key]["PREVIEW_PICTURE"]) ? CFile::GetPath($ar_res_t2["Вратарь"][$key]["PREVIEW_PICTURE"]) : '/images/logo.png' ?>" alt ="player">
                                    <a href ="<?= $ar_res_t2["Вратарь"][$key]["DETAIL_PAGE_URL"] ?>" class ="professional-name"><?= $arItem["FIRST_NAME"] ?> <?= $arItem["NAME"] ?></a>
                                </td>
                                <td class ="professional-count count-first"> </td>
                                <td class ="professional-count count-second" > </td>
                                <td class ="professional-count count-third"> </td>
                                <td class ="professional-count count-third"><?= $arItem['MISSED']?>
                            </tr>
    <? endforeach; ?>

                </table>
<?php endif; ?>
<?php if ($team2_filters["Защитник"]) : ?>
                <table class = "table-professionals defenders">
                    <tr class ="table-professionals-title">
                    <div class ="table-professionals-logo">
                        <img src="<?= $arResult['DATA']["TEAM2"]["IMG"] ? $arResult['DATA']['TEAM2']['IMG'] : '/images/logo.png' ?>" alt ="team-logo">
                        <p class ="table-professionals-profile">Защитники</p>
                        </tr>
                <? foreach ($team2_filters["Защитник"] as $key => $arItem): ?>
                            <tr class ="table-professionals-player">
                                <td class ="professional-number"><?= $arItem["NUMBER"] ?></td>
                                <td class ="professional-portrait">
                                    <img src = "<?= CFile::GetPath($ar_res_t2["Защитник"][$key]["PREVIEW_PICTURE"]) ? CFile::GetPath($ar_res_t2["Защитник"][$key]["PREVIEW_PICTURE"]) : '/images/logo.png' ?>" alt ="player">
                                    <a href ="<?= $ar_res_t2["Защитник"][$key]["DETAIL_PAGE_URL"] ?>" class ="professional-name"><?= $arItem["FIRST_NAME"] ?> <?= $arItem["NAME"] ?></a>
                                </td>
                                <td class ="professional-count count-first"> <?= ($arItem['SCORED'] > 0) ? $arItem['SCORED'] : 0 ?> </td>
                                <td class ="professional-count count-second"> <?= ($arItem['ASSISTANT']) ? $arItem['ASSISTANT'] : 0 ?></td>
                                <td class ="professional-count count-third"> <?= $arItem['SCORED'] + $arItem['ASSISTANT'] ?></td>
                            </tr>
    <? endforeach; ?>
                </table>
<?php endif; ?>

<?php if ($team2_filters["Нападающий"]) : ?>
                <table class = "table-professionals strikers">
                    <tr class ="table-professionals-title">
                    <div class ="table-professionals-logo">
                        <img src="<?= $arResult['DATA']["TEAM2"]["IMG"] ? $arResult['DATA']['TEAM2']['IMG'] : '/images/logo.png' ?>" alt ="team-logo">
                        <p class ="table-professionals-profile">Нападающие</p>
                        </tr>
                <? foreach ($team2_filters["Нападающий"] as $key => $arItem): ?>
                            <tr class ="table-professionals-player">
                                <td class ="professional-number"><?= $arItem["NUMBER"] ?></td>
                                <td class ="professional-portrait">
                                    <img src = "<?= CFile::GetPath($ar_res_t2["Нападающий"][$key]["PREVIEW_PICTURE"]) ? CFile::GetPath($ar_res_t2["Нападающий"][$key]["PREVIEW_PICTURE"]) : '/images/logo.png' ?>" alt ="player">
                                    <a href ="<?= $ar_res_t2["Нападающий"][$key]["DETAIL_PAGE_URL"] ?>" class ="professional-name"><?= $arItem["FIRST_NAME"] ?> <?= $arItem["NAME"] ?></a>
                                </td>
                                <td class ="professional-count count-first"> <?= ($arItem['SCORED'] > 0) ? $arItem['SCORED'] : 0 ?> </td>
                                <td class ="professional-count count-second"> <?= ($arItem['ASSISTANT']) ? $arItem['ASSISTANT'] : 0 ?></td>
                                <td class ="professional-count count-third"> <?= $arItem['SCORED'] + $arItem['ASSISTANT'] ?></td>
                            </tr>
    <? endforeach; ?>
                </table>
<?php endif; ?>

        </div>
    </div>


<?php if ($arResult["DATA"]["PROTOCOL"]) : ?>
    <!-- Протокол -->
    <div class ="calendar-single-tab tab-protocol">
        <div class ="protocol-wrap">
            <table class = "table-info">
                <tr class ="table-info-row table-protocol-row">
                    <td>Время</td>
                    <td>Счет</td>
                    <td>Команда</td>
                    <td>Автор</td>
                    <td>Ассистент 1</td>
                    <td>Ассистент 2</td>
                    <td>Ситуация</td>
                </tr>
            </table>

            <table class = "table-professionals">

<? foreach ($arResult["DATA"]["PROTOCOL"] as $key => $arItem): ?>

    <?php
    $itemTeam1 = array();
    $res = CIBlockElement::GetProperty(1, $arItem["TEAM"], "sort", "asc", array());
    while ($ob = $res->GetNext()) {
        $itemTeam1[$ob['CODE']]['VALUE'] = $ob['VALUE'];
        $itemTeam1[$ob['CODE']]["VALUE_ENUM"] = $ob['VALUE_ENUM'];
    }

    $res = CIBlockElement::GetByID($arItem["TEAM"]);
    $ar_res = $res->GetNext();

    $res_sco = CIBlockElement::GetByID($arItem["SCODED"]);
    $ar_sco = $res_sco->GetNext();

    $res_as1 = CIBlockElement::GetByID($arItem["ASSISTANT"]);
    $ar_as1 = $res_as1->GetNext();

    $res_as2 = CIBlockElement::GetByID($arItem["ASSISTANT2"]);
    $ar_as2 = $res_as2->GetNext();
    ?>

                    <tr class ="table-professionals-player  protocol-player">
                        <td class ="table-professionals-time">
                    <?= $arItem["TIME"] ?>
                        </td>
                        <td class ="table-professionals-game-count">
                    <?= str_replace(':', ' : ', $arItem["RESULT"]) ?>
                        </td>
                        <td class ="professional-portrait team">
                            <img src = "<?= CFile::GetPath($ar_res["PREVIEW_PICTURE"]) ? CFile::GetPath($ar_res["PREVIEW_PICTURE"]) : '/images/logo.png' ?>" alt ="player">
                            <div class ="team-info">
                                <p class ="team-name"><a href ="<?= $ar_res["DETAIL_PAGE_URL"] ?>"><?= $ar_res["NAME"] ?></a></p>
                                <p class ="team-city"><a href ="<?= $ar_res["DETAIL_PAGE_URL"] ?>"><?= $itemTeam1["CITY"]['VALUE'] ?></a></p>
                            </div>
                        </td>
                        <td class ="professional-portrait author">
    <?php if ($arItem["SCODED"]): ?>
                                <img src = "<?= CFile::GetPath($ar_sco["PREVIEW_PICTURE"]) ? CFile::GetPath($ar_sco["PREVIEW_PICTURE"]) : '/images/logo.png' ?>" alt ="player">
                                <a href ="<?= $ar_sco["DETAIL_PAGE_URL"] ?>" class ="professional-name"><?= $ar_sco["NAME"] ?></a>
    <?php endif; ?>
                        </td>
                        <td class ="professional-portrait assistant-one">
    <?php if ($arItem["ASSISTANT"]): ?>
                                <img src = "<?= CFile::GetPath($ar_as1["PREVIEW_PICTURE"]) ? CFile::GetPath($ar_as1["PREVIEW_PICTURE"]) : '/images/logo.png' ?>" alt ="player">
                                <a href ="<?= $ar_as1["DETAIL_PAGE_URL"] ?>" class ="professional-name"><?= $ar_as1["NAME"] ?></a>
    <?php endif; ?>
                        </td>
                        <td class ="professional-portrait assistant-two">
    <?php if ($arItem["ASSISTANT2"]): ?>
                                <img src = "<?= CFile::GetPath($ar_as2["PREVIEW_PICTURE"]) ? CFile::GetPath($ar_as2["PREVIEW_PICTURE"]) : '/images/logo.png' ?>" alt ="player">
                                <a href ="<?= $ar_as2["DETAIL_PAGE_URL"] ?>" class ="professional-name"><?= $ar_as2["NAME"] ?></a>
    <?php endif; ?>
                        </td>
                        <td class ="table-professionals-situation">
    <?= ($arItem["SITUATION"]=="bullit")?"СБ":$arItem["SITUATION"] ?>
                        </td>
                    </tr>
<? endforeach; ?>

            </table>
        </div>
    </div>
<?php endif; ?>
    
<?php
$itemTtan = array();
$res = CIBlockElement::GetProperty(7, $arResult["PROPERTIES"]["VIDEO_GAME"]["VALUE"], "sort", "asc", array());
while ($ob = $res->GetNext()) {
    $itemTtan[$ob['CODE']]['SRC'] = $ob["SRC"];
    $itemTtan[$ob['CODE']]["VALUE"] = $ob["VALUE"];
}
?>
    <?php if ($arResult["PROPERTIES"]["VIDEO_GAME"]["VALUE"]) : ?>
        <!-- Трансляции -->
        <div class ="calendar-single-tab tab-translation">
            <div class ="translation-block" style="width:100%;">
                <div class="translation__video" >
                    <center>			
                        <iframe src='<?= ($itemTtan["GALLERY_VIDEO"]["SRC"]) ? $itemTtan["GALLERY_VIDEO"]["SRC"] : link_youtube($itemTtan["VIDEO_LINK"]["VALUE"]) ?>' width="1300px" height="900px" frameBorder="0" allow="clipboard-write; autoplay" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                    </center>
                </div>
            </div>
        </div>
<?php endif; ?>

</div>

