<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<? $this->setFrameMode(true); ?>
<? $isAjax = (isset($_GET["AJAX_REQUEST"]) && $_GET["AJAX_REQUEST"] == "Y"); ?>
<? if ($arResult['ITEMS']): ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2 class="project_title" style="margin-top:0px;">Похожие проекты</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <? if (!$isAjax): ?>
            <div class="banners-small blog b-project-list">
                <? endif; ?>
                <? foreach ($arResult['ITEMS'] as $arItems): ?>
                    <div class="items row">
                        <? foreach ($arItems['ITEMS'] as $key => $arItem): ?>
                            <?
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

                            // preview image
                            $bImage = (is_array($arItem['PREVIEW_PICTURE']) && $arItem['PREVIEW_PICTURE']['SRC']);
                            $imageSrc = ($bImage ? $arItem['PREVIEW_PICTURE']['SRC'] : false);

                            // use detail link?
                            $bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);

                            $isWideBlock = (isset($arItem['CLASS_WIDE']) && $arItem['CLASS_WIDE']);
                            $hasWideBlock = (isset($arItem['CLASS']) && $arItem['CLASS']);
                            ?>
                            <div class="col-md-4 col-sm-4 shadow">
                                <div class="b-project-list__wrapper">
                                    <a title="<?= ($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME']) ?>"
                                       href="<?= $arItem['DETAIL_PAGE_URL'] ?>"
                                       style="background-image: url('<?= $imageSrc ?>')"
                                       class="item  animation-boxs <?= ($isWideBlock ? 'wide-block' : '') ?> <?= ($hasWideBlock ? '' : 'normal-block') ?>"
                                       id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                                        <div class="title">
                                            <span><?= $arItem['NAME'] ?></span>
                                        </div>
                                    </a>
                                    <div class="prev_text-block"><?= $arItem['PREVIEW_TEXT']; ?></div>
                                </div>
                            </div>
                        <? endforeach; ?>
                    </div>
                <? endforeach; ?>
                <div class="bottom_nav" <?= ($isAjax ? "style='display: none; '" : ""); ?>>
                    <? if ($arParams["DISPLAY_BOTTOM_PAGER"] == "Y") { ?><?= $arResult["NAV_STRING"] ?><? } ?>
                </div>
                <? if (!$isAjax): ?>
            </div>
        <? endif; ?>
        </div>
    </div>
</div>
            <? endif; ?>

