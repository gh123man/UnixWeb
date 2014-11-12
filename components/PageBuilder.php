<?php

include_once './components/LocalNavBuilder.php';

abstract class PageBuilder {

    private $urlContext;

    public function __construct($urlContext) {
        $this->urlContext = $urlContext;
    }

    abstract function getPageTypePath();

    abstract function getPageHeader($page);

    abstract function getDefaultPage();

    abstract function getLocalNav();

    private function showNavBar($select = null) {
        $this->getLocalNav()->display($select);
    }

    public function display() {

        if (isset($this->urlContext[1])) {
            $page = urldecode($this->urlContext[1]);
            $pageData = "";

            $dataLocation = sprintf($this->getPageTypePath(), $page);

            self::confirmPageExists($dataLocation);

            $this->showNavBar($page);

            ?>
            <div class="pageContent pageContentDocs">
                <h2><?php echo $this->getPageHeader($page) ?></h2>
                <?php
                include_once $dataLocation;
                ?>
            </div>
            <?php

        } else {
            $this->showNavBar();
            $this->landing();
        }

    }

    public function landing() {
        ?>
        <div class="pageContent pageContentDocs">
            <?php $this->getDefaultPage(); ?>
        </div>
        <?php
    }

    public static function confirmPageExists($dataLocation) {
        if (file_exists($dataLocation)) {
            return true;
        } else {
            throw new Exception("Page Content file not found");
        }
    }
}
?>
