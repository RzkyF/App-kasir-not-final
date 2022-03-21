<?php 

function userLogin(){
    $db = \Config\Database::connect();

    $builder = $db->table('user');
    $builder->select('*');
    $builder->join('level','level.id_level = user.id_level');
    $query = $builder->where('id_user',session('id_user'))->get()->getRow();

    return $query;
}

function countUser(){
    $db = \Config\Database::connect();

    $builder = $db->table('user');
   $query = $builder->countAll();

   return $query;

}

function countMenu(){
    $db = \Config\Database::connect();

    $builder = $db->table('tb_menu');
   $query = $builder->countAll();

   return $query;

}

function countTransaksi(){
    $db = \Config\Database::connect();

    $builder = $db->table('tb_order');
   $query = $builder->countAll();

   return $query;

}
?>