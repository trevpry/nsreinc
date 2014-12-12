'use strict';

var dialog;

function initDialog(element, height, width){
    console.log(height);
    dialog = element.dialog({

        autoOpen: false,
        height: (height != undefined) ? height : 200,
        width: (width != undefined) ? width : 350,
        modal: true,
        close: function(){
            //dialog.find( "form" ).reset();
            //dialog.find("form").trigger("reset");
            $(this).dialog("close");
        }
    });

    return dialog;
}