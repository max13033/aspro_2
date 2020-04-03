<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
$this->addExternalCss("https://use.fontawesome.com/releases/v5.8.0/css/all.css");
$this->addExternalCss($templateFolder . "/swiper/css/swiper.min.css");
$this->addExternalJs($templateFolder . "/swiper/js/swiper.min.js");
$detailPhoto = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array('width' => 1400, 'height' => 1400), BX_RESIZE_IMAGE_PROPORTIONAL, true);
$productsPosition = $arResult['PROPERTIES']['PRODUCTS_PROJECT_ON_PHOTO_PROJECT'];

$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "DETAIL_PAGE_URL", "IBLOCK_ID");
$arFilter = Array("ACTIVE" => "Y", "ID" => $arResult['PROPERTIES']['PRODUCTS_ON_PHOTO_PROJECT']['VALUE']);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 300), $arSelect);
$productPlusAr = Array();

while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();

    $image = $arFields['PREVIEW_PICTURE'];
    if (!$image) $image = $arFields['DETAIL_PICTURE'];
    if (!$image) $image = false;

    if ($image) {
        $arFields['PREVIEW_PICTURE'] = Array(
            'src' => CFile::GetPath($image),
            'width' => '',
            'height' => '',
        );
    } else {
        $arFields['PREVIEW_PICTURE'] = Array(
            'src' => 'https://place-hold.it/190x190',
            'width' => '',
            'height' => '',
        );
    }

    $arFields['PRICE'] = CPrice::GetBasePrice($arFields['ID']);

    $productPlusAr[$arFields["ID"]] = $arFields;
//    pr($arFields);
}

$productsPositionSlider = [];

foreach ($productsPosition['VALUE'] as $itemPosition) {

    $isSlide = explode('/', $itemPosition);

    if ($isSlide[1]) {
        //$isSlide[0] - номер слайдера
        //$isSlide[1] - все остальное - проверить есть ли еще id

        $productsPositionSlider[$isSlide[0]][] = $isSlide[1];
    } else {

        $productsPositionSlider['detail'][] = $isSlide[0];
    }
}


//pr($productPlusAr);
//pr($arResult['PROPERTIES']);
//pr($arResult);
//pr($arParams);
//pr($productsPositionSlider);
?>
<div class="hidden js-tpl-wrp">

    <div class="js-tps-header-project">
        <div class="inner-table-block nopadding logo-block">
            <div class="logo">
                <a href="/">
                    <img src="/upload/CNext/e1e/e1e74484e1d589938f8857cab70e0c3a.svg"
                         alt="Valles"
                         title="Valles">
                </a>
            </div>
        </div>
        <div class="inner-table-block product_block table" style="width: 80%;">
            <table class="module_products_list">
                <tbody>
                <tr class="item main_item_wrapper">
                    <td class="wrapper_td">
                        <table class="inner_table">
                            <tbody>
                            <tr>
                                <td class="item-name-cell">
                                    <div class="title"><span> </span></div>
                                </td>
                                <td class="price-cell">
                                    <div class="baskets">
                                        <a rel="nofollow"
                                           class="basket-link basket-link-project basket has_prices with_price big basket-count"
                                           href="/basket/" title="В корзине товаров на 21 378 руб.">
                                            <span class="js-basket-block">
                                                <i class="svg inline  svg-inline-basket big" aria-hidden="true">
                                                    <svg
                                                            xmlns="http://www.w3.org/2000/svg" width="22" height="21"
                                                            viewBox="0 0 22 21">
                                                          <defs>
                                                            <style>
                                                              .cls-1 {
                                                                  fill: #222;
                                                                  fill-rule: evenodd;
                                                              }
                                                            </style>
                                                          </defs>
                                                          <path data-name="Ellipse 2 copy 6" class="cls-1"
                                                                d="M1507,122l-0.99,1.009L1492,123l-1-1-1-9h-3a0.88,0.88,0,0,1-1-1,1.059,1.059,0,0,1,1.22-1h2.45c0.31,0,.63.006,0.63,0.006a1.272,1.272,0,0,1,1.4.917l0.41,3.077H1507l1,1v1ZM1492.24,117l0.43,3.995h12.69l0.82-4Zm2.27,7.989a3.5,3.5,0,1,1-3.5,3.5A3.495,3.495,0,0,1,1494.51,124.993Zm8.99,0a3.5,3.5,0,1,1-3.49,3.5A3.5,3.5,0,0,1,1503.5,124.993Zm-9,2.006a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,1494.5,127Zm9,0a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,1503.5,127Z"
                                                                transform="translate(-1486 -111)"></path>
                                                    </svg>
                                                </i>
                                                <span class="wrap">
                                                    <span class="title dark_link">Корзина</span>
                                                    <span class="prices">пусто</span>
                                                </span>
                                                <span class="count">0</span>
                                            </span>
                                        </a>
                                    </div>
                                </td>
                                <td class="like_icons full">

                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="inner-table-block nopadding small-block" style="display:table-cell">
            <div class="wrap_icon wrap_cabinet">
                <?= CNext::showCabinetLink(true, false, 'big'); ?>
            </div>
        </div>
    </div>

</div>

<div class="news-detail" id="detail_project_block">

    <div class="swiper-container-project-slides">
        <div class="swiper-wrapper">

            <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])): ?>
                <div class="swiper-slide">
                    <div class="wrapper-prj-map text-center">
                        <div class="b-map-project">
                            <img
                                    class="detail_picture"
                                    border="0"
                                    src="<?= $detailPhoto["src"] ?>"
                                    alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                                    title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"
                            />

                            <? foreach ($productsPositionSlider['detail'] as $productPlus):

                                $options = explode('=', $productPlus);//id продукта
                                $cords = explode('x', $options[1]);//координаты на изображении
                                $idProducts = explode(',', $options[0]);
                                $countProduct = explode(',', $options[2]);


                                ?>

                                <? if ($idProducts[1]):

                                    foreach ($idProducts as $idProduct){

                                        $products[]=$productPlusAr[$idProduct];//список продуктов по id

                                    }

                                    $index = 0;//для количества товара.


                               // if (!is_array($product)) continue;

                                ?>
                                <!--группа товаров-->

                                <div class="b-card-plus catalog_item_wrapp b-card-plus_mul" data-open="off"
                                     style="top: <?= $cords[1] ?>px; left: <?= $cords[0] ?>px;">

                                    <a href="#open" class="b-card-plus__icon ">+</a>
                                    <div class="multiple_plus">


                                    <? foreach ($products as $product) :

                                        $strMainID = $this->GetEditAreaId($product['ID']);

                                        $arItemIDs = array(
                                            'ID' => $strMainID,
                                            'PICT' => $strMainID . '_pict',
                                            'SECOND_PICT' => $strMainID . '_secondpict',
                                            'STICKER_ID' => $strMainID . '_sticker',
                                            'SECOND_STICKER_ID' => $strMainID . '_secondsticker',
                                            'QUANTITY' => $strMainID . '_quantity',
                                            'QUANTITY_DOWN' => $strMainID . '_quant_down',
                                            'QUANTITY_UP' => $strMainID . '_quant_up',
                                            'QUANTITY_MEASURE' => $strMainID . '_quant_measure',
                                            'BUY_LINK' => $strMainID . '_buy_link',
                                            'BASKET_ACTIONS' => $strMainID . '_basket_actions',
                                            'NOT_AVAILABLE_MESS' => $strMainID . '_not_avail',
                                            'SUBSCRIBE_LINK' => $strMainID . '_subscribe',
                                            'COMPARE_LINK' => $strMainID . '_compare_link',

                                            'PRICE' => $strMainID . '_price',
                                            'DSC_PERC' => $strMainID . '_dsc_perc',
                                            'SECOND_DSC_PERC' => $strMainID . '_second_dsc_perc',
                                            'PROP_DIV' => $strMainID . '_sku_tree',
                                            'PROP' => $strMainID . '_prop_',
                                            'DISPLAY_PROP_DIV' => $strMainID . '_sku_prop',
                                            'BASKET_PROP_DIV' => $strMainID . '_basket_prop',
                                        );
                                        ?>
                                    <div class="b-card-plus__wrapper multiple_plus_wraper">
                                        <a href="#close" class="close">
                                            <i class="fas fa-times"></i>
                                        </a>
                                        <div class="b-card-plus__image img_fl">
                                            <img
                                                    src="<?= $product['PREVIEW_PICTURE']['src'] ?>"
                                                    height="<?= $product['PREVIEW_PICTURE']['height'] ?>"
                                                    width="<?= $product['PREVIEW_PICTURE']['width'] ?>"
                                                    alt="<?= $product['~NAME'] ?>">
                                        </div>
                                        <a href="<?= $product['DETAIL_PAGE_URL'] ?>" target="_blank"
                                           class="b-card-plus__title dark_link">
                                            <?= $product['~NAME'] ?>
                                        </a>
                                        <div class="cost prices">
                    <span class="price">
                        <?= CurrencyFormat($product['PRICE']['PRICE'], $product['PRICE']['CURRENCY']) ?>
                    </span>
                                        </div>
                                        <div class="counter_wrapp">
                                            <div class="counter_block" data-offers="N"
                                                 data-item="<?= $product['ID'] ?>">
                                                <span class="minus"
                                                      id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>">-</span>
                                                <input type="text" class="text" id="<? echo $arItemIDs['QUANTITY']; ?>"
                                                       name="quantity" value="<?= $countProduct[$index] ?>">
                                                <span class="plus" id="<? echo $arItemIDs['QUANTITY_UP']; ?>"
                                                      data-max="20">+</span>
                                            </div>

                                            <div id="<? echo $arItemIDs['BASKET_ACTIONS']; ?>" class="button_block ">
                                                <!--noindex-->
                                                <span
                                                        data-value="4"
                                                        data-currency="RUB"
                                                        class="small to-cart btn btn-default transition_bg animate-load"
                                                        data-item="<?= $product['ID'] ?>"
                                                        data-float_ratio=""
                                                        data-ratio="1"
                                                        data-bakset_div="bx_basket_div_29814"
                                                        data-props=""
                                                        data-part_props="Y"
                                                        data-add_props="Y"
                                                        data-empty_props="Y"
                                                        data-offers=""
                                                        data-iblockid="<?= $product['IBLOCK_ID'] ?>"
                                                        data-quantity="<?= $countProduct[$index] ?>"
                                                ><i></i>
                                        <span>
                                            В корзину
                                        </span>
                                    </span>

                                                <a rel="nofollow" href="/basket/"
                                                   class="small in-cart btn btn-default transition_bg"
                                                   data-item="<?= $product['ID'] ?>" style="display:none;">
                                                    <i></i>
                                                    <span>В корзине</span>
                                                </a>
                                                <!--/noindex-->
                                            </div>
                                        </div>

                                    </div>
                                    <? $index++; endforeach;
                                        $products = array();
                                    ?>
                                    </div>
                                </div>

                                <? else :

                                $product = $productPlusAr[$options[0]];//сам продукт выбирается базы по выбранному id

//                                pr($options);
//                                pr($cords);
//                                pr($product);


                                if (!is_array($product)) continue;

                                $strMainID = $this->GetEditAreaId($product['ID']);

                                $arItemIDs = array(
                                    'ID' => $strMainID,
                                    'PICT' => $strMainID . '_pict',
                                    'SECOND_PICT' => $strMainID . '_secondpict',
                                    'STICKER_ID' => $strMainID . '_sticker',
                                    'SECOND_STICKER_ID' => $strMainID . '_secondsticker',
                                    'QUANTITY' => $strMainID . '_quantity',
                                    'QUANTITY_DOWN' => $strMainID . '_quant_down',
                                    'QUANTITY_UP' => $strMainID . '_quant_up',
                                    'QUANTITY_MEASURE' => $strMainID . '_quant_measure',
                                    'BUY_LINK' => $strMainID . '_buy_link',
                                    'BASKET_ACTIONS' => $strMainID . '_basket_actions',
                                    'NOT_AVAILABLE_MESS' => $strMainID . '_not_avail',
                                    'SUBSCRIBE_LINK' => $strMainID . '_subscribe',
                                    'COMPARE_LINK' => $strMainID . '_compare_link',

                                    'PRICE' => $strMainID . '_price',
                                    'DSC_PERC' => $strMainID . '_dsc_perc',
                                    'SECOND_DSC_PERC' => $strMainID . '_second_dsc_perc',
                                    'PROP_DIV' => $strMainID . '_sku_tree',
                                    'PROP' => $strMainID . '_prop_',
                                    'DISPLAY_PROP_DIV' => $strMainID . '_sku_prop',
                                    'BASKET_PROP_DIV' => $strMainID . '_basket_prop',
                                );

                                ?>

                                <div class="b-card-plus catalog_item_wrapp " data-open="off"
                                     style="top: <?= $cords[1] ?>px; left: <?= $cords[0] ?>px;">
                                    <a href="#open" class="b-card-plus__icon ">+</a>
                                    <div class="b-card-plus__wrapper b-card_pos">
                                        <a href="#close" class="close">
                                            <i class="fas fa-times"></i>
                                        </a>
                                        <div class="b-card-plus__image">
                                            <img
                                                    src="<?= $product['PREVIEW_PICTURE']['src'] ?>"
                                                    height="<?= $product['PREVIEW_PICTURE']['height'] ?>"
                                                    width="<?= $product['PREVIEW_PICTURE']['width'] ?>"
                                                    alt="<?= $product['~NAME'] ?>">
                                        </div>
                                        <a href="<?= $product['DETAIL_PAGE_URL'] ?>" target="_blank"
                                           class="b-card-plus__title dark_link">
                                            <?= $product['~NAME'] ?>
                                        </a>
                                        <div class="cost prices">
                    <span class="price">
                        <?= CurrencyFormat($product['PRICE']['PRICE'], $product['PRICE']['CURRENCY']) ?>
                    </span>
                                        </div>
                                        <div class="counter_wrapp">
                                            <div class="counter_block" data-offers="N"
                                                 data-item="<?= $product['ID'] ?>">
                                                <span class="minus"
                                                      id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>">-</span>
                                                <input type="text" class="text" id="<? echo $arItemIDs['QUANTITY']; ?>"
                                                       name="quantity" value="<?= $options[2] ?>">
                                                <span class="plus" id="<? echo $arItemIDs['QUANTITY_UP']; ?>"
                                                      data-max="20">+</span>
                                            </div>

                                            <div id="<? echo $arItemIDs['BASKET_ACTIONS']; ?>" class="button_block ">
                                                <!--noindex-->
                                                <span
                                                        data-value="4"
                                                        data-currency="RUB"
                                                        class="small to-cart btn btn-default transition_bg animate-load"
                                                        data-item="<?= $product['ID'] ?>"
                                                        data-float_ratio=""
                                                        data-ratio="1"
                                                        data-bakset_div="bx_basket_div_29814"
                                                        data-props=""
                                                        data-part_props="Y"
                                                        data-add_props="Y"
                                                        data-empty_props="Y"
                                                        data-offers=""
                                                        data-iblockid="<?= $product['IBLOCK_ID'] ?>"
                                                        data-quantity="<?= $options[2] ?>"
                                                ><i></i>
                                        <span>
                                            В корзину
                                        </span>
                                    </span>

                                                <a rel="nofollow" href="/basket/"
                                                   class="small in-cart btn btn-default transition_bg"
                                                   data-item="<?= $product['ID'] ?>" style="display:none;">
                                                    <i></i>
                                                    <span>В корзине</span>
                                                </a>
                                                <!--/noindex-->
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!--  1 товар -->

                                <? endif; ?>
                            <? endforeach; ?>
                        </div>
                    </div>
                </div>
            <? endif ?>

            <? foreach ($arResult['PROPERTIES']['PHOTOS_PRODUCTS']['VALUE'] as $indexImageSlide => $imageSlide): ?>
                <div class="swiper-slide">
                    <div class="wrapper-prj-map text-center">
                        <div class="b-map-project">
                            <img
                                    class="detail_picture"
                                    border="0"
                                    src="<?= CFile::GetPath($imageSlide) ?>"
                                    alt=" "
                                    title=" "
                            />

                            <? foreach ($productsPositionSlider[$indexImageSlide] as $productPlus):
                                $options = explode('=', $productPlus);
                                $cords = explode('x', $options[1]);
                                $idProducts = explode(',', $options[0]);
                                $countProduct = explode(',', $options[2]); //количесство товара в группировке

                                ?>
                                <? if ($idProducts[1]):

                                foreach ($idProducts as $idProduct){

                                    $products[]=$productPlusAr[$idProduct];//список продуктов по id

                                }

                                $index = 0;//для количества товара.


                                // if (!is_array($product)) continue;

                                ?>
                                <!--группа товаров-->

                                <div class="b-card-plus catalog_item_wrapp b-card-plus_mul" data-open="off"
                                     style="top: <?= $cords[1] ?>px; left: <?= $cords[0] ?>px;">

                                    <a href="#open" class="b-card-plus__icon ">+</a>
                                    <div class="multiple_plus">


                                        <? foreach ($products as $product) :

                                            $strMainID = $this->GetEditAreaId($product['ID']);

                                            $arItemIDs = array(
                                                'ID' => $strMainID,
                                                'PICT' => $strMainID . '_pict',
                                                'SECOND_PICT' => $strMainID . '_secondpict',
                                                'STICKER_ID' => $strMainID . '_sticker',
                                                'SECOND_STICKER_ID' => $strMainID . '_secondsticker',
                                                'QUANTITY' => $strMainID . '_quantity',
                                                'QUANTITY_DOWN' => $strMainID . '_quant_down',
                                                'QUANTITY_UP' => $strMainID . '_quant_up',
                                                'QUANTITY_MEASURE' => $strMainID . '_quant_measure',
                                                'BUY_LINK' => $strMainID . '_buy_link',
                                                'BASKET_ACTIONS' => $strMainID . '_basket_actions',
                                                'NOT_AVAILABLE_MESS' => $strMainID . '_not_avail',
                                                'SUBSCRIBE_LINK' => $strMainID . '_subscribe',
                                                'COMPARE_LINK' => $strMainID . '_compare_link',

                                                'PRICE' => $strMainID . '_price',
                                                'DSC_PERC' => $strMainID . '_dsc_perc',
                                                'SECOND_DSC_PERC' => $strMainID . '_second_dsc_perc',
                                                'PROP_DIV' => $strMainID . '_sku_tree',
                                                'PROP' => $strMainID . '_prop_',
                                                'DISPLAY_PROP_DIV' => $strMainID . '_sku_prop',
                                                'BASKET_PROP_DIV' => $strMainID . '_basket_prop',
                                            );
                                            ?>
                                            <div class="b-card-plus__wrapper multiple_plus_wraper">
                                                <a href="#close" class="close">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                                <div class="b-card-plus__image img_fl">
                                                    <img
                                                            src="<?= $product['PREVIEW_PICTURE']['src'] ?>"
                                                            height="<?= $product['PREVIEW_PICTURE']['height'] ?>"
                                                            width="<?= $product['PREVIEW_PICTURE']['width'] ?>"
                                                            alt="<?= $product['~NAME'] ?>">
                                                </div>
                                                <a href="<?= $product['DETAIL_PAGE_URL'] ?>" target="_blank"
                                                   class="b-card-plus__title dark_link">
                                                    <?= $product['~NAME'] ?>
                                                </a>
                                                <div class="cost prices">
                    <span class="price">
                        <?= CurrencyFormat($product['PRICE']['PRICE'], $product['PRICE']['CURRENCY']) ?>
                    </span>
                                                </div>
                                                <div class="counter_wrapp">
                                                    <div class="counter_block" data-offers="N"
                                                         data-item="<?= $product['ID'] ?>">
                                                <span class="minus"
                                                      id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>">-</span>
                                                        <input type="text" class="text" id="<? echo $arItemIDs['QUANTITY']; ?>"
                                                               name="quantity" value="<?= $countProduct[$index] ?>">
                                                        <span class="plus" id="<? echo $arItemIDs['QUANTITY_UP']; ?>"
                                                              data-max="20">+</span>
                                                    </div>

                                                    <div id="<? echo $arItemIDs['BASKET_ACTIONS']; ?>" class="button_block ">
                                                        <!--noindex-->
                                                        <span
                                                                data-value="4"
                                                                data-currency="RUB"
                                                                class="small to-cart btn btn-default transition_bg animate-load"
                                                                data-item="<?= $product['ID'] ?>"
                                                                data-float_ratio=""
                                                                data-ratio="1"
                                                                data-bakset_div="bx_basket_div_29814"
                                                                data-props=""
                                                                data-part_props="Y"
                                                                data-add_props="Y"
                                                                data-empty_props="Y"
                                                                data-offers=""
                                                                data-iblockid="<?= $product['IBLOCK_ID'] ?>"
                                                                data-quantity="<?= $countProduct[$index] ?>"
                                                        ><i></i>
                                        <span>
                                            В корзину
                                        </span>
                                    </span>

                                                        <a rel="nofollow" href="/basket/"
                                                           class="small in-cart btn btn-default transition_bg"
                                                           data-item="<?= $product['ID'] ?>" style="display:none;">
                                                            <i></i>
                                                            <span>В корзине</span>
                                                        </a>
                                                        <!--/noindex-->
                                                    </div>
                                                </div>

                                            </div>
                                            <? $index++; endforeach; $products = array();//конец перебора массива продуктов очистка массива    ?>

                                    </div>
                                </div>

                            <? else :

                                $product = $productPlusAr[$options[0]];//сам продукт выбирается базы по выбранному id

                                if (!is_array($product)) continue;

                                $strMainID = $this->GetEditAreaId($product['ID']);

                                $arItemIDs = array(
                                    'ID' => $strMainID,
                                    'PICT' => $strMainID . '_pict',
                                    'SECOND_PICT' => $strMainID . '_secondpict',
                                    'STICKER_ID' => $strMainID . '_sticker',
                                    'SECOND_STICKER_ID' => $strMainID . '_secondsticker',
                                    'QUANTITY' => $strMainID . '_quantity',
                                    'QUANTITY_DOWN' => $strMainID . '_quant_down',
                                    'QUANTITY_UP' => $strMainID . '_quant_up',
                                    'QUANTITY_MEASURE' => $strMainID . '_quant_measure',
                                    'BUY_LINK' => $strMainID . '_buy_link',
                                    'BASKET_ACTIONS' => $strMainID . '_basket_actions',
                                    'NOT_AVAILABLE_MESS' => $strMainID . '_not_avail',
                                    'SUBSCRIBE_LINK' => $strMainID . '_subscribe',
                                    'COMPARE_LINK' => $strMainID . '_compare_link',

                                    'PRICE' => $strMainID . '_price',
                                    'DSC_PERC' => $strMainID . '_dsc_perc',
                                    'SECOND_DSC_PERC' => $strMainID . '_second_dsc_perc',
                                    'PROP_DIV' => $strMainID . '_sku_tree',
                                    'PROP' => $strMainID . '_prop_',
                                    'DISPLAY_PROP_DIV' => $strMainID . '_sku_prop',
                                    'BASKET_PROP_DIV' => $strMainID . '_basket_prop',
                                );

                                ?>

                                <div class="b-card-plus catalog_item_wrapp " data-open="off"
                                     style="top: <?= $cords[1] ?>px; left: <?= $cords[0] ?>px;">
                                    <a href="#open" class="b-card-plus__icon ">+</a>
                                    <div class="b-card-plus__wrapper b-card_pos">
                                        <a href="#close" class="close">
                                            <i class="fas fa-times"></i>
                                        </a>
                                        <div class="b-card-plus__image">
                                            <img
                                                    src="<?= $product['PREVIEW_PICTURE']['src'] ?>"
                                                    height="<?= $product['PREVIEW_PICTURE']['height'] ?>"
                                                    width="<?= $product['PREVIEW_PICTURE']['width'] ?>"
                                                    alt="<?= $product['~NAME'] ?>">
                                        </div>
                                        <a href="<?= $product['DETAIL_PAGE_URL'] ?>" target="_blank"
                                           class="b-card-plus__title dark_link">
                                            <?= $product['~NAME'] ?>
                                        </a>
                                        <div class="cost prices">
                    <span class="price">
                        <?= CurrencyFormat($product['PRICE']['PRICE'], $product['PRICE']['CURRENCY']) ?>
                    </span>
                                        </div>
                                        <div class="counter_wrapp">
                                            <div class="counter_block" data-offers="N"
                                                 data-item="<?= $product['ID'] ?>">
                                                <span class="minus"
                                                      id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>">-</span>
                                                <input type="text" class="text" id="<? echo $arItemIDs['QUANTITY']; ?>"
                                                       name="quantity" value="<?= $options[2] ?>">
                                                <span class="plus" id="<? echo $arItemIDs['QUANTITY_UP']; ?>"
                                                      data-max="20">+</span>
                                            </div>

                                            <div id="<? echo $arItemIDs['BASKET_ACTIONS']; ?>" class="button_block ">
                                                <!--noindex-->
                                                <span
                                                        data-value="4"
                                                        data-currency="RUB"
                                                        class="small to-cart btn btn-default transition_bg animate-load"
                                                        data-item="<?= $product['ID'] ?>"
                                                        data-float_ratio=""
                                                        data-ratio="1"
                                                        data-bakset_div="bx_basket_div_29814"
                                                        data-props=""
                                                        data-part_props="Y"
                                                        data-add_props="Y"
                                                        data-empty_props="Y"
                                                        data-offers=""
                                                        data-iblockid="<?= $product['IBLOCK_ID'] ?>"
                                                        data-quantity="<?= $options[2] ?>"
                                                ><i></i>
                                        <span>
                                            В корзину
                                        </span>
                                    </span>

                                                <a rel="nofollow" href="/basket/"
                                                   class="small in-cart btn btn-default transition_bg"
                                                   data-item="<?= $product['ID'] ?>" style="display:none;">
                                                    <i></i>
                                                    <span>В корзине</span>
                                                </a>
                                                <!--/noindex-->
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!--  1 товар -->

                            <? endif; ?>
                            <? endforeach; ?>
                        </div>
                    </div>

                </div>
            <? endforeach; ?>
        </div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <? /* if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])): ?>
        <div class="wrapper-prj-map text-center">
            <div class="b-map-project">
                <img
                        class="detail_picture"
                        border="0"
                        src="<?= $detailPhoto["src"] ?>"
                        width="<?= $detailPhoto["width"] ?>"
                        height="<?= $detailPhoto["height"] ?>"
                        alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                        title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"
                />

                <? foreach ($productsPosition['~VALUE'] as $productPlus):
                    $options = explode('=', $productPlus);
                    $cords = explode('x', $options[1]);
                    $product = $productPlusAr[$options[0]];

                    if (!is_array($product)) continue;

                    $strMainID = $this->GetEditAreaId($product['ID']);

                    $arItemIDs = array(
                        'ID' => $strMainID,
                        'PICT' => $strMainID . '_pict',
                        'SECOND_PICT' => $strMainID . '_secondpict',
                        'STICKER_ID' => $strMainID . '_sticker',
                        'SECOND_STICKER_ID' => $strMainID . '_secondsticker',
                        'QUANTITY' => $strMainID . '_quantity',
                        'QUANTITY_DOWN' => $strMainID . '_quant_down',
                        'QUANTITY_UP' => $strMainID . '_quant_up',
                        'QUANTITY_MEASURE' => $strMainID . '_quant_measure',
                        'BUY_LINK' => $strMainID . '_buy_link',
                        'BASKET_ACTIONS' => $strMainID . '_basket_actions',
                        'NOT_AVAILABLE_MESS' => $strMainID . '_not_avail',
                        'SUBSCRIBE_LINK' => $strMainID . '_subscribe',
                        'COMPARE_LINK' => $strMainID . '_compare_link',

                        'PRICE' => $strMainID . '_price',
                        'DSC_PERC' => $strMainID . '_dsc_perc',
                        'SECOND_DSC_PERC' => $strMainID . '_second_dsc_perc',
                        'PROP_DIV' => $strMainID . '_sku_tree',
                        'PROP' => $strMainID . '_prop_',
                        'DISPLAY_PROP_DIV' => $strMainID . '_sku_prop',
                        'BASKET_PROP_DIV' => $strMainID . '_basket_prop',
                    );

                    ?>
                    <div class="b-card-plus catalog_item_wrapp" data-open="off"
                         style="top: <?= $cords[1] ?>px; left: <?= $cords[0] ?>px;">
                        <a href="#open" class="b-card-plus__icon">+</a>
                        <div class="b-card-plus__wrapper">
                            <a href="#close" class="close">
                                <i class="fas fa-times"></i>
                            </a>
                            <div class="b-card-plus__image">
                                <img
                                        src="<?= $product['PREVIEW_PICTURE']['src'] ?>"
                                        height="<?= $product['PREVIEW_PICTURE']['height'] ?>"
                                        width="<?= $product['PREVIEW_PICTURE']['width'] ?>"
                                        alt="<?= $product['~NAME'] ?>">
                            </div>
                            <a href="<?= $product['DETAIL_PAGE_URL'] ?>" target="_blank"
                               class="b-card-plus__title dark_link">
                                <?= $product['~NAME'] ?>
                            </a>
                            <div class="cost prices">
                    <span class="price">
                        <?= CurrencyFormat($product['PRICE']['PRICE'], $product['PRICE']['CURRENCY']) ?>
                    </span>
                            </div>
                            <div class="counter_wrapp">
                                <div class="counter_block" data-offers="N" data-item="<?= $product['ID'] ?>">
                                    <span class="minus" id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>">-</span>
                                    <input type="text" class="text" id="<? echo $arItemIDs['QUANTITY']; ?>"
                                           name="quantity" value="<?= $options[2] ?>">
                                    <span class="plus" id="<? echo $arItemIDs['QUANTITY_UP']; ?>" data-max="20">+</span>
                                </div>

                                <div id="<? echo $arItemIDs['BASKET_ACTIONS']; ?>" class="button_block ">
                                    <!--noindex-->
                                    <span
                                            data-value="4"
                                            data-currency="RUB"
                                            class="small to-cart btn btn-default transition_bg animate-load"
                                            data-item="<?= $product['ID'] ?>"
                                            data-float_ratio=""
                                            data-ratio="1"
                                            data-bakset_div="bx_basket_div_29814"
                                            data-props=""
                                            data-part_props="Y"
                                            data-add_props="Y"
                                            data-empty_props="Y"
                                            data-offers=""
                                            data-iblockid="<?= $product['IBLOCK_ID'] ?>"
                                            data-quantity="<?= $options[2] ?>"
                                    ><i></i>
                                        <span>
                                            В корзину
                                        </span>
                                    </span>

                                    <a rel="nofollow" href="/basket/"
                                       class="small in-cart btn btn-default transition_bg"
                                       data-item="<?= $product['ID'] ?>" style="display:none;">
                                        <i></i>
                                        <span>В корзине</span>
                                    </a>
                                    <!--/noindex-->
                                </div>
                            </div>

                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    <? endif */ ?>

    <div class="container-fluid" style="max-width: 1400px;">
        <div class="row">
            <div class="col-md-9" style="padding: 0px">
                <div class="panel-group b-projects-accordion" id="accordion-project-products" role="tablist"
                     aria-multiselectable="true">
                    <? foreach ($arResult['PROPERTIES']['SETS_PROJECTS']['VALUE'] as $i_set => $serProducts): ?>
                        <? $APPLICATION->IncludeComponent("bitrix:catalog.set.constructor", "project_plus",
                            array(
                                "IBLOCK_ID" => 51,
                                "ELEMENT_ID" => $serProducts,
                                "PRICE_CODE" => ["BASE"],
                                "BASKET_URL" => "/basket/",
                                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                "CACHE_TIME" => $arParams["CACHE_TIME"],
                                "BUNDLE_ITEMS_COUNT" => 60,
                                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                "SHOW_OLD_PRICE" => "Y",
                                "SHOW_MEASURE" => "Y",
                                "SHOW_DISCOUNT_PERCENT" => "Y",
                                "CONVERT_CURRENCY" => "Y",
                                "COLLAPSE" => $i_set === 0 ? "in" : "",
                                "CURRENCY_ID" => "RUB"
                            ), $component, array("HIDE_ICONS" => "Y")
                        ); ?>
                    <? endforeach; ?>
                </div>
                <h2 class="project_title">Описание проекта</h2>
                <p id="description" class="js-detail-text" style="text-align: justify;">
                    <span class="js-short-text">
                        <?
                        $desc = $arResult['DETAIL_TEXT'];
                        $desc = explode(' ', $desc);
                        $desc = array_chunk($desc, 40);
                        echo $desc[1] ? implode($desc[0], ' ') . '...' : $arResult['DETAIL_TEXT'];
                        ?>
                    </span>
                    <? if (isset($desc[1])): ?>
                    <span class="js-long-text" style="display: none">
                            <?= $arResult['~DETAIL_TEXT'] ?>
                        </span>
                <div class="text-center">
                    <a class="btn btn-default btn-sm js-toggle-text" href="javascript:void(0);">
                        Читать далее
                    </a>
                </div>
                <? endif; ?>
                </p>
                <br>
                <br>
                <br>
            </div>

            <div class=" col-md-3 visible-xs hidden-xs" style="padding-right: 0px">
                <h2 style="margin-top:0px;font-size: 18px;margin-bottom: 15px;">Это интересно:</h2>
                <?
                if (!empty($arResult['PROPERTIES']['NEWS_BLOG']['VALUE'])) {
                    global $filter_news_blog;
                    $filter_news_blog = array('ID' => $arResult['PROPERTIES']['NEWS_BLOG']['VALUE']);
                    $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "news-blog12",
                        Array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "ADD_SECTIONS_CHAIN" => "Y",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "N",
                            "CHECK_DATES" => "Y",
                            "COMPOSITE_FRAME_MODE" => "A",
                            "COMPOSITE_FRAME_TYPE" => "AUTO",
                            "DETAIL_URL" => "",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "N",
                            "DISPLAY_TOP_PAGER" => "N",
                            "FIELD_CODE" => array("", ""),
                            "FILTER_NAME" => "filter_news_blog",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "18",
                            "IBLOCK_TYPE" => "aspro_next_content",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Новости",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => $_REQUEST['SECTION_CODE'],
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array("", ""),
                            "SET_BROWSER_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "Y",
                            "SHOW_404" => "N",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER1" => "DESC",
                            "SORT_ORDER2" => "ASC",
                            "STRICT_SECTION_CHECK" => "N"
                        )
                    );
                }
                ?>
            </div>
        </div>
    </div>

    <?
    global $filter_projects;
    $filter_projects = array('!ID' => $arResult['ID']);
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "news-blog5",
        Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "Y",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "N",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "N",
            "CHECK_DATES" => "Y",
            "COMPOSITE_FRAME_MODE" => "A",
            "COMPOSITE_FRAME_TYPE" => "AUTO",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array("", ""),
            "FILTER_NAME" => "filter_projects",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "16",
            "IBLOCK_TYPE" => "aspro_next_content",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "Y",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "3",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => $_REQUEST['SECTION_CODE'],
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array("", ""),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "Y",
            "SHOW_404" => "N",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N"
        )
    ); ?>

</div>