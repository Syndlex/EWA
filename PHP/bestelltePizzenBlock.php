<?php // UTF-8 marker äöüÄÖÜß€
/**
 * Class BlockTemplate for the exercises of the EWA lecture
 * Demonstrates use of PHP including class and OO.
 * Implements Zend coding standards.
 * Generate documentation with Doxygen or phpdoc
 *
 * PHP Version 5
 *
 * @category File
 * @package  Pizzaservice
 * @author   Bernhard Kreling, <b.kreling@fbi.h-da.de>
 * @author   Ralf Hahn, <ralf.hahn@h-da.de>
 * @license  http://www.h-da.de  none
 * @Release  1.2
 * @link     http://www.fbi.h-da.de
 */

/**
 * This is a template for classes, which represent div-blocks
 * within a web page. Instances of these classes are used as members
 * of top level classes.
 * The order of methods might correspond to the order of thinking
 * during implementation.
 * @author   Bernhard Kreling, <b.kreling@fbi.h-da.de>
 * @author   Ralf Hahn, <ralf.hahn@h-da.de>
 */
class bestelltePizzenBlock        // to do: change name of class
{
    // --- ATTRIBUTES ---

    /**
     * Reference to the MySQLi-Database that is
     * accessed by all operations of the class.
     */
    protected $_database = null;
    private $_bestellungsRecordset = null;

    // to do: declare reference variables for members
    // representing substructures/blocks

    // --- OPERATIONS ---

    /**
     * Gets the reference to the DB from the calling page template.
     * Stores the connection in member $_database.
     *
     * @param $database $database is the reference to the DB to be used
     *
     * @return none
     */
    public function __construct(mysqli $mysqli) //$database
    {
        $this->_database = $mysqli; // =$database
        // to do: instantiate members representing substructures/blocks
    }

    /**
     * Fetch all data that is necessary for later output.
     * Data is stored in an easily accessible way e.g. as associative array.
     *
     * @return none
     */
    protected function getViewData()
    {
        // to do: fetch data for this view from the database


        $this->loadSql();
    }

    /**
     * Generates an HTML block embraced by a div-tag with the submitted id.
     * If the block contains other blocks, delegate the generation of their
     * parts of the view to them.
     *
     * @param $id $id is the unique (!!) id to be used as id in the div-tag
     *
     * @return none
     */
    public
    function generateView() //$id ""
    {
        $this->getViewData();
        echo <<<EOT
<section class="MainBody">
    <h1>Bestellte Pizzen</h1>
    <form action="https://www.fbi.h-da.de/cgi-bin/Echo.pl" method="get" id="form1" accept-charset="UTF-8">
        <table>
            <tr>
                <th>Artikel</th>
                <th>bestellt</th>
                <th>im Ofen</th>
                <th>fertig</th>

            </tr>
EOT;
        $this->generateTable();
        echo "</table></form></section>";
        /*if ($id) {
            $id = "id=\"$id\"";
        }
        echo "<div $id>\n";
        // to do: call generateView() for all members
        echo "</div>\n";*/
    }

    private
    function generateTable()
    {

        echo "<tr>";
        echo "</tr>";


        foreach ($this->_bestellungsRecordset as $item) {
            echo "<tr>";
            echo "<td>" . $item["Name"] . "</td>";

            $this->printTd($item, 2);
            $this->printTd($item, 3);
            $this->printTd($item, 4);

            echo "</tr>";

        }
    }

    private function printTd($item, $i)
    {
        $hass = $i - 2;
        echo "<td><input type='radio' onclick='sendStatus(this)' value='$hass'";
        if ($item["Status"] == $i) {
            echo "checked";
        }
        echo "/>";
    }

    /**
     * Processes the data that comes via GET or POST i.e. CGI.
     * If this block is supposed to do something with submitted
     * data do it here.
     * If the block contains other blocks, delegate processing of the
     * respective subsets of data to them.
     *
     * @return none
     */
    public
    function processReceivedData()
    {
        // to do: call processData() for all members
    }

    protected function loadSql()
    {
        try {

            $query = "SELECT bestellung.Vorname,bestellung.Nachname, bestellung.Anschrift, pizza.Name ,pizzabestellung.Status FROM `bestellung`,`pizza`,`pizzabestellung` WHERE pizzabestellung.BestellungID = bestellung.BestellungID AND pizzabestellung.PizzaID = pizza.PizzaID AND pizzabestellung.Status BETWEEN 0 AND 2 ";
            $result = $this->_database->query($query);
            $this->_bestellungsRecordset = mysqli_fetch_all($result, MYSQLI_ASSOC);


            mysqli_free_result($result);

        } catch (Exception $except) {
            echo "SQL Query failed: " . $except->getMessage();
        }
    }
}
// Zend standard does not like closing php-tag!
// PHP doesn't require the closing tag (it is assumed when the file ends).
// Not specifying the closing ? >  helps to prevent accidents
// like additional whitespace which will cause session
// initialization to fail ("headers already sent").
//? >