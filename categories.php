<?php
    include_once(__DIR__ . "/includer.php");

                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    if (isset($_GET['setCategoryId']) && !empty($_GET['setCategoryId']) && isset($_GET['to']) && !empty($_GET['to'])) {
                        DB::update('subCategories', array('headcategory' => intVal($_GET['to'])), 'id=%d', intVal($_GET['setCategoryId']));
                        header("location: categories.php");
                        die();
                    } else if (isset($_GET['resetSubcategoryId']) && !empty($_GET['resetSubcategoryId'])) {
                        DB::update('subCategories', array('headcategory' => NULL), 'id=%d', intVal($_GET['resetSubcategoryId']));
                        header("location: categories.php");
                        die();
                    } else if (isset($_GET['to']) && !empty($_GET['to']) && (isset($_GET['headCategory']) || isset($_GET['subCategory']))) {
                        if (isset($_GET['headCategory']) && !empty($_GET['headCategory'])) {
                            DB::update('headCategories', array('name' => $_GET['to']), 'id=%d', intVal($_GET['headCategory']));
                            if (DB::affectedRows() === 1) echo '<div class="alert alert-info" role="alert"><p>' . gettext('Kategorie umbenannt.') . '</p></div>';
                        } else {
                            DB::update('subCategories', array('name' => $_GET['to']), 'id=%d', intVal($_GET['subCategory']));
                            if (DB::affectedRows() === 1) echo '<div class="alert alert-info" role="alert"><p>' . gettext('Unterkategorie umbenannt.') . '</p></div>';
                        }
                    } else if (isset($_GET['removeCategory']) && !empty($_GET['removeCategory'])) {
                        DB::delete('headCategories', "id=%d", intVal($_GET['removeCategory']));
                        if (DB::affectedRows() === 1) echo '<div class="alert alert-info" role="alert"><p>' . gettext('Kategorie entfernt.') . '</p></div>';
                    } else if (isset($_GET['removeSubcategory']) && !empty($_GET['removeSubcategory'])) {
                        DB::delete('subCategories', "id=%d", intVal($_GET['removeSubcategory']));
                        if (DB::affectedRows() === 1) echo '<div class="alert alert-info" role="alert"><p>' . gettext('Unterkategorie entfernt.') . '</p></div>';
                    }
                }
                    $headCategories = DB::query('SELECT id, name, amount FROM headCategories ORDER BY name ASC');
                    $subCategories = DB::query('SELECT id, name, amount, headcategory FROM subCategories ORDER BY name ASC');

                    $smarty->assign("headCategories",$headCategories);
                    $smarty->assign("subCategories",$subCategories);
        
                    $smarty->display('categories.tpl');
