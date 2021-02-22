class Crop {
	
	constructor(x1,y1,x2,y2,cropType) {
		this.x1 = Math.min(x1, x2);
		this.y1 = Math.min(y1, y2);
		this.x2 = Math.max(x1, x2);
		this.y2 = Math.max(y1, y2);
		this.originX = x1;
		this.originY = y1;
		this.cropType = cropType;
	}
	
	
	
	coordGreater (x1, y1, x2, y2) {
		return (x1 > x2, y1 > y2);
	}
	

}

class Plot {
	tempCrop = null;
	
	constructor(canvas) {
		this.canvas = canvas
		this.ctx = canvas.getContext('2d');
		this.crops = [];
		this.drawing = false;
		this.name = "";
		this.selectedCrop = {
			crop: null,
			index: -1
		};
		this.setRect();
		this.drawScreen();
	}
	
	setRect() {
		this.rect = this.canvas.getBoundingClientRect();
	}

	drawScreen() {
		// Draw background
		this.ctx.fillStyle = 'green';
		this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height)
		
		// Draw previous rectangles
		this.ctx.strokeStyle = 'black';
		this.crops.forEach((crop) => {
			this.drawRect(crop);
		});
		
		// Draw current rectangle
		if (this.tempCrop) {
			this.ctx.strokeStyle = 'red';
			this.drawRect(this.tempCrop);
		}
		
		// Check for selected crop
		if (this.selectedCrop.index != -1) {
			this.ctx.strokeStyle = 'orange';
			this.drawRect(this.selectedCrop.crop);
		}
	}

	drawRect(rect) {
		var centerX = (rect.x1 + rect.x2) / 2;
		var centerY = (rect.y1 + rect.y2) / 2;
		var width = rect.x2 - rect.x1;
		var height = rect.y2 - rect.y1;
		var radius = Math.min(width, height) / 6;
		
		
		this.ctx.strokeRect(rect.x1, rect.y1, width, height);
		
		this.ctx.beginPath();
		this.ctx.arc(centerX, centerY, radius, 2 * Math.PI, false);
		this.ctx.stroke();
		
		this.fillStyle = "blue";
		this.ctx.font = Math.floor(radius) + "px Arial";
		this.ctx.textAlign = "center";
		this.ctx.strokeText(rect.cropType, centerX, centerY + radius / 3);
	}
}


function addToDropDown(lastID, shapesString) {

	$('#saveFile').append(
        $('<option></option>').attr("value", shapesString).attr("sqlID", lastID).html($('#cropName').val()));

	// $('#saveFile').append($('#cropName').val()).attr("value", shapesString).attr("sqlID", lastID).text($('#cropName').val());
	// $('#saveFile').html($('#saveFile').html(),"<option value = '", shapesString, "' sqlID = '", 
	// 		lastID, "'>", $('#cropName'), "</option>");
}

$(function() {
	var cropReference = {
		"Tomato": "T",
		"Potato": "P",
		"Corn": "C"
	}
	
	var selectedCropType = cropReference["Tomato"];
	
	var canvas = document.getElementById('designerWindow');

	plot = new Plot(canvas);

	// Main window resized
	$(window).on('resize', function() {
		plot.setRect();
	})

	// Track mouse inside canvas
	$(plot.canvas).mousemove(function(e) {

		if (plot.tempCrop) {

			var unBlockedX = true;
			var unBlockedY = true;
			var newX = Math.round(e.pageX - plot.rect.left);
			var newY = Math.round(e.pageY - plot.rect.top);
			var possibleCrop = new Crop (plot.tempCrop.originX, plot.tempCrop.originY, newX, newY);
			var currentPlot = plot.tempPlot;
			var i = 0;

			//Check to make sure path is not blocked
			while ((unBlockedX || unBlockedY) && i < plot.crops.length) {

				checkCrop = plot.crops[i];

				// Check overlap

				// Check to see if y can still move
				if ((possibleCrop.y2 > checkCrop.y1 && possibleCrop.y2 < checkCrop.y2) || 
						(possibleCrop.y1 < checkCrop.y2 && possibleCrop.y1 > checkCrop.y1)) {
					
					if ((possibleCrop.x1 < checkCrop.x2 && possibleCrop.x1 > checkCrop.x1)
							 || (possibleCrop.x2 > checkCrop.x1 && possibleCrop.x2 < checkCrop.x2)
						 || (possibleCrop.x1 <= checkCrop.x1 && possibleCrop.x2 >= checkCrop.x2)) {
						unBlockedY = false;
					}
				}

				// Check to see if x can still move
				if ((possibleCrop.x2 > checkCrop.x1 && possibleCrop.x2 < checkCrop.x2) || 
						(possibleCrop.x1 < checkCrop.x2 && possibleCrop.x1 > checkCrop.x1)) {

					if ((possibleCrop.y1 < checkCrop.y2 && possibleCrop.y1 > checkCrop.y1)
							 || (possibleCrop.y2 > checkCrop.y1 && possibleCrop.y2 < checkCrop.y2)
						 	|| (possibleCrop.y1 <= checkCrop.y1 && possibleCrop.y2 >= checkCrop.y2))  {
						unBlockedX = false;
					}
				}
				
				// Check to see if it's surrounded
				if (possibleCrop.x1 <= checkCrop.x1 && possibleCrop.x2 >= checkCrop.x2 &&
						possibleCrop.y1 <= checkCrop.y1 && possibleCrop.y2 >= checkCrop.y2) {
					unBlockedX = false;
					unBlockedY = false;
				}
				
				// 


				i++;
			}

			if (unBlockedX) {
				plot.tempCrop.x1 = possibleCrop.x1;
				plot.tempCrop.x2 = possibleCrop.x2;
			}

			if (unBlockedY) {
				plot.tempCrop.y1 = possibleCrop.y1;
				plot.tempCrop.y2 = possibleCrop.y2;
			}

			plot.drawScreen();
		}

	});


	// Start drawing rectangle on mouse press
	$(plot.canvas).mousedown(function(e) {

		var x = Math.round(e.pageX - plot.rect.left);
		var y = Math.round(e.pageY - plot.rect.top);
		var newCrop = true;

		plot.crops.forEach((crop, index) => {

			//See if mouse is inside existing crop
				if (x > crop.x1 && x < crop.x2 && y > crop.y1 && y < crop.y2) {
					plot.selectedCrop.crop = crop;
					plot.selectedCrop.index = index;
					newCrop = false;
				}
		});

		if (newCrop) {
			plot.selectedCrop.crop = null;
			plot.selectedCrop.index = -1;
			plot.tempCrop = new Crop(x, y, x, y, selectedCropType);
		}

		plot.drawScreen();
	});

	// Stop drawing rectangle on mouse release
	$(plot.canvas).mouseup(function(e) {

		if (plot.selectedCrop.index == -1) {
			plot.crops.push(plot.tempCrop);
			plot.tempCrop = null;
			plot.drawScreen();

		}

	});
	
	$('#cropType').change(function(e) {
		selectedCropType = cropReference[$('#cropType').val()];
		
		if (plot.selectedCrop.crop) {
			plot.selectedCrop.crop.cropType = selectedCropType;
			plot.drawScreen();
		}
	});

	$('#new').click(function() {
	plot.crops = [];
	plot.drawScreen();
	});

	$('#save').click(function() {

		// See if plot exists with current name
		oldID = -1;
		$('#saveFile option').each(function(i) {
		
			//nth child is 1 indexed
			selectString = '#saveFile option:nth-child(' + (i + 1) + ')';
			console.log(i, 'th name is ', $(selectString).html());

			if ($(selectString).html() == $('#cropName').val()) {
				oldID = $(selectString).attr("sqlID");
			}
			
		})
		console.log("Old ID: ", oldID);

		// Format crops to be transfered and stored in drop down
		sendCrops = [];
		coordsString = "";
		typesString = "";
		plot.crops.forEach(function(c) {
			sendCrops.push([c.x1, c.y1, c.x2, c.y2, c.cropType]);
			coordsString += c.x1 + "#" + c.y1 + "#" + c.x2 + "#" + c.y2 + "#";
			typesString += c.cropType;

		});
		saveString = coordsString + typesString;

		// Add to DB
		$.post( "dbhandler.php", {operation: "write", name: $('#cropName').val(), crops: sendCrops, oldID: oldID});

		// If title is new Add new crop to drop down

		if (oldID == "-1") {
			shapesString = coordsString + typesString;

			$.post("dbhandler.php", {operation: "lastID"}, function(lastID) {
				addToDropDown(lastID, shapesString);
			});
		} else {
			$('#saveFile option:selected').val(saveString);
		}

		
		

		return false;
		

	});

	$('#load').click(function() {
		saveSplit = $('#saveFile').val().split('#');
		try {
			plot.crops = [];

			for(i = 0; i * 4 + 2 < saveSplit.length; i += 1) {
				plot.crops.push(new Crop(saveSplit[i * 4], saveSplit[i * 4 + 1], saveSplit[i * 4 + 2], saveSplit[i * 4 + 3],
																 saveSplit[saveSplit.length - 1][i]));
			}

			plot.drawScreen();
			$('#cropName').val($('#saveFile option:selected').text());

		} catch {
			alert("Invalid save data");
		}
		});

	$('#delete').click(function() {

		// Remove from DB w/ shapes and from drop down
		console.log($('#saveFile option:selected').attr("sqlID"));
		console.log("Sending ", $('#saveFile option:selected').attr("sqlID"), " to DBhandler");
		$.post( "dbhandler.php", {operation: "delete", layoutID: $('#saveFile option:selected').attr("sqlID")});
		
		$('#saveFile option:selected').remove();
	})

	//$('#name')
	
	document.addEventListener('keyup', (e) => {

		if (e.code == "KeyD" && plot.selectedCrop.index != -1) {
			plot.crops.splice(plot.selectedCrop.index, 1);
			plot.selectedCrop.index = -1;
			plot.selectedCrop.crop = null;
			plot.drawScreen(this.cropType);
		}


	});
});
