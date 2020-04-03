<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $mobileDetectedIO;
$frame = $this->createFrame()->begin("");
$hideOnMobile = $arParams['HIDE_ON_MOBILE'] == 'Y';?>

<? if (!$mobileDetectedIO->isMobile()) : ?>
    <div class="<?=$hideOnMobile ? 'hidden-xs' : ''?> main-adv-banner">
        <?
        echo $arResult["BANNER"];?>
    </div>
<? endif ?>

<?
$frame->end();