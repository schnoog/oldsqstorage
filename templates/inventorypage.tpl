{include file="head.tpl" title=foo}
{include file="nav.tpl" title=foo}

        <div class="content">

{$sid = -99}
{$dataid = 0}
{foreach $storecontent as $items}
    {foreach $items as $item name='itemloop'}
        {$dataid = $dataid + 1}
        {if $smarty.foreach.itemloop.first}
            <div class="storage-area">
            <button class="btn smallButton" name="removeStorage" data-name="{$storagearray[{$item.storageid}]['label']}" value="{$item.storageid}" type="submit">
            <i class="fas fa-times-circle"></i>
            </button>
            <h4 class="text-dark">
            <a href="{$target}?storageid={$item.storageid}">{$storagearray[{$item.storageid}]['label']}</a>&nbsp;<span class="small">TODO(2 Positionen, 4 Gegenstände)</span></h4>
            <ul class="list-group">
            <li class="alert alert-info"><span class="list-span">{'Gruppe'|gettext}</span><span class="list-span">{'Bezeichnung'|gettext}</span><span class="list-span">{'Anzahl'|gettext}</span><span class="list-span">{'Bemerkung'|gettext}</span><span class="list-span">{'Unterkategorien'|gettext}</span><span class="list-span">{'Hinzugefügt'|gettext}</span><span class="list-span">{'Aktionen'|gettext}</span></li>
        {/if}
        <li class="list-group-item">
            <button class="btn smallButton" name="remove" data-name="{$item.label}" value="1" type="submit"><i class="fas fa-times-circle"></i></button>
            <a href="{$target}?category={$item.headcategory}" class="list-span">{$headCatArr[{$item.headcategory}]['name']}</a>
            <span class="list-span">{$item.label}</span>
            <span class="list-span">{$item.amount}</span>
            <span class="list-span">{$item.comment}</span>
            <span class="list-span">
            
                {$subcategoriesDB = explode(',', trim($item['subcategories'], ','))}                            
                {if count($subcategoriesDB)>0}
                {foreach $subcategoriesDB as $sub}
                    {if strlen($sub)>0}
                    {$scat = $subCatArr[{$sub}]}
                    <a href="{$target}?subcategory={$scat.id}">{$scat.name}</a>
                    {/if}
                {/foreach}
                {/if}
            
            </span>



            <span class="list-span">{$item.date}</span>
            <a class="list-span" href="index.php?editItem={$item.id}"><i class="fas fa-edit"></i></a>
            <div class="dropdown float-right">

                <select autocomplete="off" class="btn btn-primary dropdown-toggle switchStorage" value="0" type="button" tabindex="-1" data-id="{$item.id}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <option selected="selected" value="-1">{'Zuweisen'|gettext}</option>
                    {foreach $storages as $storage}
                        <option value="{$storage.id}">{$storage.label}</option>
                    {/foreach}
                </select>

            </div>
        </li>
        {if $smarty.foreach.itemloop.last}
        </ul>
        </div>
        {/if}
    {/foreach}

{/foreach}

</div>



{include file="footer.tpl"}
{literal}
        <script type="text/javascript">
            let switches = document.querySelectorAll('.btn.switchStorage')
            for (let item of switches) {
                item.addEventListener('change', function(evt) {
                    if (evt.target.value === '-1') return
                    window.location.href = '{/literal}{$target}{literal}?storageid=' + evt.target.value + '&itemid=' + evt.target.dataset['id'];
                })
            }

            let removalButtons = document.querySelectorAll('.smallButton')
            for (let button of removalButtons) {
                button.addEventListener('click', function (evt) {
                    let targetType = evt.target.name === 'removeStorage' ? '{/literal}{'Lagerplatz wirklich entfernen?'|gettext}{literal}' : '{/literal}{'Position wirklich entfernen?'|gettext}{literal}'
                    if (!window.confirm(targetType + ' "' + evt.target.dataset['name'] + '"')) {
                        evt.preventDefault()
                    }
                })
            }
        </script>
    
{/literal}
{include file="bodyend.tpl"}