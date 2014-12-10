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