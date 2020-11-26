<?php
require '../bootloader.php';

$fileDB = new FileDB(DB_FILE);
$fileDB->load();
//$fileDB->setData(['naujas masyvas']);
//$fileDB->createTable('vienas');
//$fileDB->createTable('antras');
//$fileDB->createTable('trecias');
//$fileDB->dropTable('antras');
//$fileDB->getData();



//
//$fileDB->insertRow('vienas', ['name' => 'one', 'email' => 'u@u.uu']);
////$fileDB->insertRow('vienas', []);
////
//$fileDB->insertRow('antras', ['name' => 'two', 'email' => 'e@e.ee']);
////$fileDB->insertRow('antras', []);
////
//$fileDB->insertRow('trecias', ['name' => 'three', 'email' => 'w@w.ww']);
////$fileDB->insertRow('trecias', []);



var_dump($fileDB->getRowsWhere('antras', ['email' => 'e@e.ee']));
$fileDB->save();
//var_dump($fileDB);
