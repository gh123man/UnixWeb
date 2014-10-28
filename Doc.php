<?php

include_once './components/LocalNavBuilder.php';

class Doc {

    const DOC_LOCATION_FORMAT = './content/docs/%s.html';

    private $urlContext;

    public function __construct($urlContext) {
        $this->urlContext = $urlContext;
    }

    public function display() {

        if (isset($this->urlContext[1])) {

            $doc = $this->urlContext[1];
            $pageData = "";

            $dataLocation = sprintf(self::DOC_LOCATION_FORMAT, $doc);

            $pageData = self::getPageData($dataLocation);

            self::showNav();

            //Show local nav and stuff here (should be generated)
            ?>
            <div class="pageContent">
                <h2><?php echo $doc; ?> documentation</h2>
                <?php
                echo $pageData;
                ?>
            </div>
            <?php

        } else {
            self::showNav();
            self::landing();
        }

    }

    public static function showNav() {
        $localNav = new LocalNavBuilder('content/docs', 'doc');
        $localNav->display();
    }

    public static function landing() {
        ?>
        Welcome to our docs page!
        <?php
    }

    public static function getPageData($dataLocation) {
        if (file_exists($dataLocation)) {
            return file_get_contents($dataLocation);
        } else {
            throw new Exception("Doc Content file not found");
        }
    }
}
?>
