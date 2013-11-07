$(document).ready(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();

    $("#addFolder").click(function() {
      $("#sortable").append("<li class='ui-state-default'>" +
          "<ul id='inline'>" +
           "<li id='pictures'><img class='image' src='images/folder.png'></li>" +
           "<li id='name'>Folder</li>" +
           "<li id='time'>Time</li>" +
          "</ul>" +
         "</li>");
    });

    $("#addPDF").click(function() {
      $("#sortable").append("<li class='ui-state-default'>" +
          "<ul id='inline'>" +
           "<li id='pictures'><img class='image' src='images/pdf.jpg'></li>" +
           "<li id='name'>PDF</li>" +
           "<li id='time'>Time</li>" +
          "</ul>" +
         "</li>");
    });

    $("#addWord").click(function() {
      $("#sortable").append("<li class='ui-state-default'>" +
          "<ul id='inline'>" +
           "<li id='pictures'><img class='image' src='images/word.png'></li>" +
           "<li id='name'>Word</li>" +
           "<li id='time'>Time</li>" +
          "</ul>" +
         "</li>");
      });
});