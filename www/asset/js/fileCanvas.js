$(document).ready(function() {

  var filelist = $("#file-list ul");

  //filelist.sortable();
  //filelist.disableSelection();

  function sortFilelistHTML(key, order){
    var fileArray = [];
    var folderArray = [];
    var sorted_html_code = "";
    function geneareHTMLlist(objArray){
      ret = ""
      for (var i=0; i<objArray.length; i++)
        ret += '<li class="'+ objArray[i].type +'">' + objArray[i].obj.html() + '</li>';
      return ret;
    }

    // Start iterating through each file and put it's details into an array.
    filelist.find("li").each(function(){
      var that = $(this)

      if (that.attr("class") == "type-folder") {
        folderArray.push({
          name: that.find(".name").html(),
          type: that.attr("class"),
          dateModified: that.find(".date-modified").html(),
          obj: that
        });
      } else{
        fileArray.push({
          name: that.find(".name").html(),
          type: that.attr("class"),
          dateModified: that.find(".date-modified").html(),
          obj: that
        });
      }
    });

    function compare_name(a,b) {
      if(a.name < b.name)
         return -1;
      if(a.name > b.name)
         return 1;
      return 0;
    }

    fileArray.sort(compare_name);
    folderArray.sort(compare_name);

    if (order == -1) {
      fileArray.reverse();
      folderArray.reverse();
    }
    // Generate the HTML code for the new sorted list.
    sorted_html_code = geneareHTMLlist(folderArray) + geneareHTMLlist(fileArray);

    // replace the old HTML with the sorted HTML code.
    filelist.html(sorted_html_code);
  }

  sortFilelistHTML('name');

  // If the "Create Folder" button was pressed, add a new folder
  $("#newF-button").click(function() {
      filelist.append('<li class="type-folder">\
          <div class="name">New Folder</div>\
          <div class="icon share-link">&#xf14c;</div>\
          <div class="icon delete-link">&#xf00d;</div>\
          <div class="icon info-link">&#xf129;</div>\
          <div class="filetype">Folder</div>\
          <div class="date-modified">Just Now</div>\
        </li>');
      sortFilelistHTML('name');
  });

  // If the "Upload" button was pressed, add a new file
  $("#upload-button").click(function() {
      filelist.append('<li class="type-file">\
          <div class="name">New File</div>\
          <div class="icon share-link">&#xf14c;</div>\
          <div class="icon delete-link">&#xf00d;</div>\
          <div class="icon info-link">&#xf129;</div>\
          <div class="filetype">File</div>\
          <div class="date-modified">Just Now</div>\
        </li>');
      sortFilelistHTML('name');
  });
});