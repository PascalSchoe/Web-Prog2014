/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "elementHinzufuegen.php", true);
    xmlhttp.send(null);
        
        
    xmlhttp.onreadystatechange = function() 
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            $(ursprung).innerHTML = xmlhttp.responseText;
        }
    }
    
    
    
    /*
     * bekomme daten nicht ans  php über den submit des Forms
     */