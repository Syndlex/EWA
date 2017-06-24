/**
 * Created by Marcel on 5/28/2017.
 */
function sendStatus(TableElement) {
    var parentNode = TableElement.parentNode.parentNode;
    var customer = parentNode.childNodes.item(0).textContent;
    var hiddenID = parentNode.childNodes.item(1);
    var status = TableElement.getAttribute("value");



    post("https://www.fbi.h-da.de/cgi-bin/Echo.pl", customer, status,hiddenID);
}

function post(path, name, value,hiddenID) {
    method ="post";

    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", name);
    hiddenField.setAttribute("value", value);

    form.appendChild(hiddenID);


    form.appendChild(hiddenField);
    document.body.appendChild(form);
    form.submit();
}