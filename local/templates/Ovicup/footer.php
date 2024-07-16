 </div>

    </main>
  
	 <footer class="footer">
        <div class="container">
            <a href="/" class="footer__logo">
                <img src="/images/footer-logo.png" alt="logo" class ="footer-logo">
                <img src="/images/moblogo.png" alt ="logo" class ="footer-logo-mobile">
            </a>
            <div class="footer__right">
                 <?$APPLICATION->IncludeComponent(
					"bitrix:menu",
					"footer_menu",
					Array(
						"ALLOW_MULTI_SELECT" => "N",
						"CHILD_MENU_TYPE" => "left",
						"DELAY" => "N",
						"MAX_LEVEL" => "1",
						"MENU_CACHE_GET_VARS" => array(""),
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_TYPE" => "N",
						"MENU_CACHE_USE_GROUPS" => "N",
						"MENU_THEME" => "site",
						"ROOT_MENU_TYPE" => "footer",
						"USE_EXT" => "N"
					)
				);?>
<?$year = date('Y')?>
                <div class="footer__bottom">
                    <a href="/" class="footer__politic">© <?=$year?>, «Детско-юношеский хоккейный турнир
                        «Кубок Александра Овечкина» — OviCup</a>
                    <div class="footer__social">
                        <a href="https://www.youtube.com/@ovicup" class="footer__social-row">
                            <img src="/images/vksvg.svg" alt="youtube">
                       
                        </a>
                       <!-- <a href="https://www.instagram.com/ovi_cup" class="footer__social-row">
                            <img src="/images/instsvg.svg" alt="instagram">
                       
                        </a>-->
                        <a href="https://vk.com/ovicup" class="footer__social-row">
                            <img src="/images/youtubesvg.svg" alt="vk">
                        
                        </a>
                    </div>
                    <a href="https://www.on-lineservice.ru" class="footer__made-by">
                        Разработка сайта — Онлайн-Сервис
                    </a>
                </div>
            </div>
        </div>
    </footer>
	
	
	
</div>
<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<script src="https://unpkg.com/imask"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="/js/main.min.js"></script>
<script src ="/js/additional.js"></script>


</body>

</html>

