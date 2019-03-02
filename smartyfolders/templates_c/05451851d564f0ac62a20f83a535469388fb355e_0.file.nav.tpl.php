<?php
/* Smarty version 3.1.33, created on 2019-03-02 12:33:01
  from 'C:\phpDEV\sqstorage\templates\nav.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c7a69ed5ca745_29400623',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '05451851d564f0ac62a20f83a535469388fb355e' => 
    array (
      0 => 'C:\\phpDEV\\sqstorage\\templates\\nav.tpl',
      1 => 1551524228,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c7a69ed5ca745_29400623 (Smarty_Internal_Template $_smarty_tpl) {
?><body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="index.php"><img class="logo" src="./img/sqstorage.png" /></a>
    <ul class="nav">
        <li class="nav-item"><a href="index.php" class="nav-link"><?php echo gettext('Eintragen');?>
</a></li>
        <li class="nav-item"><a href="inventory.php" class="nav-link"><?php echo gettext('Inventar');?>
</a></li>
        <li class="nav-item"><a href="categories.php" class="nav-link"><?php echo gettext('Kategorien');?>
</a></li>
        <li class="nav-item"><a href="transfer.php" class="nav-link"><?php echo gettext('Transferieren');?>
</a></li>
    </ul>

    <form class="form-inline my-2 " method="GET" action="inventory.php">
        <input class="form-control mr-sm-2" name="searchValue" type="search" placeholder="<?php echo gettext('Suche');?>
" aria-label="<?php echo gettext('Suche');?>
">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><?php echo gettext('Suchen');?>
</button>
    </form>
</nav><?php }
}
