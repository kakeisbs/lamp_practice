<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'order.php';
require_once MODEL_PATH . 'order_detail.php';

session_start();

if (is_logined() === false) {
    redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

// GET送信されたorder_idを取得
$order_id = get_get('order_id');

$order = get_order($db, $order_id);

if(is_admin($user) === false && $order['user_id'] !== $user['user_id']) {

    set_error('正しく処理されませんでした。');
    redirect_to(ORDER_URL);
}

$order_details = get_all_details($db, $order_id);

include_once VIEW_PATH . 'order_detail_view.php';