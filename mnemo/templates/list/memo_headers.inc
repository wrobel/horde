<?php $sortdirclass = $sortdir ? 'sortup' : 'sortdown' ?>

<script type="text/javascript">

var PREFS_UPDATE_TIMEOUT;

function table_sortCallback(tableId, column, sortDown)
{
    if (typeof PREFS_UPDATE_TIMEOUT != "undefined") {
        window.clearTimeout(PREFS_UPDATE_TIMEOUT);
    }

    PREFS_UPDATE_TIMEOUT = window.setTimeout('doPrefsUpdate("' + column + '", "' + sortDown + '")', 300);
}

function doPrefsUpdate(column, sortDown)
{
    baseurl = '<?php echo Horde::url($GLOBALS['registry']->get('webroot', 'horde') . '/services/prefs/', true, -1) ?>';
    try {
        new Ajax.Request(baseurl, { parameters: { app: 'mnemo', pref: 'sortby', value: encodeURIComponent(column.substring(1)) } });
        new Ajax.Request(baseurl, { parameters: { app: 'mnemo', pref: 'sortdir', value: encodeURIComponent(sortDown) } });
    } catch (e) {}
}

</script>

<table width="100%" id="memos" cellspacing="0" class="sortable linedRow nowrap">
<thead>
 <tr class="item leftAlign">
  <th class="nosort" width="3%"><?php echo Horde::img('edit.png', _("Edit Note"), '') ?></th>
<?php if ($showNotepad): ?>
  <th id="s<?php echo Mnemo::SORT_NOTEPAD ?>"<?php if ($sortby == Mnemo::SORT_NOTEPAD) echo ' class="' . $sortdirclass . '"' ?> width="2%">
   <?php echo Horde::widget(Horde::url(Horde_Util::addParameter($baseurl, 'sortby', Mnemo::SORT_NOTEPAD)), _("Sort by Notepad"), 'sortlink', '', '', _("Notepad")) ?>&nbsp;
  </th>
<?php endif; ?>
  <th id="s<?php echo MNEMO::SORT_DESC ?>"<?php if ($sortby == MNEMO::SORT_DESC) echo ' class="' . $sortdirclass . '"' ?> width="80%">
    <?php echo Horde::widget(Horde::url(Horde_Util::addParameter($baseurl, 'sortby', Mnemo::SORT_DESC)), _("Sort by Note Text"), 'sortlink', '', '', _("No_te")) ?>&nbsp;
  </th>
  <th id="s<?php echo MNEMO::SORT_MOD_DATE ?>"<?php if ($sortby == Mnemo::SORT_MOD_DATE) echo ' class="' . $sortdirclass . '"' ?> width="2%">
    <?php echo Horde::widget(Horde::url(Horde_Util::addParameter($baseurl, 'sortby', MNEMO::SORT_MOD_DATE)), _("Sort by Modification Date"), 'sortlink', '', '', _("Date")) ?>&nbsp;
  </th>
  <th id="s<?php echo Mnemo::SORT_CATEGORY ?>"<?php if ($sortby == Mnemo::SORT_CATEGORY) echo ' class="' . $sortdirclass . '"' ?> width="15%">
    <?php
    echo Horde::widget(Horde::url(Horde_Util::addParameter('list.php', 'sortby', Mnemo::SORT_CATEGORY)), _("Sort by Category"), 'sortlink', '', '', _("_Category"));
    if ($GLOBALS['registry']->getAuth() && (!$GLOBALS['prefs']->isLocked('categories') ||
                            !$GLOBALS['prefs']->isLocked('category_colors'))) {
        $categoryUrl = Horde_Util::addParameter(Horde::url($GLOBALS['registry']->get('webroot', 'horde') . '/services/prefs.php'), array('app' => 'horde', 'group' => 'categories'));
        echo ' ' . Horde::link($categoryUrl, _("Edit categories and colors"), '', '_blank', 'Horde.popup({url:this.href});Event.stop(event);return false;') . Horde::img('colorpicker.png', _("Edit categories and colors"), '') . '</a>';
    }
    ?>
  </th>
 </tr>
</thead>
<tbody id="notes_body">
