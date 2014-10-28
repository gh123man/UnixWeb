<?php

include_once './components/LocalNavBuilder.php';

class Doc {

    const DOC_LOCATION_FORMAT = './content/docs/%s.html';

    private $urlContext;
    private $doc;
    private $pageData;

    public function __construct($urlContext) {
        $this->urlContext = $urlContext;

        if (isset($urlContext[1])) {

            $this->doc = $urlContext[1];

            $dataLocation = sprintf(self::DOC_LOCATION_FORMAT, $this->doc);

            if (file_exists($dataLocation)) {
                $this->pageData = file_get_contents($dataLocation);
            } else {
                throw new Exception("Doc Content file not found");
            }

        } else {
            throw new Exception("Doc url paramater not set");
        }

    }

    public function display() {

        $localNav = new LocalNavBuilder('content/docs', 'doc');
        $localNav->display();

        //Show local nav and stuff here (should be generated)
        ?>
        <div class="pageContent">
            <h2><?php echo $this->doc; ?> documentation</h2>
            <?php
            echo $this->pageData;
            ?>
        </div>
        <?php



    }
}
?>
