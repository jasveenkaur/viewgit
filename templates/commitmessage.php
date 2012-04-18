<?php
echo
    '<div class="commitmessage">' .
        '<a class="browse" href="' . makelink(array('a' => 'files', 'p' => $page['project'], 'h' => $page['tree_id'], 'hb' => $page['commit_id'])) . '">' .
            'Browse code' .
        '</a>' .

        '<pre>' .
            htmlentities_wrapper($page['message_full']) .
        '</pre>' .

        '<div class="authorinfo">' .
            '<span class="author">' .
                format_author($page['author_name']) .
            '</span>' .

            '<span class="age">' .
                'authored ' .
                ago($page['author_datetime']) .
                ' ago' .
            '</span>' .

            '<a class="commit" href="">' .
                'commit ' .
                '<span>' .
                    $page['commit_id'] .
                '</span>' .
            '</a>' .
        '</div>' .
    '</div>' .
    '';
