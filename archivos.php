<?php
    function show_files($start) {
        $contents = scandir($start);
        array_splice($contents, 0,2);
        echo "<ul>";
        foreach ( $contents as $item ) {
            if ( is_dir("$start/$item") && (substr($item, 0,1) != '.') ) {
                echo "<li>$item</li>";
                show_files("$start/$item");
            } else {
                echo "<li>$item</li>";
            }
        }
        echo "</ul>";
    }

    show_files('./');
?>