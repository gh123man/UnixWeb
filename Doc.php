<?php
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

        //Show local nav and stuff here (should be generated)
        ?>
        You are looking at a doc for <?php echo $this->doc; ?>!
        <?php
        echo $this->pageData;



    }
}
?>
