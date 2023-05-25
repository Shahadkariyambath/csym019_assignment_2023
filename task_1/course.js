
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
              
              //using stringify function for converting the json data as it was having multipe sets of data inside ingredients, steps and nutrition.
              
              
            //   var ingredients=JSON.stringify(response.courseDetails[index].ingredients);
            //   console.log(ingredients);
            //   console.log(JSON.parse(ingredients));
  
            //   var steps=JSON.stringify(response.courseDetails[index].steps);
            //   console.log(steps);
            //   console.log(JSON.parse(steps));
  
            
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

              datatxt+="<tr><td><a href='"+response.courseDetails[index].link+"'>" +response.courseDetails[index].name+"</a></td><td>"
              +response.courseDetails[index].Level+"</td><td>"
              +DurationList.innerHTML+"</td><td>"
              +StartingList.innerHTML+"</td><td>"
              +response.courseDetails[index].Fees+"</td><td>"
              +response.courseDetails[index].Fees_Int+"</td><td>"
              +response.courseDetails[index].Location+"</td><td>"
              +response.courseDetails[index].course_Overview+"</td><td>"
              +response.courseDetails[index].english_language_requirements+"</td><td>"
              +module_and_creditsList.innerHTML+"</td>";
         });
            $(recipeTable).append(datatxt); 
            //the data obtained using the loop is stored to txt variable and it is added to the table using the append function and by referring the id for the table defined in tbody.
        },
        error: function(){
            $("#updatemessage").append("Error");
        }
    });
    }, 250);
  }());
  