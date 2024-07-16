<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

$strReturn .= '<div class="pagination">';


$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	$nextRef = ($index < $itemSize-2 && $arResult[$index+1]["LINK"] <> ""? ' itemref="bx_breadcrumb_'.($index+1).'"' : '');


	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= $arrow.'
				<a href="'.$arResult[$index]["LINK"].'" class="pagination__link" title="'.$title.'">
					'.$title.'
				</a>';
	}
	else
	{
		$strReturn .= '
			<a class="pagination__link pagination__link--last">
				'.$title.'
			</a>';
	}
}
	$strReturn .= '</div>';


return $strReturn;
 	
	