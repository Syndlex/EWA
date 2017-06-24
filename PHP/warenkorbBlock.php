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
class warenkorbBlock        // to do: change name of class
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
    public function __construct(mysqli $database)
    {
        $this->_database = $database;
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
    public function generateView()
    {
        $this->getViewData();
        echo <<<EOD
        <aside class="RightBody">
    <form action="kunde.php" method="post" id="form1"> 
    <section>
            <h2>Lieferinformation</h2>
            <input type="text" id="kVorname" size="30" maxlength="40" placeholder="Vorname" name="Vorname"
                   required="required" value="TestVorname"/>
            <input type="text" size="30" maxlength="40" placeholder="Nachname" name="Nachname" required="required"
                   value="TestNachname"/>
            <input type="text" size="30" maxlength="40" placeholder="Anschrift" name="Anschrift" required="required"
                   value="TestAnschrift"/>
            <input type="text" size="30" maxlength="40" placeholder="Telefonnummer" name="Telefonnummer"
                   required="required" value="Test0815"/>
            <input type="text" size="30" maxlength="40" placeholder="E-Mail" name="E-Mail" required="required"
                   value="Test@E.Mail"/>
            
        </section>
        <article>
            <h2>Warenkorb</h2>
            <table id="WarenKorb" on>
                <tr>
                    <th></th>
                    <th>Artikel</th>
                    <th>Preis</th>
                    <th>Menge</th>
                </tr>
            </table>
            <br>
            <p>Gesamtpreis: <span id="spanner" > </span></p>
            <input type ="hidden" id="Endpreis" name="Gesamtpreis" value="0.00 "/>
            
        </article>
        <br>
        <input type="button" value="Alle löschen" onclick="clearWarenkorb()"/>
        <input type="submit" value="Bestellung abschicken"/>
        
    </form>
</aside>
EOD;

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