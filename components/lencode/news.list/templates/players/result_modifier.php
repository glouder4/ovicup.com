<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
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

$CUP = array();
$arFilter = Array('IBLOCK_ID'=>11, 'GLOBAL_ACTIVE'=>'Y', "SECTION_ID" => false);
$db_list = CIBlockSection::GetList(Array("ID"=>"DESC"), $arFilter, true);

while($arCUP = $db_list->Fetch()) {
    $CUP[$arCUP['ID']] = $arCUP;
}
/*
CModule::IncludeModule('iblock');
$years = array();
$arFilter = Array('IBLOCK_ID'=>2, 'GLOBAL_ACTIVE'=>'Y', "SECTION_ID" => false);
$db_list = CIBlockSection::GetList(Array("NAME"=>"DESC"), $arFilter, true);

while($arY = $db_list->Fetch()) {
    $years[$arY['ID']] = $arY;
}
*/
$arResult['CUP'] = $CUP;

foreach ($arResult['ITEMS'] as $key => $arItem) {
    $scored = 0;
    $assist = 0;
    $keep = 0;
    $miss = 0;
    $time = 0;
    if ($arItem["PROPERTIES"]["TEAM"]['VALUE']) {
        $db_props = CIBlockElement::GetProperty(1, $arItem["PROPERTIES"]["TEAM"]['VALUE'], array("sort" => "asc"), Array("CODE" => "CUP"));
        if ($ar_props = $db_props->Fetch()) {
            if ($ar_props['VALUE'] == $GLOBALS['cupFilter']['PROPERTY_CUP']) {
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
                $arResult['ITEMS'][$key]['TIME'] = $time;
                $arResult['ITEMS'][$key]['MISSED'] = $miss;
                if ($_REQUEST['role'] == "sniper") {
                    $arResult['ITEMS'][$key]['SCORE'] = $scored;
                } if ($_REQUEST['role'] == "keeper") {
                    $arResult['ITEMS'][$key]['SCORE'] = ($miss>0)?$time/$miss:$time;
                } else {
                    $arResult['ITEMS'][$key]['SCORE'] = $scored + $assist;
                }
            }
        }
    } else {
        unset($arResult['ITEMS'][$key]);
    }
    
    switch ($GLOBALS['cupFilter']['PROPERTY_ROLE']) {
        case 'bombardir':
            if ($arResult['ITEMS'][$key]['SCORE'] == 0) {
                unset($arResult['ITEMS'][$key]);
            }
            break;
        case 'sniper':
            if ($arResult['ITEMS'][$key]['SCORED'] == 0) {
                unset($arResult['ITEMS'][$key]);
            }
            break;
        case 'assistant':
            if ($arResult['ITEMS'][$key]['ASSIST'] == 0) {
                unset($arResult['ITEMS'][$key]);
            }
            break;
    }
}

switch ($_REQUEST['role']) {
    case "sniper":
        $orderBy = [
            'SCORED' => 'desc',
            'SCORE' => 'desc',
        ];
        $arResult['ITEMS'] = sort_nested_arrays($arResult['ITEMS'], $orderBy);
        break;
    case "bombardir":
        $orderBy = [
            'SCORE' => 'desc',
            'SCORED' => 'desc',
        ];
        $arResult['ITEMS'] = sort_nested_arrays($arResult['ITEMS'], $orderBy);
        break;
    case "keeper":
        $orderBy = [
            'SCORE' => 'desc',
            'MISSED' => 'desc',
        ];
        $arResult['ITEMS'] = sort_nested_arrays($arResult['ITEMS'], $orderBy);
        break;
    case "defender":
        $orderBy = [
            'SCORE' => 'desc',
            'TIME' => 'desc',
        ];
        $arResult['ITEMS'] = sort_nested_arrays($arResult['ITEMS'], $orderBy);
        break;
    case "assistant":
        $orderBy = [
            'ASSIST' => 'desc',
            'SCORE' => 'desc',
        ];
        $arResult['ITEMS'] = sort_nested_arrays($arResult['ITEMS'], $orderBy);
        break;
    default :
        $orderBy = [
            'SCORE' => 'desc',
            'SCORED' => 'desc',
        ];
        $arResult['ITEMS'] = sort_nested_arrays($arResult['ITEMS'], $orderBy);
        break;
}