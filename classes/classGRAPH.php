<?php

class Graph {
	
	function __construct () {
		$this->graph_id = "chart_div_".rand();
		$this->graphTitle = null;
		$this->xLabel = null;
		$this->ylabel = null;
		$this->pie3D = false;
		$this->donutDia = 0.0;
		$this->columns = null;
		$this->rows = null;
		$this->options = null;
		$this->guageWidth = 400; 
		$this->guageHeight = 120;
        $this->guageRedFrom = 90; 
        $this->guageRedTo = 100;
        $this->guageYellowFrom = 75; 
        $this->guageYellowTo = 90;
        $this->guageMinorTicks = 5;
	}
//======================================================================================================================================	
	function get_graphID () {
		return $this->graph_id;
	}
//======================================================================================================================================	
	function set_graphTitle( $title ) {
		$this->graphTitle = $title;	
	}
//======================================================================================================================================	
	function get_graphTitle() {
		return $this->graphTitle;
	}
//======================================================================================================================================	
	function set_graphXLabel ( $xlabel ) {
		$this->xLabel = $xlabel;
	}
//======================================================================================================================================	
	function get_graphXLabel () {
		return $this->xLabel;
	}
//======================================================================================================================================	
	function set_graphYLabel ( $ylabel ) {
		$this->ylabel = $ylabel;
	}
//======================================================================================================================================	
	function get_graphYLabel () {
		return $this->ylabel;
	}
//======================================================================================================================================	
	function set_graph3DPie ( $flag ) {
		$this->pie3D = $flag;
	}	
//======================================================================================================================================	
	function get_graph3DPie () {
		return $this->pie3D;
	}	
//======================================================================================================================================	
	function set_graphDonutPie ( $diameter ) {
		$this->donutDia = $diameter;
	}	
//======================================================================================================================================	
	function get_graphDonutPie () {
		return $this->donutDia;
	}
//======================================================================================================================================	
	function set_guageSize ( $width, $height ) {
		$this->guageWidth = $width; 
		$this->guageHeight = $height;
	}
	
	function set_guageRed ( $redfrom, $redto ) {
		$this->guageRedFrom = $redfrom; 
        $this->guageRedTo = $redto;
	}
	
	function set_guageYellow ( $yellowfrom, $yellowto ) {
		$this->guageYellowFrom = $yellowfrom; 
        $this->guageYellowTo = $yellowto;
	}
	
	function set_guageTicks ( $minorticks ) {
		 $this->guageMinorTicks = $minorticks;	
	}
//======================================================================================================================================	
	function get_guageOptions () {
		return " 	width: ".$this->guageWidth.", height: ".$this->guageHeight.",
					redFrom: ".$this->guageRedFrom.", redTo: ".$this->guageRedTo.",
					yellowFrom: ".$this->guageYellowFrom.", yellowTo: ".$this->guageYellowTo.",
					minorTicks: ".$this->guageMinorTicks;
	}		
	
//======================================================================================================================================	
	function set_chartColumns ( $columns ) {
		for ($index = 0; $index < count($columns); $index++) {
			$this->columns[$index] = "'".$columns[$index]."'"; 
		}
	}
//======================================================================================================================================		
	function get_chartColumns () {
			return "[".implode(", ",$this->columns)."]";  
	}
//======================================================================================================================================	
	function set_chartRows ( $rows ) {
		for ($index = 0; $index < count($rows); $index++) {
			
			for ($index2 = 0; isset($rows[$index][$index2]); $index2++) {
				
				if($index2 == 0) 
					$single_row[$index2] = "'".$rows[$index][$index2]."'";
				else 
					$single_row[$index2] = $rows[$index][$index2];
			}
			$this->rows[$index] = "[".implode(", ", $single_row)."]";
		}	
	}
//======================================================================================================================================		
	function get_chartRows () {
		return implode(", ",$this->rows);		
	}
//======================================================================================================================================	
	function get_graphOptions ( $type ) {
		$index = -1;
		if( $this->get_graphTitle() != null ) {
				$index++;	 
				$this->options[$index] = "title: '".$this->get_graphTitle()."'";
		}
		if( $this->get_graphYLabel() != null ) {
				$index++;
				$this->options[$index] = "vAxis: {title: '".$this->get_graphYLabel()."'}";
		}
		if( $this->get_graphXLabel() != null ) {
				$index++;
				$this->options[$index] = "hAxis: { title: '".$this->get_graphXLabel()."' }";
		}
		if( $this->get_graph3DPie() != false && $type == "PieChart" ) {
				$index++;
				$this->options[$index] = "is3D: ".$this->get_graph3DPie().",";
		}
		if( $this->get_graphDonutPie() != 0.0 && $type == "PieChart" ) {
				$index++;
				$this->options[$index] = "pieHole: ".$this->get_graphDonutPie().",";
		}
		
		if( $type == "Gauge" ) return $this->get_guageOptions();
		else return implode(", ", $this->options); 
	}
//======================================================================================================================================	
#type: ColumnChart, LineChart, PieChart, Gauge
	function set_chartGraph ( $type ) {
		echo "			<script type=\"text/javascript\">
								google.load(\"visualization\", \"1\", {packages:[\"corechart\"]});
								google.setOnLoadCallback(drawChart);

								function drawChart() {
											var data = google.visualization.arrayToDataTable([ ".$this->get_chartColumns().", ".$this->get_chartRows()." ]);
											var options = { ".$this->get_graphOptions( $type )."};
											var chart = new google.visualization.".$type."(document.getElementById('".$this->get_graphID()."'));
											chart.draw(data, options);
								}
						</script>";
	}
//======================================================================================================================================	
	function get_chartGraph() {
		echo " <div id=\"".$this->get_graphID()."\"></div> ";
	}
//======================================================================================================================================
	function get_chartGraph_with_CustomSize( $height, $width ) {
		echo " <div id=\"".$this->get_graphID()."\" style=\"width: ".$width."px; height: ".$height."px;\"></div> ";
	}	
//======================================================================================================================================	

}

