<script>
	function getPageName()
	{
		var pos = 0;
		var uri = null;
		if ( (pos = window.location.href.indexOf('?'))!=-1)
			uri = window.location.href.slice(0,window.location.href.indexOf('?') );
		else
			uri = window.location.href.slice(0,window.location.href.length);

		var pagenamepre = uri.slice(uri.indexOf("http://")+7);
		var pagename = pagenamepre.slice(pagenamepre.indexOf("/")+1);
		return pagename;
	}
	function getUrlVars()
	{
		var vars = [], hash;
		var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
		for(var i = 0; i < hashes.length; i++)
		{
			hash = hashes[i].split('=');
			vars.push(hash[0]);
			vars[hash[0]] = hash[1];
		}
		return vars;
	}
	var pagename= getPageName();
	var citydropstr;
	//var statedropstr ="<div style=\"margin-top:15px;\">State ";
	//statedropstr += "<select onchange=\"location = this.options[this.selectedIndex].value;\">";
	//statedropstr += "<option value=\"arizonalocations3.php\" " + (pagename=='arizonalocations3.php' ? "selected:" : "") + ">Arizona";
	//statedropstr += "<option value=\"illinoislocations3.php\" " + (pagename=="illinoislocations3.php" ? "selected" : "") + ">Illinois";
	//statedropstr += "<option value=\"indianalocations3.php\" " + (pagename=="indianalocations3.php" ? "selected" : "") + ">Indiana";
	//statedropstr += "<option value=\"marylandlocations3.php\" " + (pagename=="marylandlocations3.php" ? "selected" : "") + ">Maryland";
	//statedropstr += "<option value=\"minnesotalocations3.php\" " + (pagename=="minnesotalocations3.php" ? "selected" : "") + ">Minnesota";
	//statedropstr += "<option value=\"newyorklocations3.php\" " + (pagename=="newyorklocations3.php" ? "selected" : "") + ">New York";
	//statedropstr += "<option value=\"ohiolocations3.php\" " + (pagename=="ohiolocations3.php" ? "selected" : "") + ">Ohio";
	//statedropstr += "<option value=\"pennsylvanialocations3.php\" " + (pagename=="pennsylvanialocations3.php" ? "selected" : "") + ">Pennsylvania";
	//statedropstr += "<option value=\"wisconsinlocations3.php\" "+ (pagename=="wisconsinlocations3.php" ? "selected" : "") + ">Wisconsin";
	//statedropstr += "</select>";
	//citydropstr = statedropstr;
	var prettystate = (pagename=='arizonalocations.php' ? "Arizona" :"");
	prettystate = (pagename=='floridalocations.php' ? "Florida" :prettystate);
	prettystate = (pagename=='illinoislocations.php' ? "Illinois" :prettystate);
	prettystate = (pagename=='indianalocations.php' ? "Indiana" :prettystate);
	prettystate = (pagename=='marylandlocations.php' ? "Maryland" :prettystate);
	prettystate = (pagename=='minnesotalocations.php' ? "Minnesota" :prettystate);
	prettystate = (pagename=='newyorklocations.php' ? "New York" :prettystate);
	prettystate = (pagename=='ohiolocations.php' ? "Ohio" :prettystate);
	prettystate = (pagename=='pennsylvanialocations.php' ? "Pennsylvania" :prettystate);
	prettystate = (pagename=='wisconsinlocations.php' ? "Wisconsin" :prettystate);
	prettystate = (pagename=='georgialocations.php' ? "Georgia" :prettystate);
	citydropstr = "<div style=\"margin-top:15px;\"><h3>";
	citydropstr += prettystate;
	citydropstr += "</h3></div>";
	citydropstr +="<div>City <select onchange=\"location = this.options[this.selectedIndex].value;\">";
	$('.city').each(function(i, cities){

		//alert(getUrlVars()['locname']);
		if ( escape(cities.name) == getUrlVars()['locname']) {
			citydropstr += "<option value=\"" + cities + "\" selected>" + cities.name;
		} else {
			citydropstr += "<option value=\"" + cities + "\">" + cities.name;
		}
	});
	citydropstr += "</div>";
	$('.citydrop').html(citydropstr);
	if ( getUrlVars()['locname']==null) {
		//alert("not found");
		$('.city').each(function(i,cities) {
			if (i ==0) {
				location = cities;
			}

		});
	}
</script> 