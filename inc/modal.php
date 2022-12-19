<?php $clients = fetch_all_clients(); ?>

<div class='popup-outer'>
  <div class='popup-inner'>
    <div class="popup-errors"></div>
    <form class="popup-form"
          id="comment-form"
          onsubmit="event.preventDefault(); createOrder(new FormData(this))">
      <input type="date" class="popup-input" name="date" placeholder='Date'>
      <select id="select-client" name="client" class="popup-input">
        <option value="default" disabled selected>Client</option>
        <?php foreach ($clients as $client): ?>
          <option value="<?= $client['id'] ?>"><?= $client['name'] ?></option>
        <?php endforeach; ?>
      </select>
      <div>
        <textarea class="popup-input" name="description" rows="10" placeholder='Order description'></textarea>
      </div>
      <input type="text" class="popup-input" name="sum" placeholder='Sum'>
      <div class="popup-checkbox-wrapper">
        <label for="paid" class="popup-checkbox-label">Paid</label>
        <input type="checkbox" class="popup-checkbox" name="paid" placeholder='Paid'>
      </div>
      <button class="popup-button">Create</button>
    </form>
  </div>
</div>