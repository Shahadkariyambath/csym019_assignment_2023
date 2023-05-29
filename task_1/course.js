/* course.js is a javascript file to read the data from course.json file and display it in the table 
body of the html */
(
    function makeAjaxRequest(){
    setTimeout(function(){  // Set timeout function with a delay of 250 milliseconds (0.25 seconds)
    $.ajax( { // AJAX request to retrieve data from a JSON file
        type:'GET', //method to retrive data from json file
        url:'course.json', //url in which data is saved, course.json
        dataType:"json",
        success: function(response){ // for a successful read of json file, exceute the following scripts
            let datatxt=""; //initialize the datatxt.
            $.each(response.courseDetails,function(index){ // Iterate over each item in the courseDetails array
              
            // Create <ul> element for Duration
            const DurationList = document.createElement("ul");
            response.courseDetails[index].Duration.forEach((Duration) => {
            const DurationItem = document.createElement("li");
            DurationItem.textContent = Duration.name;
            DurationList.appendChild(DurationItem);
            });

            // Create <ul> element for Starting
            const StartingList = document.createElement("ul");
            response.courseDetails[index].Starting.forEach((Starting) => {
            const StartingItem = document.createElement("li");
            StartingItem.textContent = Starting.name;
            StartingList.appendChild(StartingItem);
            });
                
            // Create <ul> element for module_and_credits
            const module_and_creditsList = document.createElement("ul");
            response.courseDetails[index].module_and_credits.forEach((module_and_credits) => {
            const module_and_creditsItem = document.createElement("li");
            module_and_creditsItem.textContent = module_and_credits.name;
            module_and_creditsList.appendChild(module_and_creditsItem);
            });

            // Generate the HTML table row (tr) with the data obtained from the JSON response
              datatxt+="<tr><td><a href='"+response.courseDetails[index].link+"'>" +response.courseDetails[index].name+"</a><br><br><b>Level : <br></b>"+response.courseDetails[index].Level+"<br><br> <b>Location  : <br>  </b>  "+response.courseDetails[index].Location+ //In the first cell, it will show the course name, location and level
              "</td><td >"
              +DurationList.innerHTML+"</td><td >"  //in the next cell, it will show the duration of courses will be shown
              +StartingList.innerHTML+"</td><td data-target data-original class='text-center'>"  //in the next cell, it will show the starting of courses will be shown
              +response.courseDetails[index].Fees+"</td><td data-target data-original class='text-center'>"  //in the next cell, it will show the Fees in uk of courses will be shown
              +response.courseDetails[index].Fees_Int+"</td><td>"  //in the next cell, it will show the fee of international of courses will be shown
              +response.courseDetails[index].course_Overview+"</td><td>"  //in the next cell, it will show the courses overview will be shown
              +response.courseDetails[index].Feesandfunding+"</td><td class='text-center'>"  //in the next cell, it will show the fees and funding of courses will be shown
              +response.courseDetails[index].english_language_requirements+"</td><td >"  //in the next cell, it will show the entry requirement  of courses will be shown
              +module_and_creditsList.innerHTML+"</td>";  //in the last cell, it will show the modules and credits of courses will be shown
         });
            $(courseDetails).append(datatxt);  // Append the generated table row HTML to the table body with id "courseDetails"
            //the data obtained using the loop is stored to datatxt variable and it is added to the table using the append function and by referring the id for the table defined in tbody.
        },
        error: function(){ // error message is shown for unsucceeful fetch of data from json.
            $("#updatemessage").append("Error");
        }
    });
    }, 250);
  }());



/*
The function below is used to covert the currency in pound to dollar and Euro
*/
  document.addEventListener("DOMContentLoaded", function() {// Event listener to wait for the DOM content to be fully loaded
    // Get references to the buttons
    var euroButton = document.getElementById("euro"); // Get the Euro button element
    var dollarButton = document.getElementById("dollar"); // Get the Dollar button element
    var poundButton = document.getElementById("pound"); // Get the Pound button element
  
    // Set the initial currency value
    var currentCurrency = "pound"; // Set the initial currency to Pound
  
    // Add event listeners to the buttons
    euroButton.addEventListener("click", function() { // Event listener for the Euro button click
      if (currentCurrency === "pound") { // Check if the current currency is Pound
        convertToCurrency(1.15); // Convert the currency to Euro
        currentCurrency = "euro"; // Update the current currency value
        disableButton(euroButton); // Disable the Euro button
        enableButton(dollarButton); // Enable the Dollar button
        enableButton(poundButton); // Enable the Pound button

      } else if (currentCurrency === "dollar") {// Check if the current currency is Dollar
        convertToCurrency(0.93);// Convert the currency to Euro
        currentCurrency = "euro"; // Update the current currency value
        disableButton(euroButton); // Disable the Euro button
        enableButton(dollarButton);  // Enable the Dollar button
        enableButton(poundButton); // Enable the Pound button
      }
    });
  
    dollarButton.addEventListener("click", function() { // Event listener for the Pound button click
      if (currentCurrency === "pound") { // Check if the current currency is Euro
        convertToCurrency(1.23); // Convert the currency to Dollar
        currentCurrency = "dollar"; // Update the current currency value
        disableButton(dollarButton); // Disable the Dollar button
        enableButton(euroButton); // Enable the Euro button
        enableButton(poundButton); // Enable the Pound button
      } else if (currentCurrency === "euro") { // Check if the current currency is Euro
        convertToCurrency(1.07); // Convert the currency to Dollar
        currentCurrency = "dollar"; // Update the current currency value
        disableButton(dollarButton); // Disable the Dollar button
        enableButton(euroButton); // Enable the Euro button
        enableButton(poundButton); // Enable the Pound button
      }
    });
  
    poundButton.addEventListener("click", function() {// Event listener for the Pound button click
      if (currentCurrency === "euro") {  // Check if the current currency is Euro
        convertToCurrency(0.87); // Convert the currency to Pound
        currentCurrency = "pound"; // Update the current currency value
        disableButton(poundButton); // Disable the Pound button
        enableButton(euroButton); // Enable the Euro button
        enableButton(dollarButton); // Enable the Dollar button
      } else if (currentCurrency === "dollar") {
        convertToCurrency(0.81); // Convert the currency to Pound
        currentCurrency = "pound"; // Update the current currency value
        disableButton(poundButton); // Disable the Pound button
        enableButton(euroButton); // Enable the Euro button
        enableButton(dollarButton); // Enable the Dollar button
      }
    });
  
     // Function to convert currency
     function convertToCurrency(conversionRate) {
      var targetTDs = document.querySelectorAll("td[data-target]"); // Get all the target TD elements
      targetTDs.forEach(function(td) {
          var tdValue = parseFloat(td.innerText); // Get the value from the TD element
          var convertedValue = tdValue * conversionRate; // Convert the value using the conversion rate
          td.innerText = convertedValue.toFixed(2); // Update the TD element with the converted value
      });
  }
  
    // Function to disable a button
    function disableButton(button) {
      button.disabled = true; // Set the button as disabled
    }
  
    // Function to enable a button
    function enableButton(button) {
      button.disabled = false; // Set the button as enabled
    }
  

  });
  
   