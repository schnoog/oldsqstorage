<?php
/* Smarty version 3.1.33, created on 2019-03-02 13:32:32
  from 'C:\phpDEV\sqstorage\templates\indexpage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c7a77e0559967_22626798',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a458fad3b5184048e5424e5d2ed23976d739d8a8' => 
    array (
      0 => 'C:\\phpDEV\\sqstorage\\templates\\indexpage.tpl',
      1 => 1551529939,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.tpl' => 1,
    'file:nav.tpl' => 1,
    'file:footer.tpl' => 1,
    'file:bodyend.tpl' => 1,
  ),
),false)) {
function content_5c7a77e0559967_22626798 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'foo'), 0, false);
$_smarty_tpl->_subTemplateRender("file:nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'foo'), 0, false);
?>

        <div class="content">
            <?php if ($_smarty_tpl->tpl_vars['success']->value) {?>
            <div class="alert alert-info" role="alert">
                <p>{ $post.label } <?php echo gettext('zur Datenbank hinzugefügt.');?>
</p>
            </div>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['isEdit']->value) {?>
            <div class="alert alert-danger" role="alert">
                <h6><?php echo gettext('Eintrag zur Bearbeitung:');?>
&quot;<?php echo $_smarty_tpl->tpl_vars['item']->value['label'];?>
&quot;</h6>
            </div>
            <?php }?>

            <form accept-charset="utf-8" method="POST" action="index.php">
                <?php if ($_smarty_tpl->tpl_vars['isEdit']->value) {?><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" name="itemUpdateId" /><?php }?>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><?php echo gettext('Bezeichnung');?>
</span>
                    </div>
                    <input type="text" name="label" maxlength="64" class="form-control" required="required" placeholder="<?php echo gettext('Bezeichnung oder Name');?>
")aria-label="<?php echo gettext('Bezeichnung');?>
" aria-describedby="basic-addon1" <?php if ($_smarty_tpl->tpl_vars['isEdit']->value) {?>value="<?php echo $_smarty_tpl->tpl_vars['item']->value['label'];?>
"<?php }?>>                    
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="dropdown">
                            <select class="btn btn-secondary dropdown-toggle" type="button" tabindex="-1" id="storageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" autocomplete="off">
                                <?php if ($_smarty_tpl->tpl_vars['isEdit']->value && $_smarty_tpl->tpl_vars['item']->value['storageid'] != 0) {?>
                                    <option value="-1"><?php echo gettext('Lagerplatz');?>
</option>
                                <?php } else { ?>
                                    <option value="-1" selected="selected"><?php echo gettext('Lagerplatz');?>
</option>
                                <?php }?>

                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['storages']->value, 'storage');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['storage']->value) {
?>
                                    <?php if ($_smarty_tpl->tpl_vars['isEdit']->value && $_smarty_tpl->tpl_vars['storage']->value['id'] == $_smarty_tpl->tpl_vars['item']->value['storageid']) {?>
                                        <?php $_smarty_tpl->_assignInScope('currentStorage', $_smarty_tpl->tpl_vars['storage']->value);?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['storage']->value['label'];?>
" selected="selected"><?php echo $_smarty_tpl->tpl_vars['storage']->value['label'];?>
</option>
                                    <?php } else { ?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['storage']->value['label'];?>
" ><?php echo $_smarty_tpl->tpl_vars['storage']->value['label'];?>
</option>
                                    <?php }?>

                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>

                <input type="text" name="storage" id="storage" maxlength="32" class="form-control" placeholder="<?php echo gettext('Lagerplatz');?>
" required="required" autocomplete="off" <?php if ($_smarty_tpl->tpl_vars['isEdit']->value && $_smarty_tpl->tpl_vars['item']->value['storageid'] != 0) {?>value="<?php echo $_smarty_tpl->tpl_vars['currentStorage']->value['label'];?>
"<?php }?>>

                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon7"><?php echo gettext('Bemerkung');?>
</span>
                    </div>


                    <input type="text" name="comment" maxlength="255" class="form-control" autocomplete="off" placeholder="<?php echo gettext('Bemerkung');?>
" aria-label="Bemerkung" aria-describedby="basic-addon7" <?php if (isset($_smarty_tpl->tpl_vars['item']->value['comment'])) {?>value="<?php echo $_smarty_tpl->tpl_vars['item']->value['comment'];?>
"<?php }?>>

                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="dropdown">
                            <select class="btn btn-secondary dropdown-toggle" tabindex="-1" autocomplete="off" type="button" id="categoryDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php if ($_smarty_tpl->tpl_vars['isEdit']->value) {?>
                                        <option value="-1"><?php echo gettext('Kategorie');?>
</option>
                                    <?php } else { ?>
                                        <option value="-1" selected="selected"><?php echo gettext('Kategorie');?>
</option>

                                    <?php }?>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'category');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
?>
                                        <?php if ($_smarty_tpl->tpl_vars['isEdit']->value && $_smarty_tpl->tpl_vars['category']->value['id'] == $_smarty_tpl->tpl_vars['item']->value['headcategory']) {?>
                                            <?php $_smarty_tpl->_assignInScope('currentCategory', $_smarty_tpl->tpl_vars['category']->value);?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
" selected="selected"><?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</option>
                                        <?php } else { ?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
" ><?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</option>
                                        <?php }?>

                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>


                            </select>
                        </div>
                    </div>
                        <?php if (!$_smarty_tpl->tpl_vars['isEdit']->value || $_smarty_tpl->tpl_vars['currentCategory']->value == NULL) {?>
                            <input type="text" class="form-control" id="category" name="category" required="required" autocomplete="off" placeholder="<?php echo gettext('Netzwerk/Hardware');?>
">
                        <?php } else { ?>
                            <input type="text" class="form-control" id="category" name="category" required="required" autocomplete="off" placeholder="<?php echo gettext('Netzwerk/Hardware');?>
" value="<?php echo $_smarty_tpl->tpl_vars['currentCategory']->value['name'];?>
">

                        <?php }?>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="dropdown">
                            <select class="btn btn-secondary dropdown-toggle" tabindex="-1" autocomplete="off" type="button" id="subcategoryDropdown" multiple="multiple" size="3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php if ($_smarty_tpl->tpl_vars['isEdit']->value && !empty($_smarty_tpl->tpl_vars['item']->value['subcategories'])) {?>
                                        <?php $_smarty_tpl->_assignInScope('subCat', explode(',',$_smarty_tpl->tpl_vars['item']->value['subcategories']));?>
                                        <option value="-1"><?php echo gettext('Unterkategorie');?>
</option>
                                    <?php } else { ?>
                                        <option value="-1" selected="selected"><?php echo gettext('Unterkategorie');?>
</option>
                                    <?php }?>
                                    <?php $_smarty_tpl->_assignInScope('subCategories', array());?>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'category');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
?>
                                        <?php if ($_smarty_tpl->tpl_vars['isEdit']->value && in_array($_smarty_tpl->tpl_vars['category']->value['id'],$_smarty_tpl->tpl_vars['subCat']->value)) {?>
                                            <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['subCategories']) ? $_smarty_tpl->tpl_vars['subCategories']->value : array();
if (!is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess) {
settype($_tmp_array, 'array');
}
$_tmp_array[] = $_smarty_tpl->tpl_vars['category']->value['name'];
$_smarty_tpl->_assignInScope('subCategories', $_tmp_array);?>
                                            <option selected="selected" value="<?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</option>
                                        <?php } else { ?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</option>
                                        <?php }?>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>  
                            </select>
                        </div>
                    </div>
                    <?php $_smarty_tpl->_assignInScope('subCategories_imploded', implode($_smarty_tpl->tpl_vars['subCategories']->value,','));?>
                    <?php if (!$_smarty_tpl->tpl_vars['isEdit']->value || empty($_smarty_tpl->tpl_vars['subCategories_imploded']->value)) {?>
                        <input type="text" class="form-control" id="subcategory" name="subcategories" placeholder="<?php echo gettext('Router,wlan,fritzBox');?>
" aria-label="<?php echo gettext('Unterkategorie');?>
" autocomplete="off">
                    <?php } else { ?>
                        <input type="text" class="form-control" id="subcategory" name="subcategories" placeholder="<?php echo gettext('Router,wlan,fritzBox');?>
" aria-label="<?php echo gettext('Unterkategorie');?>
" autocomplete="off" value="<?php echo $_smarty_tpl->tpl_vars['subCategories_imploded']->value;?>
">
                    <?php }?>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon4"><?php echo gettext('Anzahl');?>
</span>
                    </div>
                        <input type="text" autocomplete="off" name="amount" class="form-control" placeholder="1" aria-label="<?php echo gettext('Anzahl');?>
" aria-describedby="basic-addon4" <?php if ($_smarty_tpl->tpl_vars['isEdit']->value) {?>value="<?php echo $_smarty_tpl->tpl_vars['item']->value['amount'];?>
"<?php }?>>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon6"><?php echo gettext('Seriennummer');?>
</span>
                    </div>
                        <input type="text" name="serialnumber" class="form-control" placeholder="<?php echo gettext('Seriennummer/Artikelnummer');?>
" aria-label="<?php echo gettext('Seriennummer');?>
" aria-describedby="basic-addon6" <?php if ($_smarty_tpl->tpl_vars['isEdit']->value) {?>value="<?php echo $_smarty_tpl->tpl_vars['item']->value['serialnumber'];?>
"<?php }?>>
                </div>

                <div style="float: right;">
                    <button type="submit" class="btn btn-danger"><?php if ($_smarty_tpl->tpl_vars['isEdit']->value) {
echo gettext('Überschreiben');
} else {
echo gettext('Eintragen');
}?></button>
                </div>
            </form>
        </div>


<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <?php echo '<script'; ?>
 type="text/javascript">
            document.querySelector('#storageDropdown').addEventListener('change', function(evt) {
                if (parseInt(evt.target.value) === -1) {
                    document.querySelector('#storage').value = ''
                    return
                }
                document.querySelector('#storage').value = evt.target.value;
            })

            document.querySelector('#subcategoryDropdown').addEventListener('change', function(evt) {
                if (parseInt(evt.target.value) === -1) {
                    document.querySelector('#subcategory').value = ''
                    return
                } else {
                    let selections = []
                    document.querySelector('#subcategory').value = '';
                    for (let selection of this.selectedOptions) {
                        selections.push(selection.value);
                    }
                    document.querySelector('#subcategory').value =  selections.join(',');
                }

            })



            document.querySelector('#categoryDropdown').addEventListener('change', function(evt) {
                if (parseInt(evt.target.value) === -1) {
                    document.querySelector('#category').value = ''
                    return
                }
                document.querySelector('#category').value = evt.target.value;
            })
        <?php echo '</script'; ?>
>
    

<?php $_smarty_tpl->_subTemplateRender("file:bodyend.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
