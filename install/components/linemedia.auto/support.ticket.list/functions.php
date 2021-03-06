<?
//Functions
if (!function_exists("_GetDictionaryInfo"))
{
	function _GetDictionaryInfo($ID, $TYPE, $CODE, &$arTicketDictionary)
	{
		$ID = intval($ID);

		$arReturn = Array(
			$CODE."_NAME" => "",
			$CODE."_DESC" => "",
			$CODE."_SID" => ""
		);

		if (array_key_exists($TYPE, $arTicketDictionary) && array_key_exists($ID, $arTicketDictionary[$TYPE]))
		{
			$arReturn = Array(
				$CODE."_NAME" => htmlspecialchars($arTicketDictionary[$TYPE][$ID]["NAME"]),
				$CODE."_DESC" => htmlspecialchars($arTicketDictionary[$TYPE][$ID]["DESCR"]),
				$CODE."_SID" => htmlspecialchars($arTicketDictionary[$TYPE][$DID]["SID"])
			);
		}
		elseif ($ID > 0)
		{
			$rsD = CTicketDictionary::GetByID($ID);
			if ($arD = $rsD->Fetch())
			{
				$arReturn = Array(
					$CODE."_NAME" => htmlspecialchars($arD["NAME"]),
					$CODE."_DESC" => htmlspecialchars($arD["DESCR"]),
					$CODE."_SID" => htmlspecialchars($arD["SID"])
				);
			}
		}

		return $arReturn;
	}
}

if (!function_exists("_GetUserInfo"))
{
	function _GetUserInfo($USER_ID, $CODE)
	{
		static $arUsers;

		$arReturn = Array(
			$CODE."_NAME" =>"",
			$CODE."_LOGIN" =>""
		);

		if (is_array($arUsers) && array_key_exists($USER_ID, $arUsers))
		{
			$arReturn = Array(
				$CODE."_NAME" => $arUsers[$USER_ID]["NAME"],
				$CODE."_LOGIN" => $arUsers[$USER_ID]["LOGIN"]
			);
		}
		elseif ($USER_ID > 0)
		{
			$rsUser = CUser::GetByID($USER_ID);
			if ($arUser = $rsUser->GetNext())
			{
				$arUsers[$USER_ID] = Array(
					"NAME" => $arUser["NAME"]." ".$arUser["LAST_NAME"],
					"LOGIN" => $arUser["LOGIN"]
				);

				$arReturn = Array(
					$CODE."_NAME" => $arUser["NAME"]." ".$arUser["LAST_NAME"],
					$CODE."_LOGIN" => $arUser["LOGIN"]
				);
			}
		}
		return $arReturn;
	}
}

if (!function_exists("_InitFilter"))
{
	function _InitFilter($arFilterFields)
	{
		//Delete filter
		if (strlen($_REQUEST["del_filter"])>0)
		{
			unset($_SESSION["SESS_ADMIN"]["SUPPORT_TICKET_LIST"]);

			foreach ($arFilterFields as $field)
				$_REQUEST[$field] = "";
		}
		//Set filter
		elseif (strlen($_REQUEST["set_filter"])>0)
		{
			$arFilter = Array();
			foreach ($arFilterFields as $field)
				$arFilter[$field] = $_REQUEST[$field];

			$_SESSION["SESS_ADMIN"]["SUPPORT_TICKET_LIST"] = $arFilter;
		}
		//Get Filter
		else
		{
			$arFilter = $_SESSION["SESS_ADMIN"]["SUPPORT_TICKET_LIST"];
			if (is_array($arFilter))
			{
				foreach ($arFilter as $field => $value)
					$_REQUEST[$field] = $value;
			}
		}
	}
}
?>