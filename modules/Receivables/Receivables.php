<?php
/**
 * Created by Jacobs.
 * Auth: jacobs@anviz.com
 * Copyright: Anviz Global Inc.
 * Date: 2017/12/22
 * Time: 12:01
 * FileName: Receivables.php
 */

class Receivables extends CRMEntity
{
    var $db, $log; // Used in class functions of CRMEntity

    var $table_name = 'vtiger_receivables';
    var $table_index= 'receivablesid';
    var $column_fields = Array();

    /**
     * Mandatory table for supporting custom fields.
     */
    var $customFieldTable = Array('vtiger_receivablescf','receivablesid');
    var $entity_table = "vtiger_crmentity";

    var $tab_name = Array('vtiger_crmentity','vtiger_receivables','vtiger_receivablescf');

    var $tab_name_index = Array('vtiger_crmentity'=>'crmid','vtiger_receivables'=>'receivablesid','vtiger_receivablescf'=>'receivablesid');

    // This is the list of vtiger_fields that are in the lists.
    var $list_fields = Array(
        'Receivables No'=>Array('receivables'=>'receivables_no'),
        'Receivables Name'=>Array('receivables'=>'receivablesname'),
        'Bank' => Array('receivables'=>'bank'),
        'Assigned To'=>Array('vtiger_crmentity'=>'smownerid')
    );
    var $list_fields_name = Array(
        'Receivables No'=>'receivables_no',
        'Receivables Name'=>'receivablesname',
        'Bank' => 'bank',
        'Assigned To'=>'assigned_user_id',
    );

    var $list_link_field= 'receivablesname';

    var $search_fields = Array(
        'Receivables No'=>Array('receivables'=>'receivables_no'),
        'Receivables Name'=>Array('receivables'=>'receivablesname'),
        'Assigned To'=>Array('vtiger_crmentity'=>'smownerid'),
    );
    var $search_fields_name = Array(
        'Receivables No'=>'receivables_no',
        'Receivables Name'=>'receivablesname',
        'Assigned To'=>'assigned_user_id',
    );

    var $required_fields = Array();

    // Placeholder for sort fields - All the fields will be initialized for Sorting through initSortFields
    var $sortby_fields = Array();
    var $def_basicsearch_col = 'receivablesname';

    //Added these variables which are used as default order by and sortorder in ListView
    var $default_order_by = 'receivables_no';
    var $default_sort_order = 'ASC';

    // Used when enabling/disabling the mandatory fields for the module.
    // Refers to vtiger_field.fieldname values.
    var $mandatory_fields = Array('assigned_user_id', 'createdtime', 'modifiedtime', 'receivablesname');

    function Receivables() {
        $this->log =LoggerManager::getLogger('Receivables');
        $this->log->debug("Entering Receivables() method ...");
        $this->db = PearDatabase::getInstance();
        $this->column_fields = getColumnFields('Receivables');
        $this->log->debug("Exiting Receivables method ...");
    }

    function save_module($module)
    {

    }
}