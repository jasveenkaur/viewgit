<h1>
    <a href="<?php echo makelink(array('a' => 'shortlog', 'p' => $page['project'])); ?>">Shortlog</a>
</h1>

<table class="shortlog">
    <thead>
        <tr>
            <th class="date">Date</th>
            <th class="author">Author</th>
            <th class="message">Message</th>
            <th class="actions">Actions</th>
        </tr>
    </thead>
    <tbody>
<?php
$page['lasthash'] = 'HEAD';

foreach ($page['shortlog'] as $l) {
    $tr_class = $tr_class=='odd' ? 'even' : 'odd';

    echo
        '<tr class="' . $tr_class . '">' .
            '<td class="date">' . $l['date'] . '</td>' .
            '<td class="author">' . format_author($l['author']) . '</td>' .
            '<td class="message">' .
                '<a href="' . makelink(array('a' => 'commit', 'p' => $page['project'], 'h' => $l['commit_id'])) . '">' .
                    htmlentities_wrapper($l['message']) .
                '</a>';

    if (count($l['refs']) > 0) {
        foreach ($l['refs'] as $ref) {
            $parts = explode('/', $ref);
            $shortref = join('/', array_slice($parts, 1));
            $type = 'head';

            if ($parts[0] == 'tags') {
                $type = 'tag';
            }
            elseif ($parts[0] == 'remotes') {
                $type = 'remote';
            }

            echo '<span class="label ' . $type . '" title="' . $ref . '">' . $shortref . '</span>';
        }
    }

    echo
        '</td>' .

        '<td class="actions">' .
            '<a href="' . makelink(array('a' => 'commitdiff', 'p' => $page['project'], 'h' => $l['commit_id'])) . '" class="cdiff_link" title="Commit Diff">commitdiff</a>' .
            '<a href="' . makelink(array('a' => 'tree', 'p' => $page['project'], 'h' => $l['tree'], 'hb' => $l['commit_id'])) . '" class="tree_link" title="Tree">tree</a>' .
            '<a href="' . makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $l['tree'], 'hb' => $l['commit_id'], 't' => 'targz')) . '" rel="nofollow" class="tar_link" title="tar/gz">tar/gz</a>' .
            '<a href="' . makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $l['tree'], 'hb' => $l['commit_id'], 't' => 'zip')) . '" rel="nofollow" class="zip_link" title="zip">zip</a>' .
            '<a href="' . makelink(array('a' => 'patch', 'p' => $page['project'], 'h' => $l['commit_id'])) . '" class="patch_link" title="Patch">patch</a>' .
        '</td>' .
    '</tr>' .
    '';

    $page['lasthash'] = $l['commit_id'];
}
?>
</tbody>
</table>


<?php
if ($page['lasthash'] !== 'HEAD' && !isset($page['shortlog_no_more'])) {
	echo "<p>";
	for ($i = 0; $i < $page['pg']; $i++) {
		echo "<a href=\"". makelink(array('a' => 'shortlog', 'p' => $page['project'], 'h' => $page['ref'], 'pg' => $i)) ."\">$i</a> ";
	}
	echo "<a href=\"". makelink(array('a' => 'shortlog', 'p' => $page['project'], 'h' => $page['ref'], 'pg' => $page['pg'] + 1)) ."\">more &raquo;</a>";
	echo "</p>";
}
?>
