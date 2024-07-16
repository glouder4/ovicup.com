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

foreach ($arResult['ITEMS'] as $key=>$arItem) {
    $gameRes = LenCodeStats::getGameScore($arItem['ID']);
    $arResult['ITEMS'][$key]['DATA']['TEAM1']['ID'] = $gameRes['MASTER'];
    $team1 = CIblockElement::GetByID($gameRes['MASTER'])->Fetch();
    $arResult['ITEMS'][$key]['DATA']['TEAM1']['IMG'] = CFile::GetPath($team1['PREVIEW_PICTURE']);
    $arResult['ITEMS'][$key]['DATA']['TEAM1']['NAME'] = $team1['NAME'];
    //$arResult['ITEMS'][$key]['DATA']['TEAM1']['SHORT_NAME'] = mb_substr($team1['NAME'], 0, 3);
    $arResult['ITEMS'][$key]['DATA']['TEAM2']['ID'] = $gameRes['GUEST'];
    $team2 = CIblockElement::GetByID($gameRes['GUEST'])->Fetch();
    $arResult['ITEMS'][$key]['DATA']['TEAM2']['IMG'] = CFile::GetPath($team2['PREVIEW_PICTURE']);
    $arResult['ITEMS'][$key]['DATA']['TEAM2']['NAME'] = $team2['NAME'];
    //$arResult['ITEMS'][$key]['DATA']['TEAM2']['SHORT_NAME'] = mb_substr($team2['NAME'], 0, 3);
    
    
    $arResult['ITEMS'][$key]['DATA']['RESULT'] = $gameRes['RESULT'];
}