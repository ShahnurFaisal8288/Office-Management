<!-- index.html -->

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, 
				initial-scale=1.0">
	<link rel="stylesheet" href="./style.css">
	<title>Dynamic Calendar</title>
    <style>
        /* styles.css */

/* General styling for the entire page */
body {
	font-family: Arial, sans-serif;
	background-color: white;
	margin: 0;
}

.wrapper {
	max-width: 1100px;
	margin: 15px auto;
}

/* Calendar container */
.container-calendar {
	background: #ffffff;
	padding: 15px;
	max-width: 900px;
	margin: 0 auto;
	overflow: auto;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
	display: flex;
	justify-content: space-between;
}

/* Event section styling */
#event-section {
	padding: 10px;
	background: #f5f5f5;
	margin: 20px 0;
	border: 1px solid #ccc;
}

.container-calendar #left h1 {
	color: green;
	text-align: center;
	background-color: #f2f2f2;
	margin: 0;
	padding: 10px 0;
}

#event-section h3 {
	color: green;
	font-size: 18px;
	margin: 0;
}

#event-section input[type="date"],
#event-section input[type="text"] {
	margin: 10px 0;
	padding: 5px;
	width: 80%;
}

#event-section button {
	background: green;
	color: white;
	border: none;
	padding: 5px 10px;
	cursor: pointer;
}

.event-marker {
	position: relative;
}

.event-marker::after {
	content: '';
	display: block;
	width: 6px;
	height: 6px;
	background-color: red;
	border-radius: 50%;
	position: absolute;
	bottom: 0;
	left: 0;
}

/* event tooltip styling */
.event-tooltip {
	position: absolute;
	background-color: rgba(234, 232, 232, 0.763);
	color: black;
	padding: 10px;
	border-radius: 4px;
	bottom: 20px;
	left: 50%;
	transform: translateX(-50%);
	display: none;
	transition: all 0.3s;
	box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
	z-index: 1;
}

.event-marker:hover .event-tooltip {
	display: block;
}

/* Reminder section styling */
#reminder-section {
	padding: 10px;
	background: #f5f5f5;
	margin: 20px 0;
	border: 1px solid #ccc;
}

#reminder-section h3 {
	color: green;
	font-size: 18px;
	margin: 0;
}

#reminderList {
	list-style: none;
	padding: 0;
}

#reminderList li {
	margin: 5px 0;
	font-size: 16px;
}

/* Style for the delete buttons */
.delete-event {
	background: rgb(237, 19, 19);
	color: white;
	border: none;
	padding: 5px 10px;
	cursor: pointer;
	margin-left: 10px;
	align-items: right;
}

/* Buttons in the calendar */
.button-container-calendar button {
	cursor: pointer;
	background: green;
	color: #fff;
	border: 1px solid green;
	border-radius: 4px;
	padding: 5px 10px;
}

/* Calendar table */
.table-calendar {
	border-collapse: collapse;
	width: 100%;
}

.table-calendar td,
.table-calendar th {
	padding: 5px;
	border: 1px solid #e2e2e2;
	text-align: center;
	vertical-align: top;
}

/* Date picker */
.date-picker.selected {
	background-color: #f2f2f2;
	font-weight: bold;
	outline: 1px dashed #00BCD4;
}

.date-picker.selected span {
	border-bottom: 2px solid currentColor;
}

/* Day-specific styling */
.date-picker:nth-child(1) {
	color: red;
	/* Sunday */
}

.date-picker:nth-child(6) {
	color: green;
	/* Friday */
}

/* Hover effect for date cells */
.date-picker:hover {
	background-color: green;
	color: white;
	cursor: pointer;
}

/* Header for month and year */
#monthAndYear {
	text-align: center;
	margin-top: 0;
}

/* Navigation buttons */
.button-container-calendar {
	position: relative;
	margin-bottom: 1em;
	overflow: hidden;
	clear: both;
}

#previous {
	float: left;
}

#next {
	float: right;
}

/* Footer styling */
.footer-container-calendar {
	margin-top: 1em;
	border-top: 1px solid #dadada;
	padding: 10px 0;
}

.footer-container-calendar select {
	cursor: pointer;
	background: #ffffff;
	color: #585858;
	border: 1px solid #bfc5c5;
	border-radius: 3px;
	padding: 5px 1em;
}

    </style>
</head>

<body>
	<!-- Main wrapper for the calendar application -->
	<div class="wrapper">
		<div class="container-calendar">
			<div id="left">
				<h1>To Do List</h1>
				<div id="event-section">
					<h3>Add Event</h3>
					<input type="date" id="eventDate">
					<input type="text"
						id="eventTitle"
						placeholder="Event Title">
					<input type="text"
						id="eventDescription"
						placeholder="Event Description">
					<button id="addEvent" onclick="addEvent()">
						Add
					</button>
				</div>
				<div id="reminder-section">
					<h3>Reminders</h3>
					<!-- List to display reminders -->
					<ul id="reminderList">
						<li data-event-id="1">
							<strong>Event Title</strong>
							- Event Description on Event Date
							<button class="delete-event"
								onclick="deleteEvent(1)">
								Delete
							</button>
						</li>
					</ul>
				</div>
			</div>
			<div id="right">
				<h3 id="monthAndYear"></h3>
				<div class="button-container-calendar">
					<button id="previous"
							onclick="previous()">
						‹
					</button>
					<button id="next"
							onclick="next()">
						›
					</button>
				</div>
				<table class="table-calendar"
					id="calendar"
					data-lang="en">
					<thead id="thead-month"></thead>
					<!-- Table body for displaying the calendar -->
					<tbody id="calendar-body"></tbody>
				</table>
				<div class="footer-container-calendar">
					<label for="month">Jump To: </label>
					<!-- Dropdowns to select a specific month and year -->
					<select id="month" onchange="jump()">
						<option value=0>Jan</option>
						<option value=1>Feb</option>
						<option value=2>Mar</option>
						<option value=3>Apr</option>
						<option value=4>May</option>
						<option value=5>Jun</option>
						<option value=6>Jul</option>
						<option value=7>Aug</option>
						<option value=8>Sep</option>
						<option value=9>Oct</option>
						<option value=10>Nov</option>
						<option value=11>Dec</option>
					</select>
					<!-- Dropdown to select a specific year -->
					<select id="year" onchange="jump()"></select>
				</div>
			</div>
		</div>
	</div>
	<!-- Include the JavaScript file for the calendar functionality -->
	<script src="./script.js"></script>
    <script>
// script.js

// Define an array to store events
let events = [];

// letiables to store event input fields and reminder list
let eventDateInput =
	document.getElementById("eventDate");
let eventTitleInput =
	document.getElementById("eventTitle");
let eventDescriptionInput =
	document.getElementById("eventDescription");
let reminderList =
	document.getElementById("reminderList");

// Counter to generate unique event IDs
let eventIdCounter = 1;

// Function to add events
function addEvent() {
	let date = eventDateInput.value;
	let title = eventTitleInput.value;
	let description = eventDescriptionInput.value;

	if (date && title) {
		// Create a unique event ID
		let eventId = eventIdCounter++;

		events.push(
			{
				id: eventId, date: date,
				title: title,
				description: description
			}
		);
		showCalendar(currentMonth, currentYear);
		eventDateInput.value = "";
		eventTitleInput.value = "";
		eventDescriptionInput.value = "";
		displayReminders();
	}
}

// Function to delete an event by ID
function deleteEvent(eventId) {
	// Find the index of the event with the given ID
	let eventIndex =
		events.findIndex((event) =>
			event.id === eventId);

	if (eventIndex !== -1) {
		// Remove the event from the events array
		events.splice(eventIndex, 1);
		showCalendar(currentMonth, currentYear);
		displayReminders();
	}
}

// Function to display reminders
function displayReminders() {
	reminderList.innerHTML = "";
	for (let i = 0; i < events.length; i++) {
		let event = events[i];
		let eventDate = new Date(event.date);
		if (eventDate.getMonth() ===
			currentMonth &&
			eventDate.getFullYear() ===
			currentYear) {
			let listItem = document.createElement("li");
			listItem.innerHTML =
				`<strong>${event.title}</strong> - 
			${event.description} on 
			${eventDate.toLocaleDateString()}`;

			// Add a delete button for each reminder item
			let deleteButton =
				document.createElement("button");
			deleteButton.className = "delete-event";
			deleteButton.textContent = "Delete";
			deleteButton.onclick = function () {
				deleteEvent(event.id);
			};

			listItem.appendChild(deleteButton);
			reminderList.appendChild(listItem);
		}
	}
}

// Function to generate a range of 
// years for the year select input
function generate_year_range(start, end) {
	let years = "";
	for (let year = start; year <= end; year++) {
		years += "<option value='" +
			year + "'>" + year + "</option>";
	}
	return years;
}

// Initialize date-related letiables
today = new Date();
currentMonth = today.getMonth();
currentYear = today.getFullYear();
selectYear = document.getElementById("year");
selectMonth = document.getElementById("month");

createYear = generate_year_range(1970, 2050);

document.getElementById("year").innerHTML = createYear;

let calendar = document.getElementById("calendar");

let months = [
	"January",
	"February",
	"March",
	"April",
	"May",
	"June",
	"July",
	"August",
	"September",
	"October",
	"November",
	"December"
];
let days = [
	"Sun", "Mon", "Tue", "Wed",
	"Thu", "Fri", "Sat"];

$dataHead = "<tr>";
for (dhead in days) {
	$dataHead += "<th data-days='" +
		days[dhead] + "'>" +
		days[dhead] + "</th>";
}
$dataHead += "</tr>";

document.getElementById("thead-month").innerHTML = $dataHead;

monthAndYear =
	document.getElementById("monthAndYear");
showCalendar(currentMonth, currentYear);

// Function to navigate to the next month
function next() {
	currentYear = currentMonth === 11 ?
		currentYear + 1 : currentYear;
	currentMonth = (currentMonth + 1) % 12;
	showCalendar(currentMonth, currentYear);
}

// Function to navigate to the previous month
function previous() {
	currentYear = currentMonth === 0 ?
		currentYear - 1 : currentYear;
	currentMonth = currentMonth === 0 ?
		11 : currentMonth - 1;
	showCalendar(currentMonth, currentYear);
}

// Function to jump to a specific month and year
function jump() {
	currentYear = parseInt(selectYear.value);
	currentMonth = parseInt(selectMonth.value);
	showCalendar(currentMonth, currentYear);
}

// Function to display the calendar
function showCalendar(month, year) {
	let firstDay = new Date(year, month, 1).getDay();
	tbl = document.getElementById("calendar-body");
	tbl.innerHTML = "";
	monthAndYear.innerHTML = months[month] + " " + year;
	selectYear.value = year;
	selectMonth.value = month;

	let date = 1;
	for (let i = 0; i < 6; i++) {
		let row = document.createElement("tr");
		for (let j = 0; j < 7; j++) {
			if (i === 0 && j < firstDay) {
				cell = document.createElement("td");
				cellText = document.createTextNode("");
				cell.appendChild(cellText);
				row.appendChild(cell);
			} else if (date > daysInMonth(month, year)) {
				break;
			} else {
				cell = document.createElement("td");
				cell.setAttribute("data-date", date);
				cell.setAttribute("data-month", month + 1);
				cell.setAttribute("data-year", year);
				cell.setAttribute("data-month_name", months[month]);
				cell.className = "date-picker";
				cell.innerHTML = "<span>" + date + "</span";

				if (
					date === today.getDate() &&
					year === today.getFullYear() &&
					month === today.getMonth()
				) {
					cell.className = "date-picker selected";
				}

				// Check if there are events on this date
				if (hasEventOnDate(date, month, year)) {
					cell.classList.add("event-marker");
					cell.appendChild(
						createEventTooltip(date, month, year)
				);
				}

				row.appendChild(cell);
				date++;
			}
		}
		tbl.appendChild(row);
	}

	displayReminders();
}

// Function to create an event tooltip
function createEventTooltip(date, month, year) {
	let tooltip = document.createElement("div");
	tooltip.className = "event-tooltip";
	let eventsOnDate = getEventsOnDate(date, month, year);
	for (let i = 0; i < eventsOnDate.length; i++) {
		let event = eventsOnDate[i];
		let eventDate = new Date(event.date);
		let eventText = `<strong>${event.title}</strong> - 
			${event.description} on 
			${eventDate.toLocaleDateString()}`;
		let eventElement = document.createElement("p");
		eventElement.innerHTML = eventText;
		tooltip.appendChild(eventElement);
	}
	return tooltip;
}

// Function to get events on a specific date
function getEventsOnDate(date, month, year) {
	return events.filter(function (event) {
		let eventDate = new Date(event.date);
		return (
			eventDate.getDate() === date &&
			eventDate.getMonth() === month &&
			eventDate.getFullYear() === year
		);
	});
}

// Function to check if there are events on a specific date
function hasEventOnDate(date, month, year) {
	return getEventsOnDate(date, month, year).length > 0;
}

// Function to get the number of days in a month
function daysInMonth(iMonth, iYear) {
	return 32 - new Date(iYear, iMonth, 32).getDate();
}

// Call the showCalendar function initially to display the calendar
showCalendar(currentMonth, currentYear);
 
    </script>
</body>

</html>
