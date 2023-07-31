<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = [
	"GROUPS" => [
	],
	"PARAMETERS" => [
		"IBLOCK_CATALOG_ID" => [
			"PARENT" => "BASE",
			"NAME" => GetMessage("SIMPLECOMP_IBLOCK_CATALOG_ID"),
			"TYPE" => "STRING",
		],
        "IBLOCK_NEWS_ID" => [
            "PARENT" => "BASE",
            "NAME" => GetMessage("SIMPLECOMP_IBLOCK_NEWS_ID"),
            "TYPE" => "STRING",
        ],
        "USER_CATALOG_NEWS_BINDING_PROPERTY" => [
            "PARENT" => "BASE",
            "NAME" => GetMessage("SIMPLECOMP_USER_CATALOG_NEWS_BINDING_PROPERTY"),
            "TYPE" => "STRING",
        ],

		"CACHE_TIME"  =>  ["DEFAULT"=>180],
	],
];
