<?
CModule::IncludeModule('iblock');
$CCUP = 16;

$res = CIBlockElement::GetList(
		array(),
		 array("IBLOCK_ID" => 1, 'PROPERTY_CUP'=>$CCUP),
		false, 
		false, 
		array("ID")
);
$teams_pids = array();

while($t = $res->Fetch()){
	$res1 = CIBlockElement::GetProperty(1, $t['ID'], "sort", "asc", array("CODE" => "STRUCTURE"));
	while ($ob = $res1->GetNext())
	{	
		if($ob['VALUE']){
			$teams_pids[] = $ob['VALUE'];
		}
	}
}


if (!empty($teams_pids)) {
    $GLOBALS['Sniper']["ID"] = $teams_pids;
} 
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"players_short", 
	array(
		"TYPE_PLAYER_STAT" => "S", // НЕ УДАЛЯТЬ!!!
		"CUP" => 16, // НЕ УДАЛЯТЬ!!!
		"COUNT" => 5,  // НЕ УДАЛЯТЬ!!!
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"CLASS_NAME" => "",
		"COMPONENT_TEMPLATE" => "players_short",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "Sniper",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "participants",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MEDIA_PROPERTY" => "",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "TAGS_NEW",
			2 => "IMAGES_SLIDER",
			3 => "",
		),
		"SEARCH_PAGE" => "/search/",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SLIDER_PROPERTY" => "IMAGES_SLIDER",
		"SORT_BY1" => "NAME",
		"SORT_BY2" => "NAME",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_RATING" => "N",
		"USE_SHARE" => "N"
	),
	false
);?>