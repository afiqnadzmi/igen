//Load jQuery First
//How frequently to check for session expiration in milliseconds
var sess_pollInterval = 60000;
//How many minutes the session is valid for
var sess_expirationMinutes = 20;
//How many minutes before the warning prompt
var sess_warningMinutes = 15;

var sess_intervalID;
var sess_lastActivity;

function initSessionMonitor() {
    sess_lastActivity = new Date();
    sessSetInterval();
    $(document).bind('keypress.session', function (ed, e) { sessKeyPressed(ed, e); });
}
function sessSetInterval() {
    sess_intervalID = setInterval('sessInterval()', sess_pollInterval);
}
function sessClearInterval() {
    clearInterval(sess_intervalID);
}
function sessKeyPressed(ed, e) {
    sess_lastActivity = new Date();
}
function sessPingServer() {
    //Call an AJAX function to keep-alive your session.
    someAJAXFunction();
}
function sessLogOut() {
    window.location.href = '/Account/LogOff';
}

function sessInterval() {
    var now = new Date();
    var diff = now - sess_lastActivity;
    var diffMins = (diff / 1000 / 60);

    if (diffMins >= sess_warningMinutes) {
        //wran before expiring
        //stop the timer
        sessClearInterval();
        //promt for attention
        if (confirm('Your session will expire in ' + (sess_expirationMinutes - sess_warningMinutes) +
            ' minutes (as of ' + now.toTimeString() + '), press OK to remain logged in ' +
            'or press Cancel to log off. \nIf you are logged off any changes will be lost.')) {
            now = new Date();
            diff = now - sess_lastActivity;
            diffMins = (diff / 1000 / 60);

            if (diffMins > sess_expirationMinutes) {
                //timed out
                sessLogOut();
            }
            else {
                //reset inactivity timer
                sessPingServer();
                sessSetInterval();
                sess_lastActivity = new Date();
            }
        } else {
            sessLogOut();
        }
    } else {
        sessPingServer();
    }
}