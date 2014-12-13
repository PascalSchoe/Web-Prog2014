window.addEventListener("load", function(){
    var xmlhttp = new XMLHttpRequest();

    var passwortForm = $("passwortForm");
    var passwortAlt = $("passwortAlt");
    var passwortNeu = $("passwortNeu");

    passwortForm.addEventListener("submit", function(e){
           e.preventDefault();

           var formData = new FormData();

            formData.append("passwortAlt", passwortAlt.value);
            formData.append("passwortNeu", passwortNeu.value);

            xmlhttp.open("post", "passwortAendern.php",true);
            xmlhttp.send(formData);


            xmlhttp.onreadystatechange = function() 
            {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
                    {
                       alert(xmlhttp.responseText);
                       window.location = "kanal.html";
                    }
            }
    }, false);

});
