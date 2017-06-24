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
class lieferstandBlock        // to do: change name of class
{
    // --- ATTRIBUTES ---

    /**
     * Reference to the MySQLi-Database that is
     * accessed by all operations of the class.
     */
    protected $_database = null;
    private $_bestellungsRecordset;

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
    public function __construct(mysqli $database)
    {
        $this->_database = $database; //$database
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
    public function generateView() //$id = ""
    {
        $this->getViewData();

        echo <<< EOD
<section class="MainBody">
    <h1>Lieferstand</h1>
    <table>
        <tr>
            <th>Artikel</th>
            <th>im Ofen</th>
            <th>fertig</th>
            <th>unterwegs</th>
        </tr>   
EOD;
        foreach ($this->_bestellungsRecordset as $item) {

            echo "<tr><td>";
            echo $item["Name"];
            echo "</td>";

            $this->echoStatus($item, 1);
            $this->echoStatus($item, 2);
            $this->echoStatus($item, 3);


        }
        echo "</table></section>";

        /*if ($id) {
            $id = "id=\"$id\"";
        }
        echo "<div $id>\n";
        // to do: call generateView() for all members
        echo "</div>\n";*/
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
    public function processReceivedData()
    {
        // to do: call processData() for all members
    }

    /**
     * @param $item
     * @param $i
     */
    protected function echoStatus($item, $i)
    {
        echo "<td><input type='radio' disabled='disabled'";
        if ($item["Status"] > $i) {
            echo "checked";
        }
        echo "/>";
        echo $item["Status"];
        echo "</td>";

    }

    protected function loadSql()
    {
        if (isset($_SESSION)) {
            try {

                $currentSession = $_SESSION["Kunde"];

                $query = "SELECT pizzabestellung.Status, pizza.Name FROM `pizza`,`pizzabestellung` WHERE pizzabestellung.BestellungID =  '$currentSession' AND pizza.PizzaID = pizzabestellung.PizzaID ORDER BY pizza.PizzaID ASC";

                $result = $this->_database->query($query);
                $this->_bestellungsRecordset = mysqli_fetch_all($result, MYSQLI_ASSOC);

                mysqli_free_result($result);

            } catch (Exception $except) {
                echo "SQL Query failed: " . $except->getMessage();
            }
        }
    }
}
// Zend standard does not like closing php-tag!
// PHP doesn't require the closing tag (it is assumed when the file ends).
// Not specifying the closing ? >  helps to prevent accidents
// like additional whitespace which will cause session
// initialization to fail ("headers already sent").
//? >