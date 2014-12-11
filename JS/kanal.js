var aufforderung;

function ladeKanal()
{
    var  xmlhttp = new XMLHttpRequest();
    
    var content = $("content");
    
    aufforderung = "ladeKanal";
    
    xmlhttp.open("get", "kanal.php?aufforderung="+ aufforderung, true);
    xmlhttp.send();
    
    xmlhttp.onreadystatechange = function() 
    {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
            {
                content.innerHTML = xmlhttp.responseText;
            }
    } ;    
}