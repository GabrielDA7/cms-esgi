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
                    [getSafe(() => topTrainning[0].trainning[0].title), '#1Trainning'], 
                    [getSafe(() => topChapter[0].chapter[0].title), '#1Chapter'], 
                    [getSafe(() => topVideo[0].video[0].title), '#1Video'],
                    [getSafe(() => topTrainning[1].trainning[0].title), '#2Trainning'], 
                    [getSafe(() => topChapter[1].chapter[0].title), '#2Chapter'], 
                    [getSafe(() => topVideo[1].video[0].title), '#2Video'],
                    [getSafe(() => topTrainning[2].trainning[0].title), '#3Trainning'], 
                    [getSafe(() => topChapter[2].chapter[0].title), '#3Chapter'], 
                    [getSafe(() => topVideo[2].video[0].title), '#3Video']
                  ],
          datasets: [
            {
              label: "Number of views",
              backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9"],
              data: [
                      getSafe(() => topTrainning[0].views), getSafe(() => topChapter[0].views), getSafe(() => topVideo[0].video[0].views),
                      getSafe(() => topTrainning[1].views), getSafe(() => topChapter[1].views), getSafe(() => topVideo[1].video[0].views),
                      getSafe(() => topTrainning[2].views), getSafe(() => topChapter[2].views), getSafe(() => topVideo[2].video[0].views)
                    ]
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: { display: false },
          scales: {
            yAxes: [{
              ticks: {
                  beginAtZero: true
              }
            }]
          },
          title: {
            display: false
          }
        }
      });
  }
});
