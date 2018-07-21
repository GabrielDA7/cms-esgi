$(document).ready(function () {

  topTrainning = JSON.parse(topTrainning);
  topVideo = JSON.parse(topVideo);
  topChapter = JSON.parse(topChapter);
  viewsHistory = JSON.parse(viewsHistory);

  var ctx = document.getElementById("statistic_chart").getContext("2d");
  window.myChart = new Chart(ctx, createConfigPopularContentChart());

  $(document).change('select[name=chart_choice]', function(chart) {
    createChart();
  });

  function createChart() {
    var chart = window.myChart;
    chart.destroy();
    var ctx = document.getElementById("statistic_chart").getContext("2d");
    var selectedValue = $('select[name=chart_choice]').find(":selected").val();
    if(selectedValue == 'visits_evolution' ) {
        window.myChart = new Chart(ctx, createConfigVisitHistoryChart());
    } else if (selectedValue == 'popular_contents') {
        window.myChart = new Chart(ctx, createConfigPopularContentChart());
    }
  }


  function createConfigPopularContentChart() {
      var config = {
        type: 'bar',
        data: {
          labels: [
            [getSafe(() => topTrainning[0].trainning[0].title, "No one"), '#1Trainning'],
            [getSafe(() => topChapter[0].chapter[0].title, "No one"), '#1Chapter'],
            [getSafe(() => topVideo[0].video[0].title, "No one"), '#1Video'],
            [getSafe(() => topTrainning[1].trainning[0].title, "No one"), '#2Trainning'],
            [getSafe(() => topChapter[1].chapter[0].title, "No one"), '#2Chapter'],
            [getSafe(() => topVideo[1].video[0].title, "No one"), '#2Video'],
            [getSafe(() => topTrainning[2].trainning[0].title, "No one"), '#3Trainning'],
            [getSafe(() => topChapter[2].chapter[0].title, "No one"), '#3Chapter'],
            [getSafe(() => topVideo[2].video[0].title, "No one"), '#3Video']
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
      };
      return config;
    }

    function createConfigVisitHistoryChart() {
      var config = {
          type: 'line',
          data: {
            labels: getHistoryViews(viewsHistory, "dateInserted"),
            datasets: [{
                data: getHistoryViews(viewsHistory, "views"),
                label: "number of visits",
                borderColor: "#3e95cd",
                fill: false
              },
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
        };
        return config;
    }

    function getHistoryViews(array, property) {
      var results = [];
      $.each(array, function(index, element) {
        results.push(element[property]);
      });
      return results;
    }

});
