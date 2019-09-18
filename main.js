function searchCountryScript() {
  	var countryName = document.getElementById("countryName").value;

  	// Checking value
  	if (countryName != "") {
    		var xhttp = new XMLHttpRequest();
    		xhttp.open("GET", "functions.php?function=search_countries&countryName=" + countryName, false);
    		xhttp.send();
    		document.getElementById("countriesTable").innerHTML = xhttp.responseText;
  	}
  	// If input is blank display alert
  	else {
  		  window.alert("Please enter a value for country name.");
  	}
}
