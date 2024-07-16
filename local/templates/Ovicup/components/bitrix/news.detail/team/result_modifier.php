<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}
use Bitrix\Main\Loader; 
Loader::includeModule("highloadblock");
Loader::includeModule("iblock");

    $arResult['RESULT_CUP']['SCORE'] = 0;
    $arResult['RESULT_CUP']['GAMES'] =0;
    $arResult['RESULT_CUP']['V'] = 0;
    $res = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 10, "PROPERTY_GAME_OVER"=>21, array("LOGIC"=>"OR", array("PROPERTY_TEAM1"=>$arResult['ID']), array("PROPERTY_TEAM2"=>$arResult['ID']))), false, false, array('ID'));
    while ($arRes = $res->Fetch()) {
        $arGame = LenCodeStats::getGameScore($arRes['ID']);
        $arResult['GAMES_R'][$arRes['ID']]["RESULT"] = $arGame['RESULT']['TOTAL'];
        $arResult['GAMES_R'][$arRes['ID']]["OVERTIME"] = $arGame['RESULT']['OT'];
        $arResult['GAMES_R'][$arRes['ID']]["BULLIT"] = $arGame['RESULT']['B'];
        
        $arResult['GAMES'][] = $arRes['ID'];
        $arResult['RESULT_CUP']['GAMES']++;
        $arResult['RESULT_CUP']['SCORE'] = $arResult['RESULT_CUP']['SCORE'] + $arGame[$arResult['ID']]['SCORE'];
        if($arGame[$arResult['ID']]['SCORE'] == 2) {
            $arResult['RESULT_CUP']['V']++;
        }
    }