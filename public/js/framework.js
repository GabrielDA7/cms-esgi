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

  if ( $( "#dashboard-left-menu" ).length )
  {
    $('#main-left-menu li')
    .css({cursor: "pointer"})
    .on('click', function(){
      $(this).find('ul').toggle();
    })
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
  var statut = -1;
  $("#content-main .expand-div").click( function() {
    var childIcon = $(this).find('i');
    if(statut === 0 || statut < 0 )
    {
      childIcon.removeClass('fa-chevron-down');
      childIcon.addClass('fa-chevron-up');
      statut = 1;
    } else {
      childIcon.removeClass('fa-chevron-up');
      childIcon.addClass('fa-chevron-down');
      statut = 0;
    }
    var hiddenContent = $(this).parent().siblings('.content-hidden').toggle('fast');
  });

  // Ajax call for listing trainings
  if( $("#list-trainning").length ) {
    initListTrainning(10);
  }

  // Ajax call for listing chapter
  if( $("#list-lesson").length ) {
    initListChapter(10);
  }

});

function initListTrainning(num){
    $.ajax({
      type: 'GET',
      url:"/lab/uteach/ajax/list?object=trainning",
      dataType: 'json',
      success : function(data){
        tb = $("#list-trainning tbody");
        obj = data;
        var html;
        $.each(obj, function (index, element) {
          html+="<tr>";
          html+="<td>"+element.title+"</td>";
          html+="<td>"+element.category+"</td>";
          html+="<td>"+element.author+"</td>";
          html+="<td>"+element.status+"</td>";
          html+="<td><a href='#edit/id'><i class='fas fa-edit'></i></a><a href='#delete/id'><i class='far fa-trash-alt'></i></a></td>";
          html+="</tr>";
        });
        tb.html(html);
      },
    });
  };

function initListChapter(num) {
  $.ajax({
    type: 'GET',
    url:"/lab/uteach/ajax/list?object=chapter",
    dataType: 'json',
    success : function(data){
      tb = $("#list-lesson tbody");
      obj = data;
      var html;
      $.each(obj, function (index, element) {
        html+="<tr>";
        html+="<td>"+element.title+"</td>";
        html+="<td>"+element.category+"</td>";
        html+="<td>"+element.author+"</td>";
        html+="<td>"+element.status+"</td>";
        html+="<td><a href='#edit/id'><i class='fas fa-edit'></i></a><a href='#delete/id'><i class='far fa-trash-alt'></i></a></td>";
        html+="</tr>";
      });
      tb.html(html);
    },
  });
}

function searchTrainning(str){
  var str = $("#dashboard-list-tranning .row-tools input").val();
  $.ajax({
    type: 'GET',
    url:"/lab/uteach/ajax/search?object=trainning",
    dataType: 'json',
    success : function(data){
      tb = $("#list-trainning tbody");
      obj = data;
      var html;
      $.each(obj, function (index, element) {
        html+="<tr>";
        html+="<td>"+element.title+"</td>";
        html+="<td>"+element.category+"</td>";
        html+="<td>"+element.author+"</td>";
        html+="<td>"+element.status+"</td>";
        html+="<td><a href='#edit/id'><i class='fas fa-edit'></i></a><a href='#delete/id'><i class='far fa-trash-alt'></i></a></td>";
        html+="</tr>";
      });
      tb.html(html);
    },
  });
}

function searchChapter(str){
  var str = $("#dashboard-list-lesson .row-tools input").val();
  $.ajax({
    type: 'GET',
    url:"/lab/uteach/ajax/search?object=chapter",
    dataType: 'json',
    success : function(data){
      tb = $("#list-lesson tbody");
      obj = data;
      var html;
      $.each(obj, function (index, element) {
        html+="<tr>";
        html+="<td>"+element.title+"</td>";
        html+="<td>"+element.category+"</td>";
        html+="<td>"+element.author+"</td>";
        html+="<td>"+element.status+"</td>";
        html+="<td><a href='#edit/id'><i class='fas fa-edit'></i></a><a href='#delete/id'><i class='far fa-trash-alt'></i></a></td>";
        html+="</tr>";
      });
      tb.html(html);
    },
  });
}

function closeDiv(div){
  var elem = $('#' + div);
  elem.css("display","none");
}
