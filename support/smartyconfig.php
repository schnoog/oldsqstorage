<?php

$smarty = new Smarty();

$smarty->setTemplateDir($basedir . '/templates/');
$smarty->setCompileDir($basedir .'/smartyfolders/templates_c/');
$smarty->setConfigDir($basedir .'/smartyfolders/configs/');
$smarty->setCacheDir($basedir .'/smartyfolders/cache/');



//$smarty->assign('name','Ned');

//** un-comment the following line to show the debug console
$smarty->debugging = true;

//$smarty->display('index.tpl');