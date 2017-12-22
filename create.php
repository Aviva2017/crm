<?php
include_once('vtlib/Vtiger/Module.php');
//error_reporting(E_ALL);

$Vtiger_Utils_Log = true;

$moduleInstance = Vtiger_Module::getInstance('Receivables');
$moduleInstance->setDefaultSharing();
exit;
$moduleName = 'Receivables';
$table = 'vtiger_'.strtolower($moduleName);

$moduleInstance = new Vtiger_Module();
$moduleInstance->name = $moduleName;
$moduleInstance->parent = 'Inventory';
$moduleInstance->save();

$moduleInstance->initTables();

$menuInstance = Vtiger_Menu::getInstance('Inventory');
$menuInstance->addModule($moduleInstance);

$blockInstance = new Vtiger_Block();
$blockInstance->label = 'LBL_'.strtoupper($moduleName).'_INFORMATION';
$moduleInstance->addBlock($blockInstance);

$blockInstance2 = new Vtiger_Block();
$blockInstance2->label = 'LBL_FUNDS_INFORMATION';
$moduleInstance->addBlock($blockInstance2);

$blockInstance3 = new Vtiger_Block();
$blockInstance3->label = 'LBL_DESCRIPTION_INFORMATION';
$moduleInstance->addBlock($blockInstance3);

$blockInstance4 = new Vtiger_Block();
$blockInstance4->label = 'LBL_CUSTOM_INFORMATION';
$moduleInstance->addBlock($blockInstance4);

$fieldInstance = new Vtiger_Field();
$fieldInstance->label = $moduleName.' NO';
$fieldInstance->name = strtolower($moduleName).'_no';
$fieldInstance->table = $table;
$fieldInstance->column = $fieldInstance->name;
$fieldInstance->columntype = 'varchar(100)';
$fieldInstance->uitype = 4;
$fieldInstance->typeofdata = 'V~O';
$fieldInstance->presence = 0;
$fieldInstance->quickcreate = 3;
$fieldInstance->masseditable = 0;
$fieldInstance->readonly = 1;
$fieldInstance->displaytype = 1;
$fieldInstance->info_type = 'BAS';
$blockInstance->addField($fieldInstance);

$fieldInstance2 = new Vtiger_Field();
$fieldInstance2->label = $moduleName.' Name';
$fieldInstance2->name = strtolower($moduleName).'name';
$fieldInstance2->table = $table;
$fieldInstance2->column = $fieldInstance2->name;
$fieldInstance2->columntype = 'varchar(100)';
$fieldInstance2->uitype = 2;
$fieldInstance2->typeofdata = 'V~M';
$fieldInstance2->presence = 0;
$fieldInstance2->quickcreate = 0;
$fieldInstance2->masseditable = 1;
$fieldInstance2->readonly = 1;
$fieldInstance2->displaytype = 1;
$fieldInstance2->info_type = 'BAS';
$blockInstance->addField($fieldInstance2);

$fieldInstance3 = new Vtiger_Field();
$fieldInstance3->label = $moduleName.' Type';
$fieldInstance3->name = strtolower($moduleName).'type';
$fieldInstance3->table = $table;
$fieldInstance3->column = $fieldInstance3->name;
$fieldInstance3->columntype = 'varchar(200)';
$fieldInstance3->uitype = 15;
$fieldInstance3->typeofdata = 'V~O';
$fieldInstance3->presence = 2;
$fieldInstance3->quickcreate = 1;
$fieldInstance3->masseditable = 1;
$fieldInstance3->readonly = 1;
$fieldInstance3->displaytype = 1;
$fieldInstance3->info_type = 'BAS';
$blockInstance->addField($fieldInstance3);
$fieldInstance3->setPicklistValues(array('Purchase payment', 'Purchase refund', 'Sales receipts', 'Sales refunds', 'Other'));

$fieldInstance4 = new Vtiger_Field();
$fieldInstance4->label = 'Relation';
$fieldInstance4->name = 'relation_id';
$fieldInstance4->table = $table;
$fieldInstance4->column = $fieldInstance4->name;
$fieldInstance4->columntype = 'int(19)';
$fieldInstance4->uitype = 10;
$fieldInstance4->typeofdata = 'N~O';
$fieldInstance4->presence = 2;
$fieldInstance4->quickcreate = 1;
$fieldInstance4->masseditable = 0;
$fieldInstance4->readonly = 1;
$fieldInstance4->displaytype = 1;
$fieldInstance4->info_type = 'BAS';
$fieldInstance4->helpinfo = 'Relate to an Account OR Vendors';
$blockInstance->addField($fieldInstance4);
$fieldInstance4->setRelatedModules(array('Accounts', 'Vendors'));

$fieldInstance5 = new Vtiger_Field();
$fieldInstance5->label = 'Bank';
$fieldInstance5->name = 'bank';
$fieldInstance5->table = $table;
$fieldInstance5->column = $fieldInstance5->name;
$fieldInstance5->columntype = 'varchar(200)';
$fieldInstance5->uitype = 15;
$fieldInstance5->typeofdata = 'V~O';
$fieldInstance5->presence = 2;
$fieldInstance5->quickcreate = 1;
$fieldInstance5->masseditable = 1;
$fieldInstance5->readonly = 1;
$fieldInstance5->displaytype = 1;
$fieldInstance5->info_type = 'BAS';
$blockInstance2->addField($fieldInstance5);
$fieldInstance5->setPicklistValues(array('Alipay', 'Weixin', 'CCB', 'ABC', 'ICBC', 'BCM', 'PBC', 'BOC', 'CMBC', 'CMB', 'CIB'));

$fieldInstance6 = new Vtiger_Field();
$fieldInstance6->label = 'Amount';
$fieldInstance6->name = 'amount';
$fieldInstance6->table = $table;
$fieldInstance6->column = $fieldInstance6->name;
$fieldInstance6->columntype = 'decimal(25,8)';
$fieldInstance6->uitype = 71;
$fieldInstance6->typeofdata = 'N~O';
$fieldInstance6->presence = 2;
$fieldInstance6->quickcreate = 1;
$fieldInstance6->masseditable = 1;
$fieldInstance6->readonly = 1;
$fieldInstance6->displaytype = 1;
$fieldInstance6->info_type = 'BAS';
$blockInstance2->addField($fieldInstance6);


$f = new Vtiger_Field();
$f->label = 'Created Time';
$f->name = 'createdtime';
$f->table = 'vtiger_crmentity';
$f->column = $f->name;
$f->uitype = 70;
$f->typeofdata = 'DT~O';
$f->presence = 0;
$f->quickcreate = 3;
$f->masseditable = 0;
$f->readonly = 1;
$f->displaytype = 2;
$f->info_type = 'BAS';
$blockInstance->addField($f);

$f = new Vtiger_Field();
$f->label = 'Modified Time';
$f->name = 'modifiedtime';
$f->table = 'vtiger_crmentity';
$f->column = $f->name;
$f->uitype = 70;
$f->typeofdata = 'DT~O';
$f->presence = 0;
$f->quickcreate = 3;
$f->masseditable = 0;
$f->readonly = 1;
$f->displaytype = 2;
$f->info_type = 'BAS';
$blockInstance->addField($f);

$f = new Vtiger_Field();
$f->label = 'Last Modified By';
$f->name = 'modifiedby';
$f->table = 'vtiger_crmentity';
$f->column = $f->name;
$f->uitype = 52;
$f->typeofdata = 'V~O';
$f->presence = 0;
$f->quickcreate = 3;
$f->masseditable = 0;
$f->readonly = 1;
$f->displaytype = 3;
$f->info_type = 'BAS';
$blockInstance->addField($f);

$f = new Vtiger_Field();
$f->label = 'Handler';
$f->name = 'assigned_user_id';
$f->table = 'vtiger_crmentity';
$f->column = 'smownerid';
$f->uitype = 53;
$f->typeofdata = 'V~M';
$f->presence = 0;
$f->quickcreate = 0;
$f->masseditable = 1;
$f->readonly = 1;
$f->displaytype = 1;
$f->info_type = 'BAS';
$blockInstance->addField($f);

$f = new Vtiger_Field();
$f->label = 'Description';
$f->name = 'description';
$f->table = 'vtiger_crmentity';
$f->column = 'description';
$f->uitype = 19;
$f->typeofdata = 'V~O';
$f->presence = 2;
$f->quickcreate = 1;
$f->masseditable = 1;
$f->readonly = 1;
$f->displaytype = 1;
$f->info_type = 'ADV';
$blockInstance3->addField($f);

$filterInstance = new Vtiger_Filter();
$filterInstance->name = 'All';
$filterInstance->isdefault = true;
$filterInstance->addField($fieldInstance, 0);
$filterInstance->addField($fieldInstance2, 1);
$filterInstance->addField($fieldInstance3, 2);
$filterInstance->addField($fieldInstance4, 3);
$moduleInstance->addFilter($filterInstance);

$accountsModule = Vtiger_Module::getInstance('Accounts');
$moduleInstance->setRelatedList($accountsModule, 'Accounts', array('ADD','SELECT'));

//$moduleInstance->setDefaultSharing('Public_ReadWriteDelete');

$moduleInstance->enableTools(array('Import', 'Export'));

$moduleInstance->initWebservice();

echo 'OK';