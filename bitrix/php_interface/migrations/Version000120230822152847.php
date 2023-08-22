<?php

namespace Sprint\Migration;


class Version000120230822152847 extends Version
{
    protected $description = "Для тестового модуля";

    protected $moduleVersion = "4.2.4";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $hlblockId = $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'MyEntityName',
  'TABLE_NAME' => 'testnamehlblock',
));
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_NAME',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => NULL,
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'I',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Title',
    'ru' => 'Название',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_DESCRIPTION',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => NULL,
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'I',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Description',
    'ru' => 'Описание',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_USERNAME',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => NULL,
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'I',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'User',
    'ru' => 'Пользователь',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_DATE_FROM',
  'USER_TYPE_ID' => 'date',
  'XML_ID' => NULL,
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'I',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 
    array (
      'TYPE' => 'NONE',
      'VALUE' => '',
    ),
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Date create',
    'ru' => 'Дата создания',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_DATE_TO',
  'USER_TYPE_ID' => 'date',
  'XML_ID' => NULL,
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'I',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 
    array (
      'TYPE' => 'NONE',
      'VALUE' => '',
    ),
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Date close',
    'ru' => 'Дата исполнения',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_STATUS',
  'USER_TYPE_ID' => 'enumeration',
  'XML_ID' => NULL,
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'I',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DISPLAY' => 'LIST',
    'LIST_HEIGHT' => 1,
    'CAPTION_NO_VALUE' => '',
    'SHOW_NO_VALUE' => 'Y',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Status',
    'ru' => 'Статус',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => NULL,
    'ru' => NULL,
  ),
  'ENUM_VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Активный',
      'DEF' => 'N',
      'SORT' => '10',
      'XML_ID' => 'XML_ID_UF_ENUM_1',
    ),
    1 => 
    array (
      'VALUE' => 'Отменённый',
      'DEF' => 'N',
      'SORT' => '20',
      'XML_ID' => 'XML_ID_UF_ENUM_2',
    ),
    2 => 
    array (
      'VALUE' => 'Завершённый',
      'DEF' => 'N',
      'SORT' => '30',
      'XML_ID' => 'XML_ID_UF_ENUM_3',
    ),
  ),
));
        }

    public function down()
    {
        //your code ...
    }
}
