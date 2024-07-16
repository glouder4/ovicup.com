<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */

/** @var CBitrixComponentTemplate $this */
use Bitrix\Main\Loader;

Loader::includeModule("highloadblock");
Loader::includeModule("iblock");

use Bitrix\Highloadblock as HL;

foreach ($arResult['ITEMS'] as $key => $arItem) {
    $scored = 0;
    $assist = 0;
    $keep = 0;
    $miss = 0;
    $time = 0;
    if ($arItem["PROPERTIES"]["TEAM"]['VALUE']) {
        $team = CIBlockElement::GetByID($arItem["PROPERTIES"]["TEAM"]['VALUE']);
        if ($arTeam = $team->Fetch()) {
            $arResult['ITEMS'][$key]['TEAM_IMG'] = CFile::GetPath($arTeam['PREVIEW_PICTURE']);
        }
        $db_props = CIBlockElement::GetProperty(1, $arItem["PROPERTIES"]["TEAM"]['VALUE'], array("sort" => "asc"), Array("CODE" => "CUP"));
        if ($ar_props = $db_props->Fetch()) {
            if ($ar_props['VALUE'] == $arParams["CUP"]) {
                $res = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 10, /*"PROPERTY_GAME_OVER" => 21,*/ array("LOGIC" => "OR", array("PROPERTY_SRTUCTURE1" => $arItem['ID']), array("PROPERTY_SRTUCTURE2" => $arItem['ID']))), false, false, array("ID"));
                while ($arGame = $res->Fetch()) {
                    $hlbl = 1;
                    $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();
                    $entity = HL\HighloadBlockTable::compileEntity($hlblock);
                    $entity_data_class = $entity->getDataClass();
                    $rsData = $entity_data_class::getList(array(
                                "select" => array("*"),
                                "order" => array("ID" => "ASC"),
                                "filter" => array("UF_GAME" => $arGame['ID'])
                    ));
                    while ($arData = $rsData->Fetch()) {
                        if ($arData["UF_SCORED"] == $arItem['ID']) {
                            $scored++;
                        }
                        if ($arData["UF_ASSISTANT"] == $arItem['ID']) {
                            $assist++;
                        }
                        if ($arData["UF_ASSISTANT2"] == $arItem['ID']) {
                            $assist++;
                        }
                        if ($arData["UF_MISSED"] == $arItem['ID']) {
                            $miss++;
                        }
                    }
                    $hlbl = 2;
                      $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();
                      $entity = HL\HighloadBlockTable::compileEntity($hlblock);
                      $entity_data_class = $entity->getDataClass();
                      $rsData = $entity_data_class::getList(array(
                      "select" => array("*"),
                      "order" => array("ID" => "ASC"),
                      "filter" => array("UF_GAME" => $arGame['ID'])
                      ));
                      while ($arData = $rsData->Fetch()) {
                      if ($arData["UF_KEEPER"] == $arItem['ID']) {
                            $keep = $keep + $arData["UF_COUNT"];
                            $time = $time + ($arData["UF_MINUTE"]*60)+($arData["UF_SECOND"]);
                      }
                      }
                }
                $arResult['ITEMS'][$key]['SCORED'] = $scored;
                $arResult['ITEMS'][$key]['ASSIST'] = $assist;
                $arResult['ITEMS'][$key]['KEEP'] = $keep;
                $arResult['ITEMS'][$key]['MISSED'] = $miss;
                $arResult['ITEMS'][$key]['TIME'] = $time;
                if ($arParams['FILTER_NAME'] == "Sniper") {
                    $arResult['ITEMS'][$key]['SCORE'] = $scored;
                } else if ($arParams['FILTER_NAME'] == "Keeper") {
                    $arResult['ITEMS'][$key]['SCORE'] = ($miss>0)?$time/$miss:$time;
                } else {
                    $arResult['ITEMS'][$key]['SCORE'] = $scored + $assist;
                }
            }
        }
    } else {
        unset($arResult['ITEMS'][$key]);
    }
}
switch ($arParams['FILTER_NAME']) {
    case "Sniper":
        $orderBy = [
            'SCORE' => 'desc',
            'SCORED' => 'desc',
        ];
        $arResult['ITEMS'] = sort_nested_arrays($arResult['ITEMS'], $orderBy);
        break;
    case "Bombardir":
        $orderBy = [
            'SCORE' => 'desc',
            'SCORED' => 'desc',
        ];
        $arResult['ITEMS'] = sort_nested_arrays($arResult['ITEMS'], $orderBy);
        break;
    case "Keeper":
        $orderBy = [
            'SCORE' => 'desc',
            'MISSED' => 'desc',
        ];
        $arResult['ITEMS'] = sort_nested_arrays($arResult['ITEMS'], $orderBy);
        break;
    case "Defender":
        $orderBy = [
            'SCORE' => 'desc',
            'SCORED' => 'desc',
        ];
        $arResult['ITEMS'] = sort_nested_arrays($arResult['ITEMS'], $orderBy);
        break;
}
if (is_array($arResult['ITEMS'])) {
    $arResult['ITEMS'] = array_slice($arResult['ITEMS'], 0, $arParams['COUNT']);
}
