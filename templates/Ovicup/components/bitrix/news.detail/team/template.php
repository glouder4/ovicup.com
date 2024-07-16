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
CModule::IncludeModule("iblock");
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



<div class="team">

    <div class="team-card">
        <div class="team-card-left">
            <div class="team-card-left__top">
                <div class="team-card-left__logo">
                    <img src="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ? $arResult["PREVIEW_PICTURE"]["SRC"] : '/images/logo.png' ?>" alt="team">
                </div>
                <div class="team-card-left__text">
                    <h1 class="team-card-left__title">
                        <?= $arResult["NAME"] ?>
                    </h1>
                    <p class="team-card-left__city">
                        <?= $arResult["PROPERTIES"]["CITY"]["VALUE"] ?>
                    </p>
                </div>
            </div>
            <div class="team-card-left__bottom">
                <div class="team-card-social">

                    <?php if ($arResult["PROPERTIES"]["LINK_VK"]["VALUE"]) : ?>
                        <a href="<?= ($arResult["PROPERTIES"]["LINK_VK"]["VALUE"]) ? $arResult["PROPERTIES"]["LINK_VK"]["VALUE"] : '' ?>" class="team-card-social__icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <ellipse cx="20" cy="20" rx="20" ry="20" fill="#0077FF"/>
                                <path d="M20.4744 26C13.9038 26 10.1562 21.4955 10 14H13.2913C13.3994 19.5015 15.8258 21.8318 17.7477 22.3123V14H20.8469V18.7447C22.7448 18.5405 24.7386 16.3784 25.4112 14H28.5104C27.9939 16.9309 25.8317 19.0931 24.2942 19.982C25.8317 20.7027 28.2943 22.5886 29.2312 26H25.8197C25.087 23.7177 23.2613 21.952 20.8469 21.7117V26H20.4744Z" fill="white"/>
                            </svg>
                        </a>
                    <?php endif; ?>

                    <?php if ($arResult["PROPERTIES"]["LINK_YOUTUBE"]["VALUE"]) : ?>
                        <a href="<?= ($arResult["PROPERTIES"]["LINK_YOUTUBE"]["VALUE"]) ? $arResult["PROPERTIES"]["LINK_YOUTUBE"]["VALUE"] : '' ?>" class="team-card-social__icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="20" cy="20" r="20" fill="#FF0103"/>
                                <path d="M31.4588 15.5765C31.4588 15.3882 31.1765 13.8824 30.5176 13.2235C29.6706 12.2824 28.7294 12.1882 28.2588 12.1882H28.1647C25.2471 12 20.9176 12 20.8235 12C20.8235 12 16.4 12 13.4824 12.1882H13.3882C12.9176 12.1882 11.9765 12.2824 11.1294 13.2235C10.4706 13.9765 10.1882 15.4824 10.1882 15.6706C10.1882 15.7647 10 17.4588 10 19.2471V20.8471C10 22.6353 10.1882 24.3294 10.1882 24.4235C10.1882 24.6118 10.4706 26.1176 11.1294 26.7765C11.8824 27.6235 12.8235 27.7176 13.3882 27.8118C13.4824 27.8118 13.5765 27.8118 13.6706 27.8118C15.3647 28 20.5412 28 20.7294 28C20.7294 28 25.1529 28 28.0706 27.8118H28.1647C28.6353 27.7176 29.5765 27.6235 30.4235 26.7765C31.0824 26.0235 31.3647 24.5176 31.3647 24.3294C31.3647 24.2353 31.5529 22.5412 31.5529 20.7529V19.1529C31.6471 17.4588 31.4588 15.6706 31.4588 15.5765ZM24.4941 20.1882L18.8471 23.2C18.7529 23.2 18.7529 23.2941 18.6588 23.2941C18.5647 23.2941 18.4706 23.2941 18.4706 23.2C18.3765 23.1059 18.2824 23.0118 18.2824 22.8235V16.7059C18.2824 16.5176 18.3765 16.4235 18.4706 16.3294C18.5647 16.2353 18.7529 16.2353 18.9412 16.3294L24.5882 19.3412C24.7765 19.4353 24.8706 19.5294 24.8706 19.7176C24.8706 19.9059 24.6824 20.0941 24.4941 20.1882Z" fill="white"/>
                            </svg>
                        </a>
                    <?php endif; ?>

                </div>
                <div class="team-card-left__columns">
                    <div class="team-card-left__column">
                        <span class="team-card-left__total-name">Матчи</span>
                        <span class="team-card-left__total"><?= $arResult['RESULT_CUP']['GAMES'] ?></span>
                    </div>
                    <div class="team-card-left__column">
                        <span class="team-card-left__total-name">Победы</span>
                        <span class="team-card-left__total"><?= $arResult['RESULT_CUP']['V'] ?></span>
                    </div>
                    <div class="team-card-left__column">
                        <span class="team-card-left__total-name">Очки</span>
                        <span class="team-card-left__total"><?= $arResult['RESULT_CUP']['SCORE'] ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="team-card-center">
            <?php if ($arResult["PROPERTIES"]["FOUNDATION"]["VALUE"]) : ?>
                <div class="team-card__column">
                    <p class="team-card__title">Год основания</p>
                    <p class="team-card__text"><?= $arResult["PROPERTIES"]["FOUNDATION"]["VALUE"] ?></p>
                </div>
            <?php endif; ?>

            <?php if ($arResult["PROPERTIES"]["ADDRESS"]["VALUE"]) : ?>
                <div class="team-card__column">
                    <p class="team-card__title">Адрес</p>
                    <p class="team-card__text"><?= $arResult["PROPERTIES"]["ADDRESS"]["VALUE"] ?></p>
                </div>
            <?php endif; ?>
        </div>
        <div class="team-card-right">
            <?php if ($arResult["PROPERTIES"]["BIRTH"]["VALUE"]) : ?>
                <div class="team-card__column">
                    <p class="team-card__title">Год рождения</p>
                    <p class="team-card__text"><?= $arResult["PROPERTIES"]["BIRTH"]["VALUE"] ?></p>
                </div>
            <?php endif; ?>

            <?php if ($arResult["PROPERTIES"]["COACH"]["VALUE"]) : ?>
                <div class="team-card__column">
                    <p class="team-card__title">Главный тренер</p>
                    <p class="team-card__text"><?= $arResult["PROPERTIES"]["COACH"]["VALUE"] ?></p>
                </div>
            <?php endif; ?>

            <?php if ($arResult["PROPERTIES"]["CONTACTS"]["VALUE"]) : ?>
                <div class="team-card__column">
                    <p class="team-card__title">Контакты</p>
                    <p class="team-card__text"><?= htmlspecialchars_decode($arResult["PROPERTIES"]["CONTACTS"]["VALUE"]["TEXT"]) ?></p>
                </div>
            <?php endif; ?>

        </div>
    </div>



    <?php if ($arResult["DETAIL_PICTURE"]["SRC"]) : ?>
        <div class="team-img">
            <img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt="team">
                <p class="team__name">
                    <?= $arResult["FIELDS"]["DETAIL_TEXT"] ?>
                </p>
        </div>
    <?php endif; ?>

    <?php if ($arResult["DISPLAY_PROPERTIES"]["STRUCTURE"]): ?>
        <p class="team__title">
            Состав команды
        </p>



        <div class ="main-tabulation">
            <table class="roster">
                <tbody>

                    <tr class="roster__row">
                        <th class="roster__player">Фамилия, имя</th>
                        <th class="roster__number">№</th>
                        <th class="roster__position">Амплуа</th>
                        <th class="roster__date">Дата рождения</th>
                        <th class="roster__age">Возраст</th>
                        <th class="roster__height">Рост</th>
                        <th class="roster__weight">Вес</th>
                        <th class="roster__grip">Хват</th>
                    </tr>


                    <? foreach ($arResult["DISPLAY_PROPERTIES"]["STRUCTURE"]["LINK_ELEMENT_VALUE"] as $key => $arItem): ?>

                        <?
                        $itemProp = array();
                        $res = CIBlockElement::GetProperty($arItem["IBLOCK_ID"], $arItem["ID"], "sort", "asc", array());

                        while ($ob = $res->GetNext()) {
                            $itemProp[$ob['CODE']]['VALUE'] = $ob['VALUE'];
                            $itemProp[$ob['CODE']]["VALUE_ENUM"] = $ob['VALUE_ENUM'];
                        }
                        ?>


                        <?php
                        if ($itemProp['DATE_BIRTH']['VALUE']) {
                            $input = $itemProp['DATE_BIRTH']['VALUE'];
                            $date = DateTime::createFromFormat('d.m.Y', $input);

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
                            $math_years = ($get_current_time - $get_past_time) / (60 * 60 * 24 * 365);

                            //получаенное не целое число лет округляем в меньшую сторону,
                            //так как нам нужно знать полное количество лет
                            $final_years = floor($math_years);

                            //все, количество лет с отпределенной даты получено
                            //и находится в переменной $final_years - можно выводить
                            //echo "Прошло уже более ".(int)$final_years." лет.";
                        }
                        ?>


                        <tr class="roster__row">
                            <td class="roster__player">
                                <div class="roster__photo">
                                    <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" ><img src="<?= CFile::GetPath($arItem["PREVIEW_PICTURE"]) ? CFile::GetPath($arItem["PREVIEW_PICTURE"]) : '/images/logo.png' ?>" alt="player"></a>
                                </div>
                                <div class="roster__name"><a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" ><?= $arItem['NAME'] ?></a></div>
                            </td>
                            <td class="roster__number"><?= $itemProp['NUMBER']['VALUE'] ?></td>
                            <td class="roster__position"><?= $itemProp['ROLE']['VALUE_ENUM'] ?></td>
                            <td class="roster__date"><?= $itemProp['DATE_BIRTH']['VALUE'] ? ( (int) $date->format('d') . ' ' . $months_array[$date->format('m')] . ' ' . $date->format('Y') ) : '' ?></td>
                            <td class="roster__age"><?= $itemProp['DATE_BIRTH']['VALUE'] ? (int) $final_years : '' ?></td>
                            <td class="roster__height"><?= $itemProp['HEIGHT']['VALUE'] ?></td>
                            <td class="roster__weight"><?= $itemProp['WEIGHT']['VALUE'] ?></td>
                            <td class="roster__grip"><?= $itemProp['GRIP']['VALUE_ENUM'] ?></td>
                        </tr>
                    <? endforeach; ?>

                </tbody>
            </table>
        </div>
    <?php endif; ?>
    <p class="team__title">
        Матчи
    </p>



    <div class ="main-tabulation">
        <table class="roster">
            <tbody>

                <tr class="calendar__row calendar__row-cust">
                    <th>Дата, Время</th>
                    <th>Стадия</th>
                    <th>Команда А</th>
                    <th>Счет</th>
                    <th>Команда Б</th>
                </tr>


                <? foreach ($arResult["GAMES"] as $gID) { ?>
                    <? $game_props = CIBlockElement::GetProperty(10, $gID, array("sort" => "asc"), Array()); ?>
                    <? $gPROPS = array(); ?>
                    <?
                    while ($ar_props = $game_props->Fetch()) {
                        $gPROPS[$ar_props['CODE']] = $ar_props;
                    }
                    ?>
                    <tr class="calendar__row calendar__row-cust">
                        <td class="fw-400"><?= str_replace(" ", "<br>", substr($gPROPS['DATE']['VALUE'], 0, -3)) ?> МСК</td>
                        <td class="fw-400"><?= $gPROPS['STAGE']['VALUE_ENUM'] ?></td>
                        <? $TEAM1 = CIBlockElement::GetByID($gPROPS['TEAM1']['VALUE'])->GetNext(); ?>
                        <td class ="professional-portrait team">
                            <a href="<?= $TEAM1['DETAIL_PAGE_URL'] ?>">
                                <img src = "<?= $TEAM1['PREVIEW_PICTURE'] ? CFile::GetPath($TEAM1['PREVIEW_PICTURE']) : '/images/logo.png' ?>" alt ="player">
                            </a>
                            <div class ="team-info">
                                <p class ="team-name"><?= $TEAM1['NAME'] ?></p>
                            </div>
                        </td>
                        <td class="fw-400">
                            <?
                            $resGame = CIBlockElement::GetByID($gID);
                            $game_el = $resGame->GetNext();
                            ?>
                            <a href='<?= $game_el['DETAIL_PAGE_URL'] ?>'>
                                            <!-- <p style="color:red">LIVE</p> -->
                                <?
                                $dateM = new DateTime();
                                if ($dateM->format('d.m.Y H:i:s') >= $itemProp['DATE']['VALUE'] && $itemProp['GAME_OVER']['VALUE_ENUM'] != "Да") {
                                    ?>
                                    <!--<div class ="live">
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 122.88 69.01" style="enable-background:new 0 0 122.88 69.01" xml:space="preserve"><style type="text/css"><![CDATA[
                                                .st0{
                                                    fill-rule:evenodd;
                                                    clip-rule:evenodd;
                                                    fill:#E74040;
                                                }
                                                .st1{
                                                    fill:#242424;
                                                }
                                                ]]></style><g><path class="st0" d="M6.78,9.11H91.9c-0.15,0.81-0.25,1.65-0.3,2.49c-0.27,5.16,1.57,9.95,4.77,13.51 c3.06,3.4,7.37,5.69,12.26,6.12c0.34,0.05,0.69,0.08,1.05,0.08V31.3c0.73,0.02,1.45,0.01,2.16-0.05v30.98 c0,3.72-3.06,6.78-6.78,6.78H6.78C3.06,69.01,0,65.96,0,62.23V15.88C0,12.16,3.05,9.11,6.78,9.11L6.78,9.11L6.78,9.11z M110.97,0.02c6.94,0.37,12.26,6.29,11.89,13.23c-0.37,6.94-6.29,12.26-13.23,11.89c-6.94-0.37-12.26-6.29-11.89-13.23 C98.11,4.98,104.03-0.35,110.97,0.02L110.97,0.02z M110.71,4.71c2.18,0.12,4.1,1.1,5.45,2.6c1.35,1.5,2.12,3.51,2.01,5.69 c-0.12,2.18-1.1,4.1-2.6,5.45c-1.5,1.35-3.51,2.13-5.69,2.01c-2.18-0.12-4.11-1.1-5.45-2.6c-1.35-1.5-2.12-3.51-2.01-5.69 c0.12-2.18,1.1-4.11,2.6-5.45C106.53,5.37,108.54,4.59,110.71,4.71L110.71,4.71z M28.15,22.07v27.19h5.63v6.79h-15V22.07H28.15 L28.15,22.07L28.15,22.07z M46.4,22.07v33.98h-9.36V22.07H46.4L46.4,22.07L46.4,22.07z M73.28,22.07l-4.73,33.98H54.39l-5.42-33.98 h9.86c1.11,9.37,1.92,17.3,2.43,23.78c0.5-6.55,1.02-12.36,1.54-17.44l0.62-6.34H73.28L73.28,22.07L73.28,22.07z M75.86,22.07 h15.59v6.79h-6.22v6.49h5.82v6.44h-5.82v7.48h6.86v6.79H75.86V22.07L75.86,22.07L75.86,22.07z"/><path class="st1" d="M110.56,7.69c2.7,0.14,4.77,2.45,4.63,5.14c-0.14,2.7-2.45,4.77-5.14,4.63c-2.7-0.14-4.77-2.45-4.63-5.14 S107.86,7.55,110.56,7.69L110.56,7.69z"/></g></svg>
                                    </div>-->
                                <? } ?>
                                <?= str_replace(':', ' : ', $arResult['GAMES_R'][$gID]['RESULT']) ?> 
                                <?
                                if ($arResult['GAMES_R'][$gID]['BULLIT']) {
                                    echo "СБ";
                                } else if ($arResult['GAMES_R'][$gID]['OVERTIME']) {
                                    echo "ОТ";
                                }
                                ?>
                            </a>
                        </td>
    <? $TEAM2 = CIBlockElement::GetByID($gPROPS['TEAM2']['VALUE'])->GetNext(); ?>
                        <td class ="professional-portrait team">
                            <a href="<?= $TEAM2['DETAIL_PAGE_URL'] ?>">
                                <img src = "<?= $TEAM2['PREVIEW_PICTURE'] ? CFile::GetPath($TEAM2['PREVIEW_PICTURE']) : '/images/logo.png' ?>" alt ="player">
                            </a>
                            <div class ="team-info">
                                <p class ="team-name"><?= $TEAM2['NAME'] ?></p>
                            </div>
                        </td>

                    </tr>
<? } ?>

            </tbody>
        </table>
    </div>

</div>

