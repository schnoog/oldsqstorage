<?php
    include_once(__DIR__ . "/includer.php");
    $success = FALSE;

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $amount = isset($_POST['amount']) && !empty($_POST['amount']) ? $_POST['amount'] : 1;
                $serialNumber = isset($_POST['serialnumber']) && !empty($_POST['serialnumber']) ? $_POST['serialnumber'] : NULL;
                $comment = isset($_POST['comment']) && !empty($_POST['comment']) ? $_POST['comment'] : NULL;
                $subcategories = isset($_POST['subcategories']) && !empty($_POST['subcategories']) ? explode(',', $_POST['subcategories']) : NULL;

                if(isset($_POST['itemUpdateId']) && !empty($_POST['itemUpdateId'])) {
                    $existingItem = DB::queryFirstRow('SELECT * FROM items WHERE id=%d', intVal($_POST['itemUpdateId']));

                    $category = DB::queryFirstRow('SELECT id,amount FROM headCategories WHERE id=%d', intVal($existingItem['headcategory']));
                    DB::update('headCategories', array('amount' => $category['amount'] - intVal($existingItem['amount'])), 'id=%d', $category['id']);

                    $exitingSubCategories = explode(',', $existingItem['subcategories']);
                    foreach ($exitingSubCategories as $subcategoryId) {
                        $subCategory = DB::queryFirstRow('SELECT id, amount FROM subCategories WHERE id=%d', $subcategoryId);
                        if ($subCategory !== NULL) {
                            DB::update('subCategories', array('amount' => $subCategory['amount'] - intVal($existingItem['amount'])), 'id=%d', $subCategory['id']);
                        }
                    }

                    $storage = DB::queryFirstRow('SELECT id,label,amount FROM storages WHERE id=%d', $existingItem['storageid']);
                    if ($storage != NULL) {
                        DB::update('storages', array('amount' => $storage['amount'] - $existingItem['amount']), 'id=%d', $storage['id']);
                    }
                }

                $subIds = array();
                if ($subcategories !== NULL) {
                    foreach ($subcategories as $subcategory) {
                        $subCategory = DB::queryFirstRow('SELECT id, amount FROM subCategories WHERE name=%s', $subcategory);
                        if ($subCategory !== NULL) {
                            $subIds[] = $subCategory['id'];
                            DB::update('subCategories', array('amount' => $subCategory['amount'] + $amount), 'id=%d', $subCategory['id']);
                        } else {
                            DB::insert('subCategories', array('name' => $subcategory, 'amount' => $amount));
                            $subIds[] = DB::insertId();
                        }
                    }
                }

                $storage = DB::queryFirstRow('SELECT id,label,amount FROM storages WHERE label=%s', $_POST['storage']);

                if ($storage == NULL) {
                    DB::insert('storages', array('label' => $_POST['storage'], 'amount' => $amount));
                    $storage['id'] = DB::insertId();
                } else DB::update('storages', array('amount' => $storage['amount'] + $amount), 'id=%d', $storage['id']);

                $category = DB::queryFirstRow('SELECT id,amount FROM headCategories WHERE name=%s', $_POST['category']);
                if ($category == NULL) {
                    DB::insert('headCategories', array('name' => $_POST['category'], 'amount' => $amount));
                    $category['id'] = DB::insertId();
                } else DB::update('headCategories', array('amount' => $category['amount'] + $amount), 'id=%d', $category['id']);

                if(isset($_POST['itemUpdateId']) && !empty($_POST['itemUpdateId'])) {
                    $item = DB::update('items', array('label' => $_POST['label'], 'comment' => $comment, 'serialnumber' => $serialNumber, 'amount' => $amount, 'headcategory' => $category['id'], 'subcategories' => (',' . implode($subIds, ',') . ','), 'storageid' => $storage['id']), 'id=%d', $existingItem['id']);
                } else {
                    $item = DB::insert('items', array('label' => $_POST['label'], 'comment' => $comment, 'serialnumber' => $serialNumber, 'amount' => $amount, 'headcategory' => $category['id'], 'subcategories' => (',' . implode($subIds, ',') . ','), 'storageid' => $storage['id']));
                }

                $success = TRUE;
            }

            $isEdit = FALSE;
            if (isset($_GET['editItem']) && !empty($_GET['editItem'])) {
                $item = DB::queryFirstRow('SELECT * from items WHERE id=%d', intVal($_GET['editItem']));
                $isEdit = TRUE;
            }


            $storages = DB::query('SELECT id, label FROM storages');
            $currentStorage = NULL;
            $categories = DB::query('SELECT id, name FROM headCategories');
            $currentCategory = NULL;


            $smarty->assign("success",$success);
            $smarty->assign("isEdit",$isEdit);
            if(isset($item))$smarty->assign("item",$item);
            if(isset($_POST))$smarty->assign("post",$_POST);
            $smarty->assign("storages",$storages);
            $smarty->assign("currentStorage",$currentStorage);
            $smarty->assign("categories",$categories);
            $smarty->assign("currentCategory",$currentCategory);

            $smarty->display('indexpage.tpl');

