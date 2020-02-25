function detect_enter(objEvent,callback){
    var iKeyCode;
    iKeyCode = objEvent.keyCode?objEvent.keyCode:(objEvent.which?objEvent.which:objEvent.charCode);
    if(iKeyCode==13){
        if(arguments[2]){
            callback(arguments[2]);
        }
        else{
            callback()
        }
    }
}