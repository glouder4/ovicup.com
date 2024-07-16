<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}

use Bitrix\Main\Loader; 
Loader::includeModule("highloadblock"); 
Loader::includeModule("iblock"); 
use Bitrix\Highloadblock as HL; 
$hlbl = 1;
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch(); 
$entity = HL\HighloadBlockTable::compileEntity($hlblock); 
$entity_data_class = $entity->getDataClass(); 

$rsData = $entity_data_class::getList(array(
        "select" => array("*"),
        "order" => array("ID" => "ASC"),
        "filter" => array("UF_GAME" => $arResult['ID']) 
    ));


$gameRes = LenCodeStats::getGameScore($arResult['ID']);
$arResult['DATA']['TEAM1']['ID'] = $gameRes['MASTER'];
$team1 = CIblockElement::GetByID($gameRes['MASTER'])->Fetch();
$arResult['DATA']['TEAM1']['IMG'] = CFile::GetPath($team1['PREVIEW_PICTURE']);
$arResult['DATA']['TEAM1']['NAME'] = $team1['NAME'];
$arResult['DATA']['TEAM2']['ID'] = $gameRes['GUEST'];
$team2 = CIblockElement::GetByID($gameRes['GUEST'])->Fetch();
$arResult['DATA']['TEAM2']['IMG'] = CFile::GetPath($team2['PREVIEW_PICTURE']);
$arResult['DATA']['TEAM2']['NAME'] = $team2['NAME'];
$arResult['DATA']['RESULT'] = $gameRes['RESULT'];

$db_props = CIBlockElement::GetProperty(10, $arResult['ID'], array("sort" => "asc"), Array("CODE"=>"SRTUCTURE1"));
while ($arStructure = $db_props->GetNext()) {
    $pl_props = CIBlockElement::GetProperty(2, $arStructure['VALUE'], array("sort" => "asc"), Array());
    while ($arPlayer = $pl_props->GetNext()) {
        switch ($arPlayer['CODE']) {
            case 'FIRST_NAME':
                $arResult['DATA']['PLAYERS']['TEAM1'][$arStructure['VALUE']]['FIRST_NAME'] = $arPlayer['VALUE'];
                break;
            case 'NAME':
                $arResult['DATA']['PLAYERS']['TEAM1'][$arStructure['VALUE']]['NAME'] = $arPlayer['VALUE'];
                break;
            case 'NUMBER':
                $arResult['DATA']['PLAYERS']['TEAM1'][$arStructure['VALUE']]['NUMBER'] = $arPlayer['VALUE'];
                break;
            case 'ROLE':
                //$arResult['DATA']['PLAYERS']['TEAM1'][$arStructure['VALUE']]['ROLE'] = $arPlayer['VALUE_ENUM'];
                switch ($arPlayer['VALUE_ENUM']) {
                    case "НАП":
                    case "Н":
                    case "Нападающий":
                        $arResult['DATA']['PLAYERS']['ROLES'][$arPlayer['VALUE']]['NAME'] = "Нападающий";
                        $arResult['DATA']['PLAYERS']['TEAM1'][$arStructure['VALUE']]['ROLE'] = "Нападающий";
                        break;
                    case "Вр":
                    case "Вр.":
                    case "Вратарь":
                        $arResult['DATA']['PLAYERS']['ROLES'][$arPlayer['VALUE']]['NAME'] = "Вратарь";
                        $arResult['DATA']['PLAYERS']['TEAM1'][$arStructure['VALUE']]['ROLE'] = "Вратарь";
                        break;
                    case "ЗАЩ":
                    case "З":
                    case "Защитник":
                        $arResult['DATA']['PLAYERS']['ROLES'][$arPlayer['VALUE']]['NAME'] = "Защитник";
                        $arResult['DATA']['PLAYERS']['TEAM1'][$arStructure['VALUE']]['ROLE'] = "Защитник";
                        break;
                }
                $arResult['DATA']['PLAYERS']['ROLES'][$arPlayer['VALUE']]['PLAYERS']['TEAM1'][] = $arStructure['VALUE'];
                break;
        }
    }
}

$db_props = CIBlockElement::GetProperty(10, $arResult['ID'], array("sort" => "asc"), Array("CODE"=>"SRTUCTURE2"));
while ($arStructure = $db_props->GetNext()) {
    $pl_props = CIBlockElement::GetProperty(2, $arStructure['VALUE'], array("sort" => "asc"), Array());
    while ($arPlayer = $pl_props->GetNext()) {
        switch ($arPlayer['CODE']) {
            case 'FIRST_NAME':
                $arResult['DATA']['PLAYERS']['TEAM2'][$arStructure['VALUE']]['FIRST_NAME'] = $arPlayer['VALUE'];
                break;
            case 'NAME':
                $arResult['DATA']['PLAYERS']['TEAM2'][$arStructure['VALUE']]['NAME'] = $arPlayer['VALUE'];
                break;
            case 'NUMBER':
                $arResult['DATA']['PLAYERS']['TEAM2'][$arStructure['VALUE']]['NUMBER'] = $arPlayer['VALUE'];
                break;
            case 'ROLE':
                //$arResult['DATA']['PLAYERS']['TEAM2'][$arStructure['VALUE']]['ROLE'] = $arPlayer['VALUE_ENUM'];
                switch ($arPlayer['VALUE_ENUM']) {
                    case "НАП":
                    case "Н":
                    case "Нападающий":
                        $arResult['DATA']['PLAYERS']['ROLES'][$arPlayer['VALUE']]['NAME'] = "Нападающий";
                        $arResult['DATA']['PLAYERS']['TEAM2'][$arStructure['VALUE']]['ROLE'] = "Нападающий";
                        break;
                    case "Вр":
                    case "Вр.":
                    case "Вратарь":
                        $arResult['DATA']['PLAYERS']['ROLES'][$arPlayer['VALUE']]['NAME'] = "Вратарь";
                        $arResult['DATA']['PLAYERS']['TEAM2'][$arStructure['VALUE']]['ROLE'] = "Вратарь";
                        break;
                    case "ЗАЩ":
                    case "З":
                    case "Защитник":
                        $arResult['DATA']['PLAYERS']['ROLES'][$arPlayer['VALUE']]['NAME'] = "Защитник";
                        $arResult['DATA']['PLAYERS']['TEAM2'][$arStructure['VALUE']]['ROLE'] = "Защитник";
                        break;
                }
                $arResult['DATA']['PLAYERS']['ROLES'][$arPlayer['VALUE']]['PLAYERS']['TEAM2'][] = $arStructure['VALUE'];
                break;
        }
    }
}

$scored1 = 0;
$scored2 = 0;
while($arData = $rsData->Fetch()){
    if ($arData["UF_SCORED"]>0) {
        if ($arData["UF_TEAM"] == $team1['ID']) {
            $arResult['DATA']['PLAYERS']['TEAM1'][$arData["UF_SCORED"]]['SCORED']++;
            $scored1++;
        } else if ($arData["UF_TEAM"] == $team2['ID']) {
            $arResult['DATA']['PLAYERS']['TEAM2'][$arData["UF_SCORED"]]['SCORED']++;
            $scored2++;
        }
        if ($arData["UF_ASSISTANT"]>0) {
            if ($arData["UF_TEAM"] == $team1['ID']) {
                $arResult['DATA']['PLAYERS']['TEAM1'][$arData["UF_ASSISTANT"]]['ASSISTANT']++;
            } else if ($arData["UF_TEAM"] == $team2['ID']) {
                $arResult['DATA']['PLAYERS']['TEAM2'][$arData["UF_ASSISTANT"]]['ASSISTANT']++;
            }
        }
        if ($arData["UF_ASSISTANT2"]>0) {
            if ($arData["UF_TEAM"] == $team1['ID']) {
                $arResult['DATA']['PLAYERS']['TEAM1'][$arData["UF_ASSISTANT2"]]['ASSISTANT']++;
            } else if ($arData["UF_TEAM"] == $team2['ID']) {
                $arResult['DATA']['PLAYERS']['TEAM2'][$arData["UF_ASSISTANT2"]]['ASSISTANT']++;
            }
        }
        if ($arData["UF_MISSED"]>0) {
            if ($arData["UF_TEAM"] == $team2['ID']) {
                $arResult['DATA']['PLAYERS']['TEAM1'][$arData["UF_MISSED"]]['MISSED']++;
            } else if ($arData["UF_TEAM"] == $team1['ID']) {
                $arResult['DATA']['PLAYERS']['TEAM2'][$arData["UF_MISSED"]]['MISSED']++;
            }
        }
        $arResult['DATA']['PROTOCOL'][$arData['ID']]['RESULT'] = $scored1.":".$scored2;
        $arResult['DATA']['PROTOCOL'][$arData['ID']]['TIME'] = sprintf("%02d", $arData["UF_MINUTE"]).":".sprintf("%02d", $arData["UF_SECOND"]);
        $arResult['DATA']['PROTOCOL'][$arData['ID']]['TEAM'] = $arData["UF_TEAM"];
        $arResult['DATA']['PROTOCOL'][$arData['ID']]['SCODED'] = $arData["UF_SCORED"];
        $arResult['DATA']['PROTOCOL'][$arData['ID']]['ASSISTANT'] = $arData["UF_ASSISTANT"];
        $arResult['DATA']['PROTOCOL'][$arData['ID']]['ASSISTANT2'] = $arData["UF_ASSISTANT2"];
        $arResult['DATA']['PROTOCOL'][$arData['ID']]['MISSED'] = $arData["UF_MISSED"];
        $arResult['DATA']['PROTOCOL'][$arData['ID']]['SITUATION'] = $arData["UF_SITUATION"];
    }
}