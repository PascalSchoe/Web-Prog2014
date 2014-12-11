function $(id)
{
    return document.getElementById(id);
}
 function createE(Element)
{
    return document.createElement(Element);
}
function elementLeeren(element)
{
    while(element.hasChildNodes())
    {
        element.removeChild(element.firstChild);
    }
}
function wechselSichtbarkeit(element)
{
    if($(element).getAttribute("class") === "sichtbar")
        $(element).setAttribute("class", "versteckt");
    else
        $(element).setAttribute("class", "sichtbar");
}