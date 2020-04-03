<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $this->setFrameMode(true); ?>
<? if ($arResult["ITEMS"]) {

    /*if (hasDev()){
        pr($arResult['OTHER_BANNERS_VIEW']);
        foreach ( $arResult['ITEMS'] as $ITEM)
            pr($ITEM['NAME']);
    }*/


    $bHideOnMobile = $arParams['HIDE_ON_MOBILE'] == 'Y';
    $arCountCourusel = $bHideOnMobile ? array(1, 2) : array(1, 2, 3) ?>
    <div class="<?=$bHideOnMobile ? 'hidden-xs' : ''?> wrapper_inner1 wides float_banners">
        <h3><span style="color: #107bb1;"><a href="/projects/"><?=$arParams['TITLE_OF_BLOCK'] ? $arParams['TITLE_OF_BLOCK'] : GetMessage('TITLE_OF_BLOCK')?></a></span></h3>
        <div class="courusel-with-big-img before-ready-hidden">
            <? foreach ($arCountCourusel as $feckArr): ?>
                <div class="start_promo <?= ($arResult["OTHER_BANNERS_VIEW"] == "Y" ? "other" : "normal_view"); ?> row margin0 <?= $feckArr == 3 ? 'visible-xs mobile-courusel' : '' ?> <?= $feckArr == 2 ? 'hidden-xs second-courusel' : '' ?> <?= $feckArr == 1 ? 'hidden-xs first-courusel' : '' ?> owl-carousel owl-theme">
                    <? $i = 1; ?>
                    <? foreach ($arResult["ITEMS"] as $arItem): ?>
                        <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        $isUrl = (strlen($arItem["PROPERTIES"]["URL_STRING"]["VALUE"]) ? true : false);
                        $arSection = CIBlockSection::GetByID($arItem['IBLOCK_SECTION_ID'])->GetNext();
                        ?>
                        <? if ($arItem["DETAIL_PICTURE"]["SRC"] || $arItem["PREVIEW_PICTURE"]["SRC"]): ?>
                            <div class="item s_<?= $i; ?> <?= ($isUrl ? "hover" : ""); ?> <?= ($arItem["PROPERTIES"]["BANNER_SIZE"]["VALUE_XML_ID"] ? $arItem["PROPERTIES"]["BANNER_SIZE"]["VALUE_XML_ID"] : "normal"); ?>"
                                 id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                <? $arItem["FORMAT_NAME"] = strip_tags($arItem["~NAME"]); ?>
                                <? if ($isUrl) { ?>
                                    <a href="<?= $arItem["PROPERTIES"]["URL_STRING"]["VALUE"] ?>"
                                       class="opacity_block1 dark_block_animate"
                                       title="<?= $arItem["FORMAT_NAME"]; ?>" <?= ($arItem["PROPERTIES"]["TARGETS"]["VALUE_XML_ID"] ? "target='" . $arItem["PROPERTIES"]["TARGETS"]["VALUE_XML_ID"] . "'" : ""); ?>></a>
                                    <?
                                }
                                if ($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] != "image"):?>
                                    <? $class_position_block = $class_text_block = '';
                                    if (isset($arItem["PROPERTIES"]["TEXT_POSITION"]) && $arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"]) {
                                        $class_position_block = $arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] . '_blocks';
                                    }
                                    if (isset($arItem["PROPERTIES"]["TEXTCOLOR"]) && $arItem["PROPERTIES"]["TEXTCOLOR"]["VALUE_XML_ID"]) {
                                        $class_text_block = $arItem["PROPERTIES"]["TEXTCOLOR"]["VALUE_XML_ID"] . '_text';
                                    }
                                    ?>
                                    <div class="wrap_tizer  <?= $class_position_block; ?> <?= $class_text_block; ?>">
                                        <div class="wrapper_inner_tizer">
                                            <div class="wr_block">
                                        <span class="wrap_outer title">
                                             <a class="psevdo-href" href="<?= $arItem['DETAIL_PAGE_URL'] ?>"></a>
                                            <? if ($isUrl){
                                            ?>
                                            <? if ($arItem["PROPERTIES"]["TARGETS"]["VALUE_XML_ID"]): ?>
                                            <a class="outer_text"
                                               href="<?= $arItem["PROPERTIES"]["URL_STRING"]["VALUE"] ?>" <?= ($arItem["PROPERTIES"]["TARGETS"]["VALUE_XML_ID"] ? "target='" . $arItem["PROPERTIES"]["TARGETS"]["VALUE_XML_ID"] . "'" : ""); ?>>
                                                <? else: ?>
                                                <a class="outer_text"
                                                   href="<?= $arItem["PROPERTIES"]["URL_STRING"]["VALUE"] ?>">
                                                <? endif;
                                                ?>
                                                    <? }else{
                                                    ?>
                                                    <span class="outer_text">
                                            <? } ?>
                                                        <span class="inner_text">
                                                    <?= strip_tags($arItem["~NAME"], "<br><br/>"); ?>
                                                </span>
                                                        <? if ($isUrl){
                                                        ?>
                                                </a>
                                                <? }else{
                                                ?>
                                                </span>
                                                <? } ?>
                                                </span>
                                            </div>
                                            <? if ($arItem["PREVIEW_TEXT"] && $arParams['VIEW_PREVIEW_TEXT']!="N") {
                                                ?>
                                                <div class="wr_block price">
                                            <span class="wrap_outer_desc">
                                                <? if ($isUrl){
                                                ?>
                                                <a class="outer_text_desc"
                                                   href="<?= $arItem["PROPERTIES"]["URL_STRING"]["VALUE"] ?>" <?= ($arItem["PROPERTIES"]["TARGETS"]["VALUE_XML_ID"] ? "target='" . $arItem["PROPERTIES"]["TARGETS"]["VALUE_XML_ID"] . "'" : ""); ?>>
                                                <? }else{
                                                ?>
                                                    <span class="outer_text_desc">
                                                <? } ?>
                                                        <span class="inner_text_desc">
                                                        <?= trim(strip_tags($arItem["PREVIEW_TEXT"])) ?>
                                                    </span>
                                                        <? if ($isUrl){
                                                        ?>
                                                    </a>
                                                <? }else{
                                                ?>
                                                    </span>
                                                    <? } ?>
                                                    </span>
                                                </div>
                                            <? } ?>
                                        </div>
                                    </div>
                                <? endif; ?>
                                <div class="scale_block_animate img_block"
                                     style="background-image:url('<?= ($arItem["DETAIL_PICTURE"]["SRC"] ? $arItem["DETAIL_PICTURE"]["SRC"] : $arItem["PREVIEW_PICTURE"]["SRC"]) ?>')">
                                    <a href="<?= $arSection['SECTION_PAGE_URL'] ?>?first=<?= $arItem['ID'] ?>"></a>
                                </div>
                            </div>
                            <? $i++; ?>
                        <? endif; ?>
                    <? endforeach; ?>
                </div>
            <? endforeach; ?>
            <ul class="flex-direction-nav">
                <li class="flex-nav-prev"><a class="flex-prev" href="#">Previous</a>
                </li>
                <li class="flex-nav-next">
                    <a class="flex-next" href="#">Next</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="clearfix">
    </div>
<? } ?>