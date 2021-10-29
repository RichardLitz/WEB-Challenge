$(document).ready(function ()
{
    $(".iframe").colorbox({iframe:true, innerWidth:"95%", innerHeight:"93%", opacity:0.5, overlayClose:true});

    $( "#fecha_janela").click(function() {
        parent.$.colorbox.close();
    });
});
