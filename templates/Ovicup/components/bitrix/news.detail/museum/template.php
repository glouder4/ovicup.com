<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<style>

    .swiper-slide {
        background-size: cover;
        background-position: center;
    }

    .swiper-student-2 {
        height: 80%;
        width: 100%;
    }

    .swiper-student {
        height: 20%;
        box-sizing: border-box;
        padding: 10px 0;

    }

    .swiper-student .swiper-wrapper {
        display: flex;
        justify-content: center;
    }

    .swiper-student .swiper-slide {
        width: 25%;
        height: 100%;
    }

    .swiper-student .swiper-slide-thumb-active {
        opacity: 1;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .news-sliders{
        padding: 0;
        border: none;
    }

    .news-sliders__top{
        border-bottom: none;
        padding: 0;
    }

    .news-sliders__bottom{
        padding: 20px 45px;
        position: relative;
    }


    .news-sliders .swiper-student{
        padding: 0;
    }

    .news-sliders__bottom .swiper-slide{
        width: 100px;
    }

    .news-sliders__bottom .swiper-slide img{
        width: 100px;
        height: 100px;
        border-radius: 7px;
    }

    .news-sliders__bottom .swiper-next{
        top: 43%;
    }

    .news-sliders__bottom .swiper-prev{
        top: 43%;
    }
</style>



<div class="news-detail">
	<div class="news-detail__row">
		<div class="news-detail__left">
			<p class="news-detail__main-text">
				<?=$arResult['PREVIEW_TEXT']?>                        
			</p>
			<p class="news-detail__text">
				<?=$arResult['DETAIL_TEXT']?>   
			</p>
		</div>
		
		<?php if($arResult["PREVIEW_PICTURE"]["SRC"]): ?>
		<div class="news-detail__right">
			<div class="news-sliders">
				<div class="news-sliders__top">
					<div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
						 class="swiper swiper-student-2">
						<div class="swiper-wrapper">
							<div data-fancybox data-src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" class="swiper-slide">
								<img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt="slider">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
		
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>