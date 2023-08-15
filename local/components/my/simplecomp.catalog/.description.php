<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = [
	"NAME" => GetMessage("SIMPLECOMP_NAME"),
	"DESCRIPTION" => GetMessage("SIMPLECOMP_DESC"),
	"CACHE_PATH" => "Y",
	"PATH" => [
		"ID" => "my_id",
        "NAME" => GetMessage("SIMPLECOMP_SECTION_NAME"),
	],
];