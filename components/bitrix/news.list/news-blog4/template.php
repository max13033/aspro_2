<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?$isAjax = (isset($_GET["AJAX_REQUEST"]) && $_GET["AJAX_REQUEST"] == "Y");?>
<?if($arResult['ITEMS']):
    $cloneItem = $arResult['ITEMS'][0]['ITEMS'][0];
    unset($cloneItem['CLASS_WIDE']);
    unset($cloneItem['PROPERTIES']);
    $cloneItem['CLASS'] = "col-item";
    $cloneItem['START_DIV'] = "Y";
    $cloneItem['CLONE'] = "Y";
    if (count($arResult['ITEMS'][0]['ITEMS']) === 1) {
        $arResult['ITEMS'][0]['ITEMS'][]=$cloneItem;
        $arResult['ITEMS'][0]['ITEMS'][]=array_merge($cloneItem, ['START_DIV'=>"N", "END_DIV" => "Y"]);
    } else if (count($arResult['ITEMS'][0]['ITEMS']) === 2) {
        $arResult['ITEMS'][0]['ITEMS'][1]['START_DIV'] = "Y";
        $arResult['ITEMS'][0]['ITEMS'][1]['END_DIV'] = "N";
        $arResult['ITEMS'][0]['ITEMS'][1]=$arResult['ITEMS'][0]['ITEMS'][1];
        $arResult['ITEMS'][0]['ITEMS'][]=array_merge($cloneItem, ['START_DIV'=>"N", 'END_DIV' => 'Y']);
    }
    ?>

	<?if(!$isAjax):?>
		<div class="banners-small blog b-project-list">
	<?endif;?>
			<?foreach($arResult['ITEMS'] as $arItems):?>
				<div class="items row">
					<?foreach($arItems['ITEMS'] as $key => $arItem):?>
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
						<?if(isset($arItem['START_DIV']) && $arItem['START_DIV'] == 'Y'):?>
							<div class="col-md-4 col-sm-4">
						<?endif;?>

                            <? if ($arItem['CLONE']=='Y') :?>
                            <div style="opacity: 0" class="<?=((isset($arItem['CLASS']) && $arItem['CLASS']) ? $arItem['CLASS'] : 'col-md-4 col-sm-4 shadow');?>">
                                <div class="b-project-list__wrapper">
                                    <span href="javascript:void(0)" class="item  animation-boxs <?=($isWideBlock ? 'wide-block' : '')?> <?=($hasWideBlock ? '' : 'normal-block')?>"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                        <div class="title">
                                            <span><?=$arItem['NAME']?></span>
                                        </div>
                                    </span>
                                    <div class="prev_text-block"><?=$arItem['PREVIEW_TEXT'];?></div>
                                </div>
                            </div>
                            <? else :?>
                            <div class="<?=((isset($arItem['CLASS']) && $arItem['CLASS']) ? $arItem['CLASS'] : 'col-md-4 col-sm-4 shadow');?>">
                                <div class="b-project-list__wrapper">
                                    <a title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" href="<?=$arItem['DETAIL_PAGE_URL']?>" style="background-image: url('<?=$imageSrc?>')" class="item  animation-boxs <?=($isWideBlock ? 'wide-block' : '')?> <?=($hasWideBlock ? '' : 'normal-block')?>"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                        <div class="title">
                                            <span><?=$arItem['NAME']?></span>
                                        </div>
                                    </a>
                                    <div class="prev_text-block"><?=$arItem['PREVIEW_TEXT'];?></div>
                                </div>
                            </div>
                            <? endif ?>



						<?if(isset($arItem['END_DIV']) && $arItem['END_DIV'] == 'Y'):?>
							</div>
						<?endif;?>
					<?endforeach;?>
				</div>
			<?endforeach;?>
			<div class="bottom_nav" <?=($isAjax ? "style='display: none; '" : "");?>>
				<?if( $arParams["DISPLAY_BOTTOM_PAGER"] == "Y" ){?><?=$arResult["NAV_STRING"]?><?}?>
			</div>
	<?if(!$isAjax):?>
		</div>
	<?endif;?>
<?endif;?>