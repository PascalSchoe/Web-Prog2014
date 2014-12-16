

var aufforderung;

function ladeKanal()
{
    var  xmlhttp = new XMLHttpRequest();
    
    var content = $("content");
    
    aufforderung = "kanalInitialisierung";
    
    xmlhttp.open("get", "kanal.php?aufforderung="+ aufforderung, true);
    xmlhttp.send();
    
    xmlhttp.onreadystatechange = function() 
    {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
            {
                content.innerHTML = xmlhttp.responseText;
                
                var loeschenButtons, bearbeitenButtons, freigebenButtons, betrachtenButtons;
    
                loeschenButtons = document.getElementsByClassName("loeschen");
                bearbeitenButtons= document.getElementsByClassName("bearbeiten");
                freigebenButtons= document.getElementsByClassName("freigeben");
                betrachtenButtons= document.getElementsByClassName("betrachten");


                for(var i = 0; i < loeschenButtons.length; i++)
                {
                    loeschenButtons[i].addEventListener("click",kanalBtnHandler, false);
                    bearbeitenButtons[i].addEventListener("click",kanalBtnHandler, false);
                    freigebenButtons[i].addEventListener("click",kanalBtnHandler, false);
                    betrachtenButtons[i].addEventListener("click",kanalBtnHandler, false);
                   
                }
            }
    } ; 
    
    
}

window.addEventListener("load", function(){
    var suchEingabeForm = $("suchEingabeForm");
    var suchEingabe = $("suchEingabe");
    
    suchEingabeForm.addEventListener("submit", function(e){
        e.preventDefault();
        var  xmlhttp = new XMLHttpRequest();
    
        var content = $("content");
    
        aufforderung = "suche";

        xmlhttp.open("get", "kanal.php?aufforderung="+ aufforderung +"&suchEingabe=" + suchEingabe.value, true);
        xmlhttp.send();

        xmlhttp.onreadystatechange = function() 
        {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
                {
                    content.innerHTML = xmlhttp.responseText;
                    
                    var loeschenButtons, bearbeitenButtons, freigebenButtons, betrachtenButtons;
    
                    loeschenButtons = document.getElementsByClassName("loeschen");
                    bearbeitenButtons= document.getElementsByClassName("bearbeiten");
                    freigebenButtons= document.getElementsByClassName("freigeben");
                    betrachtenButtons= document.getElementsByClassName("betrachten");


                    for(var i = 0; i < loeschenButtons.length; i++)
                    {
                        loeschenButtons[i].addEventListener("click",kanalBtnHandler, false);
                        bearbeitenButtons[i].addEventListener("click",kanalBtnHandler, false);
                        freigebenButtons[i].addEventListener("click",kanalBtnHandler, false);
                        betrachtenButtons[i].addEventListener("click",kanalBtnHandler, false);

                    }
                }
        };
    }, false);
    
    
}, false);


function kanalBtnHandler(e)
{
    var src = e.target;
    
    console.log("Ich bin :" + e.target.getAttribute("class") +" Und mein Elternelment ist: "+ e.target.parentNode.getAttribute("id"));
    
    
    switch(src.getAttribute("class"))
    {
        case "kanalUI loeschen":
            window.location = "kanal.php?loeschen=" + src.parentNode.getAttribute("id");
            break;
            
        case "kanalUI bearbeiten":
            sessionStorage.setItem("albumName", src.parentNode.getAttribute("id"));
            sessionStorage.setItem("modus", "editieren");
            window.location="editor.html";
            break;
            
        case "kanalUI freigeben":
            window.location="kanal.php?freigabe=" + src.parentNode.getAttribute("id");
            break;
        
        case "kanalUI betrachten":
            
            break;
    }
}