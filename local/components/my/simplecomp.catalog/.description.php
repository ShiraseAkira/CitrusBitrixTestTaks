<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("SIMPLECOMP_NAME"),
	"DESCRIPTION" => GetMessage("SIMPLECOMP_DESC"),
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "my_id",
        "NAME" => GetMessage("SIMPLECOMP_SECTION_NAME"),
	),
);