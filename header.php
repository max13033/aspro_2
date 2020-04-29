<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?if(isset($GET["debug"]) && $GET["debug"] == "y")
	error_reporting(E_ERROR | E_PARSE);
IncludeTemplateLangFile(__FILE__);
global $APPLICATION, $arRegion, $arSite, $arTheme;

$arSite = CSite::GetByID(SITE_ID)->Fetch();
$htmlClass = ($_REQUEST && isset($_REQUEST['print']) ? 'print' : false);
$bIncludedModule = (\Bitrix\Main\Loader::includeModule("aspro.next"));?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>" <?=($htmlClass ? 'class="'.$htmlClass.'"' : '')?>>
<head>
	<title><?$APPLICATION->ShowTitle()?></title>
<?	$APPLICATION->ShowMeta("viewport");
	$APPLICATION->ShowMeta("HandheldFriendly");
	$APPLICATION->ShowMeta("apple-mobile-web-app-capable", "yes");
	$APPLICATION->ShowMeta("apple-mobile-web-app-status-bar-style");
	$APPLICATION->ShowMeta("SKYPE_TOOLBAR");
	include 'custom_js_add.php';	//	добавляет js и css файлы
	$APPLICATION->ShowHead();
	$APPLICATION->AddHeadString('<script>BX.message('.CUtil::PhpToJSObject( $MESS, false ).')</script>', true);
	if($bIncludedModule)CNext::Start(SITE_ID);
?>
	<!-- Web Of Trust -->
	<meta name="wot-verification" content="4c56b0b0c6a62c8c42e1"/>

	<!-- googletagmanager.com -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-TJ2WVH4');
	</script>

	<meta name="google-site-verification" content="kZ0NVBESEMnKoLQKCNL2litXLIHZNP3pMZaGW76-IlI" />
    </head>
<body class="<?=($bIncludedModule ? "fill_bg_".strtolower(CNext::GetFrontParametrValue("SHOW_BG_BLOCK")) : "");?>" id="main">
    <div id="white-curtain">Загрузка...</div>		<!-- ??? -->
	<div id="panel">	<?$APPLICATION->ShowPanel();?>	</div>	<!-- показывает админ панель Битрикса -->
	
	<noscript>
		<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TJ2WVH4"
		height="0" width="0" style="display:none;visibility:hidden"></iframe>
	</noscript>

	<?if(!$bIncludedModule):?>	<!-- если не подключился модуль aspro:next - выдавать ошибку -->
		<?$APPLICATION->SetTitle(GetMessage("ERROR_INCLUDE_MODULE_ASPRO_NEXT_TITLE"));?>
		<center><?$APPLICATION->IncludeFile(SITE_DIR."include/error_include_module.php");?></center>
		</body>
		</html>

		<?die();?>
	<?endif;?>

	<?$arTheme = $APPLICATION->IncludeComponent("aspro:theme.next", ".default", array("COMPONENT_TEMPLATE" => ".default"), false, array("HIDE_ICONS" => "Y"));
	//if (hasDev()) pr($arTheme);
    include_once('defines.php');
	CNext::SetJSOptions();
	if($APPLICATION->GetCurPage()=="/"):?>
	<div class="maxwidth-custom_banner"> 	<!-- текст вверху сайта на синем фоне -->
    	<div class="custom_banner">
			<div class="banner_text">
				<?$APPLICATION->IncludeFile(SITE_DIR."include/banner_text.php");?>		
			</div>
    	</div>
    </div>
	<?endif;?>
	<div class="wrapper1 <?=($isIndex && $isShowIndexLeftBlock ? "with_left_block" : "");?> <?=CNext::getCurrentPageClass();?> <?=CNext::getCurrentThemeClasses();?>">
		<?CNext::get_banners_position('TOP_HEADER');?>		

		<!-- Шапка сайта -->
		<div class="header_wrap visible-lg visible-md title-v<?=$arTheme["PAGE_TITLE"]["VALUE"];?><?=($isIndex ? ' index' : '')?>">
			<header id="header">
				<?CNext::ShowPageType('header');?>
			</header>
		</div>
		<?CNext::get_banners_position('TOP_UNDERHEADER');?>

		<!-- фиксированная шапка -->
		<?if($arTheme["TOP_MENU_FIXED"]["VALUE"] == 'Y'):?>
			<div id="headerfixed">
				<?CNext::ShowPageType('header_fixed');?>
			</div>
		<?endif;?>

<!-- search from DIGINETICA -->
		<script type="text/javascript">
			var digiScript = document.createElement('script');
			digiScript.src = '//cdn.diginetica.net/772/client.js?ts=' + Date.now();
			digiScript.defer = true;
			digiScript.async = true;
			document.body.appendChild(digiScript);
		</script>
<!-- /search from DIGINETICA -->

		<!-- мобильное меню -->
		<div id="mobileheader" class="visible-xs visible-sm">
			<?CNext::ShowPageType('header_mobile');?>
			<div id="mobilemenu" class="<?=($arTheme["HEADER_MOBILE_MENU_OPEN"]["VALUE"] == '1' ? 'leftside':'dropdown')?>">
				<?CNext::ShowPageType('header_mobile_menu');?>
			</div>
		</div>

		<?/*filter for contacts*/
		if($arRegion){
			if($arRegion['LIST_STORES'] && !in_array('component', $arRegion['LIST_STORES'])){
				if($arTheme['STORES_SOURCE']['VALUE'] != 'IBLOCK'){
					$GLOBALS['arRegionality'] = array('ID' => $arRegion['LIST_STORES']);
				}
				else{
					$GLOBALS['arRegionality'] = array('PROPERTY_STORE_ID' => $arRegion['LIST_STORES']);
				}
			}
		}
		if($isIndex){
			$GLOBALS['arrPopularSections'] = array('UF_POPULAR' => 1);
			$GLOBALS['arrFrontElements'] = array('PROPERTY_SHOW_ON_INDEX_PAGE_VALUE' => 'Y');
		}?>

		<div class="wraps hover_<?=$arTheme["HOVER_TYPE_IMG"]["VALUE"];?>" id="content">
			<?if(!$is404 && !$isForm && !$isIndex):?>
				<?$APPLICATION->ShowViewContent('section_bnr_content');?>
				<?if($APPLICATION->GetProperty("HIDETITLE") !== 'Y'):?>
					<!--title_content-->
					<?CNext::ShowPageType('page_title');?>
					<!--end-title_content-->
				<?endif;?>
				<?$APPLICATION->ShowViewContent('top_section_filter_content');?>
			<?endif;?>

			<?if($isIndex):?>
				<div class="wrapper_inner front <?=($isShowIndexLeftBlock ? "" : "wide_page");?>">
			<?elseif(!$isWidePage):?>
				<div class="wrapper_inner <?=($isHideLeftBlock ? "wide_page" : "");?>">
			<?endif;?>

				<?if(($isIndex && $isShowIndexLeftBlock) || (!$isIndex && !$isHideLeftBlock) && !$isBlog):?>
					<div class="right_block <?=(defined("ERROR_404") ? "error_page" : "");?> wide_<?=CNext::ShowPageProps("HIDE_LEFT_BLOCK");?>">
				<?endif;?>
					<div class="middle <?=($is404 ? 'error-page' : '');?>">
						<?CNext::get_banners_position('CONTENT_TOP');?>
						<?if(!$isIndex):?>
							<div class="container">
								<?//h1?>
								<?if($isHideLeftBlock && !$isWidePage):?>
									<div class="maxwidth-theme">
								<?endif;?>
								<?if($isBlog):?>
									<div class="row">
										<div class="col-md-9 col-sm-12 col-xs-12 content-md <?=CNext::ShowPageProps("ERROR_404");?>">
								<?endif;?>
						<?endif;?>
						<?CNext::checkRestartBuffer();?>