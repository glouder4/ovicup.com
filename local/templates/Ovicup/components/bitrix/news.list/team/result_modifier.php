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

$CUP = array();
$arFilter = Array('IBLOCK_ID'=>11, 'GLOBAL_ACTIVE'=>'Y', "SECTION_ID" => false);
$db_list = CIBlockSection::GetList(Array("ID"=>"DESC"), $arFilter, true);

while($arCUP = $db_list->Fetch()) {
    $CUP[$arCUP['ID']] = $arCUP;
    $arFilter = Array('IBLOCK_ID'=>11, 'GLOBAL_ACTIVE'=>'Y', "SECTION_ID" => $arCUP['ID'], "%NAME" => "Группа");
    $e_list = CIBlockElement::GetList(Array("NAME"=>"ASC"), $arFilter, false, false, array());
    while ($arGroup = $e_list->Fetch()) {
        $CUP[$arCUP['ID']]['GROUP'][] = $arGroup;
    }
}

$arResult['CUP'] = $CUP;