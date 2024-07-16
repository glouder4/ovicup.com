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
$property_cup = CIBlockPropertyEnum::GetList(Array("SORT"=>"ASC", "ID"=>"DESC"), Array("IBLOCK_ID"=>1, "CODE"=>"CUP"));
while($cup_fields = $property_cup->GetNext()) {
    $CUP[$cup_fields['ID']]['NAME'] = $cup_fields['VALUE'];
    $property_group = CIBlockPropertyEnum::GetList(Array("SORT"=>"ASC", "ID"=>"DESC"), Array("IBLOCK_ID"=>1, "CODE"=>"GROUP"));
    while($group_fields = $property_group->GetNext()) {
        $CUP[$cup_fields['ID']]['GROUP'][] = $group_fields;
    }
}

$arResult['CUP'] = $CUP;