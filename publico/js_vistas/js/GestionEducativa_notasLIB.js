$('#DIVcargas').dialog({
    autoOpen: false,
    hide: 'drop',
    width: 360,
    height: 80,
    closeOnEscape: false,
    open: function (event, ui) {
        $(".ui-dialog-titlebar-close").hide();
    },
    modal: true
});
$('#DIVcargas').dialog({
    draggable: false
});
$('#DIVcargas').dialog({
    resizable: false
});