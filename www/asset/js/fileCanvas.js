$(function() 
  {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();

    $("#addFolder").click(function() {
        $("#sortable").append("<li class='ui-state-default'>" + 
                                "<ul id='inline'>" + 
                                    "<li id='pictures'><img class='image' src='/asset/img/folder.png'></li>" + 
                                    "<li id='name'>Folder</li>" + 
                                    "<li id='time'>Time</li>" + 
                                "</ul>" + 
                            "</li>");
    });

    $("#addPDF").click(function() {
        $("#sortable").append("<li class='ui-state-default'>" + 
                                "<ul id='inline'>" + 
                                    "<li id='pictures'><img class='image' src='/asset/img/pdf.jpg'></li>" + 
                                    "<li id='name'>PDF</li>" + 
                                    "<li id='time'>Time</li>" + 
                                "</ul>" + 
                            "</li>");
    });
    
    $("#addWord").click(function() {
        $("#sortable").append("<li class='ui-state-default'>" + 
                                "<ul id='inline'>" + 
                                    "<li id='pictures'><img class='image' src='/asset/img/word.png'></li>" + 
                                    "<li id='name'>Word</li>" + 
                                    "<li id='time'>Time</li>" + 
                                "</ul>" + 
                            "</li>");
    });
  }
);