<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
{
	ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
	return;
}

//
if(empty($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 180;
$arParams["IBLOCK_CATALOG_ID"] = (int)$arParams["IBLOCK_CATALOG_ID"];
$arParams["IBLOCK_NEWS_ID"] = (int)$arParams["IBLOCK_NEWS_ID"];

if ($this->startResultCache()) {
    $resBlock = CIBlock::GetList([], ['ID' => [$arParams["IBLOCK_CATALOG_ID"], $arParams["IBLOCK_NEWS_ID"]]]);
	if ($resBlock->SelectedRowsCount() != 2 ||
		empty($arParams['USER_CATALOG_NEWS_BINDING_PROPERTY'])
	) {
        $arResult['ERROR'] = 'ERROR';
        $this->SetResultCacheKeys(['ERROR']);
		$this->abortResultCache();
	} else {
        //Getting active news
        $arNewsID = [];

        $arSelect = [
            'ID',
            'NAME',
            'ACTIVE_FROM',
        ];
        $arFilter = [
            'IBLOCK_ID' => $arParams["IBLOCK_NEWS_ID"],
            'ACTIVE' => 'Y',
        ];
        $resNews = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);

        while ($newsElement = $resNews->Fetch()) {
            $arNewsID[] = $newsElement['ID'];
            $arResult['NEWS'][$newsElement['ID']] = $newsElement;
        }

        //Getting active sections binded to news
        $arSections = [];
        $arSectionsID = [];

        $arSelect = [
            'ID',
            'NAME',
            $arParams['USER_CATALOG_NEWS_BINDING_PROPERTY'],
        ];
        $arFilter = [
            'IBLOCK_ID' => $arParams["IBLOCK_CATALOG_ID"],
            'ACTIVE' => 'Y',
            $arParams['USER_CATALOG_NEWS_BINDING_PROPERTY'] => $arNewsID,
        ];
        $resSections = CIBlockSection::GetList([], $arFilter, false, $arSelect, false);

        while ($sectionElement = $resSections->Fetch()) {
            $arSectionsID[] = $sectionElement['ID'];
            $arSections[$sectionElement['ID']] = $sectionElement;

            foreach ($sectionElement[$arParams['USER_CATALOG_NEWS_BINDING_PROPERTY']] as $newsID) {
                $arResult['NEWS'][$newsID]['SECTIONS'][] = $sectionElement['NAME'];
            }
        }

        //Getting active products
        $arProducts = [];
        $arProductsID = [];

        $arSelect = [
            'ID',
            'IBLOCK_SECTION_ID',
            'NAME',
            'PROPERTY_MATERIAL',
            'PROPERTY_ARTNUMBER',
            'PROPERTY_PRICE',
        ];
        $arFilter = [
            'IBLOCK_ID' => $arParams["IBLOCK_CATALOG_ID"],
            'ACTIVE' => 'Y',
            'SECTION_ID' => $arSectionsID,
        ];
        $resProducts = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);

        $arResult['PRODUCT_COUNT'] = 0;
        while ($productsElement = $resProducts->Fetch()) {
            $arResult['PRODUCT_COUNT']++;

            $productSectionID = $productsElement['IBLOCK_SECTION_ID'];
            $productSection = $arSections[$productSectionID];
            $section2NewsBind = $productSection[$arParams['USER_CATALOG_NEWS_BINDING_PROPERTY']];
            foreach($section2NewsBind as $newsID) {
                $arResult['NEWS'][$newsID]['PRODUCTS'][] = $productsElement;
            }
        }

        $this->SetResultCacheKeys(['PRODUCT_COUNT']);
        $this->IncludeComponentTemplate();
    }
}

if (empty($arResult['ERROR'])) {
    $APPLICATION->SetTitle(GetMessage('SIMPLECOMP_ELEMENTS_COUNT', ['#PRODUCT_COUNT#'=> $arResult['PRODUCT_COUNT']]));
} else {
    $APPLICATION->SetTitle(GetMessage('SIMPLECOMP_ERROR_MESSAGE'));
}
