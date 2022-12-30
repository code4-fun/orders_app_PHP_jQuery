<?php
require_once('connect.php');

function fetch_all_orders($id){
  global $db;
  if($id) {
    $query = "select o.id, o.date, o.sum, o.paid, o.user_id, u.name from `order` o join user u on o.user_id = u.id where o.user_id = '$id' ";
  } else {
    $query = 'select o.id, o.date, o.sum, o.paid, u.name from `order` o join user u on o.user_id = u.id order by o.date desc, o.id desc';
  }
  $res = mysqli_query($db, $query);
  return mysqli_fetch_all($res, MYSQLI_ASSOC);
}

function fetch_order($id){
  global $db;
  $query = "select o.*, u.name from `order` o join user u on o.user_id = u.id where o.id = '$id'";
  $res = mysqli_query($db, $query);
  return mysqli_fetch_assoc($res);
}

function fetch_client($id){
  global $db;
  $query = "select * from user where id = '$id'";
  $res = mysqli_query($db, $query);
  return mysqli_fetch_assoc($res);
}

function fetch_all_clients(){
  global $db;
  $query = "select id, name from user";
  $res = mysqli_query($db, $query);
  return mysqli_fetch_all($res, MYSQLI_ASSOC);
}

function create_order($data){
  global $db;
  $date = $data['date'];
  $description = mysqli_real_escape_string($db, $data['description']);
  $sum = $data['sum'];
  $paid = $data['paid'];
  $user_id = $data['clientId'];
  $query = "insert into `order`(date, description, sum, paid, user_id) values('$date', '$description', '$sum', '$paid', '$user_id')";
  mysqli_query($db, $query);
  return mysqli_insert_id($db);
}

function delete_order($id){
  global $db;
  $query = "delete from `order` where id = '$id'";
  return mysqli_query($db, $query);
}