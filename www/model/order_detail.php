<?php

require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function insert_order_detail($db, $order_id, $item_id, $price, $amount) {
    $sql = "
        INSERT INTO
            order_details(order_id, item_id, price, amount)
        VALUES
            (:order_id, :item_id, :price, :amount);
    ";

    $params = array(
        ':order_id' => $order_id,
        ':item_id' => $item_id,
        ':price' => $price,
        ':amount' => $amount
    );

    return execute_query($db, $sql, $params);
}

// function get_order_details($db, $order_details_id, $order_id, $item_id, $price, $amount,) {
//     $sql = "
//         SELECT
//             order_details.order_details_id,
//             order_details.order_id,
//             order_details.item_id,
//             order_details.price,
//             order_details.amount,
//             items.item_id
//         FROM
//             order_details
//         JOIN
//             items
//         ON
//             order_details.item_id = items.item_id
//         WHERE
//             order_details.order_id = :order_id
//     ";

//     $params = array(':order_id' => $order_id);

//     return fetch_all_query($db, $sql, $params);
// }