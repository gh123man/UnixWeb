<?php

class LocalNavBuilder {

    private $files;
    private $prefix;

    public function __construct($scanDir, $prefix) {
        $this->prefix = $prefix;
        $files = scandir($scanDir);
        $this->files = array_slice($files, 2);

    }

    public function display($select = null) {
        ?>
        <nav>
            <div class="localNavWrapper">
                <div class="localNavContainer">
                    <?php
                    foreach ($this->files as $file) {
                        $name = explode('.', $file);
                        if ($name[0] != "index" && isset($name[1]) && ($name[1] == "php" || $name[1] == "html")) {
                            $uri = urlencode($name[0]);
                            echo "<a href=/$this->prefix/$uri>";
                            echo '<div class="localNavItemWrapper">';
                            echo '<div class="localNavItem' . ($select != null && $select == $name[0] ? ' selectedNavItem' : '') . '">';
                            echo $name[0];
                            echo '</div>';
                            echo '</div>';
                            echo '</a>';
                        }
                    }

                    ?>
                </div>
            </div>
        </nav>
        <?php
    }


}



?>
