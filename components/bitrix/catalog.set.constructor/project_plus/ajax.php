<?
/** @global CMain $APPLICATION */
define('NO_AGENT_CHECK', true);
define('NOT_CHECK_PERMISSIONS', true);

use Bitrix\Main\Localization\Loc,
	Bitrix\Main\Loader;


if (isset($_REQUEST['lid']) && !empty($_REQUEST['lid']))
{
	if (!is_string($_REQUEST['lid']))
		die();
	if (preg_match('/^[a-z0-9_]{2}$/i', $_REQUEST['lid']))
		define('SITE_ID', $_REQUEST['lid']);
}

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

if (!Loader::includeModule('catalog'))
	return;

Loc::loadMessages(__FILE__);

if ($_SERVER["REQUEST_METHOD"]=="POST" && strlen($_POST["action"])>0 && check_bitrix_sessid())
{
	$APPLICATION->RestartBuffer();

	switch ($_POST["action"])
	{
		case "catalogSetAdd2Basket":
			if (is_array($_POST["set_ids"]))
			{
				foreach($_POST["set_ids"] as $itemID)
				{
					if (!is_string($itemID))
						continue;
					$itemID = (int)$itemID;
					if ($itemID <= 0)
						continue;

					$product_properties = true;
					if (!empty($_POST["setOffersCartProps"]))
					{
						$product_properties = CIBlockPriceTools::GetOfferProperties(
							$itemID,
							$_POST["iblockId"],
							$_POST["setOffersCartProps"]
						);
					}
					$ratio = 1;
					if ($_POST["itemsRatio"][$itemID])
						$ratio = $_POST["itemsRatio"][$itemID];

					Add2BasketByProductID($itemID, $ratio, array("LID" => $_POST["lid"]), $product_properties);
				}
			}
        break;

        case 'updateCountProductInSet':

            /*
            CModule::includeModule('catalog');

            //$intSetType = CCatalogProductSet::TYPE_SET; // Комплекты
            $intSetType = CCatalogProductSet::TYPE_GROUP; // Наборы

            $intProductID = $_POST['setId']; // ID набора, комплекта (ID элемента инфоблока)

            $arSets = CCatalogProductSet::getAllSetsByProduct(
                $intProductID,
                $intSetType
            );

            $arSets = array_shift($arSets);
            $idProductInSet = null;

            foreach ($arSets['ITEMS'] as $id__ => $setProd){
                if($setProd['ITEM_ID'] == $_POST['product']){
                    $idProductInSet = $id__;
                }
            }

            $arSets['ITEMS'][$idProductInSet]['QUANTITY'] = $_POST['countProduct'];

            if(CCatalogProductSet::update($arSets['SET_ID'], $arSets))
                CCatalogProductSet::recalculateSetsByProduct($origId);
            else
                $error = true;

            $_POST['x'] = $arSets;
            $_POST['y'] = $idProductInSet;

            $APPLICATION->IncludeComponent("bitrix:catalog.set.constructor", "project_plus",
                array(
                    "IBLOCK_ID" => intval($_POST['iblockId']),
                    "ELEMENT_ID" => intval($_POST['setId']),
                    "PRICE_CODE" => ["BASE"],
                    "BASKET_URL" => "/basket/",
                    "CACHE_TYPE" => "N",
                    "CACHE_TIME" => "3600",
                    "BUNDLE_ITEMS_COUNT" => 60,
                    "CACHE_GROUPS" => "N",
                    "SHOW_OLD_PRICE" => "Y",
                    "SHOW_MEASURE" => "Y",
                    "SHOW_DISCOUNT_PERCENT" => "Y",
                    "CONVERT_CURRENCY" => "Y",
                    "COLLAPSE" => "in",
                    "CURRENCY_ID" => "RUB"
                ), $component, array("HIDE_ICONS" => "Y")
            );*/

        break;
	}

	die();
}