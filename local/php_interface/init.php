<?

AddEventHandler("iblock", "OnAfterIBlockElementAdd", array("LenCodeEvents", "newElement"));
AddEventHandler("iblock", "OnIBlockElementUpdate", array("LenCodeEvents", "updElement"));
//AddEventHandler("", "GoalsOnAfterAdd", array("LenCodeEvents", "addStatsPlayer"));

class LenCodeEvents {
    /*static function addStatsPlayer(\Bitrix\Main\Entity\Event $event) {
        $arFields = $event->getParameter("fields");
        $c = fopen($_SERVER['DOCUMENT_ROOT']."/test.json", 'a');
        fwrite($c, json_encode($arFields));
        fclose($c);
    }*/
    static function newElement(&$arFields) {
        if (!$arFields['ID']) {
            return;
        }
        if ($arFields["IBLOCK_ID"] == 2) {
            if ($arFields["PROPERTY_VALUES"][45]['n0']['VALUE']) {
                $res = CIBlockElement::GetProperty(1, $arFields["PROPERTY_VALUES"][45]['n0']['VALUE'], "sort", "asc", array("CODE" => "STRUCTURE"));
                while ($ob = $res->GetNext()) {
                    $VALUES[] = $ob['VALUE'];
                }
                $VALUES[] = $arFields['ID'];
                CIBlockElement::SetPropertyValuesEx($arFields["PROPERTY_VALUES"][45]['n0']['VALUE'], 1, array("STRUCTURE" => $VALUES));
            }
        } else if ($arFields["IBLOCK_ID"] == 1) {
            $warning = "";
            foreach ($arFields["PROPERTY_VALUES"][7] as $k => $v) {
                if ($v['VALUE']) {
                    $db_props = CIBlockElement::GetProperty(2, $v['VALUE'], array("sort" => "asc"), Array("CODE" => "TEAM"));
                    if ($ar_props = $db_props->Fetch()) {
                        $warning .= "Игрок с ID=" . $v['VALUE'] . " был перенесен в новую команду<br>";
                    }
                    CIBlockElement::SetPropertyValuesEx($v['VALUE'], 2, array("TEAM" => $arFields['ID']));
                }
            }
            if ($warning) {
                $GLOBALS['APPLICATION']->throwException($warning);
            }
        }
    }

    static function updElement(&$arNewFields, &$arOldFields) {
        if ($arNewFields["IBLOCK_ID"] == 1) {
            $warning = "";
            $res = CIBlockElement::GetProperty(1, $arNewFields['ID'], "sort", "asc", array("CODE" => "STRUCTURE"));
            while ($ob = $res->GetNext()) {
                $VALUES[$ob['PROPERTY_VALUE_ID']] = $ob['VALUE'];
            }
            foreach ($arNewFields["PROPERTY_VALUES"][7] as $k => $v) {
                if (stripos($k, 'n') !== false) {
                    if ($v['VALUE']) {
                        $db_props = CIBlockElement::GetProperty(2, $v['VALUE'], array("sort" => "asc"), Array("CODE" => "TEAM"));
                        if ($ar_props = $db_props->Fetch()) {
                            $warning .= "Игрок с ID=" . $v['VALUE'] . " был перенесен в новую команду<br>";
                        }
                        CIBlockElement::SetPropertyValuesEx($v['VALUE'], 2, array("TEAM" => $arNewFields['ID']));
                    }
                } else {
                    if ($v['VALUE']) {
                        $db_props = CIBlockElement::GetProperty(2, $v['VALUE'], array("sort" => "asc"), Array("CODE" => "TEAM"));
                        if ($ar_props = $db_props->Fetch()) {
                            $warning .= "Игрок с ID=" . $v['VALUE'] . " был перенесен в новую команду<br>";
                        }
                        CIBlockElement::SetPropertyValuesEx($v['VALUE'], 2, array("TEAM" => $arNewFields['ID']));
                    } else {
                        $player = $VALUES[$k];
                        $warning .= "Игрок с ID=" . $player . " остался без команды<br>";
                        CIBlockElement::SetPropertyValuesEx($player, 2, array("TEAM" => false));
                    }
                }
            }
        } else if ($arNewFields["IBLOCK_ID"] == 2777777) {
            $db_props = CIBlockElement::GetProperty(2, $arNewFields['ID'], array("sort" => "asc"), Array("CODE" => "TEAM"));
            $teamNew = reset($arNewFields["PROPERTY_VALUES"][45])['VALUE'];
            $teamOld = "";
            if ($ar_props = $db_props->Fetch()) {
                $teamOld = $ar_props['VALUE'];
            }
            if ($teamOld != $teamNew) {
                if ($teamOld) {
                    $res = CIBlockElement::GetProperty(1, $teamOld, "sort", "asc", array("CODE" => "STRUCTURE"));
                    while ($ob = $res->GetNext()) {
                        if ($ob['VALUE'] != $arNewFields['ID']) {
                            $VALUES[] = $ob['VALUE'];
                        }
                    }
                    if (!$VALUES) {
                        $VALUES = false;
                    }
                    CIBlockElement::SetPropertyValuesEx($teamOld, 1, array("STRUCTURE" => $VALUES));
                }
                $VALUES = array();
                if ($teamNew) {
                    $res = CIBlockElement::GetProperty(1, $teamNew, "sort", "asc", array("CODE" => "STRUCTURE"));
                    while ($ob = $res->GetNext()) {
                        $VALUES[] = $ob['VALUE'];
                    }
                    $VALUES[] = $arNewFields['ID'];
                    CIBlockElement::SetPropertyValuesEx($teamNew, 1, array("STRUCTURE" => $VALUES));
                }
            }
        }
    }
}

class LenCodeStats {
    static function getStatPlayer($player) {
        $hlbl = 1;
        $hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById($hlbl)->fetch();
        $entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        $rsData = $entity_data_class::getList(array(
                    "select" => array("CNT"),
                    "filter" => array("UF_SCORED" => $player),
                    'runtime' => array(
                        new \Bitrix\Main\Entity\ExpressionField('CNT', 'COUNT(*)'),
                    )
        ));
        $scored = 0;
        if($arData = $rsData->Fetch()) {
            $scored = $arData['CNT'];
        }
        $rsData = $entity_data_class::getList(array(
                    "select" => array("CNT"),
                    "filter" => array("UF_ASSISTANT" => $player),
                    'runtime' => array(
                        new \Bitrix\Main\Entity\ExpressionField('CNT', 'COUNT(*)'),
                    )
        ));
        $assist1 = 0;
        if($arData = $rsData->Fetch()) {
            $assist1 = $arData['CNT'];
        }
        $rsData = $entity_data_class::getList(array(
                    "select" => array("CNT"),
                    "filter" => array("UF_ASSISTANT2" => $player),
                    'runtime' => array(
                        new \Bitrix\Main\Entity\ExpressionField('CNT', 'COUNT(*)'),
                    )
        ));
        $assist2 = 0;
        if($arData = $rsData->Fetch()) {
            $assist2 = $arData['CNT'];
        }
        $assist = $assist1 + $assist2;
        $games = CIBlockElement::GetList(array(), array("IBLOCK_ID"=>10, /*"PROPERTY_GAME_OVER" => 21,*/ array("LOGIC" => "OR", array("PROPERTY_SRTUCTURE1"=>$player), array("PROPERTY_SRTUCTURE2"=>$player))), Array(), false, array("ID"));
        return array(
            'games' => $games,
            'scored' => $scored,
            'assist' => $assist
        );
    }
    static function getGameScore($game) {
        $arResult['GAME_ID'] = $game;
        $arResult = array();
        $arScored = array();
        $score1 = 0;
        $score2 = 0;
        $hlbl = 1;
        $db_props = CIBlockElement::GetProperty(10, $game, array("sort" => "asc"), Array("CODE" => "TEAM1"));
        if ($ar_props = $db_props->Fetch()) {
            $master = $team1 = $ar_props['VALUE'];
        }
        $db_props = CIBlockElement::GetProperty(10, $game, array("sort" => "asc"), Array("CODE" => "TEAM2"));
        if ($ar_props = $db_props->Fetch()) {
            $guest = $team2 = $ar_props['VALUE'];
        }
        $arResult['MASTER'] = $master;
        $arResult['GUEST'] = $guest;
        $db_props = CIBlockElement::GetProperty(10, $game, array("sort" => "asc"), Array("CODE" => "GAME_OVER"));
        if ($ar_props = $db_props->Fetch()) {
            if ($ar_props['VALUE'] == 21) {
                $arResult['GAME_OVER'] = "Y";
            }
        }
        $db_props = CIBlockElement::GetProperty(10, $game, array("sort" => "asc"), Array("CODE" => "DATE"));
        if ($ar_props = $db_props->Fetch()) {
            $date = new DateTime();
            if($date->format('d.m.Y H:i:s') < $ar_props['VALUE'] && $arResult['GAME_OVER'] != "Y") {
                $arResult['RESULT']['TOTAL'] = "-:-";
                $arResult[$team1]['SCORE'] = 0;
                $arResult[$team2]['SCORE'] = 0;
                return $arResult;
            }
        }
        $hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById($hlbl)->fetch();
        $entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        $rsData = $entity_data_class::getList(array(
                    "select" => array("*"),
                    "order" => array("ID" => "ASC"),
                    "filter" => array("UF_GAME" => $game)
        ));
        while ($arData = $rsData->Fetch()) {
            if ($arData['UF_SCORED'] > 0 && $arData['UF_SITUATION'] != 'bullit') {
                $arScored[$arData['UF_TEAM']]['TOTAL']++;
                switch (true) {
                    case $arData['UF_MINUTE'] <= 20:
                        $arScored[$arData['UF_TEAM']][1]++;
                        break;
                    case $arData['UF_MINUTE'] <= 40:
                        $arScored[$arData['UF_TEAM']][2]++;
                        break;
                    case $arData['UF_MINUTE'] <= 60:
                        $arScored[$arData['UF_TEAM']][3]++;
                        break;
                    case $arData['UF_MINUTE'] <= 65:
                        $arScored[$arData['UF_TEAM']]['OT']++;
                        break;
                }
            } else if ($arData['UF_SCORED'] > 0 && $arData['UF_SITUATION'] == 'bullit') {
                $arScored[$arData['UF_TEAM']]['BULLIT']++;
            }
        }
        if ($arScored[$team1]['TOTAL'] !== $arScored[$team2]['TOTAL']) {
            if ($arScored[$team1]['TOTAL'] > $arScored[$team2]['TOTAL']) {
                $arResult[$team1]['SCORE'] = 2;
                if ($arScored[$team1]['OT']) {
                    $arResult[$team2]['SCORE'] = 1;
                } else {
                    $arResult[$team2]['SCORE'] = 0;
                }
            } else {
                if ($arScored[$team2]['OT']) {
                    $arResult[$team1]['SCORE'] = 1;
                } else {
                    $arResult[$team1]['SCORE'] = 0;
                }
                $arResult[$team2]['SCORE'] = 2;
            }
        } else {
            if ($arScored[$team1]['BULLIT']) {
                $arResult[$team1]['SCORE'] = 2;
                $arResult[$team2]['SCORE'] = 1;
            } else if ($arScored[$team2]['BULLIT']) {
                $arResult[$team1]['SCORE'] = 1;
                $arResult[$team2]['SCORE'] = 2;
            }
        }
        $arResult[$team1]['SCORED'] = $arScored[$team1]['TOTAL'] + $arScored[$team1]['BULLIT'];
        $arResult[$team2]['SCORED'] = $arScored[$team2]['TOTAL'] + $arScored[$team2]['BULLIT'];
        $arResult[$team1]['MISSED'] = $arScored[$team2]['TOTAL'] + $arScored[$team2]['BULLIT'];
        $arResult[$team2]['MISSED'] = $arScored[$team1]['TOTAL'] + $arScored[$team1]['BULLIT'];
        $arResult['RESULT']['TOTAL'] = (($arResult[$team1]['SCORED']) ? $arResult[$team1]['SCORED'] : "0") . ":" . (($arResult[$team2]['SCORED']) ? $arResult[$team2]['SCORED'] : "0");
        $arResult['RESULT']['1'] = (($arScored[$team1][1] > 0) ? $arScored[$team1][1] : "0") . ":" . (($arScored[$team2][1] > 0) ? $arScored[$team2][1] : "0");
        $arResult['RESULT']['2'] = (($arScored[$team1][2] > 0) ? $arScored[$team1][2] : "0") . ":" . (($arScored[$team2][2] > 0) ? $arScored[$team2][2] : "0");
        $arResult['RESULT']['3'] = (($arScored[$team1][3] > 0) ? $arScored[$team1][3] : "0") . ":" . (($arScored[$team2][3] > 0) ? $arScored[$team2][3] : "0");
        $arResult['RESULT']['OT'] = (($arScored[$team1]['OT'] > 0) ? $arScored[$team1]['OT'] : "0") . ":" . (($arScored[$team2]["OT"] > 0) ? $arScored[$team2]['OT'] : "0");
        $arResult['RESULT']['B'] = (($arScored[$team1]['BULLIT'] > 0) ? $arScored[$team1]['BULLIT'] : "0") . ":" . (($arScored[$team2]['BULLIT'] > 0) ? $arScored[$team2]['BULLIT'] : "0");
        if ($arResult['RESULT']['B'] == "0:0" || !$arResult['RESULT']['B']) {
            unset($arResult['RESULT']['B']);
            if ($arResult['RESULT']['OT'] == "0:0" || !$arResult['RESULT']['OT']) {
                unset($arResult['RESULT']['OT']);
            }
        }
        return $arResult;
    }
}

function array_sort($array, $on, $order = SORT_ASC) {
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
                break;
            case SORT_DESC:
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

function sort_nested_arrays($array, $args) {
    usort($array, function ($a, $b) use ($args) {
        $res = 0;
        $a = (object) $a;
        $b = (object) $b;
        foreach ($args as $k => $v) {
            if ($a->$k == $b->$k)
                continue;
            $res = ( $a->$k < $b->$k ) ? -1 : 1;
            if ($v == 'desc')
                $res = -$res;
            break;
        } return $res;
    });
    return $array;
}

function link_youtube ($link) {
    //https://youtu.be/wfrpG_RsSkU //копировать
//https://www.youtube.com/watch?v=wfrpG_RsSkU //сслыка

//https://www.youtube.com/embed/wfrpG_RsSkU //нужная ссылка
    $code = str_replace("https://", "", $link);
    $code = str_replace("www.", "", $code);
    $code = str_replace("youtu.be/", "", $code);
    $code = str_replace("youtube.com/watch?v=", "", $code);
    $code = str_replace("youtube.com/embed/", "", $code);
    $link = "https://www.youtube.com/embed/".$code;
    return $link;
} 