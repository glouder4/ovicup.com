<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?$APPLICATION->ShowTitle();?></title>
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" /> 
	<?$APPLICATION->ShowHead();?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,900;1,300;1,400&family=Nunito:wght@300;400;500;700;800;900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="/css/style.min.css">
    <link rel ="stylesheet" href = "/css/cssnocompile/global.css">
	<link
		rel="stylesheet"
		href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
		/>
    <link rel ="stylesheet" href = "/css/banners-3.css">
	
	<script>
	document.addEventListener('DOMContentLoaded', function(){

		if (document.getElementsByClassName('team-card')[0] || document.getElementsByClassName('player')[0] || document.getElementsByClassName('calendar-single__top')[0] ) {
			document.getElementsByClassName('title__head')[0].style.display = "none";
		}
		


	});
	</script>
	
	
</head>


<body>
<?$APPLICATION->ShowPanel();?>

    <header class="header">
		 <div class="header-top">
            <div class="container">
                <div class="header-top__row">
                    <p class="header-top__left">
                        Детско-юношеский хоккейный турнир «Кубок Александра Овечкина»
                    </p>
                    <div class="header-top__right">
                        <a href="https://www.youtube.com/@ovicup" class="header-top__youtube">
                            <img src="/images/youtube.svg" alt="youtube">
                            <span>Трансляции на YouTube</span>
                        </a>
                        <!--<a href="https://www.instagram.com/ovi_cup" class="header-top__youtube">
                            <img src="/images/inst.png" alt="inst">
                            <span>Ovi_cup</span>
                        </a>-->
                        <a href="https://vk.com/ovicup" class="header-top__vk">
                            <img src="/images/vk.svg" alt="vk">
                            <span>OviCup в ВК</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
		
        <div class="header-bottom">
            <div class="container">
               
                    <?$APPLICATION->IncludeComponent(
						"bitrix:menu", 
						"main_menu", 
						array(
							"ALLOW_MULTI_SELECT" => "N",
							"CHILD_MENU_TYPE" => "left",
							"DELAY" => "N",
							"MAX_LEVEL" => "1",
							"MENU_CACHE_GET_VARS" => array(
							),
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_TYPE" => "N",
							"MENU_CACHE_USE_GROUPS" => "N",
							"MENU_THEME" => "site",
							"ROOT_MENU_TYPE" => "header",
							"USE_EXT" => "N",
							"COMPONENT_TEMPLATE" => "main_menu"
						),
						false
					);?>

                <div class ="header-mobile-row">
					<a class ="header-mobile-logo" href ="/">
                        <img src = "/images/moblogo.png">
                    </a>
                    <div class ="right-block">
                     
                            <a href="https://www.youtube.com/@ovicup" class="header-mobile__youtube">
                                <img src="/images/Vectoryoutube.svg" alt="youtube">
                            </a>
                           <!-- <a href="https://www.instagram.com/ovi_cup" class="header-mobile__youtube">
                                <img src="/images/instsvg.svg" alt="instagram">
                            </a> -->
                            <a href="https://vk.com/ovicup" class="header-mobile__vk">
                                <img src="/images/Vectorvk.svg" alt="vk">
                            </a>
                            <div class ="header-burger-button">
                                <img src ="/images/burger.svg" alt="burger" class ="burger-open">
                                <img src ="/images/Closeb.svg" alt="close" class ="burger-close">
                            </div>
                      
                    </div>
					
					
                    <div class ="header-mobile-menu">
                        <?$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"mobile_menu",
						Array(
							"ALLOW_MULTI_SELECT" => "N",
							"CHILD_MENU_TYPE" => "mobileleft",
							"COMPONENT_TEMPLATE" => "mobile_menu",
							"DELAY" => "N",
							"MAX_LEVEL" => "2",
							"MENU_CACHE_GET_VARS" => array(),
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_TYPE" => "N",
							"MENU_CACHE_USE_GROUPS" => "N",
							"MENU_THEME" => "site",
							"ROOT_MENU_TYPE" => "mobile",
							"USE_EXT" => "N"
						)
					);?>
                        <div class ="header-mobile-socials">
                            <a href="https://www.youtube.com/@ovicup" class="header-mobile__youtube">
                                <img src="/images/Vectoryoutube.svg" alt="youtube">
                                <span>Трансляции на YouTube</span>
                            </a>
                            <!-- <a href="https://www.instagram.com/ovi_cup" class="header-mobile__youtube header-mm-inst">
                                <img src="/images/instsvg.svg" alt="instagram">
                                <span>Ovi_cup</span>
                            </a> -->
                            <a href="https://vk.com/ovicup" class="header-mobile__vk">
                                <img src="/images/Vectorvk.svg" alt="vk">
                                <span>OviCup в ВК</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"games_slider", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "10",
		"IBLOCK_TYPE" => "cup",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "1000",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "ARENA",
			1 => "DATE",
			2 => "GAME_OVER",
			3 => "STAGE",
			4 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "PROPERTY_DATE",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "games_slider"
	),
	false
);?>

	   
    </header>
<div class="wrapper">
    <main class="main">	
        <? if ( ($APPLICATION->GetCurPage(false) === '/') || ($APPLICATION->GetCurPage(false) === '/about/') ): ?>
<div class="main--gray">
<?$APPLICATION->IncludeComponent(
	"bitrix:news.detail", 
	"banner", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" => ($APPLICATION->GetCurPage(false)==="/")?"/":explode("/",$APPLICATION->GetCurPage(false))[1],
		"ELEMENT_ID" => "",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"IBLOCK_ID" => "8",
		"IBLOCK_TYPE" => "pages",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Страница",
		"PROPERTY_CODE" => array(
			0 => "IMAGE_HEADER",
			1 => "IMAGE_TEXT",
			2 => "IMAGE_LINK_TEXT",
			3 => "IMAGE_LINK",
			4 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_SHARE" => "N",
		"COMPONENT_TEMPLATE" => "banner",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>

<? if ( ($APPLICATION->GetCurPage(false) === '/') ): ?>
	<section class="tabs">
		<div class="container">
			<div class="tabs__row">
				 <?$APPLICATION->IncludeFile("/include/main/cup_table_short.php")?> 
				 <?$APPLICATION->IncludeFile("/include/main/player_stats.php")?>
			</div>
		</div>
	</section>
<? endif; ?>
 
</div>

<div class="container">

		<?php else: ?>
			<div class="container">
			
			<?$APPLICATION->IncludeComponent(
				"bitrix:breadcrumb", 
				"breadcrumb", 
				array(
					"START_FROM" => "",
					"PATH" => "",
					"SITE_ID" => "-",
					"COMPONENT_TEMPLATE" => "breadcrumb"
				),
				false
			);?>
			<div class="title__head">
                <h1 class="title"><?$APPLICATION->ShowTitle()?></h1>
            </div>
		<? endif; ?>




		