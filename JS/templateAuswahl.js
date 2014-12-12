window.addEventListener("click", testClick, false);

function anordnungsAuswahl(auswahl){
                     

    sessionStorage.setItem("anordnung", auswahl);
    window.document.getElementById("templateWrapper").setAttribute("class", sessionStorage.getItem("anordnung"));
    erzeugeTemp();
}
                    
function starteEditor(template)
{
   sessionStorage.setItem("template", template);

   wechselSichtbarkeit("inputContainer");



   var albumNameForm = $("albumNameForm");

   albumNameForm.addEventListener("submit", function(e){
       e.preventDefault();

       var xmlhttp = new XMLHttpRequest();
       var formData = new FormData();
       formData.append("albumName", albumName.value);
       formData.append("template", sessionStorage.getItem("template"));
       formData.append("anordnung", sessionStorage.getItem("anordnung"));
       xmlhttp.open("post", "elementHinzufuegen.php", true);
       xmlhttp.send(formData);

       xmlhttp.onreadystatechange = function()
       {
           if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
           {
               if(xmlhttp.responseText == "erfolgreich")
               {
                   window.location="editor.html";
               }
               else
               {
                   alert("Leider gibt hast du schon ein Album mit diesem Namen bitte waehle einen anderen Namen");
               }
           }
       }
   }, false);

}

function testClick(e)
{
    var src = e.target;
}