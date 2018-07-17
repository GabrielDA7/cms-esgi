$(document).ready(function () {
  /* ChartJs */
  if ($("#dashboard-stat .myChart").length) {
      var selectedValue = $('#dashboard-stat .select-input').find(":selected").val();
      var canvas = jQuery(".myChart");
      var type;
      var data;
      var option;
      topTrainning = JSON.parse(topTrainning);
      topVideo = JSON.parse(topVideo);
      topChapter = JSON.parse(topChapter);
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
          labels: [
                    topTrainning[0].trainning[0].title, topChapter[0].chapter[0].title, topVideo[0].video[0].title,
                    topTrainning[1].trainning[0].title, topChapter[1].chapter[0].title, topVideo[1].video[0].title,
                    topTrainning[2].trainning[0].title, topChapter[2].chapter[0].title, topVideo[2].video[0].title
                  ],
          datasets: [
            {
              label: "Number of views",
              backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
              data: [
                      topTrainning[0].trainning[0].views, topChapter[0].chapter[0].views, topVideo[0].video[0].views,
                      topTrainning[1].trainning[0].views, topChapter[1].chapter[0].views, topVideo[1].video[0].views,
                      topTrainning[2].trainning[0].views, topChapter[2].chapter[0].views, topVideo[2].video[0].views
                    ]
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
});