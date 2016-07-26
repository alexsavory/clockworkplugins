function LoadPage(action) {

    $("#mainpanel").html("<div class='alert alert-info'><span class=\'glyphicon glyphicon-refresh glyphicon-refresh-animate\'></span>   Loading "+action+"<br> This may take some time due to the amount of data.</div>");

    switch(action) {
        case "Resident":
            $("#mainpanel").css("overflow","scroll");
            $("#mainpanel").css("max-height","500px");
            $("#mainpanel").load("ajaxpage.php?action=search");
            break;
        case "Leaders":
            $("#mainpanel").css("overflow","");
            $("#mainpanel").css("max-height","");
            $("#mainpanel").load("ajaxpage.php?action=leaders");
            break;
        case "CityAdmin":
            $("#mainpanel").load("ajaxpage.php?action=cityadmin");
            break;
        default:
            $("#mainpanel").load("ajaxpage.php?action=error");
    }

}

function SearchCitizenID(input) {
    $("#mainpanel").html("<div class='alert alert-info'><span class=\'glyphicon glyphicon-refresh glyphicon-refresh-animate\'></span>   Searching<br></div>");
    $("#mainpanel").load("ajaxpage.php?action=searchcitizenid&id="+input);
}

function SearchCitizenName(input) {
    $("#mainpanel").html("<div class='alert alert-info'><span class=\'glyphicon glyphicon-refresh glyphicon-refresh-animate\'></span>   Searching<br></div>");
    $("#mainpanel").load("ajaxpage.php?action=searchcitizenname&name="+input);
}