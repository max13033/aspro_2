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
$this->addExternalCss("/bitrix/css/main/bootstrap.css");

$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx-'.$arParams['TEMPLATE_THEME'],
	'CURRENCIES' => CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true)
);
$curJsId = $this->randString();
?>

<div class="panel panel-default" >

    <div class="panel-heading"
         role="tab"
         id="heading<?=$arParams['ELEMENT_ID']?>"
         data-toggle="collapse"
         data-parent=""
         href="#collapse<?=$arParams['ELEMENT_ID']?>"
         aria-expanded="true"
         aria-controls="collapse<?=$arParams['ELEMENT_ID']?>">
        <h4 class="panel-title">
            <a role="button">
                <?=$arResult["ELEMENT"]["NAME"]?>
            </a>
            <div class="b-projects-accordion__price">
                <span class=""><?=$arResult["SET_ITEMS"]["PRICE"]?></span>
                <div class="b-projects-accordion__open-state js-accordion-state">
                    <i class="fas fa-chevron-<?=$arParams['COLLAPSE']=='in'?'up':'down'?>"></i>
                </div>
            </div>
        </h4>
    </div>
    <div id="collapse<?=$arParams['ELEMENT_ID']?>" class="panel-collapse collapse <?=$arParams['COLLAPSE']?>" role="tabpanel" aria-labelledby="heading<?=$arParams['ELEMENT_ID']?>">
        <div class="panel-body">
            <div id="bx-set-const-<?=$curJsId?>" class="bx-set-constructor container-fluid <?=$templateData['TEMPLATE_CLASS'];?>">
                <div class="row">
                    <?
                        if($_POST['action']=='updateCountProductInSet')
//                            pr($_POST);
                    ?>
                    <?/*<div class="col-sm-3">
			<div class="bx-original-item-container">
				<?if ($arResult["ELEMENT"]["DETAIL_PICTURE"]["src"]):?>
					<img src="<?=$arResult["ELEMENT"]["DETAIL_PICTURE"]["src"]?>" class="bx-original-item-image" alt="">
				<?else:?>
					<img src="<?=$this->GetFolder().'/images/no_foto.png'?>" class="bx-original-item-image" alt="">
				<?endif?>

				<div>
					<?=$arResult["ELEMENT"]["NAME"]?> <br>
					<span class="bx-added-item-new-price"><strong><?=$arResult["ELEMENT"]["PRICE_PRINT_DISCOUNT_VALUE"]?></strong> * <?=$arResult["ELEMENT"]["BASKET_QUANTITY"];?> <?=$arResult["ELEMENT"]["MEASURE"]["SYMBOL_RUS"];?></span>
					<?if (!($arResult["ELEMENT"]["PRICE_VALUE"] == $arResult["ELEMENT"]["PRICE_DISCOUNT_VALUE"])):?><span class="bx-catalog-set-item-price-old"><strong><?=$arResult["ELEMENT"]["PRICE_PRINT_VALUE"]?></strong></span><?endif?>
				</div>
			</div>
		</div>*/?>
                    <div class="col-sm-12">
                        <div class="bx-added-item-table-container">
                            <table class="bx-added-item-table">
                                <tbody data-role="set-items">
                                <?foreach($arResult["SET_ITEMS"]["DEFAULT"] as $key => $arItem):
                                    $strMainID = $this->GetEditAreaId($arItem['ID']);

                                    $arItemIDs = array(
                                        'ID' => $strMainID,
                                        'PICT' => $strMainID.'_pict',
                                        'SECOND_PICT' => $strMainID.'_secondpict',
                                        'STICKER_ID' => $strMainID.'_sticker',
                                        'SECOND_STICKER_ID' => $strMainID.'_secondsticker',
                                        'QUANTITY' => $strMainID.'_quantity',
                                        'QUANTITY_DOWN' => $strMainID.'_quant_down',
                                        'QUANTITY_UP' => $strMainID.'_quant_up',
                                        'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
                                        'BUY_LINK' => $strMainID.'_buy_link',
                                        'BASKET_ACTIONS' => $strMainID.'_basket_actions',
                                        'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
                                        'SUBSCRIBE_LINK' => $strMainID.'_subscribe',
                                        'COMPARE_LINK' => $strMainID.'_compare_link',

                                        'PRICE' => $strMainID.'_price',
                                        'DSC_PERC' => $strMainID.'_dsc_perc',
                                        'SECOND_DSC_PERC' => $strMainID.'_second_dsc_perc',
                                        'PROP_DIV' => $strMainID.'_sku_tree',
                                        'PROP' => $strMainID.'_prop_',
                                        'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
                                        'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
                                    );
                                    ?>
                                    <tr     id="set_price_wrapper-<?=$arItem['ID']?>"
                                            data-set-item="<?=$arParams['ELEMENT_ID']?>"
                                            data-id="<?=$arItem["ID"]?>"
                                            data-basket-id="<?=$arResult["BASKET_QUANTITY"][$arItem["ID"]]?>"
                                            data-img="<?=$arItem["DETAIL_PICTURE"]["src"]?>"
                                            data-url="<?=$arItem["DETAIL_PAGE_URL"]?>"
                                            data-name="<?=$arItem["NAME"]?>"
                                            data-price="<?=$arItem["PRICE_DISCOUNT_VALUE"]?>"
                                            data-print-price="<?=$arItem["PRICE_PRINT_DISCOUNT_VALUE"]?>"
                                            data-old-price="<?=$arItem["PRICE_VALUE"]?>"
                                            data-print-old-price="<?=$arItem["PRICE_PRINT_VALUE"]?>"
                                            data-diff-price="<?=$arItem["PRICE_DISCOUNT_DIFFERENCE_VALUE"]?>"
                                            data-measure="<?=$arItem["MEASURE"]["SYMBOL_RUS"];?>"
                                            data-quantity="<?=$arItem["BASKET_QUANTITY"];?>"
                                    >
                                        <td class="bx-added-item-table-cell-img">
                                            <?if ($arItem["DETAIL_PICTURE"]["src"]):?>
                                                <img src="<?=$arItem["DETAIL_PICTURE"]["src"]?>" class="img-responsive" alt="">
                                            <?else:?>
                                                <img src="<?=$this->GetFolder().'/images/no_foto.png'?>" class="img-responsive" alt="">
                                            <?endif?>
                                        </td>
                                        <td class="bx-added-item-table-cell-itemname">
                                            <a class="tdn" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
                                        </td>

                                        <td class="bx-added-item-table-cell-price">

                                            <div class="bx-added-item-table-cell-price-wrapper">
                                                <div class="bx-added-item-table-cell-price-num">
                                                    <span class="bx-added-item-new-price"><?=$arItem["PRICE_PRINT_DISCOUNT_VALUE"]?></span>
                                                    <?if ($arItem["PRICE_VALUE"] != $arItem["PRICE_DISCOUNT_VALUE"]):?>
                                                        <br><span class="bx-added-item-old-price"><?=$arItem["PRICE_PRINT_VALUE"]?></span>
                                                    <?endif?>
                                                </div>
                                                <div class="bx-added-item-table-margin-x visible-xs  hidden-xs ">X</div>
                                                <div class="counter_wrapp">
                                                    <div class="">
                                                        <div class="counter_block" data-offers="N" data-item="<?=$arItem['ID']?>">
                                                            <span class="minus">-</span>
                                                            <input
                                                                    type="text"
                                                                    class="text js-update-catalog_set_constructor"
                                                                    data-set-count='on'
                                                                    id="<? echo $arItemIDs['QUANTITY']; ?>"
                                                                    name="quantity"
                                                                    value="<?=$arItem["BASKET_QUANTITY"]?>">
                                                            <span class="plus" data-max="20000">+</span>
                                                        </div>
                                                        <div id="<? echo $arItemIDs['BASKET_ACTIONS']; ?>" class="button_block ">
                                                            <!--noindex-->
                                                            <span
                                                                    data-value="4"
                                                                    data-currency="RUB"
                                                                    class="small to-cart btn btn-default transition_bg animate-load"
                                                                    data-item="<?=$arItem['ID']?>"
                                                                    data-set-item="<?=$arParams['ELEMENT_ID']?>"
                                                                    data-float_ratio=""
                                                                    data-ratio="1"
                                                                    data-bakset_div=""
                                                                    data-props=""
                                                                    data-part_props="Y"
                                                                    data-add_props="Y"
                                                                    data-empty_props="Y"
                                                                    data-offers=""
                                                                    data-iblockid="<?=$arItem['IBLOCK_ID']?>"
                                                                    data-quantity="<?=$arItem["BASKET_QUANTITY"]?>"
                                                            ><i></i>
                                                                <span>
                                                                    В корзину
                                                                </span>
                                                            </span>

                                                            <a rel="nofollow" href="/basket/"
                                                               class="small in-cart btn btn-default transition_bg"
                                                               data-item="<?=$arItem['ID']?>" style="display:none;">
                                                                <i></i>
                                                                <span>В корзине</span>
                                                            </a>
                                                            <!--/noindex-->
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </td>
                                        <td class="bx-added-item-table-cell-del"><div class="bx-added-item-delete" data-role="set-delete-btn"></div></td>
                                    </tr>
                                <?endforeach?>
                                </tbody>
                            </table><div style="display: none;margin:20px;" data-set-message="empty-set"></div>
                        </div>
                    </div>
                </div>
                <div class="row" data-role="slider-parent-container"<?=(empty($arResult["SET_ITEMS"]["OTHER"]) ? 'style="display:none;"' : '')?>>
                    <div class="col-xs-12">
                        <div class="bx-catalog-set-topsale-slider">
                            <div class="bx-catalog-set-topsale-slider-box">
                                <div class="bx-catalog-set-topsale-slider-container">
                                    <div class="bx-catalog-set-topsale-slids bx-catalog-set-topsale-slids-<?=$curJsId?>" data-role="set-other-items">
                                        <?
                                        $first = true;
                                        foreach($arResult["SET_ITEMS"]["OTHER"] as $key => $arItem):?>
                                            <div class="bx-catalog-set-item-container bx-catalog-set-item-container-<?=$curJsId?>"
                                                 data-id="<?=$arItem["ID"]?>"
                                                 data-set-item="<?=$arParams['ELEMENT_ID']?>"
                                                 data-img="<?=$arItem["DETAIL_PICTURE"]["src"]?>"
                                                 data-url="<?=$arItem["DETAIL_PAGE_URL"]?>"
                                                 data-name="<?=$arItem["NAME"]?>"
                                                 data-price="<?=$arItem["PRICE_DISCOUNT_VALUE"]?>"
                                                 data-print-price="<?=$arItem["PRICE_PRINT_DISCOUNT_VALUE"]?>"
                                                 data-old-price="<?=$arItem["PRICE_VALUE"]?>"
                                                 data-print-old-price="<?=$arItem["PRICE_PRINT_VALUE"]?>"
                                                 data-diff-price="<?=$arItem["PRICE_DISCOUNT_DIFFERENCE_VALUE"]?>"
                                                 data-measure="<?=$arItem["MEASURE"]["SYMBOL_RUS"];?>"
                                                 data-quantity="<?=$arItem["BASKET_QUANTITY"];?>"<?
                                            if (!$arItem['CAN_BUY'] && $first)
                                            {
                                                echo 'data-not-avail="yes"';
                                                $first = false;
                                            }
                                            ?>
                                            >
                                                <div class="bx-catalog-set-item">
                                                    <div class="bx-catalog-set-item-img">
                                                        <div class="bx-catalog-set-item-img-container">
                                                            <?if ($arItem["DETAIL_PICTURE"]["src"]):?>
                                                                <img src="<?=$arItem["DETAIL_PICTURE"]["src"]?>" class="img-responsive" alt=""/>
                                                            <?else:?>
                                                                <img src="<?=$this->GetFolder().'/images/no_foto.png'?>" class="img-responsive"/>
                                                            <?endif?>
                                                        </div>
                                                    </div>
                                                    <div class="bx-catalog-set-item-title">
                                                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
                                                    </div>
                                                    <div class="bx-catalog-set-item-price">
                                                        <div class="bx-catalog-set-item-price-new"><?=$arItem["PRICE_PRINT_DISCOUNT_VALUE"]?> * <?=$arItem["BASKET_QUANTITY"];?> <?=$arItem["MEASURE"]["SYMBOL_RUS"];?></div>
                                                        <?if ($arItem["PRICE_VALUE"] != $arItem["PRICE_DISCOUNT_VALUE"]):?>
                                                            <div class="bx-catalog-set-item-price-old"><?=$arItem["PRICE_PRINT_VALUE"]?></div>
                                                        <?endif?>
                                                    </div>
                                                    <div class="bx-catalog-set-item-add-btn">
                                                        <?
                                                        if ($arItem['CAN_BUY'])
                                                        {
                                                            ?>
                                                            <a href="javascript:void(0)" data-role="set-add-btn" class="btn btn-default btn-sm"><?=GetMessage("CATALOG_SET_BUTTON_ADD")?></a>
                                                            <?
                                                        }
                                                        else
                                                        {
                                                            ?><span class="bx-catalog-set-item-notavailable"><?=GetMessage('CATALOG_SET_MESS_NOT_AVAILABLE');?></span><?
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?endforeach?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <table class="bx-constructor-result-table">
                            <tr style="display: <?=($arResult['SHOW_DEFAULT_SET_DISCOUNT'] ? 'table-row' : 'none'); ?>;">
                                <td class="bx-constructor-result-table-title"><?=GetMessage("CATALOG_SET_PRODUCTS_PRICE")?>:</td>
                                <td class="bx-constructor-result-table-value">
                                    <strong data-role="set-old-price"><?=$arResult["SET_ITEMS"]["OLD_PRICE"]?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="bx-constructor-result-table-title"><?=GetMessage("CATALOG_SET_SET_PRICE")?>:</td>
                                <td class="bx-constructor-result-table-value">
                                    <strong data-role="set-price"><?=$arResult["SET_ITEMS"]["PRICE"]?></strong>
                                </td>
                            </tr>
                            <tr style="display: <?=($arResult['SHOW_DEFAULT_SET_DISCOUNT'] ? 'table-row' : 'none'); ?>;">
                                <td class="bx-constructor-result-table-title"><?=GetMessage("CATALOG_SET_ECONOMY_PRICE")?>:</td>
                                <td class="bx-constructor-result-table-value">
                                    <strong data-role="set-diff-price"><?=$arResult["SET_ITEMS"]["PRICE_DISCOUNT_DIFFERENCE"]?></strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-4" style="text-align: center;">
                        <div class="bx-constructor-result-btn-container">
				<span class="bx-constructor-result-price" data-role="set-price-duplicate">
					<?=$arResult["SET_ITEMS"]["PRICE"]?>
				</span>
                        </div>
                        <div class="bx-constructor-result-btn-container">
                            <a href="javascript:void(0)" data-item="<?=$arParams['ELEMENT_ID']?>"  data-role="set-buy-btn" class="btn btn-default btn-sm"
                                <?=($arResult["ELEMENT"]["CAN_BUY"] ? '' : 'style="display: none;"')?>>
                                <?=GetMessage("CATALOG_SET_BUY")?>
                            </a>

                            <a href="/basket"  class="hidden small in-cart btn btn-default transition_bg js-set-basket-<?=$arParams['ELEMENT_ID']?>">В корзине</a>

                            <a href="/basket" class="btn btn-default btn-sm b-buy-cnange">
                                Купить выбранное
                            </a>

                        </div>
                    </div>
                </div>
            </div>
            <?
            $arJsParams = array(
                "numSliderItems" => count($arResult["SET_ITEMS"]["OTHER"]),
                "numSetItems" => count($arResult["SET_ITEMS"]["DEFAULT"]),
                "jsId" => $curJsId,
                "setId" => $arParams['ELEMENT_ID'],
                "parentContId" => "bx-set-const-".$curJsId,
                "ajaxPath" => $this->GetFolder().'/ajax.php',
                "canBuy" => $arResult["ELEMENT"]["CAN_BUY"],
                "currency" => $arResult["ELEMENT"]["PRICE_CURRENCY"],
                "mainElementPrice" => $arResult["ELEMENT"]["PRICE_DISCOUNT_VALUE"],
                "mainElementOldPrice" => $arResult["ELEMENT"]["PRICE_VALUE"],
                "mainElementDiffPrice" => $arResult["ELEMENT"]["PRICE_DISCOUNT_DIFFERENCE_VALUE"],
                "mainElementBasketQuantity" => $arResult["ELEMENT"]["BASKET_QUANTITY"],
                "lid" => SITE_ID,
                "iblockId" => $arParams["IBLOCK_ID"],
                "basketUrl" => $arParams["BASKET_URL"],
                "setIds" => $arResult["DEFAULT_SET_IDS"],
                "offersCartProps" => $arParams["OFFERS_CART_PROPERTIES"],
                "itemsRatio" => $arResult["BASKET_QUANTITY"],
                "noFotoSrc" => $this->GetFolder().'/images/no_foto.png',
                "messages" => array(
                    "EMPTY_SET" => GetMessage('CT_BCE_CATALOG_MESS_EMPTY_SET'),
                    "ADD_BUTTON" => GetMessage("CATALOG_SET_BUTTON_ADD")
                )
            );
            ?>
            <script type="text/javascript">
                BX.ready(function(){
                    new BX.Catalog.SetConstructor(<?=CUtil::PhpToJSObject($arJsParams, false, true, true)?>);
                });
            </script>


        </div>
    </div>
</div>



