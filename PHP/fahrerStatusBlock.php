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
class fahrerStatusBlock       // to do: change name of class
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
    public function __construct(mysqli $database)//$database
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

        if (isset($_POST) && !empty ($_POST)) {

            $status = htmlspecialchars($_POST["Status"]);
            $positionID = htmlspecialchars($_POST["ID"]);
            $query = null;
            if ($status == 4) {
                $query = "DELETE FROM pizzabestellung where Position=$positionID";

            }
            else {
                $query = "UPDATE pizzabestellung set Status=$status where Position = $positionID";
            }
            $this->_database->query($query);
            $this->_database->commit();
        }
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
    public function generateView()//$id = ""
    {
        $this->getViewData();
        echo <<< EOD
<section class="MainBody">
    <h1>Fertige Pizzen</h1>
    <table>
        <tr>
            <th>Kunde</th>
            <th>fertig</th>
            <th>unterwegs</th>
            <th>geliefert</th>
        </tr>   
EOD;
        $this->generateTable();
        echo "</table></section>";

        /*if ($id) {
        <tr>
    <td>Fritz Mayer</td>
    <td><input type="radio" onclick="sendStatus(this)" value="0"></td>
    <td><input type="radio" onclick="sendStatus(this)" value="1"></td>
    <td><input type="radio" onclick="sendStatus(this)" value="2"></td>
    </tr>
        echo "</div>\n";*/
    }

    private function generateTable()
    {
        echo "<tr>";
        echo "</tr>";


        foreach ($this->_bestellungsRecordset as $item) {
            echo "<tr>";
            echo "<td>" . $item["Vorname"] . '  ' . $item["Nachname"] . '   '. $item["Anschrift"] . "</td>";
            echo "<input type='hidden' name='ID' value='" . $item["Position"] . "'>";

            $this->printTd($item, 2);
            $this->printTd($item, 3);
            $this->printTd($item, 4);

            echo "</tr>";
        }
    }

    private function printTd($item, $status)
    {
        echo "<td><input type='radio' onclick='sendStatus(this)' value='$status'";

        if ($item["Status"] == $status) {
            echo "checked";
        }
        echo "/>";
    }

    public function processReceivedData()
    {
        // to do: call processData() for all members
    }

    protected function loadSql()
    {
        try {

            $query = "SELECT bestellung.Vorname,bestellung.Nachname, bestellung.Anschrift, pizza.Name, pizzabestellung.Position ,pizzabestellung.Status FROM `bestellung`,`pizza`,`pizzabestellung` WHERE pizzabestellung.BestellungID = bestellung.BestellungID AND pizzabestellung.PizzaID = pizza.PizzaID AND pizzabestellung.Status BETWEEN 2 AND 4 ";
            $result = $this->_database->query($query);
            $this->_bestellungsRecordset = mysqli_fetch_all($result, MYSQLI_ASSOC);


            mysqli_free_result($result);
        } catch (Exception $except) {
            echo "SQL Query failed: " . $except->getMessage();
        }
    }

    /**
     * @param $item
     * @param $i
     */

}