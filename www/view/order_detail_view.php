<!DOCTYPE html>
<html lang="ja">
    <head>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <title>購入明細画面</title>
        <link rel="stylesheet" href="<?php print h((STYLESHEET_PATH . 'order_detail.css')); ?>">
    </head>
    <body>
    <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
        <h1>購入明細画面</h1>
        <div class="container">

            <?php include VIEW_PATH . 'templates/messages.php'; ?>

            <div class="order">
                <span>注文番号:<?php print h($order_id);?></span>
                <span>購入日時:<?php print h($order['created']);?></span>
                <?php foreach($sums as $sum) { ?>
                <span>合計:<?php print h(number_format($sum['SUM(order_details.price * order_details.amount)'])); ?>円</span>
                <?php } ?>
            </div>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>商品名</th>
                        <th>価格</th>
                        <th>購入数</th>
                        <th>小計</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($order_details as $order_detail) { ?>
                    <tr>
                        <td><?php print h($order_detail['name']);?></td>
                        <td><?php print h(number_format($order_detail['price']));?></td>
                        <td><?php print h($order_detail['amount']);?></td>
                        <td><?php print h(number_format($order_detail['price'] * $order_detail['amount']));?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>
</html>