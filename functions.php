<?php

$main_function=$_REQUEST["function"];
$main_function();

function search_countries() {
    $countryName = $_REQUEST["countryName"];

    // Read content from the rest countries website and save it as a string
    $content = file_get_contents('https://restcountries.eu/rest/v2/name/' . $countryName);
    $content = json_decode($content);

    // Display alert when results has more than 50 countries
    if (count($content) > 50) {
        echo "<div class='top-countries-data'>";
        echo "<p class='result-alert'>Only displaying first 50 results</p>";
        echo "<h3>Total number of countries: " . count($content) . ', only displaying first 50 results' ."</h3>";
        echo "</div>";
    } else {
        echo "<div class='top-countries-data'>";
        echo "<h3>Total number of countries: " . count($content) . "</h3>";
        echo "</div>";
    }

    // If content is not empty create table and display results
    if ($content != null && $content != '') {
        echo "<div itemscope itemtype='http://schema.org/Table'>";
      	echo "<table class='main'>";
        		echo "<tr>";
          			echo "<th itemprop='about'>Country</th>";
          			echo "<th itemprop='about'>Alpha Code 2</th>";
          			echo "<th itemprop='about'>Alpha Code 3</th>";
          			echo "<th itemprop='about'>Flag</th>";
          			echo "<th itemprop='about'>Region</th>";
          			echo "<th itemprop='about'>Subregion</th>";
          			echo "<th itemprop='about'>Population</th>";
          			echo "<th itemprop='about'>Language(s)</th>";
        		echo "</tr>";

        // Limit results to 50
        if (count($content) <= 50) {
        	 $limit = count($content);
        }
        else {
        	 $limit = 50;
        }

        // If search criteria has results only display first 50
        for ($name = 0; $name < $limit; $name++) {
          	echo "<tr>";
            		echo "<td>" . $content[$name]->name . "</td>";
            		echo "<td>" . $content[$name]->alpha2Code . "</td>";
            		echo "<td>" . $content[$name]->alpha3Code . "</td>";
            		echo "<td><img class='country-image' src='" . $content[$name]->flag . "' alt='" . $content[$name]->name . "'/></td>";
            		echo "<td>" . $content[$name]->region . "</td>";
            		echo "<td>" . $content[$name]->subregion . "</td>";
            		echo "<td>" . number_format($content[$name]->population) . "</td>";
            		echo "<td>";
              			for ($language = 0; $language < count($content[$name]->languages); $language++) {
              				// If more than one language create a new line
              				if (count($content[$name]->languages) > 1) {
              					echo $content[$name]->languages[$language]->name . "<br>";
              				}
              				else {
              					echo $content[$name]->languages[$language]->name;
              				}
              			}
            		echo "</td>";
          	echo "</tr>";
        }
        echo "</table>";
        echo "</div>";

        // Display region and subregion results
        echo "<div class='bottom-countries-data'>";

        echo "<h3>Regions:</h3>";
        echo "<ul>";

    		// Create array for regions
    		$resultRegions = [];

    		foreach ($content as &$region) {
      			array_push($resultRegions,$region->region);
    		}

    		// For each region add number of times it appears
    		$regionTotals = array_count_values($resultRegions);
    		foreach ($regionTotals as $language_list => $value) {

      			if ($language_list != null || $language_list != "") {
      				    echo "<li>" . $language_list . " (" . $value . ")</li>";
      			}
    		}

      	echo "</ul>";

      	echo "<h3>Subregions: </h3>";
      	echo "<ul>";

    		// Create array for subregions
    		$resultSubregions = [];

    		foreach ($content as &$subregion) {
    			array_push($resultSubregions,$subregion->subregion);
    		}

    		// For each subregion add number of times it appears
    		$subregionTotals = array_count_values($resultSubregions);
    		foreach ($subregionTotals as $language_list => $value) {

      			if ($language_list != null || $language_list != "") {
      				echo "<li>" . $language_list . " (" . $value . ")</li>";
      			}
    		}

      	echo "</ul>";
        echo "</div>";
      }

      // Display error message if no results are found
      else {
      	 echo "<div class='error-message'>The criteria you entered has no results. Please try again.</div>";
      }
}
