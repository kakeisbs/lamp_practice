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

function get_user_details($db, $order_id, $user_id) {
    $sql = '
        SELECT
            items.name,
            order_details.price,
            order_details.amount,
            order_details.price * order_details.amount as subtotal
        FROM
            order_details
        INNER JOIN
            items
        ON
            order_details.item_id = items.item_id
        INNER JOIN
            orders
        ON
            orders.order_id = order_details.order_id
        WHERE
            order_details.order_id = :order_id
        AND
            orders.user_id = :user_id
    ';

    $params = array(
        ':order_id' => $order_id,
        ':user_id' => $user_id
    );

    return fetch_all_query($db, $sql, $params);
}

function get_all_details($db, $order_id) {
    $sql = '
        SELECT
            items.name,
            order_details.price,
            order_details.amount,
            order_details.price * order_details.amount as subtotal
        FROM
            order_details
        INNER JOIN
            items
        ON
            order_details.item_id = items.item_id
        INNER JOIN
            orders
        ON
            orders.order_id = order_details.order_id
        WHERE
            order_details.order_id = :order_id
    ';

    $params = array(
        ':order_id' => $order_id
    );

    return fetch_all_query($db, $sql, $params);
}