<?php $__env->startSection('title', 'Panel Administracion'); ?>

<?php $__env->startSection('css'); ?>

<style>
#chartdiv-registered-raffles, #chartdiv-tickets-raffles {
  width: 100%;
  height: 500px;
}

#chartdiv-companies, #chartdiv-user-companies {
  width: 100%;
  height: 600px;
}

.btn-filter{
    background-color: #1e3d59;
    color: #f5f0e1;
}

.btn-filter:hover, .btn-filter-active{
    background-color: #f5f0e1;
    color: #ff6e40;
}

.chart-title {
    font-family:sans-serif; 
    margin-left:20%
}

</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">

        <!-- Start sidebar -->
        <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End sidebar -->

        <!-- Main -->
        <div class="content special-card col-md-11 pt-3 mx-auto min-vh-100">
            <div class="card col-12 min-vh-100 my-5">
            
                <div class="row">
                    <div class="mt-4 mb-4 col-12">
                        <h1 class="ml-3 p-4 d-inline special-title">Resumen</h1>
                    </div>
                
                    <div class="col-8 row ml-3 mt-2 mb-5">
                        <div class="col-md-2">
                            <form >
                                <input type="hidden" name="filter" value="1">
                                <button class="btn btn-light w-100 btn-filter <?php echo e(isset($filter) && $filter == 1 ? 'btn-filter-active' : ''); ?>"><i class="fas fa-calendar-day"></i> Mes actual</button>
                            </form>
                        </div>

                        <div class="col-md-2">
                            <form >
                                <input type="hidden" name="filter" value="2">
                                <button class="btn btn-light w-100 btn-filter <?php echo e(isset($filter) && $filter == 2 ? 'btn-filter-active' : ''); ?>"><i class="fas fa-calendar-week"></i> Semestral</button>
                            </form>
                        </div>

                        <div class="col-md-2">
                            <form>
                                <input type="hidden" name="filter" value="3">
                                <button class="btn btn-light w-100 btn-filter <?php echo e(isset($filter) && $filter == 3 ? 'btn-filter-active' : ''); ?>"><i class="far fa-calendar-alt"></i> Anual</button>
                            </form>
                        </div>

                        <div class="col-md-2">
                            <form >
                                <input type="hidden" name="filter" value="4">
                                <button class="btn btn-light w-100 btn-filter <?php echo e(isset($filter) && $filter == 4 ? 'btn-filter-active' : ''); ?>"><i class="fas fa-clipboard-list"></i> Total</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-6 mb-5">
                        <div id="chartdiv-registered-raffles"></div>
                    </div>

                    <div class="col-6 mb-5">
                        <div id="chartdiv-tickets-raffles"></div>
                    </div>

                    <?php if(Auth::user()->role_id !== 2): ?>
                      <div class="col-6 my-5">
                          <h3 class="chart-title">Top Empresas que mas publicaron (<?php echo e($title); ?>)</h3>
                          <div id="chartdiv-companies"></div>
                      </div>

                      <div class="col-6 my-5">
                          <h3 class="chart-title">Top Usuarios mas activos (<?php echo e($title); ?>)</h3>
                          <div id="chartdiv-user-companies"></div>
                      </div>
                    <?php else: ?>
                      <div class="col-6 my-5">
                          <div id="chartdiv-companies" style="display: none;"></div>
                      </div>

                      <div class="col-6 my-5">
                          <div id="chartdiv-user-companies" style="display: none;"></div>
                      </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <!-- End Main -->
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<!--------------------------------------------------------------------------- GRAFICO DE SORTEOS -------------------------------------------------------------------------------->
<script>
am5.ready(function() {

var chartData = <?php echo json_encode($registeredRaffles); ?>;
var centerLabel = <?php echo json_encode($title); ?>;


// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv-registered-raffles");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
var chart = root.container.children.push(am5percent.PieChart.new(root, {
  innerRadius: 100,
  layout: root.verticalLayout
}));


// Create series
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
var series = chart.series.push(am5percent.PieSeries.new(root, {
  name: "Sorteos",
  valueField: "size",
  categoryField: "sector",
  legendLabelText: "[{fill}]{category}[/]",
  legendValueText: "[bold {fill}]:{value}[/]"
}));

chart.rtl = true;

// Set data
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
series.data.setAll(chartData);

// Add label
var label = root.tooltipContainer.children.push(am5.Label.new(root, {
  x: am5.p50,
  y: am5.p50,
  centerX: am5.p50,
  centerY: am5.p50,
  fill: am5.color(0x000000),
  fontSize: 25
}));

/* Set label text */
label.set("text", centerLabel);

/* Set top tittle */
chart.children.unshift(am5.Label.new(root, {
  text: "Sorteos registrados",
  fontSize: 25,
  fontWeight: "500",
  textAlign: "center",
  x: am5.percent(50),
  centerX: am5.percent(50),
  paddingTop: 0,
  paddingBottom: 0
}));

// Add legend
var legend = chart.children.push(am5.Legend.new(root, {
	centerX: am5.percent(50),
    x: am5.percent(50),
    layout: am5.GridLayout.new(root, {
    maxColumns: 4,
    fixedWidthGrid: true
  })
}));

legend.data.setAll(series.dataItems);

});
</script>


<!--------------------------------------------------------------------------- GRAFICO DE TICKETS -------------------------------------------------------------------------------->
<script>
am5.ready(function() {

// orderable_date => fecha, requested => tickets pendientes de pago, paid => tickets pagados
var chartData = <?php echo json_encode($ticketsTransactions); ?>;
var centerLabel = <?php echo json_encode($title); ?>;

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv-tickets-raffles");

// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([am5themes_Animated.new(root)]);

// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(
  am5xy.XYChart.new(root, {
    panX: false,
    panY: false,
    wheelX: "panX",
    wheelY: "zoomX",
    layout: root.verticalLayout
  })
);

// Add scrollbar
// https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
chart.set(
  "scrollbarX",
  am5.Scrollbar.new(root, {
    orientation: "horizontal"
  })
);

// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xAxis = chart.xAxes.push(
  am5xy.CategoryAxis.new(root, {
    categoryField: "orderable_date",
    renderer: am5xy.AxisRendererX.new(root, {}),
    tooltip: am5.Tooltip.new(root, {})
  })
);

xAxis.data.setAll(chartData);

var yAxis = chart.yAxes.push(
  am5xy.ValueAxis.new(root, {
    min: 0,
    extraMax: 0.1,
    renderer: am5xy.AxisRendererY.new(root, {})
  })
);


// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/

var series1 = chart.series.push(
  am5xy.ColumnSeries.new(root, {
    name: "Pendientes",
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: "requested",
    categoryXField: "orderable_date",
    tooltip:am5.Tooltip.new(root, {
      pointerOrientation:"horizontal",
      labelText:"{valueY} {info} pagos pendientes"
    })
  })
);

series1.columns.template.setAll({
  tooltipY: am5.percent(10),
  templateField: "columnSettings"
});

series1.data.setAll(chartData);

var series2 = chart.series.push(
  am5xy.LineSeries.new(root, {
    name: "Pago registrado",
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: "paid",
    categoryXField: "orderable_date",
    tooltip:am5.Tooltip.new(root, {
      pointerOrientation:"horizontal",
      labelText:"{valueY} {info} pagos registrados"
    })    
  })
);

series2.strokes.template.setAll({
  strokeWidth: 3,
  templateField: "strokeSettings"
});


series2.data.setAll(chartData);

series2.bullets.push(function () {
  return am5.Bullet.new(root, {
    sprite: am5.Circle.new(root, {
      strokeWidth: 3,
      stroke: series2.get("stroke"),
      radius: 5,
      fill: root.interfaceColors.get("background")
    })
  });
});

chart.set("cursor", am5xy.XYCursor.new(root, {}));

/* Set top tittle */
chart.children.unshift(am5.Label.new(root, {
  text: "Registro de tickets (" + centerLabel + ")",
  fontSize: 25,
  fontWeight: "500",
  textAlign: "center",
  y: am5.percent(-2),
  x: am5.percent(50),
  centerX: am5.percent(50),
  paddingTop: 0,
  paddingBottom: 0
}));


// Add legend
// https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
var legend = chart.children.push(
  am5.Legend.new(root, {
    centerX: am5.p50,
    x: am5.p50
  })
);
legend.data.setAll(chart.series.values);

// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
chart.appear(1000, 100);
series1.appear();

}); // end am5.ready()
</script>


<!--------------------------------------------------------------------------- GRAFICO DE EMPRESAS -------------------------------------------------------------------------------->
<script>
am5.ready(function() {


var chartData = <?php echo json_encode($movements); ?>;
var centerLabel = <?php echo json_encode($title); ?>;

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv-companies");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
  panX: false,
  panY: false,
  wheelX: "none",
  wheelY: "none"
}));

// We don't want zoom-out button to appear while animating, so we hide it
chart.zoomOutButton.set("forceHidden", true);


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var yRenderer = am5xy.AxisRendererY.new(root, {
  minGridDistance: 30
});

var yAxis = chart.yAxes.push(am5xy.CategoryAxis.new(root, {
  maxDeviation: 0,
  categoryField: "company",
  renderer: yRenderer,
  tooltip: am5.Tooltip.new(root, { themeTags: ["axis"] })
}));

var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
  maxDeviation: 0,
  min: 0,
  extraMax:0.1,
  renderer: am5xy.AxisRendererX.new(root, {})
}));


// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(am5xy.ColumnSeries.new(root, {
  name: "Empresas",
  xAxis: xAxis,
  yAxis: yAxis,
  valueXField: "count",
  categoryYField: "company",
  tooltip: am5.Tooltip.new(root, {
    pointerOrientation: "left",
    labelText: "{valueX}"
  })
}));


// Rounded corners for columns
series.columns.template.setAll({
  cornerRadiusTR: 5,
  cornerRadiusBR: 5
});

// Make each column to be of a different color
series.columns.template.adapters.add("fill", function(fill, target) {
  return chart.get("colors").getIndex(series.columns.indexOf(target));
});

series.columns.template.adapters.add("stroke", function(stroke, target) {
  return chart.get("colors").getIndex(series.columns.indexOf(target));
});

yAxis.data.setAll(chartData);
series.data.setAll(chartData);
sortCategoryAxis();

// Get series item by category
function getSeriesItem(category) {
  for (var i = 0; i < series.dataItems.length; i++) {
    var dataItem = series.dataItems[i];
    if (dataItem.get("categoryY") == category) {
      return dataItem;
    }
  }
}

chart.set("cursor", am5xy.XYCursor.new(root, {
  behavior: "none",
  xAxis: xAxis,
  yAxis: yAxis
}));


// Axis sorting
function sortCategoryAxis() {

  // Sort by value
  series.dataItems.sort(function(x, y) {
    return x.get("valueX") - y.get("valueX"); // descending
    //return y.get("valueY") - x.get("valueX"); // ascending
  })

  // Go through each axis item
  am5.array.each(yAxis.dataItems, function(dataItem) {
    // get corresponding series item
    var seriesDataItem = getSeriesItem(dataItem.get("category"));

    if (seriesDataItem) {
      // get index of series data item
      var index = series.dataItems.indexOf(seriesDataItem);
      // calculate delta position
      var deltaPosition = (index - dataItem.get("index", 0)) / series.dataItems.length;
      // set index to be the same as series data item index
      dataItem.set("index", index);
      // set deltaPosition instanlty
      dataItem.set("deltaPosition", -deltaPosition);
      // animate delta position to 0
      dataItem.animate({
        key: "deltaPosition",
        to: 0,
        duration: 1000,
        easing: am5.ease.out(am5.ease.cubic)
      })
    }
  });

  // Sort axis items by index.
  // This changes the order instantly, but as deltaPosition is set,
  // they keep in the same places and then animate to true positions.
  yAxis.dataItems.sort(function(x, y) {
    return x.get("index") - y.get("index");
  });
}

series.columns.template.setAll({
    height: am5.percent(20),
});

// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series.appear(1000);
chart.appear(1000, 100);

}); // end am5.ready()
</script>


<!--------------------------------------------------------------------------- GRAFICO DE USUARIOS -------------------------------------------------------------------------------->

<script>
am5.ready(function() {

var chartData = <?php echo json_encode($companiesUsers); ?>;
var centerLabel = <?php echo json_encode($title); ?>;


$.each(chartData, function(index, value){

    value.photo = value.photo !== null ? value.photo : "default.png";

    chartData[index]['pictureSettings'] = {src: "<?php echo e(asset('storage/users')); ?>/" + value.photo};
});
console.log(chartData);


// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv-user-companies");

// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);

// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(
  am5xy.XYChart.new(root, {
    panX: false,
    panY: false,
    wheelX: "none",
    wheelY: "none",
    paddingLeft: 50,
    paddingRight: 40
  })
);

// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/

var yRenderer = am5xy.AxisRendererY.new(root, {});
yRenderer.grid.template.set("visible", false);

var yAxis = chart.yAxes.push(
  am5xy.CategoryAxis.new(root, {
    categoryField: "username",
    renderer: yRenderer,
    paddingRight:40
  })
);

var xRenderer = am5xy.AxisRendererX.new(root, {});
xRenderer.grid.template.set("strokeDasharray", [3]);

var xAxis = chart.xAxes.push(
  am5xy.ValueAxis.new(root, {
    min: 0,
    renderer: xRenderer
  })
);

// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(
  am5xy.ColumnSeries.new(root, {
    name: "Usuario",
    xAxis: xAxis,
    yAxis: yAxis,
    valueXField: "count",
    categoryYField: "username",
    sequencedInterpolation: true,
    calculateAggregates: true,
    maskBullets: false,
    tooltip: am5.Tooltip.new(root, {
      dy: -30,
      pointerOrientation: "vertical",
      labelText: "{valueX}"
    })
  })
);

series.columns.template.setAll({
  strokeOpacity: 0,
  cornerRadiusBR: 10,
  cornerRadiusTR: 10,
  cornerRadiusBL: 10,
  cornerRadiusTL: 10,
  maxHeight: 50,
  fillOpacity: 0.8
});

var currentlyHovered;

series.columns.template.events.on("pointerover", function(e) {
  handleHover(e.target.dataItem);
});

series.columns.template.events.on("pointerout", function(e) {
  handleOut();
});

series.columns.template.setAll({
    height: am5.percent(25),
});

function handleHover(dataItem) {
  if (dataItem && currentlyHovered != dataItem) {
    handleOut();
    currentlyHovered = dataItem;
    var bullet = dataItem.bullets[0];
    bullet.animate({
      key: "locationX",
      to: 1,
      duration: 600,
      easing: am5.ease.out(am5.ease.cubic)
    });
  }
}

function handleOut() {
  if (currentlyHovered) {
    var bullet = currentlyHovered.bullets[0];
    bullet.animate({
      key: "locationX",
      to: 0,
      duration: 600,
      easing: am5.ease.out(am5.ease.cubic)
    });
  }
}


var circleTemplate = am5.Template.new({});

series.bullets.push(function(root, series, dataItem) {
  var bulletContainer = am5.Container.new(root, {});
  var circle = bulletContainer.children.push(
    am5.Circle.new(
      root,
      {
        radius: 34
      },
      circleTemplate
    )
  );

  var maskCircle = bulletContainer.children.push(
    am5.Circle.new(root, { radius: 27 })
  );

  // only containers can be masked, so we add image to another container
  var imageContainer = bulletContainer.children.push(
    am5.Container.new(root, {
      mask: maskCircle
    })
  );

  // not working
  var image = imageContainer.children.push(
    am5.Picture.new(root, {
      templateField: "pictureSettings",
      centerX: am5.p50,
      centerY: am5.p50,
      width: 60,
      height: 60
    })
  );

  return am5.Bullet.new(root, {
    locationX: 0,
    sprite: bulletContainer
  });
});

// heatrule
series.set("heatRules", [
  {
    dataField: "valueX",
    min: am5.color(0xe5dc36),
    max: am5.color(0x5faa46),
    target: series.columns.template,
    key: "fill"
  },
  {
    dataField: "valueX",
    min: am5.color(0xe5dc36),
    max: am5.color(0x5faa46),
    target: circleTemplate,
    key: "fill"
  }
]);

series.data.setAll(chartData);
yAxis.data.setAll(chartData);

var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
cursor.lineX.set("visible", false);
cursor.lineY.set("visible", false);

cursor.events.on("cursormoved", function() {
  var dataItem = series.get("tooltip").dataItem;
  if (dataItem) {
    handleHover(dataItem)
  }
  else {
    handleOut();
  }
})

// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series.appear();
chart.appear(1000, 100);

}); // end am5.ready()
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/sortealo/resources/views/panel/index.blade.php ENDPATH**/ ?>