<section id="dashboard-stat" >

 <div class="row">
    <div class="M4">
      <div class="row">
        <div class="M12">
          <div class="indicator indicator-margin">
            <p>Number of subscribers</p>
            <div class="hr-separation"></div>
            <p class="number-indicator"><?= (isset($totalPremiums) ? $totalPremiums : 0)?></p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="M12">
          <div class="indicator">
            <p>Number of views</p>
            <div class="hr-separation"></div>
            <p class="number-indicator"><?= (isset($totalViews) ? $totalViews : 0)?></p>
          </div>
        </div>
      </div>
    </div>

    <div class="M8">
      <div class="row">
        <div class="M6">
          <div class="wrapper-icon">
            <select class="select-input" name="chart_choice">
              <option value="popular_contents">Popular Contents</option>
              <option value="visits_evolution">Visits evolution</option>
            </select>
            <i class="fas fa-chevron-down icon-right"></i>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="M12">
          <canvas class="myChart" id="statistic_chart" width="300" height="320"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="row last-row">
    <div class="M4">
      <div class="row">
        <div class="M12">
          <div class="indicator">
            <p>Top Trainning</p>
            <div class="hr-separation"></div>
            <p class="text-indicator">
              <?php 
              try {
                if (!isset($topTrainning[0]))
                  throw new Exception("No index", 1);
                echo $topTrainning[0]->getTrainning()->getTitle();
              } catch (Exception $e) {
                echo "No Top"; 
              }
              ?>    
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="M4">
      <div class="row">
        <div class="M12">
          <div class="indicator">
            <p>Top Chapter</p>
            <div class="hr-separation"></div>
            <p class="text-indicator">
              <?php 
              try {
                if (!isset($topChapter[0]))
                  throw new Exception("No index", 1);
                echo $topChapter[0]->getChapter()->getTitle();
              } catch (Exception $e) {
                echo "No Top"; 
              }
              ?>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="M4">
      <div class="row">
        <div class="M12">
          <div class="indicator">
            <p>Top video</p>
            <div class="hr-separation"></div>
            <p class="text-indicator">
              <?php 
              try {
                if (!isset($topVideo[0]))
                  throw new Exception("Error Processing Request", 1);
                echo $topVideo[0]->getVideo()->getTitle();
              } catch (Exception $e) {
                echo "No Top"; 
              }
              ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php $this->addScript(3, CHART_PATH); ?>
<?php $this->addScript(4, STATISTIC_CHART_PATH, 
  [
    "topVideo" => json_encode(FormatUtils::formatDataToArray($topVideo)),
    "topChapter" => json_encode(FormatUtils::formatDataToArray($topChapter)),
    "topTrainning" => json_encode(FormatUtils::formatDataToArray($topTrainning)),
    "viewsHistory" => json_encode(FormatUtils::formatDataToArray($viewsHistory))
  ]); 
?>
