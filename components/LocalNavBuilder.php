<?php

class LocalNavBuilder {

    private $files;
    private $prefix;

    public function __construct($scanDir, $prefix) {
        $this->prefix = $prefix;
        $files = scandir($scanDir);
        $this->files = array_slice($files, 2);

    }

    public function display() {
        ?>
        <nav>
            <div class="localNavWrapper">
                <div class="localNavContainer">
                    <?php

                    foreach ($this->files as $file) {
                        $name = explode('.', $file);
                        if ($name[0] != "index" && isset($name[1]) && $name[1] == "html") {
                            echo "<a href=/$this->prefix/$name[0]>";
                            echo '<div class="localNavItemWrapper">';
                            echo '<div class="localNavItem">';
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
