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
    var limit = $( ".pagination-selector option:selected" ).val();
    var page = 1;
    load_data(page, limit, 'init');
  }

  $(document).on('click', '#pagination_links span', function() {
    var limit = $( ".pagination-selector option:selected" ).val();
    var page = $(this).attr("id");
    load_data(page, limit, 'init');
  });

  $(document).on('click', '.column_sort', function() {
    var column_name = $(this).attr("id");
    var order = $(this).attr("data-order");
    load_data(page, limit, 'sort', order, column_name);
  });

  $(document).on('change', '.pagination_selector', function() {
    var limit = $( ".pagination-selector option:selected" ).val();
    var page = 1;
    load_data(page, limit,'init');
  });

  $(document).on('input', '.list-data .row-tools input', function() {
    var limit = $( ".pagination-selector option:selected" ).val();
    var page = 1;
    load_data(page, limit,'search');
  });

});

function load_data(page, limit, action, order='asc', column_name) {

  var object = $.trim($(".list-init-object").text());
  var tb = $("#pagination_data tbody");
  var paginationLinks = $("#pagination_links");

  if( order == "asc") {
    arrow = "fas fa-arrow-up";
  } else {
    arrow = "fas fa-arrow-down";
  }

  if(action == 'search') {
    str = $.trim($(".list-data .row-tools input").val());
    url = dirname + "ajax/search?object=" + object + "&search=" + str;
  } else if(action == 'sort') {
    url = dirname + "ajax/sort?object=" + object + "&sort=" + order + "&column_name=" + column_name;
    $("#" + column_name + " i").removeClass().addClass(arrow);
  } else {
    url = dirname + "ajax/list?object=" + object;
  }


  $.ajax({
    url: url,
    method: "POST",
    data:{page:page,limit:limit},
    success:function(data) {
      data = JSON.parse(data);
      var html;
      var cpt;

      if( data["data"].length > 0) {
        $.each(data["data"], function (index, element) {
          cpt = index+1;
          html+="<tr>";
          $.each(data["config"], function(k,val) {
            if(k == "id") {
              html+="<td><a href='#edit/'" + element[k] + "><i class='fas fa-edit'></i></a><a href='#delete/'" + element[k] + "><i class='far fa-trash-alt'></i></a></td>";
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
      $('.count-all-element').html(data["data"].length);
      $('.count-page-element').html(cpt);

      html = "<input type='button' class='button' value='Previous' id='but_prev'/>";
            //alert(JSON.stringify(data["config"]));
      for(var i = 1; i<= data["total_page"]; i++){
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
                  "<input type='text' name='parts[part"+ idPart +"][title]' class='input form-group' placeholder='Title'>" +
                "</div>" +
                "<div class='row'>" +
                  "<textarea name='parts[part"+ idPart +"][content]' class='form-group input' placeholder='Content'></textarea>" +
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
