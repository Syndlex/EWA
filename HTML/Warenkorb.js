/**
 * Created by Autz on 22.05.17.
 */
function clickOnPizza(number) {
    "use strict";
    var pizzaElement = document.getElementById(number);
    var warenkorb = document.getElementById("WarenKorb");
    var elementId = "WarenKorb" + number.toString();
    var elementById = document.getElementById(elementId);

    if (warenkorb.contains(elementById)) {

        var mengeChild = elementById.lastElementChild;
        var textNode = mengeChild.textContent;
        var Anzahl = parseInt(textNode);
        Anzahl = Anzahl + 1;
        mengeChild.textContent = Anzahl;


        bestellMenge = mengeChild.textContent;
        var parentNode = mengeChild.parentNode;
        parentNode.children[3].setAttribute("value", bestellMenge);


    }
    else {
        var newChild = pizzaElement.cloneNode(true);
        newChild.setAttribute("onClick", "clickOnWarenkorb(this)");
        var attribute = newChild.getAttribute("id");
        var value = "WarenKorb" + attribute.toString();
        newChild.setAttribute("id", value);


        var formText = document.createElement("input");
        formText.setAttribute("type", "hidden");
        newChild.appendChild(formText);

        var tdMenge = document.createElement("td");
        newChild.appendChild(tdMenge);
        var Menge = document.createTextNode("1");
        tdMenge.appendChild(Menge);
        warenkorb.appendChild(newChild);

        var bestellMenge = Menge.textContent;
        formText.setAttribute("value", bestellMenge);

        var pizza = newChild.children[1].textContent;
        formText.setAttribute("name", pizza);

    }
    calcTotalPrice();

}

var pizzaListe = [
    "Pizza Prosciutto, 4.00€"
    , "Pizza Salami, 4.30€"
    , "Pizza mit allem, 4.50€"
    , "Pizza ohne allem, 4.50€"
    , "Pizza gerollt, 4.50€"
    , "Pizza Salat, 4.50€"];

function Init() {
    "use strict";

    pizzaListe.forEach(function (value, i) {
        var split = value.split(',', 2);
        var elementById = document.getElementById("BestellListe");
        var tr = document.createElement("tr");

        var tdPic = document.createElement("td");
        var newPic = document.createElement("img");
        newPic.setAttribute("src", "../Bilder/pizza_android.svg");
        tdPic.appendChild(newPic);

        var tdTitel = document.createElement("td");
        var newChild = document.createTextNode(split[0]);
        tdTitel.appendChild(newChild);

        var tdPreis = document.createElement("td");
        var newPreis = document.createTextNode(split[1]);
        tdPreis.appendChild(newPreis);


        tr.setAttribute("id", i);
        var value2 = "clickOnPizza(" + i + ")";
        tr.setAttribute("onclick", value2);
        tr.appendChild(tdPic);
        tr.appendChild(tdTitel);
        tr.appendChild(tdPreis);
        elementById.appendChild(tr);


    });
    calcTotalPrice();

}

function clearWarenkorb() {

    var elementId = document.getElementById("WarenKorb");
    var rowCount = elementId.rows.length;
    for (var i = rowCount - 1; i > 0; i--) {
        elementId.deleteRow(i);
    }
    calcTotalPrice();
}

function clickOnWarenkorb(elementById) {
    var mengeChild = elementById.lastElementChild;
    var textNode = mengeChild.textContent;
    var Anzahl = parseInt(textNode);
    if (Anzahl > 1) {
        Anzahl = Anzahl - 1;
        mengeChild.textContent = Anzahl;
    }
    else {
        elementById.remove();


    }
    calcTotalPrice();
}

function calcTotalPrice() {
    var warenkorb = document.getElementById("WarenKorb");
    var gesammtpreis = 0;


    for (var i = 1, row; row = warenkorb.rows[i]; i++) {
        var mengeData = row.lastElementChild;
        var mengeNode = mengeData.textContent;
        var anzahl = parseFloat(mengeNode).toFixed(2);

        var preisData = row.children[2];
        var preisNode = preisData.textContent;
        var preisString = preisNode.substr(0, preisNode.length - 1);
        var preis = parseFloat(preisString).toFixed(2);
        console.log(preis);

        var pizzaPreis = anzahl * preis;

        gesammtpreis = gesammtpreis + pizzaPreis;


    }
    gesammtpreis = (gesammtpreis).toFixed(2);
    var spanner = document.getElementById("spanner");
    spanner.textContent = gesammtpreis + "€";


}
