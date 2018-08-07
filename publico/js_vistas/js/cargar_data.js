   $('#DIVcargas_general').dialog({
       autoOpen: false,
       hide: 'drop',
       width: 360,
       height: 80,
       closeOnEscape: true,
       open: function (event, ui) {
           $(".ui-dialog-titlebar-close").hide();
       },
       modal: true
   });
   $('#DIVcargas_general').dialog({
       draggable: false
   });
   $('#DIVcargas_general').dialog({
       resizable: false
   });