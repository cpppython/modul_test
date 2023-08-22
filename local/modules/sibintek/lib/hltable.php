<?php
namespace Sibintek;

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

Loader::includeModule("highloadblock");
Loader::includeModule("main");
Loader::includeModule("iblock");

class HLTable
{
    // название hl блока
    public static function getTableName() 
    {
        return 'testnamehlblock';
    }

    // получение ID HLBlock
    public static function getTableId($hlTableName) 
    {
        $filter = [
            'select' => ['ID'],
            'filter' => ['=TABLE_NAME' => self::getTableName()]
        ];

        $hlblock = HLBT::getList($filter)->fetch();
        return $hlblock['ID'];
    }

    // создание блока
    public static function createDbTable () 
    {
        if (Loader::includeModule("highloadblock")) {
            $result = HLBT::add([ 
                'NAME' => "MyEntityName",
                'TABLE_NAME' => self::getTableName()
            ]);

            if ($result->isSuccess()) {
                self::addFields($result);
            }
        
        }
    }

    // удаление блока
    public static function deleteDbTable () 
    {
        if (Loader::includeModule("highloadblock")) {
            $filter = [
                'select' => ['ID'],
                'filter' => ['=TABLE_NAME' => self::getTableName()]
            ];

            $hlblock = HLBT::getList($filter)->fetch();
            
            if(is_array($hlblock) && !empty($hlblock)) {
                HLBT::delete($hlblock['ID']);
            }
        }
    }

    private static function initEntity($hlId)
    {
        $hlblock = HL\HighloadBlockTable::getById($hlId)->fetch();
        if(empty($hlblock))
            throw new \Bitrix\Main\LoaderException('Error: HL Block Id is incorrect!');

        $entity = HL\HighloadBlockTable::compileEntity($hlblock);

        return $entity->getDataClass();
    }
    
    // добавление полей hlblock 
    public static function addFields($result) 
    {
        $arFields = [
            "U_FIELDS" => [
                "ENTITY_ID" => "HLBLOCK_".$result->getId(),
                "FIELD_NAME" => "UF_NAME",
                "USER_TYPE_ID" => "string",
                "MULTIPLE" => "N",
                "MANDATORY" => "N", 
                "SETTINGS" => ["DEFAULT_VALUE" => ""],
                'SHOW_FILTER'       => 'I',
                'EDIT_FORM_LABEL'   => [
                    'ru'            => 'Название',
                    'en'            => 'Title',
                ]
            ], 
            [
                "ENTITY_ID" => "HLBLOCK_".$result->getId(),
                "FIELD_NAME" => "UF_DESCRIPTION",
                "USER_TYPE_ID" => "string",
                "MULTIPLE" => "N",
                "MANDATORY" => "N", 
                "SETTINGS" => ["DEFAULT_VALUE" => ""],
                'SHOW_FILTER'       => 'I',
                'EDIT_FORM_LABEL'   => [
                    'ru'            => 'Описание',
                    'en'            => 'Description',
                ]
            ], 
            [
                "ENTITY_ID" => "HLBLOCK_".$result->getId(),
                "FIELD_NAME" => "UF_USERNAME",
                "USER_TYPE_ID" => "string",
                "MULTIPLE" => "N",
                "MANDATORY" => "N", 
                "SETTINGS" => ["DEFAULT_VALUE" => ""],
                'SHOW_FILTER'       => 'I',
                'EDIT_FORM_LABEL'   => [
                    'ru'            => 'Пользователь',
                    'en'            => 'User',
                ]
            ], 
            [
                "ENTITY_ID" => "HLBLOCK_".$result->getId(),
                "FIELD_NAME" => "UF_DATE_FROM",
                "USER_TYPE_ID" => "date",
                "MULTIPLE" => "N",
                "MANDATORY" => "N", 
                "SETTINGS" => ["DEFAULT_VALUE" => ""],
                'SHOW_FILTER'       => 'I',
                'EDIT_FORM_LABEL'   => [
                    'ru'            => 'Дата создания',
                    'en'            => 'Date create',
                ]
            ], 
            [
                "ENTITY_ID" => "HLBLOCK_".$result->getId(),
                "FIELD_NAME" => "UF_DATE_TO",
                "USER_TYPE_ID" => "date",
                "MULTIPLE" => "N",
                "MANDATORY" => "N", 
                "SETTINGS" => ["DEFAULT_VALUE" => ""],
                'SHOW_FILTER'       => 'I',
                'EDIT_FORM_LABEL'   => [
                    'ru'            => 'Дата исполнения',
                    'en'            => 'Date close',
                ]
            ], 
            [
                "ENTITY_ID" => "HLBLOCK_".$result->getId(),
                "FIELD_NAME" => "UF_STATUS",
                "USER_TYPE_ID" => "enumeration",
                "MULTIPLE" => "N",
                "MANDATORY" => "N", 
                "SETTINGS" => ["DEFAULT_VALUE" => ""],
                'SHOW_FILTER'       => 'I',
                'EDIT_FORM_LABEL'   => [
                    'ru'            => 'Статус',
                    'en'            => 'Status',
                ]
            ],  
        ];

        $obUserField  = new \CUserTypeEntity;
        foreach ($arFields as $arFieldsItem) {
            $LAST_UF_ID = $obUserField->Add($arFieldsItem);
        }

        // добавление значений в список
        $valueEnum = [
            0 => "",
            1 => "Активный",
            2 => "Отменённый",
            3 => "Завершённый"
        ];
        
        for ($i = 0; $i < 4; $i++) {
            $arAddEnum['n'.$i] = [
                'XML_ID' => "XML_ID_UF_ENUM_".$i,
                'VALUE' => $valueEnum[$i],
                'DEF' => 'N', //по умолчанию
                'SORT' => 10 * $i
            ];
        }
        $obEnum = new \CUserFieldEnum;
        $obEnum->SetEnumValues($LAST_UF_ID, $arAddEnum);
    }
}
