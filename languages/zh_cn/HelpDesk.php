<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * 简体中文语言包 - 服务台
 * 版本: 7.0.0 
 * 作者: Maie | www.maie.name
 * 更新日期: 2016-12-31
 * All Rights Reserved.
 *************************************************************************************/
$languageStrings = array(
	// Basic Strings
	'HelpDesk' => '服务单',
	'SINGLE_HelpDesk' => '服务单',
	'LBL_ADD_RECORD' => '添加服务单',
	'LBL_RECORDS_LIST' => '服务单',

	// Blocks
	'LBL_TICKET_INFORMATION' => '服务单信息',
	'LBL_TICKET_RESOLUTION' => '详细解决方案',
	
	//Field Labels
	'Ticket No' => '编号',
	'Severity' => '严重程度',
	'Update History' => '更新历史记录',
	'Hours' => '小时',
	'Days' => '天',				
	'Title' => '标题',
	'Solution' => '解决方案',	
	'From Portal' => '来源于客户门户',						
	'Related To' => '客户名称',
	'Contact Name' => '联系人姓名',
	//Added for existing picklist entries

	'Big Problem'=>'大问题',
	'Small Problem'=>'小问题',
	'Other Problem'=>'其它问题',
	'Normal'=>'一般',
	'High'=>'高度重视',
	'Urgent'=>'急需解决',
	'Minor'=>'轻微',		
	'Major'=>'主要',
	'Feature'=>'比较特别',	
	'Critical'=>'非常严重',

	'Open'=>'待处理',
	'Wait For Response'=>'等待响应',
	'Closed'=>'已关闭',
	'LBL_STATUS' => '状态',
	'LBL_SEVERITY' => '严重程度',
	//DetailView Actions
	'LBL_CONVERT_FAQ' => '转为常见问题 FAQ',
	'LBL_RELATED_TO' => '相关于',

	//added to support i18n in ticket mails
	'Ticket ID'=>'服务单 ID',
	'Hi' => '您好',
	'Dear'=> '亲爱的',
	'LBL_PORTAL_BODY_MAILINFO'=> '服务单状态：',
	'LBL_DETAIL' => '详情:',
	'LBL_REGARDS'=> '祝商祺',
	'LBL_TEAM'=> '客户服务中心',
	'LBL_TICKET_DETAILS' => '服务单内容',
	'LBL_SUBJECT' => '主题：',
	'created' => '创建',
	'replied' => '已回复',
	'reply'=>'这里有一条回复',
	'customer_portal' => '在客户自助服务门户中。',
	'link' => '您可以点击下面的链接查看回复：',
	'Thanks' => '感谢',
	'Support_team' => '技术支持团队',
	'The comments are' => '回复：',	
	'Ticket Title' => '服务单标题',	
	'Re' => 'Re :',
						
	//This label for customerportal.
	'LBL_STATUS_CLOSED' =>'Closed',//Do not convert this label. This is used to check the status. If the status 'Closed' is changed in vtigerCRM server side then you have to change in customerportal language file also.
	'LBL_STATUS_UPDATE' => '服务单状态更新为',
	'LBL_COULDNOT_CLOSED' => '服务单不能',
	'LBL_CUSTOMER_COMMENTS' => '客户对你的回复提供了以下补充信息：',
	'LBL_RESPOND'=> '请尽快回复上述服务单',
	'LBL_SUPPORT_ADMIN' => '支持管理员',
	'LBL_RESPONDTO_TICKETID' =>'响应服务单ID',
	'LBL_RESPONSE_TO_TICKET_NUMBER' =>'响应服务单编号',
	'LBL_TICKET_NUMBER' => '服务单编号',
	'LBL_CUSTOMER_PORTAL' => '在客户自助服务门户 - 紧急',
	'LBL_LOGIN_DETAILS' => '以下是您的客户自助服务网站的登录信息：',
	'LBL_MAIL_COULDNOT_SENT' =>'邮件无法发送',
	'LBL_USERNAME' => '用户名 :',
	'LBL_PASSWORD' => '密  码 :',
	'LBL_SUBJECT_PORTAL_LOGIN_DETAILS' => '关于你的客户自助服务网站的登录信息',
	'LBL_GIVE_MAILID' => '请提供您的Email地址',
	'LBL_CHECK_MAILID' => '请检查您用于登录客户自助服务门户的电子邮件地址',
	'LBL_LOGIN_REVOKED' => '您的登录信息已被撤销。请联系您的管理员。',
	'LBL_MAIL_SENT' => '邮件已发送到您的Email（与客户自助服务网站的登录信息相同）',
	'LBL_ALTBODY' => '这是在纯文本格式的非HTML的邮件客户端的主要内容',
	'HelpDesk ID' => '服务单ID',
	//Portal shortcuts
	'LBL_ADD_DOCUMENT'=>"添加文档",
	'LBL_OPEN_TICKETS'=>"打开服务单",
	'LBL_CREATE_TICKET'=>"创建服务单",
//TBD
	//'Created By' => '创建人',
	'High Prioriy Tickets'=>'高优先级的服务单',
);

$jsLanguageStrings=array(
	'LBL_ADD_DOCUMENT'=>'添加文档',
	'LBL_OPEN_TICKETS'=>'打开服务单',
	'LBL_CREATE_TICKET'=>'创建服务单'
);