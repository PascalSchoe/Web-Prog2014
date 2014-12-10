


/*
 * 
 * Testen welche Anordnung 
 *      Dementsprechend Inhalte mit DOM erzeugen und appenden(verschiedene Anzahl an Elementen)
 * Hier erzeugte Elemente müssen allen ERSTEN Kindern von Template Wrapper hinzugefügt werden !
 * Abfangen das nur einmal inhalt erzeugt wird !
 */
function erzeugeTemp()
{
    // Auswahl der Anordnung 
    var anordnung = sessionStorage.getItem("anordnung");

    var template1Content = $("template1Content");
    var template2Content = $("template2Content");
    var template3Content = $("template3Content");
   
    var bilder = new Array(8);
    
    for(i = 1; i <= bilder.length; i++)
    {
            bilder[i-1] = createE("img");      
            bilder[i-1].setAttribute("src", "res/img/beispielBilder/img"+ i+".jpg");
            bilder[i-1].setAttribute("class", "bild"+i);
    }
    
    var albumTexte = new Array(3);
    albumTexte[0] = createE("p");
    
    var t1 = document.createTextNode("Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore \n\
                    Atmagna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea\n\
                    takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor\n\
                    invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. \n\
                    Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.");
    albumTexte[0].setAttribute("class", "albumText1");
    albumTexte[0].appendChild(t1);
    
    albumTexte[1] = createE("p");
    
    var t2 = document.createTextNode("Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore \n\
                    Atmagna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea\n\
                    takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor\n\
                    invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. \n\
                    Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.");
    albumTexte[1].setAttribute("class", "albumText2");
    albumTexte[1].appendChild(t2);
    
    albumTexte[2] = createE("p");
    
    var t3 = document.createTextNode("Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore \n\
                    Atmagna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea\n\
                    takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor\n\
                    invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. \n\
                    Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.");
    albumTexte[2].setAttribute("class", "albumText3");
    albumTexte[2].appendChild(t3);

    switch(anordnung)
    {
        case "anordnung1":
            // 6 Bilder, 3 Album Texte( Div O  3 Bilder, Div links 3 Bilder, div rechts 3 Texte)
            appendElements(6,3);
            break;
        case "anordnung2":
            // 4 Bilder, 2 Texte(Div O 2 Bilder, Div darunter Text, mal 2)
            appendElements(4,2);
            break;
        case "anordnung3":
            // 3 Bilder, 2 Texte(Div O 2 Bilder,Div M Text, Div LU Text kleiner, Div RU Bild)
            appendElements(3,2);
            break;
        case "anordnung4":
            // 1 Bild, 2 Texte(div LO text,div RO Bild, div unten Text)
            appendElements(1,2);
            break;
        case "anordnung5":
            // 3 Bilder, 2 Texte(1 Div top, div unten mit bild und Text)
            appendElements(3,2);
            break;
        case "anordnung6":
            // 4 Bilder, 1 Text(immer 2 bilder pro row, dann text, dann 2 bilder)
            appendElements(4,1);
            break;
        case "anordnung7":
            // 3 Bilder, 3 Texte(Bilder immer im wechsel links und rechts 2 pro row)
            appendElements(3,3);
            break;
        case "anordnung8":
            // 4 Bilder, 1 Text(Bilder div oben, text drunter)
            appendElements(4,1);
            break;
        case "anordnung9":
            // 8 Bilder, 1 Text ( Bilder div links, Text div rechts)
            appendElements(8,1);
            break;

      

        function appendElements(imageIndex, textIndex)
        {
            //zu erst Container leeren
            elementLeeren(template1Content);
            elementLeeren(template2Content);
            elementLeeren(template3Content);
            
            for(i = 0; i < imageIndex; i++)
            {
                template1Content.appendChild(bilder[i].cloneNode(true));
                template2Content.appendChild(bilder[i].cloneNode(true));
                template3Content.appendChild(bilder[i].cloneNode(true));
            }
            for(i = 0; i < textIndex; i++)
            {
                template1Content.appendChild(albumTexte[i].cloneNode(true));
                template2Content.appendChild(albumTexte[i].cloneNode(true));
                template3Content.appendChild(albumTexte[i].cloneNode(true));
            }
            var clearFix = document.createElement("div");
            clearFix.setAttribute("class", "clearFix");
            template1Content.appendChild(clearFix.cloneNode(true));
            template2Content.appendChild(clearFix.cloneNode(true));
            template3Content.appendChild(clearFix.cloneNode(true));
        }
    }
}