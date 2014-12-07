<?php

include_once './components/LocalNavBuilder.php';
include_once './src/PageTracker.php';

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


            //Track page view here
            $trackPath = '/' . $this->urlContext[0] . '/' . $this->urlContext[1];
            PageTracker::track($page, $trackPath, $this->urlContext[0]);


            $this->showSideBar($page);

            ?>
            <div class="pageContent pannel pageContentDocs">
                <h2><?php echo $this->getPageHeader($page) ?>
                <div class="pageVIews">
                <?php

                $currentItem = PageTracker::getItem($trackPath);
                echo $currentItem->hits();

                ?>
                Views</div>
                </h2>
                <?php
                include_once $dataLocation;
                ?>
            </div>
            <?php

        } else {
            $this->showSideBar();
            $this->landing();
        }


    }

    public function showSideBar($page = null) {
        echo '<div class="sideBar">';
        drawLogin();
        $this->showNavBar($page);
        echo '</div>';
    }

    public function landing() {
        ?>
        <div class="pageContent pannel pageContentDocs">
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
