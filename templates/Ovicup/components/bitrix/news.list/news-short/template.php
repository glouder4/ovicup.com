<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
 <section class="news news--main main__section">
	<div class="title__head">
		<h2 class="news__title title">Новости</h2>
		<?php if ($arParams["PAGER_SHOW_ALL"]) { ?>
		<div class="news__link link link--right"><a href="/press-center/news/">Все новости</a></div>
	<?php } ?>
	</div>
	<div class="news__row">
	
	<? foreach ($arResult["ITEMS"] as $key => $arItem): ?>
	
		<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="news-card">
			<img class="news-card__img" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="news">
			<div class="news-card__bottom">
				<p class="news-card__date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></p>
				<h4 class="news-card__title"><?=$arItem["NAME"] ?></h4>
				<div class="news-card__button button">
					Подробнее
				</div>
			</div>

		</a>
		
	<? endforeach; ?>
	   
	</div>

</section>


