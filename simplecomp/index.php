<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("simplecomp");
?><?$APPLICATION->IncludeComponent(
	"my:simplecomp.catalog", 
	".default", 
	array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "180",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "",
		"IBLOCKS" => "",
		"IBLOCK_TYPE" => "news",
		"PARENT_SECTION" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_CATALOG_ID" => "2",
		"IBLOCK_NEWS_ID" => "1",
		"USER_CATALOG_NEWS_BINDING_PROPERTY" => "UF_NEWS_LINK"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>