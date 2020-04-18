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
    if(document.getElementById("citizenid").value.length === 0){
        $("#alertbox").html('<div class="alert alert-warning" role="alert">Please enter a value into the Citizen ID Box!</div>');
        return false;
    }
    $("#alertbox").html("");
    $("#mainpanel").html("<div class='alert alert-info'><span class=\'glyphicon glyphicon-refresh glyphicon-refresh-animate\'></span>   Searching<br></div>");
    $("#mainpanel").load("ajaxpage.php?action=searchcitizenid&id="+input);
}

function SearchCitizenName(input) {
        if(document.getElementById("citizenname").value.length === 0){
        $("#alertbox").html('<div class="alert alert-warning" role="alert">Please enter a value into the Citizen Name Box!</div>');
        return false;
    }
    $("#alertbox").html("");
    $("#mainpanel").html("<div class='alert alert-info'><span class=\'glyphicon glyphicon-refresh glyphicon-refresh-animate\'></span>   Searching<br></div>");
    $("#mainpanel").load("ajaxpage.php?action=searchcitizenname&name="+input);
}

function Edit(input) {
    $("#mainpanel").html("<div class='alert alert-info'><span class=\'glyphicon glyphicon-refresh glyphicon-refresh-animate\'></span>   Loading Citizen Data<br></div>");
    $("#mainpanel").load("ajaxpage.php?action=editcitizen&id="+input);
}

function DeletePoint(input,input2) {
    $("#mainpanel").html("<div class='alert alert-info'><span class=\'glyphicon glyphicon-refresh glyphicon-refresh-animate\'></span>   Processing Citizen Data<br></div>");
    $("#mainpanel").load("ajaxpage.php?action=deletepoint&cid="+input+"&pid="+input2);
}
function UpdateData(input) {
    
    var formDataSerialized = $("#CharData").serialize()
    $("#mainpanel").html("<div class='alert alert-info'><span class=\'glyphicon glyphicon-refresh glyphicon-refresh-animate\'></span>   Processing Citizen Data<br></div>");
    $("#mainpanel").load("ajaxpage.php", formDataSerialized);
}
function AddPoint(input) {
    
    var reason = document.getElementById('reason').value
    var points = document.getElementById('points').value
    var formDataSerialized = $("#addpoint").serialize()
    $("#mainpanel").html("<div class='alert alert-info'><span class=\'glyphicon glyphicon-refresh glyphicon-refresh-animate\'></span>   Processing Citizen Data<br></div>");
    $("#mainpanel").load("ajaxpage.php", formDataSerialized);
}