<?php
namespace Sibintek;

use Bitrix\Main\Localization\Loc,
	Bitrix\Main\ORM\Data\DataManager,
	Bitrix\Main\ORM\Fields\DateField,
	Bitrix\Main\ORM\Fields\IntegerField,
	Bitrix\Main\ORM\Fields\TextField;

Loc::loadMessages(__FILE__);

/**
 * Class Table
 * 
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> UF_NAME text optional
 * <li> UF_DESCRIPTION text optional
 * <li> UF_USERNAME text optional
 * <li> UF_DATE_FROM date optional
 * <li> UF_DATE_TO date optional
 * <li> UF_STATUS int optional
 * </ul>
 *
 * @package Bitrix\
 **/

class Table extends DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'testnamehlblock';
	}

	/**
	 * Returns entity map definition.
	 *
	 * @return array
	 */
	public static function getMap()
	{
		return [
			new IntegerField(
				'ID',
				[
					'primary' => true,
					'autocomplete' => true,
					'title' => 'ID' //Loc::getMessage('_ENTITY_ID_FIELD')
				]
			),
			new TextField(
				'UF_NAME',
				[
					'title' => 'NAME' 
				]
			),
			new TextField(
				'UF_DESCRIPTION',
				[
					'title' => 'DESCRIPTION' 
				]
			),
			new TextField(
				'UF_USERNAME',
				[
					'title' => 'USERNAME' 
				]
			),
			new DateField(
				'UF_DATE_FROM',
				[
					'title' => 'DATE_FROM' 
				]
			),
			new DateField(
				'UF_DATE_TO',
				[
					'title' => 'DATE_TO' 
				]
			),
			new IntegerField(
				'UF_STATUS',
				[
					'title' => 'STATUS' 
				]
			),
		];
	}
}