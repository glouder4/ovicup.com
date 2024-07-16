<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}

/** @var array $arParams */
/** @var array $arResult */
use Bitrix\Main\Loader; 
Loader::includeModule("highloadblock"); 
Loader::includeModule("iblock"); 
use Bitrix\Highloadblock as HL; 
use Bitrix\Main\Entity;
$hlbl = 1;
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch(); 
$entity = HL\HighloadBlockTable::compileEntity($hlblock); 
$entity_data_class = $entity->getDataClass(); 

$STATS = array();
$scored = 0;
$assist = 0;
$assist2 = 0;

$arResult['CLUB'] = CIBlockElement::GetList(array(), array("IBLOCK_ID"=>1, "PROPERTY_STRUCTURE" => $arResult['ID']), false, false, array('ID', 'NAME', 'PREVIEW_PICTURE', 'PROPERTY_CUP'))->Fetch();
$arResult['CLUB']['IMG'] = CFile::GetPath($arResult['CLUB']['PREVIEW_PICTURE']);

$games = array();
$res = CIBlockElement::GetList(array(), array("IBLOCK_ID"=>10, /*"PROPERTY_GAME_OVER" => 21,*/ array("LOGIC" => "OR", array("PROPERTY_SRTUCTURE1"=>$arResult['ID']), array("PROPERTY_SRTUCTURE2"=>$arResult['ID']))), false, false, array("ID"));
while ($arRes = $res->Fetch()) {
    $games[] = $arRes['ID'];
}
$arResult['STATS']['GAMES_TOTAL'] = (is_array($games))?count($games):0;


//по матчам

foreach ($games as $id) {
    $statGame = LenCodeStats::getGameScore($id);
    $scoredG = 0;
    $assistG = 0;
    $assist2G = 0;
    $rsData = $entity_data_class::getList(array(
        "select" => array("*"),
        "order" => array("ID" => "ASC"),
        "filter" => array("UF_GAME" => $id) 
    ));
    while($arData = $rsData->Fetch()){
        if ($arData["UF_SCORED"] == $arResult['ID']) {
            $scored++;
            $scoredG++;
        }
        if ($arData["UF_ASSISTANT"] == $arResult['ID']) {
            $assist++;
            $assistG++;
        }
        if ($arData["UF_ASSISTANT2"] == $arResult['ID']) {
            $assist2++;
            $assist2G++;
        }
    }
    $arResult['STATS']['GAMES'][$id]["GAME"] = CIBlockElement::GetByID($id)->Fetch()["NAME"];
    $arResult['STATS']['GAMES'][$id]["SCORED"] = $scoredG;
    $arResult['STATS']['GAMES'][$id]["ASSISTANT"] = $assistG;
    $arResult['STATS']['GAMES'][$id]["ASSISTANT2"] = $assist2G;
    $arResult['STATS']['GAMES'][$id]["SCORE"] = $statGame[$arResult['CLUB']['ID']]['SCORE'];
    $arResult['STATS']['GAMES'][$id]["RESULT"] = $statGame['RESULT']['TOTAL'];
    $arResult['STATS']['GAMES'][$id]["OVERTIME"] = $statGame['RESULT']['OT'];
    $arResult['STATS']['GAMES'][$id]["BULLIT"] = $statGame['RESULT']['B'];
    $arResult['STATS']['SCORE'] = $arResult['STATS']['SCORE'] + $arResult['STATS']['GAMES'][$id]["SCORE"];
}

$arResult['STATS']['SCORED'] = $scored;
$arResult['STATS']['ASSISTANT'] = $assist;
$arResult['STATS']['ASSISTANT2'] = $assist2;