<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>


<div class="pages__tab-row">
	<div class="tab-tour__tabs tab-card__tabs">
	
	<? //группы ?>
	<? foreach ($arResult['CUP'][$GLOBALS['teamFilter']['PROPERTY_CUP']]['GROUP'] as $GROUP) { ?>  
		<div class="tab-tour-tab tab-card-tab tab-card-js <?= ($GROUP['ID'] == $GLOBALS['teamFilter']['PROPERTY_GROUP']) ? "active" : "" ?> "><a href="?cup=<?= $GLOBALS['teamFilter']['PROPERTY_CUP'] ?>&group=<?= $GROUP['ID'] ?>" ><?= $GROUP["NAME"] ?></a></div>
	<? } ?>


	</div>
	

	<div class ="tourney-list-wrapper calendar-list">
		<div class = "tab-card-tab tab-tourneys">
			<?foreach($arResult['CUP'] as $CUP) { ?>
				<?php if ($CUP['ID'] == $GLOBALS['teamFilter']['PROPERTY_CUP']) { ?>
				<p><span class ="tab-card-tab__textcontent"><?= $CUP["NAME"] ?></span>
					<svg width="15" height="8" viewBox="0 0 15 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0.207031 1.39172L1.22893 0.5L7.20703 5.76115L13.1851 0.5L14.207 1.39172L7.20703 7.5L0.207031 1.39172Z" fill="white"/>
					</svg>
				</p>
				<?php } ?>
			<? } ?>
		</div>
		
		<div class ="ajax-list" id="cup">  
			<? //турниры?>
			<?foreach($arResult['CUP'] as $CUP) { ?>
				<a value="<?= $CUP['ID'] ?>" <?= ($CUP['ID'] == $GLOBALS['teamFilter']['PROPERTY_CUP']) ? "selected" : "" ?> href="?cup=<?= $CUP['ID'] ?>" ><?= $CUP["NAME"] ?></a>
			<? } ?>

			<script>
				BX.bind(BX('cup'), 'change', function () {
					location.href = '?cup=' + this.options[this.selectedIndex].value;
				});
			</script>
		</div>    
	</div>
	
	
	
</div>


<div class="teams-content">
	<div class="teams-tab-content tab-content-js active">
		<div class="team">
			<div class="teams__cards">
			
				<? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
					<?= $arResult["NAV_STRING"] ?><br />
				<? endif; ?>  
				
				
				<? foreach ($arResult["ITEMS"] as $arItem): ?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
					
					<div class="teams-card">
						<div class="teams-card__img">
							<a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>">
							
								<? if ($arParams["DISPLAY_PICTURE"] != "N" ): ?>				
									
									<div class="teams-card__logo">
										<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ? $arItem["PREVIEW_PICTURE"]["SRC"] : '/images/footer-logo.png' ?>" alt="teams">
									</div>
									
								<? endif ?>
								
								<? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
									<div class="teams-card__title"><? echo $arItem["NAME"] ?></div>
								<? endif; ?>
								
								<? if ($arItem["PROPERTIES"]["CITY"]["VALUE"]): ?>
									<div class="teams-card__city"><? echo $arItem["PROPERTIES"]["CITY"]["VALUE"] ?></div>
								<? endif; ?>
								
							</a>
						</div>
					</div>
				<? endforeach; ?>

				
				<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
					<br /><?= $arResult["NAV_STRING"] ?>
				<? endif; ?>
				
			</div>
		</div>
	</div>
</div>


