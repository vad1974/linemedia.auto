<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("SPOL_DEFAULT_TEMPLATE_NAME"),
	"DESCRIPTION" => GetMessage("SPOL_DEFAULT_TEMPLATE_DESCRIPTION"),
	"ICON" => "/images/sale_order_tbl.gif",
	"PATH" => array(
        "ID" => GetMessage("LM_AUTO_MAIN_SECTION"),
        "CHILD" => array(
            "ID" => "LM_AUTO_MAIN_ORDERS",
            "NAME" => GetMessage("LM_AUTO_MAIN_ORDERS_SUB_SECTION"),
            "SORT" => 10,
        ),
    ),
);
?>