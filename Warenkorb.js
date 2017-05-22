/**
 * Created by Autz on 22.05.17.
 */
function clickOnPizza(number) {
    var pizzaElement = document.getElementById(number);
    var warenkorb = document.getElementById("WarenKorb");
    var elementId = "WarenKorb"+number.toString();
    var elementById = document.getElementById(elementId);

    if(warenkorb.contains(elementById)){

        var mengeChild = elementById.lastElementChild;
        var textNode = mengeChild.textContent;
        var Anzahl = parseInt(textNode);
        console.log(Anzahl);
        Anzahl =Anzahl +1;

        mengeChild.textContent = Anzahl;

    }
    else
    {
        var newChild = pizzaElement.cloneNode(true);
        newChild.setAttribute("onClick", "");
        var attribute = newChild.getAttribute("id");
        var value = "WarenKorb" + attribute.toString();
        newChild.setAttribute("id", value);

        var tdMenge = document.createElement("td");
        var Menge = document.createTextNode("1");
        tdMenge.appendChild(Menge);
        newChild.appendChild(tdMenge);
        warenkorb.appendChild(newChild);
    }
}

var pizzaListe = [
    "Pizza Prosciutto, 4.00€"
    , "Pizza Salami, 4.30€"
    , "Pizza mit allem, 4.50€"
    , "Pizza ohne allem, 4.50€"
    , "Pizza gerollt, 4.50€"
    , "Pizza Salat, 4.50€"];

function Init() {

    pizzaListe.forEach(function (value, i) {
        var split = value.split(',',2);
        var elementById = document.getElementById("BestellListe");
        var tr = document.createElement("tr");

        var tdPic = document.createElement("td");
        var newPic = document.createElement("img");
        newPic.setAttribute("src","Bilder/pizza_android.svg");
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

}