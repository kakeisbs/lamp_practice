<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'order.php';
require_once MODEL_PATH . 'order_detail.php';

session_start();

if(is_logined() === false){
    redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

// order_idを取得
$order_id = get_get('order_id');

$check_csrf_token = get_get('token');
if(is_valid_csrf_token($check_csrf_token) === false) {
    set_error('不正なアクセスです。');
    redirect_to(LOGIN_URL);
}
// 管理者であれば全ての明細を表示し、特定のユーザーはユーザーが購入した明細のみ表示
if(is_admin($user) === false) {
    $order = get_order($db, $order_id);  // order_idごとの購入日時を取得
    $sums = order_sum($db, $order_id);  // order_idの合計を取得
    $order_details = get_order_detail($db, $order_id, $user['user_id']);
}else {
    $order = get_order($db, $order_id);
    $sums = order_sum($db, $order_id);
    $order_details = get_order_details($db, $order_id);
}

include_once VIEW_PATH . 'order_detail_view.php';