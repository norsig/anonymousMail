 <?php session_start(); ?>    
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Disposable Email</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.5/material.cyan-light_blue.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
    #read {
      background-color : #f4f4f4;
    }
    /*#view-source {
      position: fixed;
      display: block;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }*/
    .hiddenContent{
      display :none;
    }
    
    td,#emailId{
      overflow:hidden;
      word-wrap: break-word;
    }
    
    </style>
        
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68450533-1', 'auto');
  ga('send', 'pageview');
</script>

<script type="text/javascript" src="./jquery-1.11.3.min.js"></script>
<script type="text/javascript">
  var eMail = "";
  
  
    function getNewMail(){
          //$.removeCookie("PHPSESSID");
          //document.cookie = "PHPSESSID=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
          document.location = 'destroy.php';
        }            
    
    $(document).ready(function(){
       //console.log(document.cookie);
        function getMail(){
           $.get( 
                "./../rest/getEmail/", 
                  function( data ) {
                   // console.log(data["Email"]);
                    $("#emailId").html(data["Email"]);
                    eMail = data["Email"];
                    //console.log(eMail);
                    //alert( "Load was performed." );
                    fetchEmails();
                                });     
                    }
       
        
        function fetchEmails(){
            //console.log(eMail);
            $.post(
                "./../rest/getMails/",
                 {
                    email: eMail
                },
            function(data,status){
               console.log(data);
                $(jQuery.parseJSON(
                    JSON.stringify(data)))
                    .each(function() {  
                        var mailData = "<td>"+this["id"]+"</td>";
                        mailData +=    "<td class='mdl-data-table__cell--non-numeric'>"+this["sender"]+"</td>";
                        mailData +=    "<td class='mdl-data-table__cell--non-numeric'>"+this["emailId"]+"</td>";
                        mailData +=    "<td class='mdl-data-table__cell--non-numeric'>"+this["subject"]+"</td>";
                        mailData +=    "<td class='mdl-data-table__cell--non-numeric'>"+this["receivedTime"]+"</td>";
                        mailData +=    "<td class='hiddenContent'>"+this["content"]+"</td>";
                        if(this["viewed"] == 0){mailData = "<tr id='read'>"+mailData+"</tr>";}
                        else {mailData = "<tr>"+mailData+"</tr>";}
                        
                        $('#emailData').append(mailData);
                        mailData="";
                        /*
                        $('#emailData').append('<tr><td>'+this["id"]+'</td><td class="mdl-data-table__cell--non-numeric">'+this["sender"]+'</td><td class="mdl-data-table__cell--non-numeric">'+this["emailId"]+'</td><td class="mdl-data-table__cell--non-numeric">'+this["subject"]+'</td><td class="mdl-data-table__cell--non-numeric">'+this["receivedTime"]+'</td><td class="mdl-data-table__cell--non-numeric">'+this["viewed"]+'</td></tr>');*/
                        
});
                
                 
                    //console.log("Data: " + data + "\nStatus: " + status);
                });
         }
        getMail();
        
    });
</script>
    </head>
    <body>
   
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--white mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">Alternate Mail.com</span>
          <div class="mdl-layout-spacer"></div>
          <!--<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
              <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
              <input class="mdl-textfield__input" type="text" id="search">
              <label class="mdl-textfield__label" for="search">Enter your query...</label>
            </div>
          </div>-->
          <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored mdl-color-text--white" onclick="getNewMail()">NEW Email</a>
          <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="refresh" onclick="location.reload(true);">
            <i class="material-icons" >refresh</i>
          </button>
          <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
            <i class="material-icons">more_vert</i>
          </button>
          <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
            <li class="mdl-menu__item">About</li>
            <li class="mdl-menu__item">Contact</li>
            <li class="mdl-menu__item">Legal information</li>
          </ul>
        </div>
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          <img src="images/user.jpg" class="demo-avatar">
          <div class="demo-avatar-dropdown">
            <span id="emailId">hello@example.com</span>
            <div class="mdl-layout-spacer"></div>
            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
              <i class="material-icons" role="presentation">arrow_drop_down</i>
              <span class="visuallyhidden">Accounts</span>
            </button>
            <!--<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
              <li class="mdl-menu__item">hello@example.com</li>
              <li class="mdl-menu__item">info@example.com</li>
              <li class="mdl-menu__item"><i class="material-icons">add</i>Add another account...</li>
            </ul>-->
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
          <a class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home</a>
          
          <div class="mdl-layout-spacer"></div>
          <a class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Help</span></a>
        </nav>
      </div>
      <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
        <table class="mdl-data-table mdl-js-data-table mdl-data-table mdl-shadow--2dp mdl-cell--12-col mdl-cell--8-col-tablet" id="emailData">
          <thead>
            <tr>
              <th >No.</th>
              <th class="mdl-data-table__cell--non-numeric">Sender</th>
              <th class="mdl-data-table__cell--non-numeric">Date</th>
              <th class="mdl-data-table__cell--non-numeric">Subject</th>
              <th class="mdl-data-table__cell--non-numeric">Received at</th>
              <!--<th class="mdl-data-table__cell--non-numeric">Read</th>-->
            </tr>
          </thead>
          <tbody>
          <!--<tr>
            <td >1</td>
            <td class="mdl-data-table__cell--non-numeric">sender@testMail.com</td>
            <td class="mdl-data-table__cell--non-numeric">13th October 2015</td>
            <td class="mdl-data-table__cell--non-numeric">Test Email</td>  	
            <td class="mdl-data-table__cell--non-numeric">2015-10-25 11:15:46</td> 
            <td class="mdl-data-table__cell--non-numeric">1</td> 
          </tr>
          <tr>
            <td >2</td>
            <td class="mdl-data-table__cell--non-numeric">sender@testMail.com</td>
            <td class="mdl-data-table__cell--non-numeric">13th October 2015</td>
            <td class="mdl-data-table__cell--non-numeric">Test Email</td>
            <td class="mdl-data-table__cell--non-numeric">2015-10-25 11:15:46</td> 
            <td class="mdl-data-table__cell--non-numeric">1</td> 
          </tr>
          <tr>
            <td >3</td>
            <td class="mdl-data-table__cell--non-numeric">sender@testMail.com</td>
            <td class="mdl-data-table__cell--non-numeric">13th October 2015</td>
            <td class="mdl-data-table__cell--non-numeric">Test Email</td>
            <td class="mdl-data-table__cell--non-numeric">2015-10-25 11:15:46</td> 
            <td class="mdl-data-table__cell--non-numeric">1</td> 
          </tr>
          <tr>
            <td >4</td>
            <td class="mdl-data-table__cell--non-numeric">sender@testMail.com</td>
            <td class="mdl-data-table__cell--non-numeric">13th October 2015</td>
            <td class="mdl-data-table__cell--non-numeric">Test Email</td>
            <td class="mdl-data-table__cell--non-numeric">2015-10-25 11:15:46</td> 
            <td class="mdl-data-table__cell--non-numeric">1</td> 
            <td class="mailBody" style="display:none">Content here </td>
          </tr>-->
        </tbody>
      </table>
        </div>
      </main>
    </div>
     
    <script src="./material.min.js"></script>
    </body>
</html>