<?php	// UTF-8 marker äöüÄÖÜß€
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

class fertigePizzenBlock       // to do: change name of class
{
    // --- ATTRIBUTES ---

    /**
     * Reference to the MySQLi-Database that is
     * accessed by all operations of the class.
     */
    protected $_database = null;

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
    public function __construct()//$database
    {
        $this->_database = null; //$database
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
        echo  <<< EOD
<section class="MainBody">
    <h1>Fertige Pizzen</h1>
    <table>
        <tr>
            <th>Kunde</th>
            <th>fertig</th>
            <th>unterwegs</th>
            <th>geliefert</th>
            <th>Bestellung</th>
            <th>Endpreis</th>

        </tr>
        <tr>
            <td>Fritz Mayer</td>
            <td><input type="radio" onclick="sendStatus(this)" value="0"></td>
            <td><input type="radio" onclick="sendStatus(this)" value="1"></td>
            <td><input type="radio" onclick="sendStatus(this)" value="2"></td>
            <td>Pizza Tonno <br/>Pizza Margherita <br/>Pizza Funghi</td>
            <td>26,50€</td>
        </tr>
        <tr>
            <td>Hans Müller</td>
            <td><input type="radio" onclick="sendStatus(this)" value="0"></td>
            <td><input type="radio" onclick="sendStatus(this)" value="1"></td>
            <td><input type="radio" onclick="sendStatus(this)" value="2"></td>
            <td>Pizza Tonno <br/>Pizza Margherita <br/>Pizza Funghi</td>
            <td>26,50€</td>
        </tr>
        <tr>
            <td>Gertrude Kaztea</td>
            <td><input type="radio" onclick="sendStatus(this)" value="0"></td>
            <td><input type="radio" onclick="sendStatus(this)" value="1"></td>
            <td><input type="radio" onclick="sendStatus(this)" value="2"></td>
            <td>Pizza Tonno <br/>Pizza Salami <br/>Pizza Rukola</td>
            <td>26,50€</td>
        </tr>

    </table>
</section>
EOD;
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
}
// Zend standard does not like closing php-tag!
// PHP doesn't require the closing tag (it is assumed when the file ends).
// Not specifying the closing ? >  helps to prevent accidents
// like additional whitespace which will cause session
// initialization to fail ("headers already sent").
//? >