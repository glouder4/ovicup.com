<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}
use Bitrix\Main\Loader; 
Loader::includeModule("highloadblock");
Loader::includeModule("iblock");

foreach ($arResult['ITEMS'] as $key=>$arItem) {
    $arResult['ITEMS'][$key]['SORT'] = 0;
    $arResult['ITEMS'][$key]['SORT1'] = 0;
    $arResult['ITEMS'][$key]['SORT2'] = 0;
    $arResult['ITEMS'][$key]['SORT3'] = 0;
    $arResult['ITEMS'][$key]['SORTTOTAL'] = 0;
    $db_props = CIBlockElement::GetProperty(1, $arItem['ID'], array("sort" => "asc"), Array('CODE'=>'RATING_CUP'));
    if($ar_props = $db_props->Fetch()) {
        $arResult['ITEMS'][$key]['SORTTOTAL'] = $ar_props['VALUE'];
    }
    $arResult['ITEMS'][$key]['RESULT_CUP']['SCORE'] = 0;
    $arResult['ITEMS'][$key]['RESULT_CUP']['SCORED'] = 0;
    $arResult['ITEMS'][$key]['RESULT_CUP']['MISSED'] = 0;
    $arResult['ITEMS'][$key]['RESULT_CUP']['P'] = 0;
    $arResult['ITEMS'][$key]['RESULT_CUP']['PO'] = 0;
    $arResult['ITEMS'][$key]['RESULT_CUP']['PB'] = 0;
    $arResult['ITEMS'][$key]['RESULT_CUP']['VB'] = 0;
    $arResult['ITEMS'][$key]['RESULT_CUP']['VO'] = 0;
    $arResult['ITEMS'][$key]['RESULT_CUP']['V'] = 0;
    $arResult['ITEMS'][$key]['RESULT_CUP']['GAMES'] = 0;
    $res = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 10, "PROPERTY_GAME_OVER"=>21, "PROPERTY_STAGE"=>16, array("LOGIC"=>"OR", array("PROPERTY_TEAM1"=>$arItem['ID']), array("PROPERTY_TEAM2"=>$arItem['ID']))), false, false, array('ID'));
    while ($arRes = $res->Fetch()) {
        //$arResult['ITEMS'][$key]['RESULT_CUP']['GAMES_LIST'][] = $arRes['ID'];
        $arGame = LenCodeStats::getGameScore($arRes['ID']);
        //$arResult['ITEMS'][$key]['RESULT_CUP_TEMP'] = $arGame;
        $arResult['ITEMS'][$key]['RESULT_CUP']['GAMES']++;
        $arResult['ITEMS'][$key]['SORT'] = $arResult['ITEMS'][$key]['SORT'] + $arGame[$arItem['ID']]['SCORE'];
        $arResult['ITEMS'][$key]['RESULT_CUP']['SCORE'] = $arResult['ITEMS'][$key]['RESULT_CUP']['SCORE'] + $arGame[$arItem['ID']]['SCORE'];
        switch ($arGame[$arItem['ID']]['SCORE']) {
            case 0:
                $arResult['ITEMS'][$key]['RESULT_CUP']['P']++;
                break;
            case 1:
                if($arGame['RESULT']['B']) {
                    $arResult['ITEMS'][$key]['RESULT_CUP']['PB']++;
                } else {
                    $arResult['ITEMS'][$key]['RESULT_CUP']['PO']++;
                }
                break;
            case 2:
                if($arGame['RESULT']['B']) {
                    $arResult['ITEMS'][$key]['RESULT_CUP']['VB']++;
                } else if($arGame['RESULT']['OT']) {
                    $arResult['ITEMS'][$key]['RESULT_CUP']['VO']++;
                } else {
                    $arResult['ITEMS'][$key]['RESULT_CUP']['V']++;
                }
                break;
        }
        $arResult['ITEMS'][$key]['RESULT_CUP']['SCORED'] = $arResult['ITEMS'][$key]['RESULT_CUP']['SCORED'] + $arGame[$arItem['ID']]['SCORED'];
        $arResult['ITEMS'][$key]['RESULT_CUP']['MISSED'] = $arResult['ITEMS'][$key]['RESULT_CUP']['MISSED'] + $arGame[$arItem['ID']]['MISSED'];
    }
    $arResult['ITEMS'][$key]['SORT2'] = $arResult['ITEMS'][$key]['RESULT_CUP']['V'];
    $arResult['ITEMS'][$key]['SORT1'] = $arResult['ITEMS'][$key]['RESULT_CUP']['DIFF'] = $arResult['ITEMS'][$key]['RESULT_CUP']['SCORED'] - $arResult['ITEMS'][$key]['RESULT_CUP']['MISSED'];
    $arResult['ITEMS'][$key]['SORT3'] = $arResult['ITEMS'][$key]['RESULT_CUP']['SCORED'];
}
        $orderBy = [
            'SORTTOTAL' => 'asc',
            'SORT' => 'desc',
            'SORT1' => 'desc',
            'SORT2' => 'desc',
            'SORT3' => 'desc',
        ];
        $arResult['ITEMS'] = sort_nested_arrays($arResult['ITEMS'], $orderBy);
//$arResult['ITEMS'] = array_sort($arResult['ITEMS'], 'SORT1', SORT_DESC);
//$arResult['ITEMS'] = array_sort($arResult['ITEMS'], 'SORT2', SORT_DESC);