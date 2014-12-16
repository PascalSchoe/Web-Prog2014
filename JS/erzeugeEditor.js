/*
 * In diesem Script wird auf den SessionStorage zugegriffen und ausgelesen welches Template und welche Anordnung gewählt wurden,
 * entsprechend der getroffenen Auswahl wird die Vorschau des Albums generiert. Jedes Element wird mit einem Onclick-Listener versehen,
 * bei Klick auf eines dieser Elemente erscheint ein Popup welches den Inhalt der eingefügt werden soll abfragt, eingegebene Inhalte
 * werden an ein Php script geschickt und auf der Seite als Vorschau gezeigt sowie als Xml auf dem Server hinterlegt
 */

var xmlhttp = new XMLHttpRequest();
var album;

window.addEventListener("load", function(){
    if(sessionStorage.getItem("modus") === "editieren")
    {
        //initialisiereEditor("albumEditieren");
        xmlhttp.open("get", "elementHinzufuegen.php?editieren="+ sessionStorage.getItem("albumName"),true);
        xmlhttp.send();

        xmlhttp.onreadystatechange = function() 
        {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
            {
                album = JSON.parse(xmlhttp.responseText);
                
                
                sessionStorage.setItem("template", album[0]["template"]);
                sessionStorage.setItem("anordnung", album[0]["anordnung"]);
               
               if(album[0]["albumTexte"].length > 0)
                {
                    counter = 1;
                    
                    for(x in album[0]["albumTexte"])
                    {
                        sessionStorage.setItem("albumText"+counter, album[0]["albumTexte"][x]);
                        counter++;
                    }
                }
               
                if(album[0]["fotos"].length > 0)
                {
                    counter = 1;
                    
                    for(x in album[0]["fotos"])
                    {
                        sessionStorage.setItem("bild"+counter, "<img class='vorschauBild' src='getImage.php?filename=" + album[0]["fotos"][x] + "'>");
                        counter++;
                    }
                }
                
              initialisiereEditor();    
            }
        }
    }
    else
    {
        initialisiereEditor();
    }

    
    
});

function initialisiereEditor()
{
    var template = sessionStorage.getItem("template");
    var anordnung = sessionStorage.getItem("anordnung");
    var vorschauContainer = $("vorschau");


    //Erzeugen aller DomObjekte
    var bild1,bild2,bild3,bild4,bild5,bild6,bild7,bild8;
    var albumText1,albumText2,albumText3;

    var albumTextMaxBuchstaben = new Array(3);

    var albumNameHeader = $("albumNameHeader");
    albumNameHeader.innerHTML = "Das ist dein Album: " + sessionStorage.getItem("albumName");

    bild1 = createE("div");
    bild2 = createE("div");
    bild3 = createE("div");
    bild4 = createE("div");
    bild5 = createE("div");
    bild6 = createE("div");
    bild7 = createE("div");
    bild8 = createE("div");

    albumText1 = createE("div");
    albumText2 = createE("div");
    albumText3 = createE("div");


    //Bilder
    bild1.setAttribute("id","bild1");
    bild1.setAttribute("class","bild1");
    bild1.addEventListener("click", bildHinzufuegen, false);
   
    bild2.setAttribute("id","bild2");
    bild2.setAttribute("class","bild2");
    bild2.addEventListener("click", bildHinzufuegen, false);
    
    bild3.setAttribute("id","bild3");
    bild3.setAttribute("class","bild3");
    bild3.addEventListener("click", bildHinzufuegen, false);
    
    bild4.setAttribute("id","bild4");
    bild4.setAttribute("class","bild4");
    bild4.addEventListener("click", bildHinzufuegen, false);
    
    bild5.setAttribute("id","bild5");
    bild5.setAttribute("class","bild5");
    bild5.addEventListener("click", bildHinzufuegen, false);
    
    bild6.setAttribute("id","bild6");
    bild6.setAttribute("class","bild6");
    bild6.addEventListener("click", bildHinzufuegen, false);
    
    bild7.setAttribute("id","bild7");
    bild7.setAttribute("class","bild7");
    bild7.addEventListener("click", bildHinzufuegen, false);
    
    bild8.setAttribute("id","bild8");
    bild8.setAttribute("class","bild");
    bild8.addEventListener("click", bildHinzufuegen, false);
    
    
    //Albumtexte
    albumText1.setAttribute("id","albumText1");
    albumText1.setAttribute("class","albumText1");
    albumText1.addEventListener("click", textHinzufuegen, false);
    
    albumText2.setAttribute("id","albumText2");
    albumText2.setAttribute("class","albumText2");
    albumText2.addEventListener("click", textHinzufuegen, false);
 
    albumText3.setAttribute("id","albumText3");
    albumText3.setAttribute("class","albumText3");
    albumText3.addEventListener("click", textHinzufuegen, false);
 

    //Sonstiges
    var clearFix = createE("div");
    clearFix.setAttribute("class", "clearFix");
    
    
    
    var editorInfo = createE("p");
    editorInfo.innerHTML = "Hier ";

    if(template === "template1")
    {
      vorschauContainer.setAttribute("class", "templateEinsVorschau " +anordnung);  
    }
    else if(template === "template2")
    {
      vorschauContainer.setAttribute("class", "templateZweiVorschau " +anordnung);  
    }
    else if(template === "template3")
    {
        vorschauContainer.setAttribute("class", "templateDreiVorschau " +anordnung);
    }


    switch(anordnung)
    {
        case "anordnung1":
            vorschauContainer.appendChild(bild1);
            vorschauContainer.appendChild(bild2);
            vorschauContainer.appendChild(bild3);
            vorschauContainer.appendChild(clearFix);
            vorschauContainer.appendChild(bild4);
            vorschauContainer.appendChild(albumText1);
            vorschauContainer.appendChild(bild5);
            vorschauContainer.appendChild(albumText2);
            vorschauContainer.appendChild(bild6);
            vorschauContainer.appendChild(albumText3);

            if(sessionStorage.getItem("modus") === "editieren")
            {   
                bild1.innerHTML = sessionStorage.getItem("bild1");
                bild2.innerHTML = sessionStorage.getItem("bild2");
                bild3.innerHTML = sessionStorage.getItem("bild3");
                bild4.innerHTML = sessionStorage.getItem("bild4");
                bild5.innerHTML = sessionStorage.getItem("bild5");
                bild6.innerHTML = sessionStorage.getItem("bild6");
                
                albumText1.innerHTML = sessionStorage.getItem("albumText1");
                albumText2.innerHTML = sessionStorage.getItem("albumText2");
                albumText3.innerHTML = sessionStorage.getItem("albumText3");
            }
            
            if(!sessionStorage.getItem("bild1"))
            {
                 bild1.innerHTML ="1#";
            }
            else
            {
                bild1.innerHTML = sessionStorage.getItem("bild1");
            }
            if(!sessionStorage.getItem("bild2"))
            {
                 bild2.innerHTML ="2#";
            }
            else
            {
                bild2.innerHTML = sessionStorage.getItem("bild2");
            }
            if(!sessionStorage.getItem("bild3"))
            {
                 bild3.innerHTML ="3#";
            }
            else
            {
                bild3.innerHTML = sessionStorage.getItem("bild3");
            }
            if(!sessionStorage.getItem("bild4"))
            {
                 bild4.innerHTML ="4#";
            }
            else
            {
                bild4.innerHTML = sessionStorage.getItem("bild4");
            }
            if(!sessionStorage.getItem("bild5"))
            {
                 bild5.innerHTML ="5#";
            }
            else
            {
                bild5.innerHTML = sessionStorage.getItem("bild5");
            }
            if(!sessionStorage.getItem("bild6"))
            {
                 bild6.innerHTML ="6#";
            }
            else
            {
                bild6.innerHTML = sessionStorage.getItem("bild6");
            }
            
            
            albumTextMaxBuchstaben[0] = 300;
            albumTextMaxBuchstaben[1] = 300;
            albumTextMaxBuchstaben[2] = 300;

            break;

        case "anordnung2":
            vorschauContainer.appendChild(bild1);
            vorschauContainer.appendChild(bild2);
            vorschauContainer.appendChild(albumText1);
            vorschauContainer.appendChild(bild3);
            vorschauContainer.appendChild(bild4);
            vorschauContainer.appendChild(albumText2);

            albumTextMaxBuchstaben[0] = 300;
            albumTextMaxBuchstaben[1] = 300;

            break;

        case "anordnung3":
            vorschauContainer.appendChild(bild1);
            vorschauContainer.appendChild(bild2);
            vorschauContainer.appendChild(albumText1);
            vorschauContainer.appendChild(albumText2);
            vorschauContainer.appendChild(bild3);

            albumTextMaxBuchstaben[0] = 600;
            albumTextMaxBuchstaben[1] = 200;

            break;
            
        case "anordnung4":
            vorschauContainer.appendChild(albumText1);
            vorschauContainer.appendChild(bild2);
            vorschauContainer.appendChild(albumText2);

            albumTextMaxBuchstaben[0] = 300;
            albumTextMaxBuchstaben[1] = 900;

            break;
            
        case "anordnung5":
            vorschauContainer.appendChild(bild1);
            vorschauContainer.appendChild(bild2);
            vorschauContainer.appendChild(bild3);
            vorschauContainer.appendChild(albumText1);
            vorschauContainer.appendChild(albumText2);

            albumTextMaxBuchstaben[0] = 300;
            albumTextMaxBuchstaben[1] = 150;

            break;
            
        case "anordnung6":
            vorschauContainer.appendChild(bild1);
            vorschauContainer.appendChild(bild2);
            vorschauContainer.appendChild(albumText1);
            vorschauContainer.appendChild(bild3);
            vorschauContainer.appendChild(bild4);

            albumTextMaxBuchstaben[0] = 300;

            break;
            
        case "anordnung7":
            vorschauContainer.appendChild(bild1);
            vorschauContainer.appendChild(albumText1);
            vorschauContainer.appendChild(bild2);
            vorschauContainer.appendChild(albumText2);
            vorschauContainer.appendChild(bild3);
            vorschauContainer.appendChild(albumText3);


            albumTextMaxBuchstaben[0] = 300;
            albumTextMaxBuchstaben[1] = 300;
            albumTextMaxBuchstaben[2] = 300;

            break;
            
        case "anordnung8":
            vorschauContainer.appendChild(bild1);
            vorschauContainer.appendChild(bild2);
            vorschauContainer.appendChild(bild3);
            vorschauContainer.appendChild(bild4);
            vorschauContainer.appendChild(albumText1);

            albumTextMaxBuchstaben[0] = 300;

            break;
            
        case "anordnung9":
            vorschauContainer.appendChild(bild1);
            vorschauContainer.appendChild(bild2);        
            vorschauContainer.appendChild(albumText1);
            vorschauContainer.appendChild(bild3);
            vorschauContainer.appendChild(bild4);
            vorschauContainer.appendChild(bild5);
            vorschauContainer.appendChild(bild6);
            vorschauContainer.appendChild(bild7);
            vorschauContainer.appendChild(bild8);

            albumTextMaxBuchstaben[0] = 600;
            break;
    }
}

function bildHinzufuegen(e)
{
    var srcID;
    
    if(e.target.getAttribute("id")!== null)
    {
        srcID = e.target.getAttribute("id");
    }
    else
    {
        srcID = e.target.parentNode.getAttribute("id");
    }
    
    console.log(srcID);
    var index = srcID.substr(4,1);
    console.log(index);
    var inputContainerFoto = $("inputContainerFoto");
    wechselSichtbarkeit("inputContainerFoto");
    
    var fotoForm = $("fotoForm");
    var fotoName = $("fotoName");
    var fotoFile = $("fotoFile");
    var fotoText = $("fotoText");
    var fotoSubmit = $("fotoSubmit");
    
    fotoForm.addEventListener("submit", function(e){
        e.preventDefault();

        var formData = new FormData();

        formData.append("file", fotoFile.files[0], fotoName.value);
        formData.append("fotoText", fotoText.value);
        formData.append("albumName", sessionStorage.getItem("albumName"));
        if(sessionStorage.getItem("modus") === "editieren")
        {
            formData.append("indexFoto", index);
        }
        xmlhttp.open("post", "elementHinzufuegen.php",true);
        xmlhttp.send(formData);


        xmlhttp.onreadystatechange = function() 
        {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
            {
                /* kleiner test der leider nicht klappt
                var bild = createE("img");
                bild.setAttribute("class", "vorschauBild");
                bild.setAttribute("src", xmlhttp.responseText);
                elementLeeren($(srcID));
                
               
                $(srcID).appendChild(bild);
                */
                $(srcID).innerHTML = xmlhttp.responseText;
                sessionStorage.setItem(srcID, xmlhttp.responseText);
                wechselSichtbarkeit("inputContainerFoto");

            }
        }
    }, false);
}
//index wird benötigt function textHinzufuegen(ursprung, index)
function textHinzufuegen(e)
{
    var srcID = e.target.getAttribute("id");
    var index = srcID.substr(9,1);
    
    
    
    var inputContainerAlbumText = $("inputContainerAlbumText");
    wechselSichtbarkeit("inputContainerAlbumText");
    
    var albumTextForm = $("albumTextForm");
    var albumText = $("albumText");
    var albumTextSubmit = $("albumTextSubmit");
    
    albumTextForm.addEventListener("submit", function(e){
        e.preventDefault();

        var formData = new FormData();
        formData.append("albumText", albumText.value);
        formData.append("albumName", sessionStorage.getItem("albumName"));
        
        if(sessionStorage.getItem("modus") === "editieren")
        {
            formData.append("indexAlbumText", index);
        }
        xmlhttp.open("post", "elementHinzufuegen.php", true);
        xmlhttp.send(formData);
        
        xmlhttp.onreadystatechange = function() 
        {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
            {
                sessionStorage.setItem("albumText"+index ,xmlhttp.responseText);
                $(srcID).innerHTML = xmlhttp.responseText;
                wechselSichtbarkeit("inputContainerAlbumText");
            }
        } 
    },false);
}
function speicherAlbum()
{
    var formData = new FormData();
    formData.append("albumName", sessionStorage.getItem("albumName"));
    formData.append("benutzerName", sessionStorage.getItem("benutzerName"));
    formData.append("template", sessionStorage.getItem("template"));
    formData.append("anordnung", sessionStorage.getItem("anordnung"));
    formData.append("albumText1", sessionStorage.getItem("albumText1"));
    formData.append("albumText2", sessionStorage.getItem("albumText2"));
    formData.append("albumText3", sessionStorage.getItem("albumText3"));
    formData.append("bild1", sessionStorage.getItem("bild1"));
    formData.append("bild2", sessionStorage.getItem("bild2"));
    formData.append("bild3", sessionStorage.getItem("bild3"));
    formData.append("bild4", sessionStorage.getItem("bild4"));
    formData.append("bild5", sessionStorage.getItem("bild5"));
    formData.append("bild6", sessionStorage.getItem("bild6"));
    formData.append("bild7", sessionStorage.getItem("bild7"));
    formData.append("bild8", sessionStorage.getItem("bild8"));
    xmlhttp.open("post", "starteXMLGenerator.php", true);
    xmlhttp.send(formData);
        
    xmlhttp.onreadystatechange = function() 
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            alert(xmlhttp.responseText);
            
            sessionStorage.removeItem("modus");
            sessionStorage.removeItem("template");
            sessionStorage.removeItem("anordnung");
            sessionStorage.removeItem("albumName");
            sessionStorage.removeItem("albumText1");
            sessionStorage.removeItem("albumText2");
            sessionStorage.removeItem("albumText3");
            sessionStorage.removeItem("bild1");
            sessionStorage.removeItem("bild2");
            sessionStorage.removeItem("bild3");
            sessionStorage.removeItem("bild4");
            sessionStorage.removeItem("bild5");
            sessionStorage.removeItem("bild6");
            sessionStorage.removeItem("bild7");
            sessionStorage.removeItem("bild8");
            //spaeter sessionStorage.removeItem("seite");

            window.location ="kanal.html";
        }
    }
    
    
    
}

