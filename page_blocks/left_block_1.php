<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<? global $arTheme, $APPLICATION, $mobileDetectedIO;?>

<?if (CNext::IsMainPage()):?>

	<? if (!$mobileDetectedIO->isMobile()): ?>
		<?CNext::get_banners_position('SIDE', 'Y');?>
	<? endif; ?>

<?endif?>

<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
	"COMPONENT_TEMPLATE" => ".default",
		"PATH" => SITE_DIR."include/left_block/menu.left_menu.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "",
		"AREA_FILE_RECURSIVE" => "Y",
		"EDIT_TEMPLATE" => "include_area.php"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?>

<?$APPLICATION->ShowViewContent('left_menu');?>
<?$APPLICATION->ShowViewContent('under_sidebar_content');?>


<?if (!CNext::IsMainPage()):?>
	<?CNext::get_banners_position('SIDE', 'Y');?>
<?endif;?>

<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
	"COMPONENT_TEMPLATE" => ".default",
		"PATH" => SITE_DIR."include/left_block/comp_subscribe.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "",
		"AREA_FILE_RECURSIVE" => "Y",
		"EDIT_TEMPLATE" => "include_area.php"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?>
<?$APPLICATION->IncludeComponent("bitrix:main.include", "front", array(
	"COMPONENT_TEMPLATE" => "front",
		"PATH" => SITE_DIR."include/left_block/comp_news.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "",
		"AREA_FILE_RECURSIVE" => "Y",
		"EDIT_TEMPLATE" => "include_area.php",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?>
<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
	"COMPONENT_TEMPLATE" => ".default",
		"PATH" => SITE_DIR."include/left_block/comp_news_articles.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "",
		"AREA_FILE_RECURSIVE" => "Y",
		"EDIT_TEMPLATE" => "include_area.php"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?>
