<?php

class PrimaryNavBuilder {

    private $navItems;

    public function __construct($items) {
        $this->navItems = $items;

    }

    public function display($leftCallback = null, $rightCallback = null) {
        ?>
        <nav>
            <div class="navWrapper">
                <div class="navContainer">
                    <?php
                    if (isset($leftCallback)){
                        $leftCallback();
                    }

                    foreach ($this->navItems as $title => $address) {
                        echo '<a href=' . $address . '>';
                        echo '<div class="navItemWrapper">';
                        echo '<div class="navItem">';
                        echo $title;
                        echo '</div>';
                        echo '</div>';
                        echo '</a>';
                    }

                    if (isset($rightCallback)){
                        $rightCallback();
                    }
                    ?>
                </div>
            </div>
        </nav>
        <?php
    }


}



?>
