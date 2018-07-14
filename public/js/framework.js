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

  $(document).on('click', '.expand-comment', function(){
    var childIcon = $(this).find('i');
    if(childIcon.hasClass('fa-chevron-down') )
    {
      childIcon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
    } else {
      childIcon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
    }
    var hiddenContent = $(this).parents().next().next().next('.comment-hidden').toggle('fast');
  });

  $(document).on('click', '.answer-comment-link', function(){
    var object = $.trim($("#comments span:eq(1)").text());
    var objectId = $.trim($("#comments span:first-child").text());
    var commentParentId;

    if($(this).parents().next('.answer-comment-form').children().length == 0) {
      $(this).parents().next('.answer-comment-form')
      .append(
        "<div class='answer-comment'>" +
          "<form method='POST' action=" + dirname + "comment/response>" +
            "<input type='hidden' name='" + object + "_id' value=" + objectId + ">" +
            "<input type='hidden' name='comment_id' value='2'>" + // " + commentId + "
            "<div class='row'>" +
              "<div class='M12 no-padding'>" +
                "<textarea class='answer-comment-input' name='content' placeholder='Enter a comment here'></textarea>" +
              "</div>" +
            "</div>" +
            "<div class='row'>" +
              "<div class='M12 no-padding form-group'>" +
                "<input type='submit' id='comment-button' class='input-btn btn-filled-blue btn-icon' value='Comment'>" +
              "</div>" +
            "</div>" +
          "</form>"+
        "</div>"
      );
    } else {
        $(this).parents().next('.answer-comment-form').children().remove();
    }
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

  // COMMENTS
  if( $("#comments").length > 0 ) {
    var object = $.trim($("#comments span:eq(1)").text());
    var id = $.trim($("#comments span:first-child").html());
    load_data_list_comment(object, id);
  }

  $(document).on('click', '.report-comment', function() {
    var modal = $("#report-comment-mdl");
    var btn = $(this);
    var closeModal = $(".close-mdl");
    var commentId = $(this).find('.content-hidden').html();
    var id = $.trim($("#comments span:first-child").html());
    var object = $.trim($("#comments span:eq(1)").text());
    $("#report-comment-mdl form").append("<input type='hidden' name='" + object + "_id' value='"+ id +"'>");
    modal.find('input[name=comment_id]').attr('value', commentId);
    modal.css({display: "block"});
  });

  $(document).on('click', '.close-mdl', function() {
      $("#report-comment-mdl").css({display: "none"});
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
            if(object != "video") {
              if( element.image != null ) {
                html += "  <image src='" + dirname + element.image + "' alt='" + element.title + "'>";
              } else {
                html += "  <image src='" + dirname + "public/img/default.jpg' alt='" + element.title + "'>";
              }
            } else {
              html += "<video class='video-card' width='100%' height='100%' controls='controls'>";
              html += "<source src='" + dirname + element.url + "' type='video/mp4' />";
              html += "<source src='" + dirname + element.url + "' type='video/mp3' />";
              html += "<source src='" + dirname + element.url + "' type='video/webm' />";
              html += "<source src='" + dirname + element.url + "' type='video/3gp' />";
              html += "No video";
              html += "</video>";
            }
            html += "  </div>";
            html += "  <div class='card-separation'></div>";
            html += "  <div class='card-content'>";
            html += "    <p class='card-content-title'>" + element.title + "</p>";
            html += "    <p class='card-content-author'>" + element.user[0].userName + "</p>";
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
              if(object == "user") {
                 html += "<td><a href='" + dirname + object + "/edit/back?id=" + element[k] + "'><i class='fas fa-edit'></i></a>";
                 html += "<form class='form_actions' method='POST' action='" + dirname + object + "/delete'><button class='button_table' type='submit' name='delete'><i class='fas fa-trash-alt'></i></button><input class='content-hidden' type='text' name='id' value='" + element[k] + "'/></form></td>";
              } else {
                html += "<td><form class='form_actions' method='POST' action='" + dirname + object + "/publish'><button class='button_table'type='submit' name='share'><i class='fas fa-share-square'></i></button><input class='content-hidden' type='text' name='id' value='" + element[k] + "'/></form>"
                html +="<a href='" + dirname + object + "/edit/back?id=" + element[k] + "'><i class='fas fa-edit'></i></a>";
                html += "<form class='form_actions' method='POST' action='" + dirname + object + "/delete'><button class='button_table' type='submit' name='delete'><i class='fas fa-trash-alt'></i></button><input class='content-hidden' type='text' name='id' value='" + element[k] + "'/></form></td>";
              }
            } else {
              if ( $.isArray(element[k])) {
                if(k == "trainning") {
                  html+="<td>"+element[k][0].title+"</td>";
                } else {
                  html+="<td>"+element[k][0].userName+"</td>";
                }
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
                "<input type='hidden' name='parts["+ idPart +"][number]' value='" + idPart + "'></input>"
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

function load_data_list_comment(object, id){
  url = dirname + "ajax/listComment?object=comment&sort=desc" + "&columnName=date" + "&page=1&itemsPerPage=10&" + object + "_id=" + id;
  div = $("#comments-result");
  paginationLinks = $("#pagination_links");
  linkObjectView = $.trim($(".list-init-object span:last-child").text());
  $.ajax({
    url: url,
    method: 'POST',
    success:function(data) {
      data = JSON.parse(data);
      var html = '';
      if( data['comments'].length > 0) {
        $.each(data['comments'], function(index, element) {
          html += renderCommentResponse(element);
        });
      } else {
        html = "No comments";
      }
      div.html(html);
    }
  });
}

function getTimeDifference(date) {
  var dateComment = new Date(date)
  var now = new Date();
  var difference_ms = now.getTime() - dateComment.getTime();
  return dhm(difference_ms);
}

function dhm(ms){
    days = Math.floor(ms / (24*60*60*1000));
    daysms=ms % (24*60*60*1000);
    hours = Math.floor((daysms)/(60*60*1000));
    hoursms=ms % (60*60*1000);
    minutes = Math.floor((hoursms)/(60*1000));
    minutesms=ms % (60*1000);
    sec = Math.floor((minutesms)/(1000));
    if(days > 0 && hours > 0 && minutes > 0 && sec > 0) {
      return days + " d " + hours+" h "+minutes+" m "+sec + " s";
    }
    if(days == 0 && hours > 0 && minutes > 0 && sec > 0) {
      return hours+" h "+minutes+" m "+sec + " s";
    }
    if(days == 0 && hours == 0 && minutes > 0 && sec > 0) {
      return minutes+" m "+sec + "s";
    }
    if(days == 0 && hours == 0 && minutes == 0 && sec > 0) {
      return sec + "s";
    }
}

function renderCommentResponse(element) {
  html = "<div class='row comment-card M--start'>";
  html +=   "<div class='M1 no-padding align-center'>";
  html +=     "<img class='avatar-img-medium' src='" + element.user[0].avatar + "' alt='avatar'>";
  html +=   "</div>";
  html +=   "<div class='M11'>";
  html +=     "<div class='row padding-bottom-comment'>";
  html +=       "<div class='M3 no-padding'>";
  html +=         "<strong>" + element.user[0].userName + "</strong><span class='grey-content'>" + getTimeDifference(element.dateInserted) + "</span>";
  html +=       "</div>";
  html +=       "<div class='M2 M--offset7'>";
  html +=         "<a class='align-right report-comment'><span class='content-hidden'>" + element.id + "</span><i class='fas fa-flag'></i></a>";
  html +=       "</div>";
  html +=     "</div>";
  html +=     "<div class='row padding-bottom-comment'>";
  html +=       "<p>" + element.content + "</p>";
  html +=     "</div>";
  html +=     "<div class='row M--start'>";
  html +=       "<div class='M2 no-padding'>";
  if(element.responses[0].length > 0) {
      html +=  "<a href='javascript:void(0);' class='expand-comment no-decoration'><strong>Reply(" + element.responses[0].length + ")<i class='fas fa-chevron-down'></i></strong></a>";
  }
  html +=       "</div>";
  html +=       "<div class='M2 M--offset8 no-padding'>";
  html +=         "<a href='javascript:void(0);' class='align-right grey-content answer-comment-link'>Answer</a>";
  html +=       "</div>";
  html +=       "<div class='M12 no-padding answer-comment-form'></div>";
  html +=       "<div class='M12 no-padding comment-hidden'>"
  if(element.responses[0].length > 0) {
    renderCommentResponse(element.responses[0]);
  }
  html +=       "</div>";
  html +=     "</div>";
  html +=   "</div>";
  html += "</div>";
  return html;
}
