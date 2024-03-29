<?php
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Material Examined</title>	
	
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.css">
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.js"></script>
    


   <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<script src="https://cdn.jsdelivr.net/npm/ejs@2.6.1/ejs.min.js" integrity="sha256-ZS2YSpipWLkQ1/no+uTJmGexwpda/op53QxO/UBJw4I=" crossorigin="anonymous"></script>	

	<!-- <script src="js/jquery-1.11.2.min.js"></script> -->
	<!-- <script src="js/ejs.js"></script> -->

	<script>
	
        //--------------------------------------------------------------------------------
		var template_results = `
			<div>
				<table>
					<tbody>
						<tr>
							<th>Specimen</th>
							<th>Higher taxon</th>
							<th>Scientific name</th>
							<th>Type status</th>
							<th>Map</th>
							<th>Images</th>
							<th>GenBank</th>
							
						</tr>
				
				<% 
				var n = data.hits.length;
				for (var i = 0; i < n; i++) { %>
					<tr>
						<td style="width:200px;word-wrap:break-word;display:inline-block;">
						
							<a href="https://www.gbif.org/occurrence/<%= data.hits[i].key %>" target="_new">GBIF:<%= data.hits[i].key %></a>

						
							<%
							var code = '';

							if (data.hits[i].institutionCode) {
								code = data.hits[i].institutionCode;
							}
							if (data.hits[i].catalogNumber) {
								code += '&nbsp;' + data.hits[i].catalogNumber.replace(/\s/g, '&nbsp;');
							}
							
							%>
							
							<br /><span style="font-size:12px;color:green;"><%-  code  %></span>
							
							<%
							if (data.hits[i].occurrenceID) {
								var handled = false;
								var occurrenceUrl = '';
								var occurrenceID = '';
								
								if (!handled) {
									if (data.hits[i].institutionCode == 'NHMUK') {
										occurrenceUrl = 'https://data.nhm.ac.uk/object/' + data.hits[i].occurrenceID;
										occurrenceID = data.hits[i].occurrenceID;
										handled = true;
									}
								}
								
								if (!handled) {
									if (data.hits[i].occurrenceID.match(/^http/)) {
										occurrenceUrl = data.hits[i].occurrenceID;
										occurrenceID = data.hits[i].occurrenceID;
										handled = true;
									}
								}

								// USNM verts
								if (!handled) {
									if (data.hits[i].datasetKey == '5df38344-b821-49c2-8174-cf0f29f4df0d') {
										var verts=['Mammalia', 'Aves', 'Amphibia', 'Elasmobranchii', 'Reptilia', 'Actinopterygii'];
										if (verts.indexOf(data.hits[i].class) != -1) {
											 var parts = data.hits[i].occurrenceID.split('.');
											 occurrenceUrl = 'http://collections.si.edu/search/results.htm?q=record_ID:nmnhvz_' + parts[1];
										     occurrenceID = data.hits[i].occurrenceID;
											 handled = true;
										}
									}
								}
								

								// Harvard Herbarium
								if (!handled) {
									if (data.hits[i].datasetKey == '861e6afe-f762-11e1-a439-00145eb45e9a') {
										if (data.hits[i].extensions)
										{
											console.log(data.hits[i].extensions);
											if (data.hits[i].extensions["http://rs.tdwg.org/dwc/terms/ResourceRelationship"]) {
												for (var j in data.hits[i].extensions["http://rs.tdwg.org/dwc/terms/ResourceRelationship"]) {
													console.log(data.hits[i].extensions["http://rs.tdwg.org/dwc/terms/ResourceRelationship"][j]);
													if (data.hits[i].extensions["http://rs.tdwg.org/dwc/terms/ResourceRelationship"][j]["http://rs.tdwg.org/dwc/terms/relationshipOfResource"] == "sameAs") {
														occurrenceUrl = data.hits[i].extensions["http://rs.tdwg.org/dwc/terms/ResourceRelationship"][j]["http://rs.tdwg.org/dwc/terms/relatedResourceID"];
														occurrenceID = data.hits[i].occurrenceID;
														handled = true;													
													}
												}											
											}	
										}									
									}
								}
								
								
								// COI
								if (!handled) {
									if (data.hits[i].datasetKey == 'a559e942-0fbe-4f09-93ca-28cf244ce2a0') {
										if (data.hits[i].catalogNumber.match(/^http/)) {
											occurrenceUrl = data.hits[i].catalogNumber;
											occurrenceID = data.hits[i].catalogNumber;
											handled = true;
										}
									}
								}	
								
								if (!handled) {
									if (data.hits[i].references) {
										if (data.hits[i].references.match(/collections.peabody.yale.edu/)) {
											occurrenceUrl = data.hits[i].references;
											occurrenceID = data.hits[i].references;
											handled = true;
										}
									}
								}	
								
								// NCU
								if (!handled) {
									if (data.hits[i].datasetKey == '27b4ff4b-29c3-4017-9c48-3750861392f7') {
											occurrenceUrl = data.hits[i].references;
											occurrenceID = data.hits[i].occurrenceID;
											handled = true;
									}
								}	

								// NY
								if (!handled) {
									if (data.hits[i].datasetKey == 'd415c253-4d61-4459-9d25-4015b9084fb0') {
											occurrenceUrl = data.hits[i].references;
											occurrenceID = data.hits[i].occurrenceID;
											handled = true;
									}
								}	
								
								// AK
								if (!handled) {
									if (data.hits[i].datasetKey == '83ae84cf-88e4-4b5c-80b2-271a15a3e0fc') {
											occurrenceUrl = data.hits[i].references;
											occurrenceID = data.hits[i].identifier;
											handled = true;
									}
								}	
								
													       
					    		if (!handled) {
					       			occurrenceID = data.hits[i].occurrenceID;
					     		}
					     		
					     		if (handled) { %>
					     			<br /><a href="<%= occurrenceUrl %>" target="_new"><%= occurrenceID %></a>					     		
					     		<% }
							}
						%>
	
						</td>
						
						<%
						// higher taxon
					   var klass = '';
					   if (data.hits[i].class) {
					     klass = data.hits[i].class;
					   }
					   %>

						<td>
							<img style="opacity:0.5;vertical-align:middle" height="48" src="image.php?name=<%= klass %>" >
							<%= klass %>
						</td>

						<td>
							<%= data.hits[i].scientificName %>
						</td>

						<td>
						<%
					     
						   var typeStatus = '';
						   if (data.hits[i].typeStatus) {
							 typeStatus = data.hits[i].typeStatus;
						   } %>
						   <%= typeStatus %>						
						
						</td>
						<td>
							<% if (data.hits[i].decimalLatitude) {
							  var link = 'https://www.openstreetmap.org/?mlat=' 
							  	+ data.hits[i].decimalLatitude
							  	+ '&mlon=' + data.hits[i].decimalLongitude
							  	+ '&zoom=8';
							
					     	  var url = 'https://api.mapbox.com/styles/v1/mapbox/outdoors-v11/static';
							  var marker = '/pin-s-circle+285A98(' + + data.hits[i].decimalLongitude + ',' + data.hits[i].decimalLatitude + ')';
							  var pt = '/' + data.hits[i].decimalLongitude + ',' + data.hits[i].decimalLatitude;
							  var zoom = ',4';
							  var size = '/100x100';
							  var token='?access_token=pk.eyJ1IjoicmRtcGFnZSIsImEiOiJjajJrdmJzbW8wMDAxMnduejJvcmEza2k4In0.bpLlN9O6DylOJyACE8IteA';
							  
							  var map = url + marker + pt + zoom + size + token;
							%>
							  <a href="<%- link %>" target="_new">
							  <img src="<%- map %>">
							  </a>
							<% } %>
						
						</td>
						
						<td>
							<div>
							<% var media = [];
					   
					   
						   for (var j in data.hits[i].media) {
							  if (data.hits[i].media[j].type) {
								 if (data.hits[i].media[j].type == "StillImage") {
									if (data.hits[i].media[j].description == "thumbnail") {
									   media.push(data.hits[i].media[j].identifier);
									} else {
									  media.push(data.hits[i].media[j].identifier);
									}
								 }
							  }
							}
							
							var m = media.length;
							for (var j=0; j < m; j++) { %>
								<img style="width:64px;padding:4px;float:left;" src="<%= media[j] %>" >								
							<% } %>
							
							
						
						
							</div>
						</td>
						
						
						<td>
						<%
					   
					   var genbank_list = [];
					   if (data.hits[i].associatedSequences) {
					   	 var genbank = data.hits[i].associatedSequences;
					   	 genbank = genbank.replace(/Genbank:/, '');
					   	 genbank = genbank.replace(/https?:\\/\\/www.ncbi.nlm.nih.gov\\/nuccore\\//g, '');
					   	 genbank = genbank.replace(/https?:\\/\\/www.ncbi.nlm.nih.gov\\/gquery\\?term=/g, '');
					   	 genbank = genbank.replace(/\s*;\s*/g, '|');
					   	 genbank_list = genbank.split('|');
					   }	
					   
					     var ng = genbank_list.length;
					     for (var j = 0 ; j < ng; j++) { %>
					     	<a href="https://www.ncbi.nlm.nih.gov/nuccore/<%= genbank_list[j] %>" target="_new"><%= genbank_list[j] %></a>
					    <%  } %>
						
						
						</td>
						
					</tr>
					
				<% } %>	
					</tbody>
				</table>
			</div>
			`;
	
        //--------------------------------------------------------------------------------
		// http://stackoverflow.com/a/11407464
		$(document).keypress(function(event){		
			var keycode = (event.keyCode ? event.keyCode : event.which);			
			if(keycode == '13'){
				search();   
			}
		});    
    
        //--------------------------------------------------------------------------------
		//http://stackoverflow.com/a/25359264
		$.urlParam = function(name){
			var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
			if (results==null){
			   return null;
			}
			else{
			   return results[1] || 0;
			}
		}        
		
        //--------------------------------------------------------------------------------
		function search() {      
      		document.activeElement.blur();
      		
      		document.getElementById('results').innerHTML = '<progress></progress>';
      		
			var q = document.getElementById('query').value;
						
			$.getJSON('service/api.php?code=' 
				+ encodeURI(q)
				+ '&match&extend=10'
				+ '&callback=?',
			function(data){
			
				console.log(JSON.stringify(data, null, 2));
				
				if (data.hits) {				
					html = ejs.render(template_results, { data: data });
				} else {
					html = '<span style="background-color:orange;padding:1em;">' + q + '" not found</span>';
				}
				document.getElementById('results').innerHTML = html;

			}
		);  			


		}		
		
		
	
	
	</script>
	
  <script type="text/javascript">
//<![CDATA[

    window.onload=function(){
    }

//]]></script>
	
	
</head>
<body>
	<div class="container"> 
	<!-- <div> -->

	<!-- search box -->
	<div class="row">
		<div class="input-field col s12">
			<i class="material-icons prefix">search</i>
			<input style="font-size:2em;" type="text" id="query"  placeholder="BMNH 1891.6.13.25">
		</div>
		<!-- <button class="btn-large type="submit" style="font-size:2em;" id="search" onclick="search();">Find</button> -->
	</div>
	
	<div>
		<p>
		<a href="./">Material examined</a> is a simple tool by <a href="https://twitter.com/rdmpage">Rod Page</a> to find specimens in 
		<a href="https://www.gbif.org">GBIF</a> based on the specimen code. For example,
		<a href="?q=MNHN 2003-1054">MNHN 2003-1054</a>, <a href="?q=BMNH 1891.6.13.25">BMNH 1891.6.13.25</a>,
		<a href="?q=KU 3581">KU 3581</a>, and <a href="?q=BM000944668">BM000944668</a>. If found the tool displays
		available information on that specimen, including a map, images, and links to Genbank sequences.</p> 
		
		<p>The tool makes use
		of the GBIF API and (lots of) regular expressions. Source code is available on <a href="https://github.com/rdmpage/material-examined">GitHub</a>
		where you can also leave <a href="https://github.com/rdmpage/material-examined/issues">feedback</a>, or you can reach out on Twitter (<a href="https://twitter.com/rdmpage">@rdmpage</a>)
		Note that there may be more than one specimen with the same code (e.g., <a href="?q=KU 3581">KU 3581</a>,
		<a href="?q=CNMA 22439">CNMA 22439</a>, or <a href="?q=WAM R31009">WAM R31009</a>),
		this is because individual collections in the same institution often have the same numbering scheme. 
		The tool is biased towards animals which tend to have distinctive specimen codes, however a growing number of
		herbaria are adopting standardised codes, such as <a href="?q=BM000944668">BM000944668</a>.</p>
		
		<p>There is a reconciliation API <a href="./match.html">here</a>. 
		You can also call a simple search API directly at <a href="service/api.php">service/api.php</a>.</p>
		
		<p>The code is on GitHub, where you can also <a href="https://github.com/rdmpage/material-examined/issues" target="_new">report problems</a>.
		
		
	</div>
	
	<div id="results">
	</div>
	
	<div id="output">
	</div>
	
	</div>
  
  <script>
  		// do we have a URL parameter?
		var query = $.urlParam('q');
		if (query) {
		   query = decodeURIComponent(query);
		   $('#query').val(query); 
		   search();
		}
  </script>
  


</body>
</html>

