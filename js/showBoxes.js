// Event binding using addEventListener
var registerBtn = document.getElementById( "registerBoxLink" );
var LoginBtn = document.getElementById( "loginBoxLink" );
 





registerBtn.addEventListener( "click", function( event ) {
    var registerBox = document.getElementById( "registerBox" );
    var loginBox = document.getElementById( "loginBox" );
    
    // console.log();
    if(loginBox.style.display !== 'none' ){
        $( "#loginBox" ).hide( "fast" );
    }
    if(registerBox.style.display !== 'none' ){
        $( "#registerBox" ).hide( "fast" );
    }else{
        $( "#registerBox" ).show( "slow" );
    }  
}, false );

 
LoginBtn.addEventListener( "click", function( event ) {
    var loginBox = document.getElementById( "loginBox" );
    var registerBox = document.getElementById( "registerBox" );

    // console.log();
    if(registerBox.style.display !== 'none' ){
        $( "#registerBox" ).hide( "fast" );
    }
    if(loginBox.style.display !== 'none' ){
        $( "#loginBox" ).hide( "fast" );
    }else{
        $( "#loginBox" ).show( "slow" );
    }  
}, false );


if(document.getElementById( "logoutLink" )){
    var LogoutBtn = document.getElementById( "logoutLink" );

    LogoutBtn.addEventListener( "click", function( event ) {
        $.ajax({    
            type: "GET",
            url: "/assistent_task/server_side/auth/logout.php",             
            dataType: "html",                  
            success: function(data){                    
                // $("#otzivy").html(data); 
                console.log('Loged out!');
                $( "#logedInBox" ).hide( "fast" );

                $.ajax({    
                    type: "GET",
                    url: "/assistent_task/server_side/Fetching.php",             
                    dataType: "html",                  
                    success: function(data){                    
                        $("#otzivy").html(data); 
                    }
                });
            }
        });  
    
        
    }, false );
}


function showMessage(){
    alert('You need to sign in');
}

function saveChanges(id){


    var specialDiv = document.getElementById('tr'+id);

    var otziv_pole = specialDiv.children[1];
    var edit_pole = specialDiv.children[4];
    var status_pole = specialDiv.children[2];

    edit_pole.children[0].style.display = 'block';

    otziv_pole.children[0].style.display = 'block';
    
    otziv_pole.children[0].innerHTML = otziv_pole.children[1].value;
    status_pole.children[0].innerHTML = status_pole.children[1].children[0].value;

    console.log('status current: ', status_pole.children[1].children[0].value);

    var new_data = {
        'text':otziv_pole.children[1].value,
        'status_otziva':status_pole.children[1].children[0].value
    }


    edit_pole.children[1].remove();
    edit_pole.children[1].remove();

    
    otziv_pole.children[1].remove();
    status_pole.children[1].remove();
    // otziv_pole.children[1].style.display = 'none';
    // status_pole.children[1].style.display = 'none';

    console.log(specialDiv);

    $.ajax({    
        type: "POST",
        url: "/assistent_task/controllers/OtzivController.php",
        data: {'id':id, 'new_data': new_data, 'operation': 'update_otziv'},             
        dataType:'JSON',                  
        success: function(data){
            console.log(otziv_pole.children[1].value = data[0]['text']);
        }
    });

}

function change(id){
    var specialDiv = document.getElementById('tr'+id);
    var status_pole = specialDiv.children[2];
    var current_value = status_pole.children[1].children[0].value;
    console.log(current_value);
    if(current_value == '1'){
        status_pole.children[1].children[0].value = '0';
    }else {
        status_pole.children[1].children[0].value = '1';
    }
    
}

function cancelChanges(id){
    var specialDiv = document.getElementById('tr'+id);

    var otziv_pole = specialDiv.children[1];
    // console.log(otziv_pole);
    var edit_pole = specialDiv.children[4];
    var status_pole = specialDiv.children[2];



    otziv_pole.children[0].style.display = 'block';
    edit_pole.children[0].style.display = 'block';

    status_pole.children[0].innerHTML = status_pole.children[1].children[0].value;
    

    $("<td class='px-6 py-4 whitespace-nowrap text-right text-sm font-medium'>"+
        +"<a href='#' class='text-indigo-600 hover:text-indigo-900' onclick='editFeedback("+id+")>Edit</a>"+
    "</td>").appendTo();

    edit_pole.children[1].remove();
    edit_pole.children[1].remove();

    
    otziv_pole.children[1].remove();
    status_pole.children[1].remove();



}

function editFeedback(id){
    var specialDiv = document.getElementById('tr'+id);

    var otziv_pole = specialDiv.children[1];
    var edit_pole = specialDiv.children[4];
    var status_pole = specialDiv.children[2];
    
    otziv_pole.children[0].style.display = 'none';
    $( "<input class='shadow-md focus:ring-indigo-500 focus:border-indigo-500 font-bold py-2 px-4 rounded'type='text' name='text'/>" ).appendTo( otziv_pole );
    
    edit_pole.children[0].style.display = 'none';
    $('<svg onclick="saveChanges('+id+')" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-2 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">' + 
    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /> ' +
   '</svg>').appendTo(edit_pole);
   $('<svg onclick="cancelChanges('+id+')" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">'+
    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />'+
    '</svg>').appendTo(edit_pole);

    status_pole.children[0].innerHTML = '';
    $('<div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">'+
        '<input type="checkbox" onclick="change('+id+')" name="toggle" id="toggle" class="cursor-pointer"/>'+
        // '<label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>'+
      '</div>').appendTo(status_pole);

    // otziv_pole.appendTo("<a href='helloworld.com'>hello world</a>");

    $.ajax({    
        type: "GET",
        url: "/assistent_task/controllers/OtzivController.php",
        data: {'id':id, 'method_name': 'get_by_id'},             
        dataType:'JSON',                  
        success: function(response){                    
            // console.log(response[0]['id']);
            otziv_pole.children[1].value = response[0]['text'];
            status_pole.children[1].children[0].value = response[0]['status_otziva'];
            if(response[0]['status_otziva'] == 1){
                console.log(status_pole.children[1].children[0].checked = true);
            }else{
                console.log(status_pole.children[1].children[0].checked = false);

            }

        }
    });
}
