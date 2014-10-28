<?php

class PrimaryNavBuilder {

    private $navItems;

    public function __construct($items) {
        $this->navItems = $items;

    }

    public function display() {
        ?>
        <nav>
            <div class="navWrapper">
                <div class="navContainer">
                    <?php

                    foreach ($this->navItems as $title => $address) {
                        echo '<a href=' . $address . '>';
                        echo '<div class="navItemWrapper">';
                        echo '<div class="navItem">';
                        echo $title;
                        echo '</div>';
                        echo '</div>';
                        echo '</a>';
                    }

                    ?>
                </div>
            </div>
        </nav>
        <?php
    }


}



?>
