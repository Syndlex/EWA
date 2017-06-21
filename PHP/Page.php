<?php // UTF-8 marker äöüÄÖÜß€

abstract class Page
{
    // --- ATTRIBUTES ---

    /**
     * Reference to the MySQLi-Database that is
     * accessed by all operations of the class.
     */
    protected $_database = null;

    // --- OPERATIONS ---

    /**
     * Connects to DB and stores
     * the connection in member $_database.
     * Needs name of DB, user, password.
     *
     * @return none
     */
    protected function __construct()
    {
        $this->_database = new mysqli("localhost","root","","Pizza",3306);/* to do: create instance of class MySQLi */;
    }

    /**
     * Closes the DB connection and cleans up
     *
     * @return none
     */
    protected function __destruct()
    {
        $this->_database->close();
        // to do: close database
    }

    /**
     * Generates the header section of the page.
     * i.e. starting from the content type up to the body-tag.
     * Takes care that all strings passed from outside
     * are converted to safe HTML by htmlspecialchars.
     *
     * @param string $headline $headline is the text to be used as title of the page
     *
     * @param string $script
     * @param string $onload
     * @return none
     */
    protected function generatePageHeader($headline = "", $script = "", $onload = "")
    {

        $headline = htmlspecialchars($headline);

        header("Content-type: text/html; charset=UTF-8");
        echo "<head>";
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\"/>";
        echo "<title>$headline</title>";
        echo "<script src=\"$script\"></script>";
        echo "</head>";

        echo "<body onload=$onload>";

        echo "<nav>";
        echo "<ul class=\"Navigation\">";
        echo "<li ><a href = \"bestellung.php\" > Bestellung</a ></li >";
        echo "<li ><a href = \"kunde.php\" > Kunde</a ></li >";
        echo "<li ><a href = \"baecker.php\" > Bäcker</a ></li >";
        echo "<li ><a href = \"fahrer.php\" > Fahrer</a ></li >";
        echo "</ul >";
        echo "</nav>";
    }


    /**
     * Outputs the end of the HTML-file i.e. /body etc.
     *
     * @return none
     */
    protected function generatePageFooter()
    {
        echo"</body>";
        echo"</html>";
        // to do: output common end of HTML code
    }

    /**
     * Processes the data that comes via GET or POST i.e. CGI.
     * If every page is supposed to do something with submitted
     * data do it here. E.g. checking the settings of PHP that
     * influence passing the parameters (e.g. magic_quotes).
     *
     * @return none
     */
    protected function processReceivedData()
    {
        if (get_magic_quotes_gpc()) {
            throw new Exception
            ("Bitte schalten Sie magic_quotes_gpc in php . ini aus!");
        }
    }
} // end of class

// Zend standard does not like closing php-tag!
// PHP doesn't require the closing tag (it is assumed when the file ends). 
// Not specifying the closing ? >  helps to prevent accidents 
// like additional whitespace which will cause session 
// initialization to fail ("headers already sent"). 
//? >