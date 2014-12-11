/*
 * In diesem Script wird auf den SessionStorage zugegriffen und ausgelesen welches Template und welche Anordnung gewählt wurden,
 * entsprechend der getroffenen Auswahl wird die Vorschau des Albums generiert. Jedes Element wird mit einem Onclick-Listener versehen,
 * bei Klick auf eines dieser Elemente erscheint ein Popup welches den Inhalt der eingefügt werden soll abfragt, eingegebene Inhalte
 * werden an ein Php script geschickt und auf der Seite als Vorschau gezeigt sowie als Xml auf dem Server hinterlegt
 */
var xmlhttp = new XMLHttpRequest();

var template = sessionStorage.getItem("template");
var anordnung = sessionStorage.getItem("anordnung");
var vorschauContainer = $("vorschau");


//Erzeugen aller DomObjekte
var bild1,bild2,bild3,bild4,bild5,bild6,bild7,bild8;
var albumText1,albumText2,albumText3;

var albumTextMaxBuchstaben = new Array(3);



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
bild1.setAttribute("onclick","bildHinzufuegen('bild1')");

bild2.setAttribute("id","bild2");
bild2.setAttribute("class","bild2");
bild2.setAttribute("onclick","bildHinzufuegen('bild2')");

bild3.setAttribute("id","bild3");
bild3.setAttribute("class","bild3");
bild3.setAttribute("onclick","bildHinzufuegen('bild3')");

bild4.setAttribute("id","bild4");
bild4.setAttribute("class","bild4");
bild4.setAttribute("onclick","bildHinzufuegen('bild4')");

bild5.setAttribute("id","bild5");
bild5.setAttribute("class","bild5");
bild5.setAttribute("onclick","bildHinzufuegen('bild5')");

bild6.setAttribute("id","bild6");
bild6.setAttribute("class","bild6");
bild6.setAttribute("onclick","bildHinzufuegen('bild6')");

bild7.setAttribute("id","bild7");
bild7.setAttribute("class","bild7");
bild7.setAttribute("onclick","bildHinzufuegen('bild7')");

bild8.setAttribute("id","bild8");
bild8.setAttribute("class","bild");
bild8.setAttribute("onclick","bildHinzufuegen('bild8')");


//Albumtexte
albumText1.setAttribute("id","albumText1");
albumText1.setAttribute("class","albumText1");
albumText1.setAttribute("onclick","textHinzufuegen('albumText1',0)");

albumText2.setAttribute("id","albumText2");
albumText2.setAttribute("class","albumText2");
albumText2.setAttribute("onclick","textHinzufuegen('albumText2',1)");

albumText3.setAttribute("id","albumText3");
albumText3.setAttribute("class","albumText3");
albumText3.setAttribute("onclick","textHinzufuegen('albumText3',2)");


//Sonstiges
var clearFix = createE("div");
clearFix.setAttribute("class", "clearFix");

var inputContainer = createE("div");
inputContainer.setAttribute("id", "inputContainer");
inputContainer.setAttribute("class", "versteckt");

var fotoForm = createE("form");
fotoForm.setAttribute("id", "fotoForm");
fotoForm.setAttribute("name", "fotoForm");
fotoForm.setAttribute("action","elementHinzufuegen.php");
fotoForm.setAttribute("method","post");
fotoForm.setAttribute("enctype","multipart/form-data");
   
var textForm = createE("form");
textForm.setAttribute("id", "textForm");
textForm.setAttribute("name", "textForm");
textForm.setAttribute("action","elementHinzufuegen.php");
textForm.setAttribute("method","post");


        
var input = createE("input");
input.setAttribute("id", "fotoInput");
input.setAttribute("name", "fotoInput");


var textArea = createE("textarea");
textArea.setAttribute("name", "albumTextInput");
textArea.setAttribute("id", "albumTextInput");

var fotoText = createE("textarea");
fotoText.setAttribute("maxlength", "250");
fotoText.setAttribute("name", "fotoText");

var submit = createE("button");
submit.setAttribute("type", "submit");
submit.setAttribute("id", "hinzufuegen");


var fieldset = createE("fieldset");
var legend = createE("legend");
var albumTextLabel = createE("label");
albumTextLabel.setAttribute("for", "albumTextInput");

var fotoFileLabel = createE("label");
fotoFileLabel.setAttribute("for", "fotoInput");
fotoFileLabel.setAttribute("id","fotoFileLabel");

var fotoTextLabel = createE("label");
fotoTextLabel.setAttribute("for", "fotoText");
fotoTextLabel.setAttribute("id", "fotoTextLabel");

var fotoTitleLabel = createE("label");
fotoTitleLabel.setAttribute("for", "fotoTitleInput");

var p1Tag = createE("p");
var p2Tag = createE("p");
var p3Tag = createE("p");

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
else
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
        
        albumTextMaxBuchstaben[0] = 300;
        albumTextMaxBuchstaben[1] = 300;
        albumTextMaxBuchstaben[2] = 300;
        
        vorschauContainer.appendChild(inputContainer);
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





function bildHinzufuegen(ursprung)
{
    elementLeeren(fieldset);
    elementLeeren(p1Tag);
    elementLeeren(p2Tag);
    elementLeeren(p3Tag);
    
    
    submit.innerHTML = "fertig";
    fotoFileLabel.innerHTML= "W&auml;hle ein Foto: ";
    fotoTextLabel.innerHTML= "Fototext(optional): ";
    legend.innerHTML="Bild hochladen...";
    
    fotoText.setAttribute("rows", "4");
    fotoText.setAttribute("cols", "50");
    
    //inputContainer.setAttribute("class", "sichtbar");
    wechselSichtbarkeit("inputContainer");
    input.setAttribute("type", "file");
    
    fieldset.appendChild(legend);
    p1Tag.appendChild(fotoFileLabel);
    p1Tag.appendChild(input);
    fieldset.appendChild(p1Tag);
    
    p2Tag.appendChild(fotoTextLabel);
    fieldset.appendChild(p2Tag);
    
    p3Tag.appendChild(fotoText);
    fieldset.appendChild(p3Tag);
    
    fieldset.appendChild(submit);
    fotoForm.appendChild(fieldset);
    inputContainer.appendChild(fotoForm);
    
    
    
    fotoForm.addEventListener("submit", function(e){
        e.preventDefault();

        var formData = new FormData();
        
        //Testen ob das auslösende Submit vom Image hochladen oder text Hochladen herrührt 
        
            formData.append("file", fotoInput.files[0]);
            //formData.append("fotoText", fotoText.value);
            
            //var xmlhttp = new XMLHttpRequest();

            xmlhttp.open("post", "elementHinzufuegen.php",true);
            xmlhttp.send(formData);


            xmlhttp.onreadystatechange = function() 
            {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
                    {
                       
                        $(ursprung).innerHTML = xmlhttp.responseText;
                        inputContainer.setAttribute("class", "versteckt");
                        
                    }
            }        
       
        
    }, false);
    
}
function textHinzufuegen(ursprung, index)
{
    elementLeeren(fieldset);
    
    elementLeeren(p1Tag);
    elementLeeren(p2Tag);
    elementLeeren(p3Tag);
    
    wechselSichtbarkeit("inputContainer");
    
    submit.innerHTML = "fertig";
    
    legend.innerHTML = "Mach bitte deine Eingabe:";
    albumTextLabel.innerHTML= "Text fuer " + ursprung +"(max "+ albumTextMaxBuchstaben[index] +" Buchstaben): ";
    textArea.setAttribute("maxlength", albumTextMaxBuchstaben[index]);
    textArea.setAttribute("rows", "4");
    textArea.setAttribute("cols", "50");
    
    fieldset.appendChild(legend);
    p1Tag.appendChild(albumTextLabel);
    p1Tag.appendChild(textArea);
    
    fieldset.appendChild(p1Tag);
 
 
    fieldset.appendChild(submit);
    textForm.appendChild(fieldset);
    inputContainer.appendChild(textForm);
    
    
    //eventlistener
    textForm.addEventListener("submit", function(e){
        e.preventDefault();

        var formData = new FormData();
        formData.append("albumText", textArea.value);

            

            xmlhttp.open("post", "elementHinzufuegen.php", true);
            xmlhttp.send(formData);

            xmlhttp.onreadystatechange = function() 
            {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
                    {
                        $(ursprung).innerHTML = xmlhttp.responseText;
                        inputContainer.setAttribute("class", "versteckt");
                        
                    }
            } 
        }, false);
    /*
    vorschauContainer.setAttribute("onclick", toggleSichtbarkeit(this));
function toggleSichtbarkeit(){
    if(this === $(inputContainer))
    {
        inputContainer.setAttribute("class", "sichtbar");
    }
    else
    {
        inputContainer.setAttribute("class", "versteckt");
    }
    }
    */

}