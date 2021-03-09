$(function() {

	class Crop {
	
		constructor(x1,y1,x2,y2,cropID,cropAbbr) {
			this.x1 = Math.min(x1, x2);
			this.y1 = Math.min(y1, y2);
			this.x2 = Math.max(x1, x2);
			this.y2 = Math.max(y1, y2);
			this.originX = x1;
			this.originY = y1;
			this.cropAbbr = cropAbbr;
			this.cropID = cropID;
		}
		
		
		// Orient coords properly
		coordGreater (x1, y1, x2, y2) {
			return (x1 > x2, y1 > y2);
		}
		
	
	}
	
	class Plot {
		tempCrop = null;
		
		constructor(canvas, ctx, width, height) {
			this.canvas = canvas;
			this.ctx = ctx;
			this.width = width;
			this.height = height;
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
			this.ctx.strokeText(rect.cropAbbr, centerX, centerY + radius / 3);
		}
	}
	
	
	function addToDropDown(lastID, coordsString, idsString, abbrsString) {
	
		//Build option with attributes
		$('#saveFile').append(
			$('<option></option>').attr("value", coordsString)
			.attr("cropIDs", idsString).attr("cropAbbrs", abbrsString)
			.attr("sqlID", lastID).attr("width", plot.width).attr("height", plot.height)
			.html($('#cropName').val()));
	}
	
	function notLoggedIn(canvas, ctx) {
		ctx.font = "30px Arial";
		ctx.fillStyle = "black";
		ctx.textAlign = "center";
		ctx.fillText("Please Log in to use this feature", canvas.width / 2, canvas.height / 2); 
		
		$('#designerRight').html("");
		$('#designerInstructions').html("");
	}
	
	function resize(canvas, plot) {
		plot.setRect();
		$('#dimY').css('left', (plot.rect.width + $('#designerWindow').offset().left + 5) +'px');
	}

	// Initialize selected ID and abbreviation
	var selectedCropID = $('#cropType option:selected').attr('cropID');
	var selectedCropAbbr = $('#cropType option:selected').attr('cropAbbr');


	canvas = document.getElementById('designerWindow');
	ctx = canvas.getContext('2d');

	var plot = new Plot(canvas, ctx, 60, 40);
	resize(canvas, plot);


	// Stop running if user isn't logged in.
	if (userID == 0 || userID == null) {
		notLoggedIn(canvas, ctx);
		return false;
	}

	// Main window resized
	$(window).on('resize', function() {
		resize(canvas, plot);
	})

	// Track mouse inside canvas
	$(plot.canvas).mousemove(function(e) {

		if (plot.tempCrop) {

			var unBlockedX = true;
			var unBlockedY = true;
			var newX = Math.round(e.pageX - plot.rect.left);
			var newY = Math.round(e.pageY - plot.rect.top);
			var possibleCrop = new Crop (plot.tempCrop.originX, plot.tempCrop.originY, newX, newY, selectedCropID, selectedCropAbbr);
			var currentPlot = plot.tempPlot;
			var i = 0;

			//Check to make sure path is not blocked
			while (false && (unBlockedX || unBlockedY) && i < plot.crops.length) {

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

		//See if mouse is inside existing crop
		plot.crops.forEach((crop, index) => {

				if (x > crop.x1 && x < crop.x2 && y > crop.y1 && y < crop.y2) {
					plot.selectedCrop.crop = crop;
					plot.selectedCrop.index = index;
					newCrop = false;
				}
		});

		// Hold new crop
		if (newCrop) {
			plot.selectedCrop.crop = null;
			plot.selectedCrop.index = -1;
			plot.tempCrop = new Crop(x, y, x, y, selectedCropID, selectedCropAbbr);
		}

		plot.drawScreen();
	});

	// Stop drawing rectangle on mouse release
	$(plot.canvas).mouseup(function(e) {

		if (plot.selectedCrop.index == -1 && plot.tempCrop != null) {
			plot.crops.push(plot.tempCrop);
			plot.tempCrop = null;
			plot.drawScreen();

		}

	});
	
	$('#cropType').change(function(e) {
		// Change selected ID and abbreviation
		selectedCropID = $('#cropType option:selected').attr('cropID');
		selectedCropAbbr = $('#cropType option:selected').attr('cropAbbr');
		
		// Change currently selected if selected
		if (plot.selectedCrop.crop) {
			plot.selectedCrop.crop.cropID = selectedCropID;
			plot.selectedCrop.crop.cropAbbr = selectedCropAbbr;
			plot.drawScreen();
		}
	});

	$('#new').click(function() {
		// Get new dimensions
		var width = prompt("Width (in feet)");
		var height = prompt("Height (in feet)");

		if (!($.isNumeric(width) && $.isNumeric(height))){
            alert('Please enter valid numbers.');
        } else {
			$('#designerWindow').attr('width', (width * 10));
			$('#designerWindow').attr('height', (height * 10));
			$('#dimX').html(width + "'");
			$('#dimY').html(height + "'");

            $('#cropName').val("");
			// Get new ref to resized canvas
			canvas = document.getElementById('designerWindow');

			// Create new plot with new dimensions for proper bindings
			plot = new Plot(canvas, ctx, width, height);
			resize(canvas, plot);
        }
		
	});

	$('#save').click(function() {

		// See if plot exists with current name
		oldID = -1;
		$('#saveFile option').each(function(i) {
		
			//nth child is 1 indexed
			selectString = '#saveFile option:nth-child(' + (i + 1) + ')';
	

			if ($(selectString).html() == $('#cropName').val()) {
				oldID = $(selectString).attr("sqlID");
			}
			
		})

		// Format crops to be transfered and stored in drop down
		sendCrops = [];
		coordsString = "";
		idsString = "";
		abbrsString = "";
		plot.crops.forEach(function(c) {
			sendCrops.push([c.x1, c.y1, c.x2, c.y2, c.cropID]);
			coordsString += c.x1 + "#" + c.y1 + "#" + c.x2 + "#" + c.y2 + "#";
			idsString += c.cropID + '#';
			abbrsString += c.cropAbbr + '#';

		});

		// Add to DB
		$.post( "dbhandler.php", {operation: "write", name: $('#cropName').val(), crops: sendCrops, oldID: oldID, width: plot.width, height: plot.height});


		// If title is new Add new crop to drop down
		if (oldID == "-1") {

			$.post("dbhandler.php", {operation: "lastID"}, function(lastID) {
				addToDropDown(lastID, coordsString, idsString, abbrsString);
			});
		} else {
			// Update dropdown listing
			$('#saveFile option:selected').val(coordsString);
			$('#saveFile option:selected').attr('cropIDs', idsString);
			$('#saveFile option:selected').attr('cropAbbrs', abbrsString);
			$('#saveFile option:selected').attr('width', plot.width);
			$('#saveFile option:selected').attr('height', plot.height);
		}

		
		

		return false;
		

	});

	$('#load').click(function() {
		coordsSplit = $('#saveFile option:selected').val().split('#');
		idsSplit = $('#saveFile option:selected').attr('cropIDs').split('#');
		abbrsSplit = $('#saveFile option:selected').attr('cropAbbrs').split('#');
		try {
			var width = $('#saveFile option:selected').attr('width');
			var height = $('#saveFile option:selected').attr('height');
			
			// Create new plot in case of different dimensions
			plot = new Plot(canvas, ctx, width, height);
			$('#designerWindow').attr('width', width * 10);
			$('#designerWindow').attr('height', height * 10);
			canvas = document.getElementById('designerWindow');
			resize(canvas, plot);

			console.log(coordsSplit);
			console.log(idsSplit);
			console.log(abbrsSplit);
			//coords have 4 in each
			for(i = 0; i * 4 + 2 < coordsSplit.length; i += 1) {
				console.log(i);
				plot.crops.push(new Crop(coordsSplit[i * 4], coordsSplit[i * 4 + 1], 
					coordsSplit[i * 4 + 2], coordsSplit[i * 4 + 3],
								idsSplit[i], abbrsSplit[i]));
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
