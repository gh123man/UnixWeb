<?php

include_once './components/LocalNavBuilder.php';

abstract class PageBuilder {

    const DOC_LOCATION_FORMAT = './content/docs/%s.html';

    private $urlContext;

    public function __construct($urlContext) {
        $this->urlContext = $urlContext;
    }

    abstract function getPageTypePath();

    abstract function getPageHeader($page);

    abstract function getDefaultPage();

    abstract function getLocalNav();

    private function showNavBar() {
        $this->getLocalNav()->display();
    }

    public function display() {

        if (isset($this->urlContext[1])) {

            $page = $this->urlContext[1];
            $pageData = "";

            $dataLocation = sprintf($this->getPageTypePath(), $page);

            $pageData = self::getPageData($dataLocation);

            $this->showNavBar();

            ?>
            <div class="pageContent pageContentDocs">
                <h2><?php echo $this->getPageHeader($page) ?></h2>
                <?php
                echo $pageData;
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

    public static function getPageData($dataLocation) {
        if (file_exists($dataLocation)) {
            return file_get_contents($dataLocation);
        } else {
            throw new Exception("Page Content file not found");
        }
    }
}
?>
