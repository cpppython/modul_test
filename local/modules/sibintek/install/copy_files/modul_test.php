<?php
namespace Sibintek;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");

use \Bitrix\Highloadblock\HighloadBlockTable as HLBT;
use Bitrix\Main\Loader;
use Bitrix\Main\Grid\Options as GridOptions;
use Bitrix\Main\UI\PageNavigation;

Loader::includeModule("sibintek");
Loader::includeModule("highloadblock"); 


$list_id = 'test_list';
$grid_options = new GridOptions($list_id);
$nav_params = $grid_options->GetNavParams();

$filterOption = new \Bitrix\Main\UI\Filter\Options($list_id);
$filterData = $filterOption->getFilter([]);


// FILTER 
$filter = [];
$date_from = strtotime($filterData['DATE_FROM_from']);
$date_to = strtotime($filterData['DATE_TO_to']);

if ($filterData['FIND']) {

    $filter = [ 
        "LOGIC" => "OR", 
            ["UF_NAME" => '%'.$filterData['FIND'].'%'], 
            ["UF_DESCRIPTION" => '%'.$filterData['FIND'].'%'],
            ["UF_USERNAME" => '%'.$filterData['FIND'].'%'],
            ["U_NAME" => '%'.$filterData['FIND'].'%'],
            ["U_LAST_NAME" => '%'.$filterData['FIND'].'%'],
    ];
}
if ($filterData['NAME']) {
    $filter['UF_NAME'] = "%".$filterData['NAME']."%";
}
if ($filterData['DESCRIPTION']) {
    $filter['UF_DESCRIPTION'] = "%".$filterData['DESCRIPTION']."%";
}
if ($filterData['USERNAME']) {
    $filter = [ 
        "LOGIC" => "OR", 
            ["UF_USERNAME" => '%'.$filterData['USERNAME'].'%'], 
            ["U_NAME" => '%'.$filterData['USERNAME'].'%'], 
    ];
}

if ($filterData['DATE_FROM_from'] && $filterData['DATE_TO_to']) {
    $filter = [ 
        "LOGIC" => "AND", 
            [">=UF_DATE_FROM" => Date('d.m.Y', $date_from)], 
            ["<=UF_DATE_TO" => Date('d.m.Y', $date_to)]
    ];
}
else {
    if ($filterData['DATE_FROM_from']) {
        $filter['=UF_DATE_FROM'] = Date('d.m.Y', $date_from);
    }
    if ($filterData['DATE_TO_to']) {
        $filter['=UF_DATE_TO'] = Date('d.m.Y', $date_to);
    }
}

$statusItems = [];
$all = false;
if ($filterData['STATUS']) {

    foreach ($filterData['STATUS'] as $statusItem) {

        $statusItems [] = UserFieldId($statusItem);
        if (UserFieldId($statusItem) == '') {
            $all = true;
            break;
        }
    }
    if (!$all) {
        $filter['UF_STATUS'] = $statusItems;
    }
}
// FILTER - End

$hlTableName = HLTable::getTableName();
$hlBlock_id = HLTable::getTableId($hlTableName);

$hlblock = HLBT::getById($hlBlock_id)->fetch();
$entity = HLBT::compileEntity($hlblock);
$entityDataClass = $entity->getDataClass();

$limit = 10;

$res = $entityDataClass::getList([
	"select" => ["*", "U_NAME" => "USER_TABLE.NAME", "U_LAST_NAME" => "USER_TABLE.LAST_NAME"], 
	"order" => ["ID" => "ASC"], 
    "count_total" => true,
	"offset" => ($_REQUEST[$list_id]) ? (str_replace("page-", "", $_REQUEST[$list_id]) * $limit) - 10 : 0 ,
	"limit" => $limit,
	"filter" => $filter, 
	'runtime' => [
		(
            new \Bitrix\Main\ORM\Fields\Relations\Reference(
			'USER_TABLE',
			\Bitrix\Main\UserTable::class,
			\Bitrix\Main\ORM\Query\Join::on('this.ID', 'ref.ID')))->configureJoinType(\Bitrix\Main\ORM\Query\Join::TYPE_INNER
        )
	]
]);

$ui_filter = [
	['id' => 'NAME', 'name' => 'Название', 'type'=>'text', 'default' => true],
	['id' => 'DESCRIPTION', 'name' => 'Описание', 'type'=>'text', 'default' => true],
	['id' => 'USERNAME', 'name' => 'Пользователь', 'type'=>'text', 'default' => true],
	['id' => 'DATE_FROM', 'name' => 'Дата создания', 'type'=>'date', 'default' => true],
	['id' => 'DATE_TO', 'name' => 'Дата исполнения', 'type'=>'date', 'default' => true],
	['id' => 'STATUS', 'name' => 'Статус', 'type' => 'list', 'items' => ['Все' => 'Все', 'Активный' => 'Активный', 'Отменённый' => 'Отменённый', 'Завершённый' => 'Завершённый'], 'params' => ['multiple' => 'Y'], 'default' => true],
];
?>
    <h2>Фильтр</h2>
    <div>
		<?$APPLICATION->IncludeComponent('bitrix:main.ui.filter', '', [
			'FILTER_ID' => $list_id,
			'GRID_ID' => $list_id,
			'FILTER' => $ui_filter,
			'ENABLE_LIVE_SEARCH' => true,
			'ENABLE_LABEL' => true
		]);?>
    </div>
    <div style="clear: both;"></div>

    <hr>

    <h2>Таблица</h2>
<?php
$columns = [];
$columns[] = ['id' => 'ID', 'name' => 'ID', 'sort' => 'ID', 'default' => true];
$columns[] = ['id' => 'NAME', 'name' => 'Название', 'sort' => 'NAME', 'default' => true];
$columns[] = ['id' => 'DESCRIPTION', 'name' => 'Описание', 'sort' => 'DESCRIPTION', 'default' => true];
$columns[] = ['id' => 'USERNAME', 'name' => 'Пользователь', 'sort' => 'USERNAME', 'default' => true];
$columns[] = ['id' => 'DATE_FROM', 'name' => 'Дата создания', 'sort' => 'DATE_FROM', 'default' => true];
$columns[] = ['id' => 'DATE_TO', 'name' => 'Дата исполнения', 'sort' => 'DATE_TO', 'default' => true];
$columns[] = ['id' => 'STATUS', 'name' => 'Статус', 'sort' => 'STATUS', 'default' => true];


// Значение элемента списка по ID
function UserFieldValue($ID) {
	$UserField = \CUserFieldEnum::GetList([], ["ID" => $ID]);
	if($UserFieldAr = $UserField->GetNext())
	{
		return $UserFieldAr["VALUE"];
	}
	else return false;
}

// ID элемента списка по значению
function UserFieldId($VALUE) {
	$UserField = \CUserFieldEnum::GetList([], ["VALUE" => $VALUE]);
	if($UserFieldAr = $UserField->GetNext())
	{
		return $UserFieldAr["ID"];
	}
	else return false;
}

foreach ($res->fetchAll() as $row) {

	$list[] = [
		'data' => [
			"ID" => $row['ID'],
			"NAME" => $row['UF_NAME'],
			"DESCRIPTION" => $row['UF_DESCRIPTION'],
			"USERNAME" => (($row['U_NAME'])?$row['U_NAME']:$row['UF_USERNAME']).' '.(($row['U_LAST_NAME']) ? $row['U_LAST_NAME'] : ''), // $row['UF_USERNAME'],
			"DATE_FROM" => ($row['UF_DATE_FROM'] == '') ? '-' : $row['UF_DATE_FROM'],
			"DATE_TO" => ($row['UF_DATE_TO'] == '') ? '-' : $row['UF_DATE_TO'],
			//"STATUS" => $row['UF_STATUS'],
			"STATUS" => (UserFieldId($row['UF_STATUS']) == NULL) ? UserFieldValue($row['UF_STATUS']) : '',
		],
		'actions' => [
			[
				'text'    => 'Просмотр',
				'default' => true,
				'onclick' => 'document.location.href="?op=view&id='.$row['ID'].'"'
			], [
				'text'    => 'Удалить',
				'default' => true,
				'onclick' => 'if(confirm("Точно?")){document.location.href="?op=delete&id='.$row['ID'].'"}'
			]
		]
	];
}

$nav = new \Bitrix\Main\UI\PageNavigation($list_id);
$nav->allowAllRecords(false)
   ->setPageSize($limit)
   ->initFromUri();
$nav->setRecordCount($res->getCount());

$APPLICATION->IncludeComponent('bitrix:main.ui.grid', '', [
	'GRID_ID' => $list_id,
	'COLUMNS' => $columns,
	'ROWS' => $list,
	'SHOW_ROW_CHECKBOXES' => false,
	'NAV_OBJECT' => $nav,
	'FOOTER' => [
			'TOTAL_ROWS_COUNT' => $res->getCount(),
		],
	'AJAX_MODE' => 'Y',
	'AJAX_ID' => \CAjax::getComponentID('bitrix:main.ui.grid', '.default', ''),
   'SHOW_ROW_CHECKBOXES' => false,
   'SHOW_CHECK_ALL_CHECKBOXES' => false,
   'SHOW_ROW_ACTIONS_MENU'     => false,
   'SHOW_GRID_SETTINGS_MENU'   => false,
   'SHOW_NAVIGATION_PANEL'     => true,
   'SHOW_PAGINATION'           => true,
   'SHOW_SELECTED_COUNTER'     => false,
   'SHOW_TOTAL_COUNTER'        => true,
   'SHOW_PAGESIZE'             => false,   
   'SHOW_ACTION_PANEL'         => false,
   'ALLOW_COLUMNS_SORT'        => false,
   'ALLOW_COLUMNS_RESIZE'      => true,
   'ALLOW_HORIZONTAL_SCROLL'   => true,
   'ALLOW_SORT'                => false,
   'ALLOW_PIN_HEADER'          => true,
   'ALLOW_CONTEXT_MENU'          => false,
   'SHOW_MORE_BUTTON'          => true,
   'AJAX_OPTION_HISTORY'       => 'N'   
]);

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>