function run(){

	document.getElementById("geo_country_id").addEventListener("change", function() {
		loadState();
	});


	function loadState() {
	  idCountry = document.getElementById("geo_country_id").value;
	  console.log(idCountry);
	  document.getElementById("#geo_state_id").innerHTML = "";
	  $("#geo_region_id").html('');
	  $("#geo_district_id").html('');
	  $("#geo_suburb_id").html('');
	  $.get(selectState, {
	    idCountry: idCountry
	  }, function(data) {
	    $.each(data, function(key, val) {
	      $("#geo_state_id").append('<option value="' + val.id + '">' + val.name + '</option>')
	    });
	    loadRegion();
	  });
	}
}