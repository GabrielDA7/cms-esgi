$(document).ready(function () {

  topTrainning = JSON.parse(topTrainning);
  topVideo = JSON.parse(topVideo);
  topChapter = JSON.parse(topChapter);
  viewsHistory = JSON.parse(viewsHistory);

  createChart();

  $(document).change('select[name=chart_choice]', function() {
    createChart();
  });

  function createChart() {
      var selectedValue = $('select[name=chart_choice]').find(":selected").val();
      var canvas = jQuery(".myChart");
      if(selectedValue == 'visits_evolution' ) {
        createVisitHistoryChart(canvas);
      } else if (selectedValue == 'popular_contents') {
        createPopularContentChart(canvas);
      }
  }
  

  function createPopularContentChart(canvas) {
      var chart = new Chart(canvas, {
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
      });
    }

    function createVisitHistoryChart(canvas) {
      var chart = new Chart(canvas, {
        type: 'bar',
        data: {
          labels: getHistoryDate(viewsHistory),
          datasets: [
          {
            label: "Number of views",
            data: getHistoryViews(viewsHistory)
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

    function getHistoryDate(array) {
      var dates = [];
      $.each(array, function(index, element) {
        dates.push(element.dateInserted);
      });
      return dates;
    }

    function getHistoryViews(array) {
      var views = [];
      $.each(array, function(index, element) {
        views.push(element.views);
      });
      return views;
    }
});
