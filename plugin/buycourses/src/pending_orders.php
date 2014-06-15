<?php
/**
 * Initialization
 */
require_once '../config.php';
require_once dirname(__FILE__) . '/buy_course.lib.php';

$plugin = Buy_CoursesPlugin::create();
$_cid = 0;
$tableName = $plugin->get_lang('AvailableCoursesConfiguration');
$interbreadcrumb[] = array("url" => "list.php", "name" => $plugin->get_lang('CourseListOnSale'));
$interbreadcrumb[] = array("url" => "paymentsetup.php", "name" => $plugin->get_lang('PaymentsConfiguration'));

$tpl = new Template($tableName);

$teacher = api_is_platform_admin();
api_protect_course_script(true);

if ($teacher) {
    $pendingList = pendingList();
    $confirmationImg = api_get_path(WEB_PLUGIN_PATH) . 'buy_courses/resources/message_confirmation.png';
    $deleteImg = api_get_path(WEB_PLUGIN_PATH) . 'buy_courses/resources/delete.png';
    $currencyType = findCurrency();

    $tpl->assign('server', $_configuration['root_web']);
    $tpl->assign('pending', $pendingList);
    $tpl->assign('confirmation_img', $confirmationImg);
    $tpl->assign('delete_img', $deleteImg);
    $tpl->assign('currency', $currencyType);

    $listing_tpl = 'buy_courses/view/pending_orders.tpl';
    $content = $tpl->fetch($listing_tpl);
    $tpl->assign('content', $content);
    $tpl->display_one_col_template();
}