<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>
<?=$arResult["FORM_NOTE"]?>
<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>

<script src='https://www.google.com/recaptcha/api.js'></script>


<table>
<?
if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y")
{
?>
	<tr>
		<td><?
if ($arResult["isFormTitle"])
{
?>
	<h3><?//=$arResult["FORM_TITLE"]?></h3>
<?
} //endif ;

	if ($arResult["isFormImage"] == "Y")
	{
	?>
	<a href="<?=$arResult["FORM_IMAGE"]["URL"]?>" target="_blank" alt="<?=GetMessage("FORM_ENLARGE")?>"><img src="<?=$arResult["FORM_IMAGE"]["URL"]?>" <?if($arResult["FORM_IMAGE"]["WIDTH"] > 300):?>width="300"<?elseif($arResult["FORM_IMAGE"]["HEIGHT"] > 200):?>height="200"<?else:?><?=$arResult["FORM_IMAGE"]["ATTR"]?><?endif;?> hspace="3" vscape="3" border="0" /></a>
	<?//=$arResult["FORM_IMAGE"]["HTML_CODE"]?>
	<?
	} //endif
	?>

			<p><?=$arResult["FORM_DESCRIPTION"]?></p>
		</td>
	</tr>
	<?
} // endif
	?>
</table>
<br />
<table class="form-table data-table">
	<thead>
		<tr>
			<th colspan="2">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
	<?
	$i = 1;
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
		{
			echo $arQuestion["HTML_CODE"];
		}
		else
		{
	?>
	
		<tr>
			<td>
				<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
				<span class="error-fld" title="<?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID])?>"></span>
				<?endif;?>
				<?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><?=$arResult["REQUIRED_SIGN"];?><?endif;?>
				<?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>
			</td>
			<td <?php if ($arQuestion["CAPTION"]=="Телефон") { ?>class ='phone'<?php } ?>>
				<!-- <?php 
					if ($arQuestion["CAPTION"] == "Телефон") 
					{
						echo ' +7 9';
					}
				?> -->
				<div class ="input-wrap">
				<?=$arQuestion["HTML_CODE"]?>
				</div>
				<p><span color="red" id="font_error" class="form-required starrequired font_error<?=$i?>"> </span></p>
				
			</td>
		</tr>
	<?
		}
		$i++;
	} //endwhile
	?>
<?
if($arResult["isUseCaptcha"] == "Y")
{
?>
		<tr>
			<th colspan="2"><b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b></th>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" /></td>
		</tr>
		<tr>
			<td><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?></td>
			<td><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></td>
		</tr>
<?
} // isUseCaptcha
?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="2">
				<div hidden class="g-recaptcha" data-sitekey="6Lfi-3UnAAAAAOm74cGNbtDu9lWPpb7KtBTDvbic" style="margin-bottom:1em";></div>


				<input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
				&nbsp;<input type="reset" value="<?=GetMessage("FORM_RESET");?>" />
			</th>
		</tr>
	</tfoot>
</table>
<p>
<?=$arResult["REQUIRED_SIGN"];?> - <?=GetMessage("FORM_REQUIRED_FIELDS")?>
</p>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
	



if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response']) {
	$secret = '6Lfi-3UnAAAAAGUKi5e7DARhler7HgfrR8rLEAYC';
	$ip = $_SERVER['REMOTE_ADDR'];
	$response = $_POST['g-recaptcha-response'];
	$rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$ip");
	$arr = json_decode($rsp, TRUE);
	if ($arr['success']) {
		return $arr['success'];
	}
}
?>


<script>


document.addEventListener('DOMContentLoaded', function(){ 

	var inp2 = document.getElementsByName('form_text_2')[0];
	inp2.addEventListener('change', monitorE2);
	function monitorE2(e) {
		if ( inp2.value.toString().length != 12)  {
			//alert("Количество должно быть больше 0!");
			document.getElementsByClassName('font_error2')[0].innerHTML = "Введите 9 цифр!";
		} else {
			document.getElementsByClassName('font_error2')[0].innerHTML = "";
		}
	}
	
	
	var inp4 = document.getElementsByName('form_text_4')[0];
	inp4.addEventListener('change', monitorE1);
	function monitorE1(e) {
		if (inp4.value < 0){
			//alert("Количество должно быть больше 0!");
			document.getElementsByClassName('font_error4')[0].innerHTML = "Кол-во должно быть > 0!";
		} else {
			document.getElementsByClassName('font_error4')[0].innerHTML = "";
		}
		
		if (inp4.value > 4){
			//alert("Количество должно быть меньше или равно 4!");
			document.getElementsByClassName('font_error4')[0].innerHTML = "Не более 4 в одном заказе!";
		} else {
			document.getElementsByClassName('font_error4')[0].innerHTML = "";
		}
		
	}
	
});
</script>