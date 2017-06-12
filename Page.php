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
        //$this->_database = new mysqli("127.0.0.1","user","password","mysql",80,"");/* to do: create instance of class MySQLi */;
    }

    /**
     * Closes the DB connection and cleans up
     *
     * @return none
     */
    protected function __destruct()
    {
        //$this->_database->close();
        // to do: close database
    }

    /**
     * Generates the header section of the page.
     * i.e. starting from the content type up to the body-tag.
     * Takes care that all strings passed from outside
     * are converted to safe HTML by htmlspecialchars.
     *
     * @param $headline $headline is the text to be used as title of the page
     *
     * @return none
     */
    protected function generatePageHeader($headline = "")
    {
        $Klass = "warenkorb";//Todo put this in header.
        $headline = htmlspecialchars($headline);

        header("Content-type: text/html; charset=UTF-8");
        echo "<head>";
        echo(headString());
        echo "</head>";

        echo "<body>";

        echo "<nav>";
        echo(navString());
        echo "</nav>";
    }

    protected function headString()
    {
        return '<link rel="stylesheet" href="style.css"/>
        <script src="$Klass.js"></script>
        <Title>Bestellung</Title>';
    }

    protected function navString()
    {
        return '<ul class="Navigation" >
    <li ><a href = "bestellung . html" > Bestellung</a ></li >
    <li ><a href = "kunde . html" > Kunde</a ></li >
    <li ><a href = "baecker . html" > Bäcker</a ></li >
    <li ><a href = "fahrer . html" > Fahrer</a ></li >
</ul >';
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