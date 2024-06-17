<?php 
  include_once("../../controller/auth.php");
  include_once("../../model/query.php");
  adminAuth();
  $data = userData();

  $schema = new Schema;
  $total_user = $schema->totalRow('SELECT * FROM tbl_users');
  $total_book = $schema->totalRow('SELECT * FROM tbl_books');
  $total_rented = $schema->totalRow('SELECT * FROM tbl_books WHERE status="Rented"');
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <title>Home | LMS</title>
 <?php
    include '../include/header.php';
  ?>
  <!-- Calendar  -->
  <link href="../../../template/plugins/full-calendar/dist/fullcalendar.css" rel="stylesheet" type="text/css">
</head>
<body class="sidebar-mini layout-navbar-fixed sidebar-open">
<div class="wrapper">

  <!-- Navbar -->
  <?php  include '../include/navbar.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php  include '../include/panel.php'; ?>
  <!-- /.panel -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">
                  <div class=" d-flex">
                    <div>
                      <img src="../../../img/widget.png" style="height: 30px; width:30px">
                    </div>
                    <div class="ml-1 mt-1" style="font-weight: bold">WIDGET</div> 
                  </div>
              </h5>

                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">

                 <div class="col-lg-4 col-6">
                  <!-- small card -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3><?php echo $total_user; ?></h3>

                      <p>User Registered</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-users"></i>
                    </div>
                    <a href="user.php" class="small-box-footer">
                      More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>

                <div class="col-lg-4 col-6">
                  <!-- small card -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3><?php echo $total_book; ?></h3>

                      <p>Book Registered</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-book"></i>
                    </div>
                    <a href="list_of_book.php" class="small-box-footer">
                      More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>

                <div class="col-lg-4 col-6">
                  <!-- small card -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3><?php echo $total_rented; ?></h3>

                      <p>Total book rent</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-book"></i>
                    </div>
                    <a href="rented_book.php" class="small-box-footer">
                      More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
                </div>

                </div>
                <!-- /.row -->
              </div>
              
            </div>
          </div>



        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fa fa-chevron-up"></i>
    </a>

  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php include '../include/footer.php'; ?>
  <!-- Main Footer -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<?php include '../include/js.php'; ?>
<script src="../../../template/plugins/moment/moment.min.js"></script>
<script src="../../../template/plugins/full-calendar/dist/fullcalendar.min.js" type="text/javascript"></script>
<script src="../../../template/plugins/amcharts/amcharts.js"></script>
<script src="../../../template/plugins/amcharts/pie.js"></script>
<script src="../../../template/plugins/amcharts/plugins/export/export.js"></script>
<script src="../../../template/plugins/amcharts/serial.js"></script>
<script type="text/javascript">
  $('#dashboard').addClass('active');

  var legend = "";
  var chart2 = "";
  var chartData2 = [
      
      {
          "category": "Rented",
          "total": 10,
"color": "#FCD202"
      },
      {
          "category": "Available",
          "total": 10,
"color": "#04D215"
      }
  ];
  


  AmCharts.ready(function () {
      // PIE CHART
      chart2 = new AmCharts.AmPieChart();

      // title of the chart
      chart2.addTitle("List of books", 16);

      chart2.dataProvider = chartData2;
      chart2.titleField = "category";
      chart2.valueField = "total";
      chart2.colorField = "color",
      chart2.sequencedAnimation = true;
      chart2.startEffect = "elastic";
      chart2.innerRadius = "30%";
      chart2.startDuration = 2;
      chart2.labelRadius = 15;
      chart2.balloonText = "<span style='font-size:18px'><b>Category: </b>[[title]]</span><br><span style='font-size:18px'><b>Total: </b>[[value]]</span>";
      // the following two lines makes the chart 3D
      chart2.depth3D = 10;
      chart2.angle = 15;
      legend = new AmCharts.AmLegend();
      legend.align = "center";
      legend.markerType = "square";
      chart2.addLegend(legend);
      chart2.addListener("clickSlice", function(event){
     
        });
    // WRITE
    chart2.write("chartdiv2");
  });



  var chart;
  var chartData = [
    {
      Month:'January', 
      Total: 1, 
      Color:'#FCD202'
    },
    {
      Month:'February', 
      Total: 2, 
      Color:'#FF6600'
    },
    {
      Month:'March', 
      Total: 3, 
      Color:'#FCD202'
    },
    {
      Month:'April', 
      Total: 4, 
      Color:'#FF6600'
    },
    {
      Month:'May', 
      Total: 5, 
      Color:'#FCD202'
    },
    {
      Month:'June', 
      Total: 6, 
      Color:'#FF6600'
    },
    {
      Month:'July', 
      Total: 7, 
      Color:'#FCD202'
    },
    {
      Month:'August', 
      Total: 8, 
      Color:'#FF6600'
    },
    {
      Month:'September', 
      Total: 9, 
      Color:'#FCD202'
    },
    {
      Month:'October', 
      Total: 10, 
      Color:'#FF6600'
    },
    {
      Month:'November', 
      Total: 11, 
      Color:'#FF6600'
    },
    {
      Month:'December', 
      Total: 12, 
      Color:'#FF6600'
    }
  ];
  var chart = AmCharts.makeChart("chartdiv", {
      type: "serial",
      dataProvider: chartData,
      categoryField: "Month",
      depth3D: 15,
      angle: 30,

      categoryAxis: {
          labelRotation: 30,
          gridPosition: "start"
      },

      valueAxes: [{
          title: "Total"
      }],

      graphs: [{

          valueField: "Total",
          colorField: "Color",
          type: "column",
          lineAlpha: 0,
          fillAlphas: 1,
          balloonText: "<span style='font-size:18px'>Month: <b>[[Month]]</b><br>Total: <b>[[value]]</b></span>"
      }],

      chartCursor: {
          cursorAlpha: 0,
          zoomable: false,
          categoryBalloonEnabled: false
      }
  });
  var legend2 = new AmCharts.AmLegend();
  chart.addTitle("Monthly borrowed", 16);
  chart.addListener("clickGraphItem", function(event) {
   
  });


  init_calendar();
            
  function  init_calendar() {
          
      if( typeof ($.fn.fullCalendar) === 'undefined'){ return; }
      //console.log('init_calendar');
          
      var date = new Date(),
          d = date.getDate(),
          m = date.getMonth(),
          y = date.getFullYear(),
          started,
          categoryClass;

      var calendar = $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: ''
        },
        selectable: true,
        selectHelper: true,
        select: function(start, end, allDay) {
          $('#fc_create').click();

          started = start;
          ended = end;

          $("#antoform").on("submit", function(e) {
          
              
            if (end) {
              ended = end;
            }

            categoryClass = $("#event_type").val();

            if (title) {
              calendar.fullCalendar('renderEvent', {
                  title: "Event: "+title,
                  start: started,
                  end: end,
                  allDay: allDay
                },
                true // make the event "stick"
              );
            }

            $('#title').val('');
              $('#descr').val('');

            calendar.fullCalendar('unselect');

            $('.antoclose').click();

            return false;
          });
        },
        eventClick: function(calEvent, jsEvent, view) {
           
            
        },
        editable: false,
        events: [],
         
      });
      
  };
</script>
</body>
</html>
