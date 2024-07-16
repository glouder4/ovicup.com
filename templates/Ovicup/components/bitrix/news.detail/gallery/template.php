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


<div class="news-detail__date">
	<?=$arResult["TIMESTAMP_X"]?> 
</div>


<div class="news-sliders">
	<div class="news-sliders__top">
    <div class="news-prev2">
			<svg width="12" height="24" viewBox="0 0 12 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M10.4713 24L12 22.2482L2.98088 12L12 1.75183L10.4713 2.6728e-07L-9.59124e-07 12L10.4713 24Z" fill="#888E9B"/>
			</svg>
		</div>
		<div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
			 class="swiper swiper-student-2">
			<div class="swiper-wrapper">
				<?php
				foreach ($arResult["PROPERTIES"]['GALLERY_IMAGE']['VALUE'] as $arImage) {
					?>
					<div data-fancybox data-src="<?=CFile::GetPath($arImage)?>" class="swiper-slide">
						<img src="<?=CFile::GetPath($arImage)?>" alt="slider">
					</div>
					<?php 
				}
				?>
			</div>
		</div>
        <div class="news-next2">
			<svg width="12" height="24" viewBox="0 0 12 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M1.52866 24L1.72293e-07 22.2482L9.01912 12L2.18812e-06 1.75183L1.52866 2.6728e-07L12 12L1.52866 24Z" fill="#888E9B"/>
			</svg>
		</div>
	</div>
	<div class="news-sliders__bottom">
    <div class="news-prev">
			<svg width="12" height="24" viewBox="0 0 12 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M10.4713 24L12 22.2482L2.98088 12L12 1.75183L10.4713 2.6728e-07L-9.59124e-07 12L10.4713 24Z" fill="#888E9B"/>
			</svg>
		</div>
  
		<div thumbsSlider="" class="swiper swiper-student">
			<div class="swiper-wrapper">
			<?php
			foreach ($arResult["PROPERTIES"]['GALLERY_IMAGE']['VALUE'] as $arImage) {
				?>
				<div class="swiper-slide">
					<img src="<?=CFile::GetPath($arImage)?>" alt="slider">
				</div>
				<?php 
			}
			?>
			</div>
		</div>
        <div class="news-next">
			<svg width="12" height="24" viewBox="0 0 12 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M1.52866 24L1.72293e-07 22.2482L9.01912 12L2.18812e-06 1.75183L1.52866 2.6728e-07L12 12L1.52866 24Z" fill="#888E9B"/>
			</svg>
		</div>

	</div>
</div>


			
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
    let swiper = new Swiper(".swiper-student", {
        spaceBetween: 22,
        slidesPerView: 3,
   
        breakpoints:{
      
            851:{
                slidesPerView: 3,
                spaceBetween:22,
            },
            1050:{
                slidesPerView: 4,
                spaceBetween:22,
            },
            1300:{
                slidesPerView: 5,
                spaceBetween:22,
            },
            1550:{
                slidesPerView: 6,
                spaceBetween:22,
            }
        },
        navigation: {
            nextEl: ".news-next",
            prevEl: ".news-prev",
        },
    });
    let swiper2 = new Swiper(".swiper-student-2", {
        spaceBetween: 18,
        slideToClickedSlide:true,
        navigation: {
            nextEl: ".news-next2",
            prevEl: ".news-prev2",
        },
        thumbs: {
            swiper: swiper,
        },
    });
</script>