$(function() {
    function setArea() {
        var cropID = $('#cropType option:selected').attr("cropID");
        var selectedSqFeet = parseFloat($('#layout option:selected').attr(cropID)).toFixed(2);

        // Set to 0 if value is not found
        if (isNaN(selectedSqFeet)){
            $('#squareFeet').val(0);
        } else {
            $('#squareFeet').val(selectedSqFeet);
        }
    }
    //Set up
    $('#savedLayouts').hide();
    $('#saveButton').hide();

    $('#layoutNo').click(function() {
        $("#squareFeet").prop('disabled', false);
        $('#savedLayouts').hide();
		
	})

    $('#layoutYes').click(function() {
        $("#squareFeet").prop('disabled', true);
        $('#savedLayouts').show();
        setArea();
		
	})

    $('#harvestButton').click(function(e) {
        e.preventDefault();
        squareFeet = $('#squareFeet').val();
        poundsProduced = $('#poundsProduced').val();

        // Check numeric
        if (!($.isNumeric(squareFeet) && $.isNumeric(poundsProduced))){
            alert('Please enter valid numbers.');
        } else {
            var crop = $('#cropType option:selected').text().toLowerCase();
            var result = parseFloat(poundsProduced / squareFeet).toFixed(2);
            var average = parseFloat($('#cropType option:selected').attr("average")).toFixed(2);

            $('#resultsText').html("Your " + crop + " harvest was " + result + " pounds per square foot.");
            // Check if average exists from other harvests
            if (!isNaN(average)) {
                $('#resultsText').html($('#resultsText').html() + "Our average gardener gets " + average + ".");  
            }

            // Show save button
            $('#saveButton').show();
        }
    })

    $('#saveButton').click(function(e) {
        try {
            var cropID = $('#cropType option:selected').attr("cropID");
            var sqFeet = parseInt($('#squareFeet').val());
            var poundsProduced = parseInt($('#poundsProduced').val());
            // User id stashed in here
            var userID = $('#harvestForm').attr("userID");

            $.post( "dbhandler.php", {operation: "saveHarvest", userID: userID,cropID: cropID, sqFeet: sqFeet, poundsProduced: poundsProduced});
            $('#saveButton').hide();
            alert("Harvest saved")
        } catch {
            alert("Error saving harvest");
        }
    })

    $('#cropType').change(function(e) {
        // Only alter if in layout mode
        if ($('#layoutYes').prop('checked')) {
            setArea();
        }
    })

    $('#savedLayouts').change(function(e) {
        setArea();
    })

});