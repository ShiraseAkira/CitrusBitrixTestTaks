<?php
AddEventHandler("main", "OnBeforeEventAdd", ["FeedbackHandler", "OnBeforeEventAddHandler"]);
class FeedbackHandler
{
    const MSG_USER_IS_NOT_AUTH = 'Пользователь не авторизован, данные из формы: $form_data';
    const MSG_USER_AUTH = 'Пользователь авторизован: $id ($login) $name, данные из формы: $form_data';
    const MSG_REPLACEMENT = 'Замена данных в отсылаемом письме';
    public static function OnBeforeEventAddHandler(&$event, &$lid, &$arFields)
    {
        if (strcmp($event, 'FEEDBACK_FORM') === 0) {
            global $USER;
            if ($USER->IsAuthorized()) {
                $arFields['AUTHOR'] = strtr(self::MSG_USER_AUTH, [
                    '$id' => $USER->GetID(),
                    '$login' => $USER->GetLogin(),
                    '$name' => $USER->GetFullName(),
                    '$form_data' => $arFields['AUTHOR'],
                ]);
            } else {
                $arFields['AUTHOR'] = self::MSG_USER_IS_NOT_AUTH.$arFields['AUTHOR'];
            }
        }

        CEventLog::Add([
            "SEVERITY" => "INFO",
            "AUDIT_TYPE_ID" => self::MSG_REPLACEMENT,
            "MODULE_ID" => "main",
            "ITEM_ID" => $event,
            "DESCRIPTION" => self::MSG_REPLACEMENT.' - '.$arFields['AUTHOR'],
        ]);
    }
}