var availableTags = equity_omnibar.citydata;

var cities = [];
for (var i = 1; i < availableTags.length; i = i + 2) {
    cities.push(availableTags[i]);
};



jQuery(function($) {
	$( "#cities" ).autocomplete({
		source: cities
	});
});
  

function check() {
    
	var ID_search = equity_omnibar.results_url + '?csv_listingID=';
	var input = document.getElementById('cities').value;
	var lth = input.length;
	var zero = input * 0;
	var firsttwo = input.substring(0, 2) * 0;
	var nexteight = input.substring(2, 8) * 0;
	var a = cities.indexOf(input, 0);

	if (lth == 8 && zero == 0){

		var go_ID = ID_search + input;

		window.location = go_ID;

}

else if  (lth == 10 && nexteight == 0){

	var gogoID = ID_search + input;

	window.location = gogoID;

}


else if (a > -1){

	var city_search = equity_omnibar.results_url + '?ccz=city&city[]=';
	var city_search_end = '&per=10&srt=prd';
	var b = availableTags.indexOf(input, 0);
	var go_city = city_search + availableTags[b-1] + '&pt=' + jQuery('#search-property-type').val() + '&bd=' + jQuery('#search-beds').val() + '&tb=' + jQuery('#search-baths').val() + '&lp=' + jQuery('#search-min-price').val() + '&hp=' + jQuery('#search-max-price').val() + city_search_end;

	window.location = go_city;

}

else if (!input) {

	var all_search = equity_omnibar.results_url + '?';
	var all_search_end = '&per=10&srt=prd';
	var go_all = all_search + '&pt=' + jQuery('#search-property-type').val() + '&bd=' + jQuery('#search-beds').val() + '&tb=' + jQuery('#search-baths').val() + '&lp=' + jQuery('#search-min-price').val() + '&hp=' + jQuery('#search-max-price').val() + all_search_end;

	window.location = go_all;

}

else {

	var res = input.split(" ");
	var add_search_num = equity_omnibar.results_url + '?ccz=city&a_streetNumber=';
	var add_search_st = '&aw_streetName=';
	var add_search = add_search_num + res[0] + add_search_st + res[1];

	window.location = add_search;
}

};