<?php
use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Entity\Base;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Config\Option;
use Bitrix\Main\IO\Directory;
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
use Sibintek\HLTable;

Loc::loadMessages(__FILE__);

class Sibintek extends CModule
{
    public function __construct()
    {
        $arModuleVersion = array();

        include __DIR__ . '/version.php';

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }
        $this->MODULE_ID = 'sibintek';
        $this->MODULE_NAME = 'Тестовый модуль';
        $this->MODULE_DESCRIPTION = 'Тестовый модуль, описание';
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = 'Sibintek';
        $this->PARTNER_URI = 'https://site.site';
    }
    
    public function doInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        $this->installDB();
    }
	
    public function doUninstall()
    {
        $this->uninstallDB();
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }
	
    public function installDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            HLTable::createDbTable();
            // копируем файлы, необходимые для работы модуля
            $this->InstallFiles();
            
        }
    }
	
    public function uninstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {

            // тут удаление таблицы
            HLTable::deleteDbTable();
            $this->UnInstallFiles();
            //UnRegisterModule("sibintek");
        }
    }

    public function InstallFiles()
	{
		CopyDirFiles(
			$_SERVER["DOCUMENT_ROOT"]."/local/modules/sibintek/install/copy_files/",
			$_SERVER["DOCUMENT_ROOT"]."/",
			true, true
		);
		return true;
	}
	public function UnInstallFiles()
	{
		DeleteDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/sibintek/install/copy_files", $_SERVER["DOCUMENT_ROOT"]."/");
		return true;
	}

}