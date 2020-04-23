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


function get_user_orders($db, $user_id) {
    $sql = '
        SELECT
            orders.order_id,
            orders.created,
            SUM(order_details.price * order_details.amount)
        FROM
            orders
        JOIN
            order_details
        ON
            orders.order_id = order_details.order_id
        WHERE
            orders.user_id = :user_id
        GROUP BY
            order_details.order_id
        ORDER BY
            orders.created DESC   
    ';

    $params = array(':user_id' => $user_id);

    return fetch_all_query($db, $sql, $params);
}

function get_orders($db) {
    $sql = '
        SELECT
            orders.order_id,
            orders.created,
            SUM(order_details.price * order_details.amount)
        FROM
            orders
        JOIN
            order_details
        ON
            orders.order_id = order_details.order_id
        GROUP BY
            order_details.order_id
        ORDER BY
            orders.created DESC   
    ';

    return fetch_all_query($db, $sql);
}

function get_order($db, $order_id) {
    $sql = '
        SELECT
            orders.user_id,
            orders.created
        FROM
            orders
        WHERE
            orders.order_id = :order_id
    ';

    $params = array(':order_id' => $order_id);

    return fetch_query($db, $sql, $params);
}