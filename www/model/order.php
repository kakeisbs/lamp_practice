<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function insert_order($db, $user_id) {
    $sql = "
        INSERT INTO
            orders(user_id)
        VALUES
            (:user_id);
    ";

    $params = array(':user_id' => $user_id);

    return execute_query($db, $sql, $params);
};

// function get_orders($db, $user_id) {
//     $sql = "
//         SELECT
//             orders.order_id,
//             orders.user_id,
//             orders.created,
//             users.user_id
//         FROM
//             orders
//         JOIN
//             users
//         ON
//             orders.user_id = users.user_id
//         WHERE
//             orders.user_id = :user_id
//         ORDER BY
//             orders.created DESC   
//     ";

//     $params = array(':user_id' => $user_id);

//     return fetch_all_query($db, $sql, $params);
// };

// // 管理者
// function get_orders_admin($db) {
//     $sql = "
//         SELECT
//             orders.order_id,
//             orders.user_id,
//             orders.created
//         FROM
//             orders
//         ORDER BY
//             orders.created DESC   
//     ";

//     return fetch_all_query($db, $sql, $params);
// }