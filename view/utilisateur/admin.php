              <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Vue d'ensemble</h2>
                                    <button class="au-btn au-btn-icon au-btn--blue" id="help_button">
                                        <i class="zmdi zmdi-plus"></i>Aide
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="help_slide" class="mt-4" style="display: none;">
                            <div class="alert alert-success" role="alert">
                                 <h4 class="alert-heading">Well done!</h4>
                                        <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.
                                        </p>
                                        <hr>
                                 <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                            </div>
                        </div>

                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div id="list_user_button" class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo $inscrit;?></h2>
                                                <span>Inscrits</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-shopping-cart"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo $vendu;?></h2>
                                                <span>téléphone vendu</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-calendar-note"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo $thisweek;?></h2>
                                                <span>cette semaine</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-money"></i>
                                            </div>
                                            <div class="text">
                                                <h2>€<?php 
                                                    if($total!=null) {
                                                        echo $total;
                                                    }
                                                    else {
                                                        echo 0;
                                                    }?></h2>
                                                <span>total des ventes</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="au-card recent-report">
                                    <div class="au-card-inner">
                                        <h3 class="title-2">Nombre de téléphones par marque</h3>
                                        <div class="recent-report__chart">
                                            <!--<canvas id="recent-rep-chart"></canvas>-->
                                            <canvas id="canvas"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="au-card chart-percent-card">
                                    <div class="au-card-inner">
                                        <h3 class="title-2 tm-b-5">Statistiques sur les offres</h3>
                                        <div class="row no-gutters">
                                            <div class="col-xl-6">
                                                <div class="chart-note-wrap">
                                                    <div class="chart-note mr-0 d-block">
                                                        <span class="dot dot--green"></span>
                                                        <span>créée</span>
                                                    </div>
                                                    <div class="chart-note mr-0 d-block">
                                                        <span class="dot dot--red"></span>
                                                        <span>supprimée</span>
                                                    </div>
                                                    <div class="chart-note mr-0 d-block">
                                                        <span class="dot dot--blue"></span>
                                                        <span>modifiée</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="percent-chart">
                                                    <canvas id="percent-chart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="title-1 m-b-25">Les 10 dernières ventes</h2>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>date</th>
                                                <th>Offre ID</th>
                                                <th>article</th>
                                                <th class="text-right">prix</th>
                                                <th class="text-right">quantité</th>
                                                <th class="text-right">total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            while ($rep = $sales->fetch()) {
                                                $total_price = $rep[2]*$rep[12];
                                                $article_name = $rep[9] . ' ' .$rep[10] . ' ' . $rep[15] . 'Go ' . $rep[11];
                                                echo'
                                                <tr>
                                                    <td>'. $rep[5] .'</td>
                                                    <td>'. $rep[1] .'</td>
                                                    <td>'. $article_name .'</td>
                                                    <td class="text-right">€'. $rep[12] .'</td>
                                                    <td class="text-right">'. $rep[2] .'</td>
                                                    <td class="text-right">€'. $total_price .'</td>
                                                </tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <h2 class="title-1 m-b-25">Top vendeurs</h2>
                                <div class="au-card au-card--bg-blue au-card-top-countries m-b-40">
                                    <div class="au-card-inner">
                                        <div class="table-responsive">
                                            <table class="table table-top-countries">
                                                <tbody>
                                                    <?php
                                                    while ($rep = $top->fetch()) {
                                                        echo '<tr>
                                                            <td>'. $rep[3] . ' ' . $rep[2] .'</td>
                                                            <td class="text-right">€'. $rep[0] .'</td>
                                                            </tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>
<script src="vendor/wow/wow.min.js"></script>
<script src="vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="vendor/counter-up/jquery.counterup.min.js"></script>
<script src="vendor/chartjs/Chart.bundle.min.js"></script>
<script type="text/javascript" src="vendor/select2/select2.min.js"></script>

<script type="text/javascript">
try {
    var data = {
    labels: ["Apple", "Samsung", "Huawei", "Wiko","Autre"],
    datasets: [
        {
            label: "Nombre",
            backgroundColor: [
                'rgba(193, 220, 222, 0.6)',
                'rgba(75, 164, 171, 0.6)',
                'rgba(52, 113, 117, 0.6)',
                'rgba(29, 87, 117, 0.6)'
            ],
            borderColor: [
                'rgba(193, 220, 222, 1)',
                'rgba(75, 164, 171, 1)',
                'rgba(52, 113, 117, 1)',
                'rgba(29, 87, 117, 1)'
            ],
            borderWidth: 5,
            data: [<?php echo $apple; ?>, <?php echo $samsung; ?>, <?php echo $huawei; ?>, <?php echo $wiko; ?>, <?php echo $autre; ?>],
        }
    ]
};

var ctx = document.getElementById("canvas");

var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: data,
  options: {
    scales: {
            xAxes: [{
                stacked: true
            }],
            yAxes: [{
                stacked: true
            }]
  }
}
});

    <?php 
        $stats = Model::$pdo->query("SELECT * FROM p_stats LIMIT 1");
        $rep = $stats->fetch();
    ?>
// Percent Chart
    var ctx = document.getElementById("percent-chart");
    if (ctx) {
      ctx.height = 280;
      var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          datasets: [
            {
              label: "Statistiques",
              data: [<?php echo $rep[0] . ',' . $rep[1] .',' . $rep[2];?>],
              backgroundColor: [
                '#36E30F',
                '#fa4251',
                '#00b5e9'
              ],
              hoverBackgroundColor: [
                '#36E30F',
                '#fa4251',
                '#00b5e9'
              ],
              borderWidth: [
                4, 4, 4
              ],
              hoverBorderColor: [
                'transparent',
                'transparent',
                'transparent'
              ]
            }
          ],
          labels: [
            'Créee',
            'Supprimée',
            'Modifiée'
          ]
        },
        options: {
          maintainAspectRatio: false,
          responsive: true,
          cutoutPercentage: 55,
          animation: {
            animateScale: true,
            animateRotate: true
          },
          legend: {
            display: false
          },
          tooltips: {
            titleFontFamily: "Poppins",
            xPadding: 15,
            yPadding: 10,
            caretPadding: 0,
            bodyFontSize: 16
          }
        }
      });
    }
} catch(error){
    console.log(error);
}
</script>
<script type="text/javascript">
$('#help_button').click(function(){
    $('#help_slide').slideToggle('slow');
});
$('#list_user_button').click(function(){
    document.location.href="index.php?action=readAll&controller=utilisateur";
});
</script>