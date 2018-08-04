$('#DIVcargas_general').dialog({
    autoOpen: false,
    hide: 'drop',
    width: 350,
    height: 120,
    closeOnEscape: false,
    open: function (event, ui) {
        $(".ui-dialog-titlebar-close").hide();
    },
    modal: true,
    buttons: {

    }
});
$('#DIVcargas_general').dialog({
    draggable: false
});
$('#DIVcargas_general').dialog({
    resizable: false
});