
(
    function makeAjaxRequest(){
    setTimeout(function(){  //calling the timeout function with the timer set to 3 sec
    $.ajax( {
        type:'GET', //method to retrive data from json file
        url:'course.json',
        dataType:"json",
        success: function(response){
            let datatxt="";
            $.each(response.courseDetails,function(index){
              
            
            const DurationList = document.createElement("ul");
            response.courseDetails[index].Duration.forEach((Duration) => {
            const DurationItem = document.createElement("li");
            DurationItem.textContent = Duration.name;
            DurationList.appendChild(DurationItem);
            });

            const StartingList = document.createElement("ul");
            response.courseDetails[index].Starting.forEach((Starting) => {
            const StartingItem = document.createElement("li");
            StartingItem.textContent = Starting.name;
            StartingList.appendChild(StartingItem);
            });
                
            const module_and_creditsList = document.createElement("ul");
            response.courseDetails[index].module_and_credits.forEach((module_and_credits) => {
            const module_and_creditsItem = document.createElement("li");
            module_and_creditsItem.textContent = module_and_credits.name;
            module_and_creditsList.appendChild(module_and_creditsItem);
            });

              datatxt+="<tr><td><a href='"+response.courseDetails[index].link+"'>" +response.courseDetails[index].name+"</a><br><br><b>Level : <br></b>"+response.courseDetails[index].Level+"<br><br> <b>Location  : <br>  </b>  "+response.courseDetails[index].Location+
              "</td><td >"
              +DurationList.innerHTML+"</td><td >"
              +StartingList.innerHTML+"</td><td data-target data-original class='center-align'>"
              +response.courseDetails[index].Fees+"</td><td data-target data-original class='center-align'>"
              +response.courseDetails[index].Fees_Int+"</td><td>"
              +response.courseDetails[index].course_Overview+"</td><td>"
              +response.courseDetails[index].Feesandfunding+"</td><td class='center-align'>"
              +response.courseDetails[index].english_language_requirements+"</td><td >"
              +module_and_creditsList.innerHTML+"</td>";
         });
            $(courseDetails).append(datatxt); 
            //the data obtained using the loop is stored to txt variable and it is added to the table using the append function and by referring the id for the table defined in tbody.
        },
        error: function(){
            $("#updatemessage").append("Error");
        }
    });
    }, 250);
  }());




  document.addEventListener("DOMContentLoaded", function() {
    // Get references to the buttons
    var euroButton = document.getElementById("euro");
    var dollarButton = document.getElementById("dollar");
    var poundButton = document.getElementById("pound");
  
    // Set the initial currency value
    var currentCurrency = "pound"; // Initial value for Pound
  
    // Add event listeners to the buttons
    euroButton.addEventListener("click", function() {
      if (currentCurrency === "pound") {
        convertToCurrency(1.15);
        currentCurrency = "euro"; // Update the current currency value
        disableButton(euroButton);
        enableButton(dollarButton);
        enableButton(poundButton);
      } else if (currentCurrency === "dollar") {
        convertToCurrency(0.93);
        currentCurrency = "euro"; // Update the current currency value
        disableButton(euroButton);
        enableButton(dollarButton);
        enableButton(poundButton);
      }
    });
  
    dollarButton.addEventListener("click", function() {
      if (currentCurrency === "pound") {
        convertToCurrency(1.23);
        currentCurrency = "dollar"; // Update the current currency value
        disableButton(dollarButton);
        enableButton(euroButton);
        enableButton(poundButton);
      } else if (currentCurrency === "euro") {
        convertToCurrency(1.07);
        currentCurrency = "dollar"; // Update the current currency value
        disableButton(dollarButton);
        enableButton(euroButton);
        enableButton(poundButton);
      }
    });
  
    poundButton.addEventListener("click", function() {
      if (currentCurrency === "euro") {
        convertToCurrency(0.87);
        currentCurrency = "pound"; // Update the current currency value
        disableButton(poundButton);
        enableButton(euroButton);
        enableButton(dollarButton);
      } else if (currentCurrency === "dollar") {
        convertToCurrency(0.81);
        currentCurrency = "pound"; // Update the current currency value
        disableButton(poundButton);
        enableButton(euroButton);
        enableButton(dollarButton);
      }
    });
  
    // Function to convert currency
    function convertToCurrency(conversionRate) {
      var targetTDs = document.querySelectorAll("td[data-target]");
      targetTDs.forEach(function(td) {
        var tdValue = parseFloat(td.innerText);
        var convertedValue = tdValue * conversionRate;
        td.innerText = convertedValue.toFixed(2);
      });
    }
  
    // Function to disable a button
    function disableButton(button) {
      button.disabled = true;
    }
  
    // Function to enable a button
    function enableButton(button) {
      button.disabled = false;
    }
  
    // Initially disable the pound button
    disableButton(poundButton);
  });
  
   


  
//   function disableButton(clickedButtonId) {
//     var buttons = document.getElementsByClassName("button-container")[0].getElementsByTagName("button");

//     for (var i = 0; i < buttons.length; i++) {
//       var button = buttons[i];
      
//       if (button.id === clickedButtonId) {
//         button.disabled = true;
//       } else {
//         button.disabled = false;
//       }
//     }
//   }


//   document.addEventListener("DOMContentLoaded", function() {
//     var euro = document.getElementById("euro");
//     euro.addEventListener("click", euro);
//   });

//   function euro() {
//     var targetTDs = document.querySelectorAll("td[data-target]");
//     targetTDs.forEach(function(td) {
//       var tdValue = parseInt(td.innerText);
//       var multipliedValue = tdValue * 1.15;
//       td.innerText = multipliedValue;
//     });
//   }

//   document.addEventListener("DOMContentLoaded", function() {
//     var dollar = document.getElementById("dollar");
//     dollar.addEventListener("click", dollar);
//   });

//   function dollar() {
//     var targetTDs = document.querySelectorAll("td[data-target]");
//     targetTDs.forEach(function(td) {
//       var tdValue = parseInt(td.innerText);
//       var multipliedValue = tdValue * 1.23;
//       td.innerText = multipliedValue;
//     });
//   }

//   document.addEventListener("DOMContentLoaded", function() {
//     var pound = document.getElementById("pound");
//     pound.addEventListener("click", pound);
//   });

//   function pound() {
//     var targetTDs = document.querySelectorAll("td[data-target]");
//     targetTDs.forEach(function(td) {
//       var tdValue = parseInt(td.innerText);
//       var multipliedValue = tdValue * 1.15;
//       td.innerText = multipliedValue;
//     });
//   }
  