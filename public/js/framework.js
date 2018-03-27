$(function() {
  /* ChartJs */
  if ( $( ".myChart" ).length )
  {
      var canvas = jQuery(".myChart");
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


});