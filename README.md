# PHP Google Charts
It is a PHP wrapper of Google Visualization API and also contains DB class to get graphs based on SQL query results.
Currenlty it supports Line Chart, Column Chart and Guage only.

Please make sure that you have included Google API in HTML Page

```
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
```

## Column Chart from SQL Query

```
require_once('classes/classGRAPH.php');
require_once('classes/classDB.php');
	
$hostname = "<host>:<port>";
$username = "<username>";
$password = "<password>";
$dbname = "<database>";

$objDB = new mysql_db();
$objDB->sql_connect( $hostname, $username, $password, $dbname );

$ColumnChart = new Graph();
				
$ColumnChart->set_graphTitle ( "Hits Summary");
$ColumnChart->set_graphXLabel ( "Hour" );
$ColumnChart->set_graphYLabel ( "Total Hits" );
				
$ColumnChart->set_chartColumns ( array("Hour","Total Hits") );
			
$result = $objDB->query("select Hour(datetime) as hour, count(*) as hits from hits group by 1 order by 1 desc;");
				
$index = 0;
while($line = $objDB->fetch_row($result)) {
	$rows [$index][0] = $line['hour'];
	$rows [$index][1] = $line['hits'];
	$index++;
}
	
$ColumnChart->set_chartRows( $rows );
$ColumnChart->set_chartGraph( "ColumnChart" );
$ColumnChart->get_chartGraph();

$objDB->sql_close();
```

## Line Chart from Static Values
```
require_once('classes/classGRAPH.php');
require_once('classes/classDB.php');

$LineChart = new Graph();
				
$LineChart->set_graphTitle ( "Hits Summary" );
$LineChart->set_graphXLabel ( "Hour" );
$LineChart->set_graphYLabel ( "Total Hits" );
				
$LineChart->set_chartColumns ( array("Hour","Total Hits") );
				
$rows = array( 0 => array(0,5), 1 => array(1,10), 2 => array(2,15), 3 => array(3,20) );
				
$LineChart->set_chartRows( $rows );
$LineChart->set_chartGraph( "LineChart" ); 
$LineChart->get_chartGraph();
```

