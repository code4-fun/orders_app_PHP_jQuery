<?php require 'inc/header.php'?>

  <?php error_reporting(E_ERROR) ?>
  <?php $orders = fetch_all_orders($_GET['id']); ?>

  <?php if(!empty($orders)): ?>
    <div class="main">
      <div class='orderItem'>
        <div class='orderItem__body orderItem__body--header'>
          <div class='orderItem__content'>
            <div class='orderItem__text orderItem__text--header'>Date</div>
            <div class='orderItem__text orderItem__text--header'>Client</div>
            <div class='orderItem__text orderItem__text--header orderItem__text--sum'>Sum</div>
          </div>
          <div class='orderItem__delete'></div>
        </div>
      </div>
      <div class="orderList">
        <?php foreach($orders as $order): ?>
          <div class='orderItem'>
            <a href="order.php?id=<?= $order['id'] ?>"
               class="orderItem__link">
              <div class='orderItem__body'>
                <div class='orderItem__content'>
                  <div class='orderItem__text'><?= date('Y/m/d', strtotime($order['date'])) ?></div>
                  <div class='orderItem__text'><?= $order['name'] ?></div>
                  <div class='orderItem__text <?= $order['paid'] ? 'orderItem__text--paid' : 'orderItem__text--unpaid' ?>'><?= $order['sum'] ?></div>
                </div>
                <div class='orderItem__delete'>
                  <img onclick="event => {event.stopPropagation(); remove(item);}"
                       src="img/trash.svg"
                       alt="delete" />
                </div>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
      <?php if($_GET['id']): ?>
        <?php
          $overall = 0;
          $paid = 0;
          $unpaid = 0;
          foreach ($orders as $order){
            $overall += (int)$order['sum'];
            $paid += $order['paid'] ? (int)$order['sum'] : 0;
            $unpaid += !$order['paid'] ? (int)$order['sum'] : 0;
          }
        ?>
        <div class='card'>
          <div class='card__body'>
            <div class='card__content'>
              <div class="card__column card__column--header">
                <div class='card__text'>Overall:</div>
                <div class='card__text'>Paid:</div>
                <div class='card__text'>Unpaid:</div>
              </div>
              <div class="card__column">
                <div class='card__text'><?= $overall ?></div>
                <div class='card__text card__text--paid'><?= $paid ?></div>
                <div class='card__text card__text--unpaid'><?= $unpaid ?></div>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
    <?php endif; ?>
    </div>

<?php require 'inc/footer.php'?>