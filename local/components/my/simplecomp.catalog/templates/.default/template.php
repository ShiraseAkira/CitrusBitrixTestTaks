<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p>
    <b><?= GetMessage("SIMPLECOMP_TITLE") ?></b>
</p>

<ul>
    <? foreach ($arResult['NEWS'] as $class) { ?>
        <li>
            <b><?= $class['NAME'] ?></b> - <?= $class['ACTIVE_FROM'] ?>
            (<?= implode(', ', $class['SECTIONS']) ?>)
            <ul>
                <? foreach ($class['PRODUCTS'] as $product) { ?>
                    <li>
                        <?= $product['NAME'] ?> -
                        <?= $product['PROPERTY_PRICE_VALUE'] ?> -
                        <?= $product['PROPERTY_MATERIAL_VALUE'] ?> -
                        <?= $product['PROPERTY_ARTNUMBER_VALUE'] ?>
                    </li>
                <? } ?>
            </ul>
        </li>
    <? } ?>
</ul>
