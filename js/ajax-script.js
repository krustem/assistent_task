// $(document).on('click','#showData',function(e){
$.ajax({    
type: "GET",
url: "/assistent_task/server_side/Fetching.php",             
dataType: "html",                  
success: function(data){                    
    $("#otzivy").html(data); 
}
});



// if( !$("#usernameLink").html()){
//     console.log('Salem');
//     $.ajax({    
//         type: "GET",
//         url: "/assistent_task/server_side/Fetching.php",             
//         dataType: "html",                  
//         success: function(data){                    
//             $("#otzivy").html(data); 
//         }
//     });
// }

// });