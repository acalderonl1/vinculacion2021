<?php
namespace PHPMaker2019\LiveBrief;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 
?>
<?php
$RELATIVE_PATH = "./core/";
$ROOT_RELATIVE_PATH = "./core/";
?>
<?php include_once $RELATIVE_PATH . "autoload.php" ?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$main = new main();

// Run the page
$main->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include "header.php" ?>
<table class="table"><tr><td style="display: block;width: 1024px; HEIGHT: 1024PX;">
<script src="https://cdn.anychart.com/releases/v8/js/anychart-base.min.js"></script>
  <script src="https://cdn.anychart.com/releases/v8/js/anychart-ui.min.js"></script>
  <script src="https://cdn.anychart.com/releases/v8/js/anychart-exports.min.js"></script>
  <script src="https://cdn.anychart.com/releases/v8/js/anychart-gantt.min.js"></script>
  <script src="https://cdn.anychart.com/releases/v8/js/anychart-data-adapter.min.js"></script>
  <link href="https://cdn.anychart.com/releases/v8/css/anychart-ui.min.css" type="text/css" rel="stylesheet">
  <link href="https://cdn.anychart.com/releases/v8/fonts/css/anychart-font.min.css" type="text/css" rel="stylesheet">
  <style type="text/css">

 
    #container {
      width: 100%;
      height: 100%;
      margin: 0;
      padding: 0;
	  display:table;
    }
  
</style>

  
  <div id="container"></div>
  

  <script>

    anychart.onDocumentReady(function () {
      // The data used in this sample can be obtained from the CDN
      // https://cdn.anychart.com/samples/gantt-charts/server-status-list/data.json
      anychart.data.loadJsonFile(
        'https://cdn.anychart.com/samples/gantt-charts/server-status-list/_data.json',
        function (data) {
          // create data tree on our data
          var treeData = anychart.data.tree(data, 'as-table');

          // create project gantt chart
          var chart = anychart.ganttResource();

          // set data for the chart
          chart.data(treeData);

          // set start splitter position settings
          chart.splitterPosition(320);

          // get chart data grid link to set column settings
          var dataGrid = chart.dataGrid();

          // hide first column
          dataGrid.column(0).enabled(false);

          // get chart timeline
          var timeLine = chart.getTimeline();
          // set base fill
          timeLine.elements().fill(function () {
            // get status from data item
            var status = this.period.status;

            // create fill object
            var fill = {
              // if this element has children, then add opacity to it
              opacity: this.item.numChildren() ? 1 : 0.6
            };

            // set fill color by status
            switch (status) {
              case 'online':
                fill.color = 'green';
                break;
              case 'maintenance':
                fill.color = 'orange';
                break;
              case 'offline':
                fill.color = 'red';
                break;
              default:
            }

            return fill;
          });

          // set base stroke
          timeLine.elements().stroke('none');
          // set select fill
          timeLine.elements().selected().fill('#ef6c00');

          // set first column settings
          var firstColumn = dataGrid.column(1);
          firstColumn.labels().hAlign('left');
          firstColumn
            .title('Server')
            .width(140)
            .labelsOverrider(labelTextSettingsOverrider)
            .labels()
            .format(function () {
              return this.name;
            });

          // set first column settings
          var secondColumn = dataGrid.column(2);
          secondColumn.labels().hAlign('right');
          secondColumn
            .title('Online')
            .width(60)
            .labelsOverrider(labelTextSettingsOverrider)
            .labels()
            .format(function () {
              return this.item.get('online') || '';
            });

          // set first column settings
          var thirdColumn = dataGrid.column(3);
          thirdColumn.labels().hAlign('right');
          thirdColumn
            .title('Maintenance')
            .width(60)
            .labelsOverrider(labelTextSettingsOverrider)
            .labels()
            .format(function () {
              return this.item.get('maintenance') || '';
            });

          // set first column settings
          var fourthColumn = dataGrid.column(4);
          fourthColumn.labels().hAlign('right');
          fourthColumn
            .title('Offline')
            .width(60)
            .labelsOverrider(labelTextSettingsOverrider)
            .labels()
            .format(function () {
              return this.item.get('offline') || '';
            });

          // set container id for the chart
          chart.container('container');

          // initiate chart drawing
          chart.draw();

          // zoom chart to specified date
          chart.zoomTo(
            Date.UTC(2008, 0, 31, 1, 36),
            Date.UTC(2008, 1, 15, 10, 3)
          );
        }
      );
    });

    function labelTextSettingsOverrider(label, item) {
      switch (item.get('status')) {
        case 'online':
          label.fontColor('green').fontWeight('bold');
          break;
        case 'maintenance':
          label.fontColor('orange').fontWeight('bold');
          break;
        case 'offline':
          label.fontColor('red').fontWeight('bold');
          break;
        default:
      }
    }
  
</script>
</body>
</html>
</td></tR></table>
<!-- %%Custom page content begin%% --><!-- %%Custom page content end%% --><?php if ('DEBUG_ENABLED') echo GetDebugMessage(); ?>
<?php include_once "footer.php" ?>
<?php
$main->terminate();
?>