<?php require 'inc/header.php'?>

<?php $client = fetch_client($_GET['id']); ?>

<?php if(!empty($client)): ?>
  <div class='card'>
    <div class='card__body'>
      <div class='card__content'>
        <table>
          <tr>
            <th>Name:</th>
            <td>
              <?= $client['name'] ?>
            </td>
          </tr>
          <tr>
            <th>Address:</th>
            <td>
              <?= $client['address'] ?>
            </td>
          </tr>
          <tr>
            <th>Phone number:</th>
            <td>
              <?= $client['phone'] ?>
            </td>
          </tr>
          <tr class='table-last-row'>
            <th></th>
            <td>
              <a href="index.php?id=<?= $client['id'] ?>"
                 class="card__link">
                <?= $client['name'] ?>'s statistics
              </a>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php require 'inc/footer.php'?>