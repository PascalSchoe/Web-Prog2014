<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!Doctype html>
<html id="top">
    <head>
        <title>W&auml;hle deine Template</title>
        <link href='http://fonts.googleapis.com/css?family=Poiret+One|Indie+Flower|Playball|Audiowide' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="JS/hilfsFunktionen.js"></script>
        <script type="text/javascript" src="erzeugeTemplate.js"></script>
        <script type="text/javascript" src="JS/templateAuswahl.js"></script>
        <link  rel="stylesheet" type="text/css" href="CSS/main.css">
        <link  rel="stylesheet" type="text/css" href="CSS/buttons.css">
        
    </head>
    <body>
        <div id="sticky" ><a href="#top">Nach oben!</a></div>
        <p style="width: 50%; margin-left: 20%;margin-top: 3%; font-style: oblique">
            Hier kannst du entscheiden wie das Design deines Albums aussehen soll zu erst w&auml;hle bitte eine der folgenden Anordnungen von Bildern und Albumtexten.
            Dunkelgrau stellt die Bilder und hellgrau die Texte dar. Nachdem du eine Anordnung gew&auml;hlt hast siehst du unsere Templates die dir zur Verf&uuml;gung stehen
            mit deiner Anordnung, bitte suche dir hier eines der folgenden Templates aus, im Anschluss wirst du in den Editor weitergeleitet und du kannst dein Album erstellen.
            
            
          
        </p>
        
        <div id="anordnungBar">        
            <div class="anordnungsItem" onclick="anordnungsAuswahl('anordnung1')">
                        <img src="res/img/template1.png" alt="template1">
                    </div>
                    <div class="anordnungsItem" onclick="anordnungsAuswahl('anordnung2')">
                        <img src="res/img/template2.png" alt="template2">
                    </div>
                    <div class="anordnungsItem" onclick="anordnungsAuswahl('anordnung3')">
                        <img src="res/img/template3.png" alt="template3">
                    </div>
                    <div class="anordnungsItem" onclick="anordnungsAuswahl('anordnung4')">
                        <img src="res/img/template4.png" alt="template4">
                    </div>
                    <div class="anordnungsItem" onclick="anordnungsAuswahl('anordnung5')">
                        <img src="res/img/template5.png" alt="template5">
                    </div>
                    <div class="anordnungsItem" onclick="anordnungsAuswahl('anordnung6')">
                        <img src="res/img/template6.png" alt="template6">
                    </div>
                    <div class="anordnungsItem" onclick="anordnungsAuswahl('anordnung7')">
                        <img src="res/img/template7.png" alt="template7">
                    </div>
                    <div class="anordnungsItem" onclick="anordnungsAuswahl('anordnung8')">
                        <img src="res/img/template8.png" alt="template8">
                    </div>
                    <div class="anordnungsItem" onclick="anordnungsAuswahl('anordnung9')">
                        <img src="res/img/template9.png" alt="template9">
                    </div>
                    <div class="clearFix"></div>
        </div>
        
        <div id="templateWrapper">
            <div id="template1">
                <h1>Temp1</h1>
                <div class="info" >
                    <p >
                        Dieses Template zeichnet sich durch eine rustikales und zu gleich gem&uuml;tliches Erscheinungsbild aus.
                        Die Farben sind neutral gew&auml;hlt und fallen dennoch ins Auge.
                        blablablalblablablalblablablalblablablal blablablalblablablalblablablalblablablal
                        blablablalblablablalblablab lalblablablalblablablalb lablablalblablablalblablab lalblablablalblablablalblablablal
                        blablablalblablablalb lablablalblablablalblablablalblablab lalblablablalblablabla  lblablablalblablablalblablablal
                        blablablalb lablablalblablabla lblablablalblablablalblablabl alblablablalblablablal blablablalblablablalblablablal
                    </p>
                    <a onclick="starteEditor('template1')" class="button bestaetigen" href="#top">Ich will dieses Template</a>
                </div>

                <hr width="1" size="800" style="float: left">

                <div class="pageSample" id="template1Content">
                </div>
                <div class="clearFix"></div>
            </div>
            <div id="inputContainerTemplateAuswahl" class="versteckt">
                <fieldset>
                    <form action="elementHinzufuegen.php" method="post" id="albumNameForm">
                        <legend>Albumname</legend>
                        <p>
                            <label for="albumName">Bitte gib einen Albumnamen ein: </label>
                        </p>
                        <p>
                            <input type="text" name="albumName" id="albumName"autofocus>
                        </p>
                        <input type="submit" name="albumNameSub" value="abschicken">
                    </form>
                </fieldset>
            </div>
            <div id="template2" >
                <h1>Temp2</h1>
                <div class="info" >
                    <p >
                        Dieses Template zeichnet sich durch eine rustikales und zu gleich gem&uuml;tliches Erscheinungsbild aus.
                        Die Farben sind neutral gew&auml;hlt und fallen dennoch ins Auge.
                        blablablalblablablalblabla blalblablablalblablablalbla blablalblablablalblablablal
                        blablablalblablablalblablab lalblablablalblablablalb lablablalblablablalblablab lalblablablalblablablalblablablal
                        blablablalblablablalb lablablalblablablalblablablalblablab lalblablablalblablabla  lblablablalblablablalblablablal
                        blablablalb lablablalblablabla lblablablalblablablalblablabl alblablablalblablablal blablablalblablablalblablablal
                    </p>
                    <a onclick="starteEditor('template2')" class="button bestaetigen" href="#top">Ich will dieses Template</a>
                </div>

                <hr width="1" size="800" style="float: left">

                <div class="pageSample" id="template2Content">
                    
                </div>
                <div class="clearFix"></div>
            </div>
            <div id="template3" >
                <h1>Temp3</h1>
               <div class="info" >
                    <p >
                        Dieses Template zeichnet sich durch eine rustikales und zu gleich gem&uuml;tliches Erscheinungsbild aus.
                        Die Farben sind neutral gew&auml;hlt und fallen dennoch ins Auge.
                        blablablalblablablalblablab lalblablablalblablablalb lablablalblablablalblablab lalblablablalblablablalblablablal
                        blablablalblablablalb lablablalblablablalblablablalblablab lalblablablalblablabla  lblablablalblablablalblablablal
                        blablablalb lablablalblablabla lblablablalblablablalblablabl alblablablalblablablal blablablalblablablalblablablal
                    </p>
                   <a onclick="starteEditor('template3')" class="button bestaetigen" href="#top">Ich will dieses Template</a>
                </div>

                <hr width="1" size="800" style="float: left">

                <div class="pageSample" id="template3Content">
                </div>
                <div class="clearFix"></div>
            </div>
        </div>
    </body>
</html>

