

<html lang="en">

<head>
		<meta charset="utf-8">
		<link rel=stylesheet href="style.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans|Poppins&display=swap" rel="stylesheet">
		<script type="text/javascript" src="main.js"></script>
		<title>Rest Countries- by Kevin Wilgenbusch</title>
    <meta name="description" content="This is a software engineer technical assessment.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
		<h1>Rest Countries</h1>
		<div id="restForm">
				<form>
						<input name="countryName" type="text" alt="countryName" id="countryName" placeholder="Enter country name or code" autofocus required>
						<input type="button" class="filter-button" alt="search_countries" id="search_countries" onclick="searchCountryScript();" value="Search">
				</form>
		</div>
		<div id="countriesTable">
		</div>
</body>
<footer>
		Proudly developed by Kevin Wilgenbusch
</footer>

</html>
