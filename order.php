<?php require 'inc/header.php'?>

<?php $order = fetch_order($_GET['id']); ?>

  <?php if(!empty($order)): ?>
    <div class='card'>
      <div class='card__body'>
        <div class='card__content'>
          <div class="card__column card__column--header">
            <div class='card__text'>Date:</div>
            <div class='card__text'>Client:</div>
            <div class='card__text'>Description:</div>
            <div class='card__text'>Sum:</div>
            <div class='card__text'>Status:</div>
          </div>
          <div class="card__column">
            <div class='card__text'><?= date('Y/m/d', strtotime($order['date'])) ?></div>
            <div class='card__text'>
              <a href="client.php?id=<?= $order['user_id'] ?>"
                 class="card__link">
                <?= $order['name'] ?>
              </a>
            </div>
            <div class='card__text'><?= $order['description'] ?></div>
            <div class='card__text'><?= $order['sum'] ?></div>
            <div class='card__text <?= $order['paid'] ? 'card__text--paid' : 'card__text--unpaid' ?>'><?= $order['paid'] ? 'Paid' : 'Unpaid' ?></div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

<?php require 'inc/footer.php'?>