<?php require 'inc/header.php'?>

<?php $order = fetch_order($_GET['id']); ?>
  <?php if(!empty($order)): ?>
    <div class='card'>
      <div class='card__body'>
        <div class='card__content'>
          <table>
            <tr>
              <th>Date:</th>
              <td>
                <?= date('Y/m/d', strtotime($order['date'])) ?>
              </td>
            </tr>
            <tr>
              <th>Client:</th>
              <td>
                <a href="client.php?id=<?= $order['user_id'] ?>"
                   class="card__link">
                  <?= $order['name'] ?>
                </a>
              </td>
            </tr>
            <tr>
              <th>Description:</th>
              <td>
                <?= nl2br(htmlspecialchars($order['description'])) ?>
              </td>
            </tr>
            <tr>
              <th>Sum:</th>
              <td><?= $order['sum'] ?></td>
            </tr>
            <tr class='table-last-row'>
              <th>Status:</th>
              <td class='card__text <?= $order['paid'] ? 'card__text--paid' : 'card__text--unpaid' ?>'>
                <?= $order['paid'] ? 'Paid' : 'Unpaid' ?>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  <?php endif; ?>

<?php require 'inc/footer.php'?>