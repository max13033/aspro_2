<?
use \Bitrix\Main\Page\Asset;
$asset = Asset::getInstance();
$asset->addJs(SITE_TEMPLATE_PATH.'/js/slick.min.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/js/owl/owl.carousel.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/js/owl/owl.autoplay.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/js/owl/owl.autoheight.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/js/owl/owl.navigation.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/js/owl/owl.support.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/js/owl/owl.animate.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/js/owl/owl.autorefresh.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/js/owl/owl.hash.js');
$asset->addCss(SITE_TEMPLATE_PATH.'/css/slick.css');
$asset->addCss(SITE_TEMPLATE_PATH.'/css/owl/owl.carousel.css');
$asset->addCss(SITE_TEMPLATE_PATH.'/css/owl/owl.theme.default.css');