<?php require 'inc/header.php'?>

<?php $client = fetch_client($_GET['id']); ?>

<?php if(!empty($client)): ?>
  <div class='card'>
    <div class='card__body'>
      <div class='card__content'>
        <div class="card__column card__column--header">
          <div class='card__text'>Name:</div>
          <div class='card__text'>Address:</div>
          <div class='card__text'>Phone number:</div>

        </div>
        <div class="card__column">
          <div class='card__text'><?= $client['name'] ?></div>
          <div class='card__text'><?= $client['address'] ?></div>
          <div class='card__text'><?= $client['phone'] ?></div>
          <div class='card__text'>
            <a href="index.php?id=<?= $client['id'] ?>"
               class="card__link">
              <?= $client['name'] ?>'s statistics
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php require 'inc/footer.php'?>