<?php
    include_once(__DIR__ . "/includer.php");


            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['remove']) && !empty($_POST['remove'])) {
                    $item = DB::queryFirstRow('SELECT * FROM items WHERE id=%d', $_POST['remove']);
                    $storage = DB::queryFirstRow('SELECT amount FROM storages WHERE id=%d', $item['storageid']);

                    if (!empty($item['subcategories'])) {
                        foreach (explode(',', $item['subcategories']) as $subCategory) {
                            $subCategoryDB = DB::queryFirstRow('SELECT id, amount FROM subCategories WHERE id=%d', intVal($subCategory));

                            if ($subCategoryDB != NULL) {
                                DB::update('subCategories', array('amount' => intVal($subCategoryDB['amount']) - intVal($item['amount'])), 'id=%d', $subCategoryDB['id']);
                            }
                        }
                    }

                    $headCategory = DB::queryFirstRow('SELECT amount FROM headCategories WHERE id=%d', $item['headcategory']);
                    DB::update('storages', array('amount' => intVal($storage['amount']) - intVal($item['amount'])), 'id=%d', $item['storageid']);
                    DB::update('headCategories', array('amount' => intVal($headCategory['amount']) - intVal($item['amount'])), 'id=%d', $item['headcategory']);
                    DB::query('DELETE FROM items WHERE id=%d', $_POST['remove']);
                } else if (isset($_POST['removeStorage']) && !empty($_POST['removeStorage'])) {
                    DB::update('items', array('storageid' => NULL), 'storageid=%d', $_POST['removeStorage']);
                    DB::query('DELETE FROM storages WHERE id=%d', $_POST['removeStorage']);
                }
            }
/************************
 * 
 */
$outputdata = array();
$storages = DB::query('SELECT id, label, amount FROM storages ORDER BY label ASC');
for($x=0;$x<count($storages);$x++){
    $sid=$storages[$x]['id'];
    $storagearray[$sid] = $storages[$x];
}
$headCategories = DB::query('SELECT id, name FROM headCategories');
foreach ($headCategories as $sub) {
    $headCatArr[$sub['id']] = $sub;
}
$subCategories = DB::query('SELECT id, name FROM subCategories');
foreach ($subCategories as $sub) {
    $subCatArr[$sub['id']] = $sub;
}

                if (isset($_GET['storageid']) && !empty($_GET['storageid']) && !isset($_GET['itemid'])) {
                    $storeId = intVal($_GET['storageid']);
                    $store = DB::queryFirstRow('SELECT id, label, amount FROM storages WHERE id=%d', $storeId);
                    $items = DB::query('SELECT * FROM items WHERE storageid=%d', $storeId);
                    $outputdata = $items;
                } else if (isset($_GET['subcategory']) && !empty($_GET['subcategory'])) {
                    $categoryId = intVal($_GET['subcategory']);
                    $category = DB::queryFirstRow('SELECT id, name, amount from subCategories WHERE id=%d', $categoryId);
                    $items = DB::query('SELECT * FROM items WHERE subCategories LIKE %s', ('%,' . $categoryId . ',%'));
                    $outputdata = $items;
                } else if (isset($_GET['storageid']) && !empty($_GET['storageid']) && isset($_GET['itemid']) && !empty($_GET['itemid'])) {
                    $storeId = intVal($_GET['storageid']);
                    $itemId = intVal($_GET['itemid']);
                    $item = DB::queryFirstRow('SELECT id, amount, storageid FROM items WHERE id=%d', $itemId);
                    if ($item['storageid'] == $storeId) {
                        header("location: " . $_SERVER['PHP_SELF']);
                        die();
                    }
                    if ($storeId != NULL) {
                        $previousStorage = DB::queryFirstRow('SELECT id, amount FROM storages WHERE id=%d', $item['storageid']);
                        DB::update('storages', array('amount' => intVal($previousStorage['amount']) - intVal($item['amount'])), 'id=%d', $previousStorage['id']);
                    }
                    $storage = DB::queryFirstRow('SELECT id, amount FROM storages WHERE id=%d', $storeId);
                    DB::update('storages', array('amount' => intVal($storage['amount']) + intVal($item['amount'])), 'id=%d', $storage['id']);
                    DB::update('items', array('storageid' => $storage['id']), 'id=%d', $item['id']);
                    header("location:" .$_SERVER['PHP_SELF']);
                    die();
                } else if (isset($_GET['searchValue']) && !empty($_GET['searchValue'])) {
                    $searchValue = $_GET['searchValue'];
                    $headCategories = DB::query('SELECT id, name FROM headCategories');
                    $subCategories = DB::query('SELECT id, name FROM subCategories');
                    $foundData = FALSE;
                    $finalitems = array();
                    $existingItemIds = array();
                    foreach ($storages as $store) {
                        $hasHeader = FALSE;
                        $hasItems = FALSE;

                        if ($headCategories != null) {
                            foreach ($headCategories as $headCategory) {
                                if (stripos($headCategory['name'], $searchValue) !== FALSE) $items = DB::query('SELECT * FROM items WHERE storageid=%d', $store['id']);
                                else $items = DB::query('SELECT * FROM items WHERE storageid=%d AND (label LIKE %ss OR comment LIKE %ss OR serialnumber LIKE %ss)', $store['id'], $searchValue, $searchValue, $searchValue);

                                if ($items != null) {
                                    if (!$hasHeader) {
                                        //addHeadColumnsPositions($store);
                                        $hasHeader = TRUE;
                                    }

                                    foreach($items as $item) if (!in_array($item['id'], $existingItemIds)) {
                                        //addItem($item, $storages);
                                        $finalitems[] = $item;
                                        $existingItemIds[] = $item['id'];
                                    }

                                    $hasItems = TRUE;
                                    $foundData = TRUE;
                                }
                            }
                        }

                        if ($subCategories != null) {
                            foreach ($subCategories as $subCategory) {
                                if (stripos($subCategory['name'], $searchValue) !== FALSE) $items = DB::query('SELECT * FROM items WHERE storageid=%d AND subcategories LIKE %s', $store['id'], ('%,' . $subCategory['id'] . ',%'));
                                else $items = DB::query('SELECT * FROM items WHERE storageid=%d AND subcategories LIKE %s AND (label LIKE %ss OR comment LIKE %ss OR serialnumber LIKE %ss)', $store['id'], ('%,' . $subCategory['id'] . ',%'), $searchValue, $searchValue, $searchValue, ($searchValue . '%'));

                                if ($items != null) {
                                    if (!$hasHeader) {
                                        //addHeadColumnsPositions($store);
                                        $hasHeader = TRUE;
                                    }

                                    foreach($items as $item) if (!in_array($item['id'], $existingItemIds)) {
                                        $existingItemIds[] = $item['id'];
                                        $finalitems[] = $item;
                                        //addItem($item, $storages);
                                    }

                                    $hasItems = TRUE;
                                    $foundData = TRUE;
                                }
                            }

                        }

                        $outputdata = $finalitems;
                    }
                } else if (isset($_GET['category']) && !empty($_GET['category'])) {
 
 
                    $categoryId = intVal($_GET['category']);
                    $category = DB::queryFirstRow('SELECT id, name, amount from headCategories WHERE id=%d', $categoryId);
                    $items = DB::query('SELECT * FROM items WHERE headcategory=%d', $categoryId);

                    $subCategories = DB::query('SELECT * FROM subCategories WHERE headcategory=%d ORDER BY name ASC', $categoryId);
                    foreach ($subCategories as $subCategory) {
                        $items = DB::query('SELECT * FROM items WHERE subcategories LIKE %s', '%,' . $subCategory['id'] . ',%');
                    }
                    $outputdata = $items;




                } else {
                            $items = DB::query('SELECT * FROM items');
                            $outputdata = $items;
                    
                }

                for($x=0;$x<count($outputdata);$x++){
                    $item = $outputdata[$x];
                    $storecontent[$item['storageid']][] = $item;
                }

/************************
 * 
 */            



                $smarty->assign('target',$_SERVER['PHP_SELF']) ;
                $smarty->assign('storecontent',$storecontent);
                $smarty->assign('storages',$storages);
                $smarty->assign('storagearray',$storagearray);
                $smarty->assign('headCatArr',$headCatArr);
                $smarty->assign('subCatArr',$subCatArr);
    
                $smarty->display('inventorypage.tpl');                