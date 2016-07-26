/**
 * Created by Alex on 08/08/2015.
 */

function EditReport(){
    document.getElementById("date").readOnly = false;
    document.getElementById("dateic").readOnly = false;
    document.getElementById("location").readOnly = false;
    document.getElementById("info").readOnly = false;
    document.getElementById("date").removeAttribute('readonly');
    document.getElementById("dateic").removeAttribute('readonly');
    document.getElementById("location").removeAttribute('readonly');
    document.getElementById("info").removeAttribute('readonly');
};