<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(is_array($arParams['FILTER_BY_SECTIONS_ID']) && count($arParams['FILTER_BY_SECTIONS_ID'])){
    foreach ($arResult['SECTIONS'] as $key => $arSection)
    {
        if (!in_array($arSection['ID'], $arParams['FILTER_BY_SECTIONS_ID']))
            unset($arResult['SECTIONS'][$key]);
    }
}