$(function() {

  getSafe = function (fn, defaultVal) {
    try {
        return fn();
    } catch (e) {
        return defaultVal;
    }
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
    var hiddenContent = $(this).parents().siblings(".comment-hidden").toggle('fast');
  });

  $(document).on('click', '.answer-comment-link', function(){
    var commentParentId = $(this).parents().parents().parents().children().children().next().children().children().html();
    if($(this).parents().next('.answer-comment-form').children().length == 0) {
      $(this).parents().next('.answer-comment-form')
      .append(
        "<div class='answer-comment'>" +
          "<form method='POST' action=" + dirname + "comment/response>" +
            "<input type='hidden' name='comment_id' value='"+ commentParentId +"'>" +
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
  if( $("#pagination_data").length > 0 ) {
    var limit = $( ".pagination_selector option:selected" ).val();
    var page = 1;
    load_data_table(page, limit, 'init');
  }

  if( $("#front-global-search").length > 0) {
    var limit = 12;
    var page = 1;
    load_data_list_card(page,'desc','dateInserted','chapter',limit, true, 'result-search-chapter', 'result-search-chapter-pagination', 'search');
    load_data_list_card(page,'desc','dateInserted','trainning',limit, true, 'result-search-trainning', 'result-search-trainning-pagination', 'search');
    load_data_list_card(page,'desc','dateInserted','video',limit, true, 'result-search-video', 'result-search-video-pagination', 'search');
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
    load_data_list_card(page,'desc', 'dateInserted', object,24, true, 'data-list', 'pagination_links');
  }

  $(document).on('click', '.list-data #pagination_links span', function() {
    var page = $(this).attr("id");
    var object = $.trim($(".list-init-object span:first-child").text());
    load_data_list_card(page,'desc', 'dateInserted', object ,24,true, 'data-list', 'pagination_links');
  });

  $(document).on('click', '.button-pagination-selector input[id^=but]', function() {
    var buttonValue = $(this).attr("value");
    var currentPage = parseInt($(this).siblings('.selected-pagination').attr('id'));
    var numberSpan = $(this).siblings('span').length;
    var page = currentPage;
    if(buttonValue == 'Next') {
      if(currentPage != numberSpan) {
        page = (currentPage+1).toString();
      }
    } else {
      if(currentPage != 1) {
        page = (currentPage-1).toString();
      }
    }
    if($('.list-init-object').length > 0) {
      var object = $.trim($(".list-init-object span:first-child").text());
      if($(".table-data").length > 0) {
        var limit = $( ".pagination_selector option:selected" ).val();
        load_data_table(page, limit, 'init');
      } else {
        load_data_list_card(page,'desc', 'dateInserted', object ,24,true, 'data-list', 'pagination_links');
      }
    } else {
      var paginationIdDiv = $(this).parents().attr("id");
      var listCardIdDiv = $(this).parents().parents().prev().attr("id");
      var object = $(this).parents().siblings('.content-hidden').html();
      load_data_list_card(page,'desc', 'dateInserted', object ,12,true, listCardIdDiv, paginationIdDiv, 'search');
    }
  });

  $(document).on('click', '.pagination-global-search span', function() {
    var page = $(this).attr("id");
    var paginationIdDiv = $(this).parents().attr("id");
    var listCardIdDiv = $(this).parents().parents().prev().attr("id");
    var object = $(this).parents().siblings('.content-hidden').html();
    load_data_list_card(page,'desc', 'dateInserted', object ,12,true, listCardIdDiv, paginationIdDiv, 'search');
  });

  // COMMENTS
  if( $("#comments").length > 0 ) {
    var object = $.trim($("#comments span:eq(1)").text());
    var id = $.trim($("#comments span:first-child").html());
    load_data_list_comment(object, id);
  }

  $(document).on('click', '#front-video video', function() {
      var overlay = $("#open-video");
      overlay.removeClass('content-hidden').addClass('wrap-flex');
  });

  $(document).on('click', '.close-video', function() {
      var overlay = $("#open-video");
      overlay.removeClass('wrap-flex').addClass('content-hidden');
  });

  $(document).on('click', '.report-comment', function() {
    var modal = $("#report-comment-mdl");
    var btn = $(this);
    var closeModal = $(".close-mdl");
    var commentId = $(this).find('.content-hidden').html();
    modal.find('input[name=id]').attr('value', commentId);
    modal.css({display: "block"});
  });

  $(document).on('click', '.close-mdl', function() {
      $("#report-comment-mdl").css({display: "none"});
  });

  if( $("#recent-chapter").length > 0) {
    load_data_list_card(1,'desc','dateInserted','chapter',6, false, 'recent-chapter', 'pagination_links');
  }

  if( $("#recent-trainning").length > 0) {
    load_data_list_card(1,'desc','dateInserted','trainning',6, false, 'recent-trainning', 'pagination_links');
  }

  if( $("#recent-video").length > 0) {
    load_data_list_card(1,'desc','dateInserted','video',6, false, 'recent-video', 'pagination_links');
  }

  $(document).on('change', '#dashboard-add-chapter select[name="trainning_id"]', function() {
    var valueOption = $(this).find(':selected').attr('value');
    if(valueOption != ""){
      $("input[name='number']").prop("disabled", false);
      $("input[name='number']").attr("type", "number");
    } else {
      $("input[name='number']").val("");
      $("input[name='number']").attr("type", "text");
      $("input[name='number']").prop("disabled", true);
    }
  });

  $(document).on('click', '.flash-msg i', function() {
    $('.flash-msg').remove();
  });

  $("#global-search").enterKey(function () {
    str = $("#global-search").val();
    if(str.length >= 2) {
      redirect(dirname + 'index/search?str=' + str);
    }
  });

  /* Get signaled comments number */

  if( $("#dashboard-left-menu").length > 0 ) {
    getCommentsSignaled("number-comments-signaled", "list-comments-report");
  }

});

function getCommentsSignaled(divNumber, divList){
  url = dirname + "ajax/listcomment?object=comment&report=1";
  $.ajax({
    url: url,
    divNumber: divNumber,
    divList: divList,
    success:function(data) {
      data = JSON.parse(data);
      dataComments = data['comments'];
      html = '';
      if(divList.length > 0) {
        divNumber = $("#" + divNumber);
        divNumber.html(data['itemsNumber']);

        $.each(dataComments, function(index, element) {
          html += renderCommentSignaled(element);
        });
        divList = $("#" + divList);
        divList.html(html);
      } else {
        divNumber = $("#" + divNumber);
        divNumber.html(data['itemsNumber']);
      }
    }
  });
}

function load_data_list_card(page,order='desc', column_name, object, itemsPerPage=30, pagination=true,div, pagination_div, action='init'){
  objects = object + 's';
  if(action == 'init') {
    url = dirname + "ajax/list?object=" + object + "&page=" + page + "&sort=" + order + "&columnName=" + column_name +"&itemsPerPage=" + itemsPerPage + "&status=1";
  } else {
    str = $.trim($("#global-search").val());
    url = dirname + "ajax/search?object=" + object + "&search=" + str + "&page=" + page + "&itemsPerPage=" + itemsPerPage + "&status=1";
  }
  div = $('#' + div);
  linkObjectView = object + "/" + object;

  $.ajax({
    url: url,
    objects: objects,
    div: div,
    linkObjectView: linkObjectView,
    page: page,
    pagination_div : pagination_div,
    success:function(data) {
      data = JSON.parse(data);
      var html = '';
      var resultRequest = '';
      if( data[this.objects].length > 0) {
        link = this.linkObjectView;
        $.each(data[this.objects], function(index, element) {
            html += "<div class='M2 X12'>"
            html += " <a href='" + link + "?id=" + element.id + "' class='card'>";
            html += "  <div class='card-image'>";
            if(object != "video") {
              if( element.image != null ) {
                html += "  <image src='" + element.image + "' alt='" + element.title + "'>";
              } else {
                html += "  <image src='" + dirname + "public/img/default.jpg' alt='" + element.title + "'>";
              }
            } else {
              html += "<video class='video-card' width='100%' height='100%' controls='controls'>";
              html += "<source src='" + element.url + "' type='video/mp4' />";
              html += "<source src='" + element.url + "' type='video/mp3' />";
              html += "<source src='" + element.url + "' type='video/webm' />";
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
        }, link);
      } else {
        html = "<div class='no-content'>" +
                "<h3>No content yet !</h3>" +
               "</div>";
      }
      this.div.html(html);
      if(pagination == true && data[this.objects].length > 0) {
        paginationLinks = $("#" + this.pagination_div);
        html = "<input type='button' class='button' value='Previous' id='but_prev'/>";
        for(var i=1; i <= data["pagination"].pagesNumber; i++){
          if(i==this.page) {
              html += "<span class='selected-pagination' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='"+i+"'>" + i + "</span>";
          } else {
              html += "<span style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='"+i+"'>" + i + "</span>";
          }
        }
        html += "<input type='button' class='button' value='Next' id='but_next' />"
        paginationLinks.html(html);
      }
    }
  });
}

function load_data_table(page, limit, action, order='desc', column_name='dateInserted') {

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
    url = dirname + "ajax/list?object=" + object + "&page=" + page + "&itemsPerPage=" + limit + "&sort=" + order + "&columnName=" + column_name ;
  }

  $.ajax({
    url: url,
    page: page,
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
                 html += "<form class='form_actions' method='POST' action='" + dirname + object + "/delete'><button class='button_table' type='submit' name='submit'><i class='fas fa-trash-alt'></i></button><input class='content-hidden' type='text' name='id' value='" + element[k] + "'/></form></td>";
              } else {
                html += "<td><form class='form_actions' method='POST' action='" + dirname + object + "/publish'><button class='button_table' type='submit' name='submit'><i class='fas fa-share-square'></i></button><input class='content-hidden' type='text' name='status' value='" + (element.status == 1 ? 0 : 1) + "'/><input class='content-hidden' type='text' name='id' value='" + element[k] + "'/></form>"
                html +="<a href='" + dirname + object + "/edit/back?id=" + element[k] + "'><i class='fas fa-edit'></i></a>";
                html += "<form class='form_actions' method='POST' action='" + dirname + object + "/delete'><button class='button_table' type='submit' name='submit'><i class='fas fa-trash-alt'></i></button><input class='content-hidden' type='text' name='id' value='" + element[k] + "'/></form></td>";
              }
            } else if(k == "status") {
              if(element.status == 1) {
                html+="<td class='color-green'><i class='fas fa-circle'></i></td>";
              } else {
                html+="<td class='color-red'><i class='fas fa-circle'></i></td>";
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
        if(i==this.page) {
            html += "<span class='selected-pagination' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='"+i+"'>" + i + "</span>";
        } else {
            html += "<span style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='"+i+"'>" + i + "</span>";
        }
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
                  "<input type='text' name='parts["+ idPart +"][title]' class='input form-group margin-bottom' placeholder='Title'>" +
                "</div>" +
                "<div class='row'>" +
                  "<textarea name='parts["+ idPart +"][content]' class='form-group input tinymce' placeholder='Content'></textarea>" +
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
  initialisationParamTiny();
}

function load_data_list_comment(object, id){
  url = dirname + "ajax/listComment?object=comment&sort=desc" + "&columnName=dateInserted" + "&page=1&itemsPerPage=10&" + object + "_id=" + id;
  div = $("#comments-result");
  paginationLinks = $("#pagination_links");
  $.ajax({
    url: url,
    method: 'POST',
    success:function(data) {
      data = JSON.parse(data);
      var html = '';
      if( data['comments'].length > 0) {
        $.each(data['comments'], function(index, element) {
          html += renderCommentResponse(element, false);
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
    return "1s";
}

function renderCommentSignaled(element) {
  html = "<div class='row comment-card M--start'>";
  html +=   "<div class='M1 no-padding align-center'>";
  html +=     "<a href='" + dirname + "user/user?id=" + element.user[0].id + "'>"
  html +=       "<img class='avatar-img-medium' src='" + element.user[0].avatar + "' alt='avatar image'>";
  html +=     "</a>"
  html +=   "</div>";
  html +=   "<div class='M11'>";
  html +=     "<div class='row padding-bottom-comment'>";
  html +=       "<div class='M3 no-padding'>";
  html +=         "<strong>" + element.user[0].userName + "</strong><span class='grey-content'>" + getTimeDifference(element.dateInserted) + "</span>";
  html +=       "</div>";
  html +=       "<div class='M2 M--offset7 no-padding'>";
  html +=         "<form action='" + dirname + "comment/delete' method='POST'>"
  html +=           "<input type='hidden' name='id' value='" + element.id + "'></input>";
  html +=           "<input class='align-righ delete-comment' type='submit' name='submit' value='&times'></input>";
  html +=         "</form>"
  html +=       "</div>";
  html +=     "</div>";
  html +=     "<div class='row padding-bottom-comment'>";
  html +=       "<p>" + element.content + "</p>";
  html +=     "</div>";
  html +=   "</div>";
  html += "</div>";
  return html;
}

function renderCommentResponse(element, intern) {
  html = "<div class='row comment-card M--start'>";
  html +=   "<div class='M1 no-padding align-center'>";
  html +=     "<a href='user/user?id=" + element.user[0].id + "'>"
  html +=       "<img class='avatar-img-medium' src='" + element.user[0].avatar + "' alt='avatar image'>";
  html +=     "</a>"
  html +=   "</div>";
  if(intern == false) {
    html +=   "<div class='M11'>";
  } else {
    html +=   "<div class='M11 no-padding'>";
  }
  html +=     "<div class='row padding-bottom-comment'>";
  html +=       "<div class='M3 no-padding'>";
  html +=         "<strong>" + element.user[0].userName + "</strong><span class='grey-content'>" + getTimeDifference(element.dateInserted) + "</span>";
  html +=       "</div>";
  if(isLogged == 'true') {
    html +=       "<div class='M2 M--offset7 no-padding'>";
    html +=         "<a class='align-right report-comment'><span class='content-hidden'>" + element.id + "</span><i class='fas fa-flag'></i></a>";
    html +=       "</div>";
  }
  html +=     "</div>";
  html +=     "<div class='row padding-bottom-comment'>";
  html +=       "<p>" + element.content + "</p>";
  html +=     "</div>";
  html +=     "<div class='row M--start'>";
  html +=       "<div class='M2 no-padding'>";
  if(element.comments[0].length > 0) {
      html +=  "<a href='javascript:void(0);' class='expand-comment no-decoration'><strong>Reply(" + element.comments[0].length + ") <i class='fas fa-chevron-down'></i></strong></a>";
  }
  html +=       "</div>";
  if( isLogged == 'true') {
    html +=       "<div class='M2 M--offset8 no-padding'>";
    html +=         "<a href='javascript:void(0);' class='align-right grey-content answer-comment-link'>Answer</a>";
    html +=       "</div>";
  }
  html +=       "<div class='M12 no-padding answer-comment-form'></div>";
  html +=       "<div class='M12 no-padding comment-hidden'>"
  if(element.comments[0].length > 0) {
    $.each(element.comments[0], function(index, elem) {
      html += renderCommentResponse(elem, true);
    });
  }
  html +=       "</div>";
  html +=     "</div>";
  html +=   "</div>";
  html += "</div>";
  return html;
}

function initialisationParamTiny(){
  tinymce.init(
      {
      /* replace textarea having class .tinymce with tinymce editor */
      selector: "textarea.tinymce",

      /* theme of the editor */
      theme: "modern",
      skin: "lightgray",

      /* width and height of the editor */
      width: "100%",
      height: 300,

      /* display statusbar */
      statubar: true,

      /* plugin */
      plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
      ],

      /* toolbar */
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",

      /* style */
      style_formats: [
        {title: "Headers", items: [
          {title: "Header 1", format: "h1"},
          {title: "Header 2", format: "h2"},
          {title: "Header 3", format: "h3"},
          {title: "Header 4", format: "h4"},
          {title: "Header 5", format: "h5"},
          {title: "Header 6", format: "h6"}
        ]},
        {title: "Inline", items: [
          {title: "Bold", icon: "bold", format: "bold"},
          {title: "Italic", icon: "italic", format: "italic"},
          {title: "Underline", icon: "underline", format: "underline"},
          {title: "Strikethrough", icon: "strikethrough", format: "strikethrough"},
          {title: "Superscript", icon: "superscript", format: "superscript"},
          {title: "Subscript", icon: "subscript", format: "subscript"},
          {title: "Code", icon: "code", format: "code"}
        ]},
        {title: "Blocks", items: [
          {title: "Paragraph", format: "p"},
          {title: "Blockquote", format: "blockquote"},
          {title: "Div", format: "div"},
          {title: "Pre", format: "pre"}
        ]},
        {title: "Alignment", items: [
          {title: "Left", icon: "alignleft", format: "alignleft"},
          {title: "Center", icon: "aligncenter", format: "aligncenter"},
          {title: "Right", icon: "alignright", format: "alignright"},
          {title: "Justify", icon: "alignjustify", format: "alignjustify"}
        ]}
      ]
    }
  );

}

$.fn.enterKey = function (fnc) {
    return this.each(function () {
        $(this).keypress(function (ev) {
            var keycode = (ev.keyCode ? ev.keyCode : ev.which);
            if (keycode == '13') {
                fnc.call(this, ev);
            }
        })
    })
}

function redirect (url) {
    var ua        = navigator.userAgent.toLowerCase(),
        isIE      = ua.indexOf('msie') !== -1,
        version   = parseInt(ua.substr(4, 2), 10);

    // Internet Explorer 8 and lower
    if (isIE && version < 9) {
        var link = document.createElement('a');
        link.href = url;
        document.body.appendChild(link);
        link.click();
    }

    // All other browsers can use the standard window.location.href (they don't lose HTTP_REFERER like Internet Explorer 8 & lower does)
    else {
        window.location.href = url;
    }
}
