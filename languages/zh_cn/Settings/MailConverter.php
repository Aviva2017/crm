<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * 简体中文语言包 - 邮件转换
 * 版本: 7.0.0 
 * 作者: Maie | www.maie.name
 * 更新日期: 2016-12-28
 * All Rights Reserved.
 *************************************************************************************/
$languageStrings = array(
	'MailConverter' => '邮件扫描',
	'MailConverter_Description' => '将电子邮件转换为相应的记录',
	'MAILBOX' => '邮箱',
	'RULE' => '规则',
	'LBL_ADD_RECORD' => '添加邮箱',
	'ALL' => '所有',
	'UNSEEN' => '未读',
	'LBL_MARK_READ' => '标记为已读',
	'SEEN' => '已读',
	'LBL_EDIT_MAILBOX' => '编辑邮箱',
        'LBL_CREATE_MAILBOX' => '创建邮箱',
	'LBL_BACK_TO_MAILBOXES' => '返回邮箱',
	'LBL_MARK_MESSAGE_AS' => '标记邮件为',
	'LBL_CREATE_MAILBOX_NOW' => '现在创建邮箱',
	'LBL_ADDING_NEW_MAILBOX' => '添加新邮箱',
	'MAILBOX_DETAILS' => '邮箱详细信息',
	'SELECT_FOLDERS' => '选择文件夹',
	'ADD_RULES' => '添加规则',
	'CREATE_Leads_SUBJECT' => '创建潜在客户',
	'CREATE_Contacts_SUBJECT' => '创建联系人',
	'CREATE_Accounts_SUBJECT' => '创建客户',
	'LBL_ACTIONS' => '操作',
	'LBL_MAILBOX' => '邮箱',
	'LBL_RULE' => '规则',
	'LBL_CONDITIONS' => '条件',
	'LBL_FOLDERS_SCANNED' => '文件夹已扫描',
	'LBL_NEXT' => '下一步',
	'LBL_FINISH' => '完成',
	'TO_CHANGE_THE_FOLDER_SELECTION_DESELECT_ANY_OF_THE_SELECTED_FOLDERS' => '要更改文件夹选择取消选中任何选定的文件夹',
	'LBL_MAILCONVERTER_DESCRIPTION' => "邮件扫描转换器允许您配置通过自动扫描您的邮箱中的邮件来创建相应的 CRM 对象。<br/>你也需要定义规则来指定在指定的邮件上完成什么操作。<br/>扫描电子邮件的操作是自动，除非你在计划中禁用邮件扫描任务。 <br /><br /><br />",

	//Server Messages
	'LBL_MAX_LIMIT_ONLY_TWO' => '您可以配置两个邮箱',
	'LBL_IS_IN_RUNNING_STATE' => '在运行状态',
	'LBL_SAVED_SUCCESSFULLY' => '保存成功',
	'LBL_CONNECTION_TO_MAILBOX_FAILED' => '连接到邮箱失败！<br>服务器名称和用户名不能包含特殊字符。',
	'LBL_DELETED_SUCCESSFULLY' => '删除成功',
	'LBL_RULE_DELETION_FAILED' => '规则删除失败',
	'LBL_RULES_SEQUENCE_INFO_IS_EMPTY' => '规则排序信息为空',
	'LBL_SEQUENCE_UPDATED_SUCCESSFULLY' => '已成功更新顺序',
	'LBL_SCANNED_SUCCESSFULLY' => '扫描成功',

	//Field Names
	'scannername' => '扫描名称',
	'server' => '邮件服务器名称',
	'protocol' => '协议',
	'username' => '邮箱账户',
	'password' => '邮箱密码',
	'ssltype' =>  'SSL 类型',
	'sslmethod' => 'SSL 方法',
	'connecturl' => '连接 URL',
	'searchfor' => '查找',
	'markas' => '扫描后标记为',
    'isvalid' => '状态',
    'time_zone' => '邮件服务器时区',
    'scanfrom' => '扫描邮件从',
    'YESTERDAY' => '昨天',

	//Field values & Messages
	'LBL_ENABLE' => '启用',
	'LBL_DISABLE' =>'禁用',	
	'LBL_STATUS_MESSAGE' => '勾选激活',
	'LBL_VALIDATE_SSL_CERTIFICATE' => '验证 SSL 证书',
	'LBL_DO_NOT_VALIDATE_SSL_CERTIFICATE' => '不验证 SSL 证书',
	'LBL_ALL_MESSAGES_FROM_LAST_SCAN' => '从上次扫描后的所有信息',
	'LBL_UNREAD_MESSAGES_FROM_LAST_SCAN' => '从上次扫描后的未读消息',
	'LBL_MARK_MESSAGES_AS_READ' => '标记信息为已读',
	'LBL_I_DONT_KNOW' => "我不确定",

	//Mailbox Actions
	'LBL_SCAN_NOW' => '立即扫描',
	'LBL_RULES_LIST' => '规则列表',
	'LBL_SELECT_FOLDERS' => '选择文件夹',

	//Action Messages
	'LBL_DELETED_SUCCESSFULLY' => '删除成功',
	'LBL_RULE_DELETION_FAILED' => '规则删除失败',
	'LBL_SAVED_SUCCESSFULLY' => '保存成功',
	'LBL_SCANED_SUCCESSFULLY' => '扫描成功',
	'LBL_IS_IN_RUNNING_STATE' => '处于运行状态',
	'LBL_FOLDERS_INFO_IS_EMPTY' => '文件夹信息为空',
	'LBL_RULES_SEQUENCE_INFO_IS_EMPTY' => '规则顺序信息为空',
	
	//Folder Actions
	'LBL_UPDATE_FOLDERS' => '更新文件夹',

	//Rule Fields
	'fromaddress' => '发件人',
	'toaddress' => '收件人',
	'subject' => '主题',
	'body' => '内容',
	'matchusing' => '匹配',
	'action' => '操作',

	//Rules List View labels
	'LBL_PRIORITY' => '优先级',
	'PRIORITISE_MESSAGE' => '按住鼠标拖动调整规则的优先级',
	'LBL_NOTE'=>'备注',
	'LBL_MAILCONVERTER_DISABLE_MESSAGE'=>'邮件转换功能将在7月31日停用。邮件中心提供了一种更多容易的方式扫描您的邮件。需要激活邮件中心，请 ',
	'LBL_CLICK_HERE'=>'点击这里',
	

	//Rule Field values & Messages	
	'LBL_ALL_CONDITIONS' => '所有条件',	
	'LBL_ANY_CONDITIOn' => '任何条件',

	//Rule Conditions
	'Contains' => '包含',
	'Not Contains' => '不包含',
	'Equals' => '等于',
	'Not Equals' => '不等于',
	'Begins With' => '开始于',
	'Ends With' => '结束于',
	'Regex' => '正则表达式',
    'LBL_FROM_ADDRESS_PLACE_HOLDER' => '邮件地址或域名',

	//Rule Actions
	'CREATE_HelpDesk_FROM' => '创建服务单（有联系人）',
    'CREATE_HelpDeskNoContact_FROM' => '创建服务单（无联系人）',
	'UPDATE_HelpDesk_SUBJECT' => '更新服务单',
	'LINK_Contacts_FROM' => '添加到联系人 [发件人]',
	'LINK_Contacts_TO' => '添加到联系人 [收件人]',
	'LINK_Accounts_FROM' => '添加到客户 [发件人]',
	'LINK_Accounts_TO' => '添加到客户 [收件人]',
	'LINK_Leads_FROM' => '添加到潜在客户 [发件人]',
	'LINK_Leads_TO' => '添加到潜在客户 [收件人]',
    'CREATE_Potentials_SUBJECT' => '创建销售机会（有联系人）',
    'CREATE_PotentialsNoContact_SUBJECT' => '创建销售机会（无联系人）',
    'LINK_Potentials_FROM' => '添加到销售机会 [发件人]',
    'LINK_Potentials_TO' => '添加到销售机会 [收件人]',
    'LINK_HelpDesk_FROM' => '添加到服务单 [发件人]',
    'LINK_HelpDesk_TO' => '添加到服务单 [收件人]',

    //Select Folder
    'LBL_UPDATE_FOLDERS' => '更新文件夹',
	'LBL_UNSELECT_ALL' => '取消全选',

	//Setup Rules
	'LBL_CONVERT_EMAILS_TO_RESPECTIVE_RECORDS' => '将电子邮件转换为相应的记录',	
	'LBL_DRAG_AND_DROP_BLOCK_TO_PRIORITISE_THE_RULE' => '按住鼠标拖动调整规则的优先级',
	'LBL_ADD_RULE' => '添加规则',
    'LBL_EDIT_RULE' => '编辑规则',
	'LBL_PRIORITY' => '优先级',
	'LBL_DELETE_RULE' => '删除规则',
	'LBL_BODY' => '内容',
	'LBL_MATCH' => '匹配',
	'LBL_ACTION' => '操作',
	'LBL_FROM' => '发件人',	
	'LBL_CONNECTION_ERROR' => '连接邮箱失败。请检查网络连接，再试一次。', 
    'LBL_RULE_CONDITIONS' => '规则条件',
    'LBL_RULE_ACTIONS' => '规则操作',

    // Body Rule
    'LBL_AUTOFILL_VALUES_FROM_EMAIL_BODY' => '从电子邮件正文自动填充关键字',
    'LBL_DELIMITER' => '分隔符',
    'LBL_COLON' => ': (冒号)',
    'LBL_SEMICOLON' => '; (分号)',
    'LBL_DASH' => '- (连字符)',
    'LBL_EQUAL' => '= (等号)',
    'LBL_GREATER_THAN' => '> (大于)',
    'LBL_COLON_DASH' => ':- (冒号 + 连字符)',
    'LBL_COLON_EQUAL' => ':= (冒号 + 等号)',
    'LBL_SEMICOLON_DASH' => ';- (分号 + 连字符)',
    'LBL_SEMICOLON_EQUAL' => ';= (分号 + 等号)',
    'LBL_EQUAL_GREATER_THAN' => '=> (等号 + 大于)',
    'LBL_OTHER' => '其它',
    'LBL_DELIMITER_INFO' => '请选择电子邮件正文标签分隔符',
    'LBL_EMAIL_BODY_INFO' => '将要扫描的示例电子邮件中的文本复制到下面的框中。 CRM 将尝试定位关键字，并帮助您映射到 CRM 字段。',
    'LBL_SAMPLE_BODY_TEXT' => '示例正文文本',
    'LBL_FIND_FIELDS' => '点击这里从电子邮件正文中查找关键字',
    'LBL_BODY_FIELDS' => '来自电子邮件的关键字',
    'LBL_CRM_FIELDS' => 'CRM 字段',
    'LBL_MAP_TO_CRM_FIELDS' => '映射关键字到 CRM 字段',
    'SELECT_FIELD' => '选择字段',
    'LBL_SAVE_MAPPING_INFO' => '保存现有邮件转换器规则的正文规则将覆盖现有正文规则。',
    'LBL_MULTIPLE_FIELDS_MAPPED' => '无法将多个字段映射到一个 CRM 字段',
    'LBL_BODY_RULE' => '正文规则已定义',
	
    'LBL_MAIL_SCANNER_INACTIVE' => '此邮箱是无效状态',
    'LBL_NO_RULES' => '此邮箱未定义任何规则',
    
    'LBL_SCANNERNAME_ALPHANUMERIC_ERROR' => '扫描名称仅接受字母和数字值。 不允许使用特殊字符。',
    'LBL_SERVER_NAME_ERROR' => '服务器名称无效。 服务器名称不允许使用特殊字符。',
    'LBL_USERNAME_ERROR' => '请输入有效电子邮件地址作为用户名。',
    'servertype' => '服务器类型',
    'LBL_DUPLICATE_USERNAME_ERROR' => '已经有使用此电子邮件地址配置的邮件转换器。 您不能使用相同的电子邮件地址创建重复的邮件转换器。',
    'LBL_DUPLICATE_SCANNERNAME_ERROR' => '已经有使用此名称配置的邮件转换器。您不能再创建重复名称的邮件转换器。',
);

$jsLanguageStrings = array(
	'JS_MAILBOX_DELETED_SUCCESSFULLY' => '邮箱删除成功',
	'JS_MAILBOX_LOADED_SUCCESSFULLY' => '邮箱加载成功',
    'JS_SELECT_ATLEAST_ONE' => '请至少映射一个字段',
    'JS_SERVER_NAME' => '输入服务器名称',
    'JS_TIMEZONE' => '邮件服务器时区',
    'JS_SCAN_FROM' => '扫描邮件从',
    'JS_TIMEZONE_INFO' => '请选择您的邮件服务器所在的时区。选择错误的时区可能会跳过扫描一些电子邮件。',
    'JS_SCAN_FROM_INFO' => '此字段决定是否应扫描邮箱中的所有邮件，或扫描昨天或以后登录到邮箱中的邮件。 此字段仅适用于首次配置或选择要扫描的新文件夹时。',
    'JS_SELECT_ONE_FOLDER' => '您必须至少选择一个文件夹。',
);	
