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


  // Ajax call for listing trainings
  if( $("#list-trainning").length ) {
    initList(10, "trainning", "list-trainning");
  }

  // Ajax call for listing chapter
  if( $("#list-lesson").length ) {
    initList(10, "chapter", "list-lesson");
  }

});


function initList(num, object, id) {
  $.ajax({
    type: 'GET',
    url:dirname + "ajax/list?object=" + object,
    dataType: 'json',
    success : function(data) {
      tb = $("#"+ id + " tbody");
      var html;
      var cpt;

      if( data.length > 0) {
        $.each(data, function (index, element) {
          if(index === num) {
            return false;
          }
          cpt = index+1;
          html+="<tr>";
          $.each(element, function(i, elem) {
            if(elem != null && elem.constructor.name === 'Array' && elem.length > 0){
              html+="<td>"+elem[0].title+"</td>";
            } else {
              html+="<td>"+elem+"</td>";
            }
          });
          html+="<td><a href='#edit/id'><i class='fas fa-edit'></i></a><a href='#delete/id'><i class='far fa-trash-alt'></i></a></td>";
          html+="</tr>";
        });
      } else {
          html+="<tr>";
          html+="<td colspan='5'>No results</td>";
          html+="</tr>";
      }
      tb.html(html);
      $('.count-all-element').html(data.length);
      $('.count-page-element').html(cpt);
    },
  });
}

function searchTable(object ,idpage, id){
  var str = $("#" + idpage + " .row-tools input").val();
  $.ajax({
    type: 'GET',
    url:dirname + "ajax/search?object=" + object + "&search=" + str,
    dataType: 'json',
    success : function(data){
      tb = $("#" + id + " tbody");
      var html;
      if(data.length > 0) {
        $.each(data, function (index, element) {
          html+="<tr>";
          html+="<td>"+element.title+"</td>";
          html+="<td>"+element.category+"</td>";
          html+="<td>"+element.author+"</td>";
          html+="<td>"+element.status+"</td>";
          html+="<td><a href='#edit/id'><i class='fas fa-edit'></i></a><a href='#delete/id'><i class='far fa-trash-alt'></i></a></td>";
          html+="</tr>";
        });
      } else {
        html+="<tr>";
        html+="<td colspan='5'>No results</td>";
        html+="</tr>";
      }
      tb.html(html);
    },
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
