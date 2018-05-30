$(function() {

  /* ChartJs */
  if ( $( "#dashboard-stat .myChart" ).length )
  {
      var selectedValue = $('#dashboard-stat .select-input').find(":selected").val();
      var canvas = jQuery(".myChart");
      var type;
      var data;
      var option;
/*
      if( selectedValue == 'popular_contents' ) {
        type = "type: 'bar'";
        data = "data: {
                  labels: ["Course #1", "Trainning #1", "Trainning #2", "Course #3", "Video #1"],
                  datasets: [
                    {
                      label: "Number of views",
                      backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                      data: [2478,5267,734,784,433]
                    }
                  ]
                }";
        option = "options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: { display: false },
          title: {
            display: false
          }
        }";
      } else if ( selectValue == 'visits_evolution') {
      } */
      var chart = new Chart(canvas, {
        type: 'bar',
        data: {
          labels: ["Course #1", "Trainning #1", "Trainning #2", "Course #3", "Video #1"],
          datasets: [
            {
              label: "Number of views",
              backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
              data: [2478,5267,734,784,433]
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: { display: false },
          title: {
            display: false
          }
        }
      });
  }

  /* Hambuger nav */
  $("#icon-expand-nav").click(function() {
      var x = $( "#myTopnav" );
      if (x.hasClass("topnav")) {
          x.addClass("responsive");
      } else {
          x.addClass("topnav");
      }
  });

  /* Home slider */
  if ( $( "#slider" ).length )
  {
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
      showDivs(slideIndex += n);
    }

    function showDivs(n) {
      var i;
      var x = $(".mySlides");
      if (n > x.length) {slideIndex = 1}
      if (n < 1) {slideIndex = x.length}
      for (i = 0; i < x.length; i++) {
         x[i].style.display = "none";
      }
      x[slideIndex-1].style.display = "block";
    }

    $("#slider-left").click(function() {
      plusDivs(-1);
    });

    $("#slider-right").click(function() {
      plusDivs(1);
    });
  }

  /* Expandable div */
  $(document).on('click', '.expand-div', function(){
    var childIcon = $(this).find('i');
    if(childIcon.hasClass('fa-chevron-down') )
    {
      childIcon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
    } else {
      childIcon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
    }
    var hiddenContent = $(this).next('.content-hidden').toggle('fast');
  });



  // Ajax call for load table
  if( $("#pagination_data").length ) {
    var limit = $( ".pagination_selector option:selected" ).val();
    var page = 1;
    load_data_table(page, limit, 'init');
  }

  $(document).on('click', '.table-data #pagination_links span', function() {
    var limit = $( ".pagination_selector option:selected" ).val();
    var page = $(this).attr("id");
    load_data_table(page, limit, 'init');
  });

  $(document).on('click', '.column_sort', function() {
    var column_name = $(this).attr("id");
    var order = $(this).attr("data-order");
    load_data_table(page, limit, 'sort', order, column_name);
  });

  $(document).on('change', '.pagination_selector', function() {
    var limit = $( ".pagination_selector option:selected" ).val();
    var page = 1;
    load_data_table(page, limit,'init');
  });

  $(document).on('input', '.table-data .row-tools input', function() {
    var limit = $( ".pagination_selector option:selected" ).val();
    var page = 1;
    load_data_table(page, limit,'search');
  });

  /* get trainning id and name for select */
  if( $(".select-formation").length > 0 ) {
    select = $(".select-formation");
    getIdAndNameObject("trainning", select);
  }

  // FRONT
  if( $(".list-data").length > 0 ) {
    var page = 1;
    var object = $.trim($(".list-init-object span:first-child").text());
    load_data_list_card(page, 'init','desc', 'dateInserted', object);
  }

  $(document).on('click', '.list-data #pagination_links span', function() {
    var page = $(this).attr("id");
    var object = $.trim($(".list-init-object span:first-child").text());
    load_data_list_card(page, 'init','desc', 'dateInserted', object);
  });

});

function load_data_list_card(page, action, order='desc', column_name, object){
  objects = object + 's';
  url = dirname + "ajax/list?object=" + object + "&page=" + page + "&sort=" + order + "&columnName=" + column_name;

  div = $("#data-list");
  paginationLinks = $("#pagination_links");

  linkObjectView = $.trim($(".list-init-object span:last-child").text());

  $.ajax({
    url: url,
    success:function(data) {
      data = JSON.parse(data);
      var html = '';
      if( data[objects].length > 0) {
        $.each(data[objects], function(index, element) {
            html += "<div class='M2 X12'>"
            html += " <a href='" + linkObjectView + "?id=" + element.id + "' class='card'>";
            html += "  <div class='card-image'>";
            if( element.image != null ) {
              html += "  <image src='" + dirname + element.image + "' alt='" + element.title + "'>";
            } else {
              html += "  <image src='" + dirname + "public/img/default.jpg' alt='" + element.title + "'>";
            }
            html += "  </div>";
            html += "  <div class='card-separation'></div>";
            html += "  <div class='card-content'>";
            html += "    <p class='card-content-title'>" + element.title + "</p>";
            html += "    <p class='card-content-author'>" + element.author + "</p>";
            html += "  </div>";
            html += " </a>";
            html += " </div>";
        });
      } else {
        html = "No content";
      }
      div.html(html);

      html = "<input type='button' class='button' value='Previous' id='but_prev'/>";
      for(var i = 1; i<= data["pagination"].pagesNumber; i++){
        html += "<span style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='"+i+"'>" + i + "</span>";
      }
      html += "<input type='button' class='button' value='Next' id='but_next' />"
      paginationLinks.html(html);
    }
  });
}

function load_data_table(page, limit, action, order='asc', column_name) {

  var object = $.trim($(".list-init-object span:first-child").text());
  var objects = object + 's';

  var tb = $("#pagination_data tbody");
  var paginationLinks = $("#pagination_links");

  if( order == "asc") {
    arrow = "fas fa-arrow-up";
  } else {
    arrow = "fas fa-arrow-down";
  }

  if(action == 'search') {
    str = $.trim($(".table-data .row-tools input").val());
    url = dirname + "ajax/search?object=" + object + "&search=" + str + "&page=" + page + "&itemsPerPage=" + limit;
  } else if(action == 'sort') {
    url = dirname + "ajax/list?object=" + object + "&sort=" + order + "&columnName=" + column_name + "&page=" + page + "&itemsPerPage=" + limit;
    $("#" + column_name + " i").removeClass().addClass(arrow);
  } else {
    url = dirname + "ajax/list?object=" + object + "&page=" + page + "&itemsPerPage=" + limit;
  }


  $.ajax({
    url: url,
    success:function(data) {
      data = JSON.parse(data);
      var html;
      var cpt;
      if( data[objects].length > 0) {
        $.each(data[objects], function (index, element) {
          cpt = index+1;
          html+="<tr>";
          $.each(data["tableConfig"]["cells"], function(k,val) {
            if(k == "id") {
              html += "<td><form class='form_actions' method='POST' action='" + dirname + object + "/publish'><button class='button_table'type='submit' name='delete'><i class='fas fa-share-square'></i></button><input class='content-hidden' type='text' name='id' value='" + element[k] + "'/></form>"
              html+="<a href='" + dirname + object + "/edit/back?id=" + element[k] + "'><i class='fas fa-edit'></i></a>";
              html += "<form class='form_actions' method='POST' action='" + dirname + object + "/delete'><button class='button_table' type='submit' name='delete'><i class='fas fa-trash-alt'></i></button><input class='content-hidden' type='text' name='id' value='" + element[k] + "'/></form></td>";
            } else {
              if ( $.isArray(element[k])) {
                html+="<td>"+element[k][0].title+"</td>";
              } else {
                html+="<td>"+element[k]+"</td>";
              }
            }
          });
          html+="</tr>";
        });
      } else {
        cpt = 0;
        html+="<tr>";
        html+="<td colspan='5'>No results</td>";
        html+="</tr>";
      }

      tb.html(html);
      $('.count-all-element').html(data["itemsNumber"]);
      $('.count-page-element').html(cpt);

      html = "<input type='button' class='button' value='Previous' id='but_prev'/>";
      for(var i = 1; i<= data["pagination"].pagesNumber; i++){
        html += "<span style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='"+i+"'>" + i + "</span>";
      }
      html += "<input type='button' class='button' value='Next' id='but_next' />"
      paginationLinks.html(html);
    }
  });

  $(".column_sort i").each(function(){
    $(this).removeClass();
  });

  if(action == 'sort') {
    if( order == "asc") {
      $("#" + column_name).attr("data-order", "desc");
      $("#" + column_name + " i").removeClass().addClass("fas fa-arrow-up");
    } else {
      $("#" + column_name).attr("data-order", "asc");
      $("#" + column_name + " i").removeClass().addClass("fas fa-arrow-down");
    }
  }
}

function getIdAndNameObject(object, select){
  url = dirname + "ajax/list?object=" + object ;
  objects = object + 's';
  $.ajax({
    url: url,
    success:function(data) {
      data = JSON.parse(data);
      var html;
      if( data[objects].length > 0) {
        $.each(data[objects], function (index, element) {
          html += "<option value='" + element.id + "'>";
          html += element.title;
          html += "</option>";
        });
        select.append(html);
      }
    }
  });
}

function closeDiv(div){
  var elem = $('#' + div);
  elem.css("display","none");
}


var idPart = 1;
function addChapterSubpart(){
  var html = "<div id='chapterSubpart"+ idPart +"' class='form-group chapterParts'>" +
              "<div class='row subpartHead expand-div'>" +
                "<div class='M10'>" +
                  "<p>Subpart " + idPart + "</p>" +
                "</div>" +
                "<div class='M2'>" +
                  "<i class='fas fa-chevron-down btn-icon'></i>" +
                "</div>" +
              "</div>" +
              "<div class='content-hidden'>" +
                "<div class='row'>" +
                  "<input type='text' name='parts["+ idPart +"][title]' class='input form-group' placeholder='Title'>" +
                "</div>" +
                "<div class='row'>" +
                  "<textarea name='parts["+ idPart +"][content]' class='form-group input' placeholder='Content'></textarea>" +
                "</div>" +
              "</div>" +
             "</div>";
  var idbis = idPart - 1;
  if( $("#chapterSubpart" + idbis).length ) {
    $("#chapterSubpart" + idbis).after(html);
  } else {
    $("#addChapterPart").after(html);
  }
  idPart += 1;
}
