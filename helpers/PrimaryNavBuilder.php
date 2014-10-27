<?php

class PrimaryNavBuilder {

    private $navItems;
    private $itemWidth;

    public function __construct($items) {
        $this->navItems = $items;

    }

    public function display() {
        ?>
        <nav>
            <div class="navWrapper absoluteNav">
                <div class="navContainer">
                    <?php

                    foreach ($this->navItems as $title => $address) {
                        echo '<a href=' . $address . '>';
                        echo '<div class="">';
                        echo '<div class="">';
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
