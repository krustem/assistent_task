<?php
include('Helpers/database.php');
session_start();

$db=$conn;

// fetch query
function fetch_data(){
    global $db;
   
    $sql = "SELECT * from otziv ORDER BY id ASC";
    $result = $db->query($sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $rows;
}
$fetchData = fetch_data();

function show_data($fetchData){
    if(count($fetchData)>0){
        $sn=1;
        if($_SESSION['login_user'] !== null){ // Когда пользователь зашел
          echo "<div class='flex flex-col'>
              <div class='-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8'>
                <div class='py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8'>
                  <div class='shadow overflow-hidden border-b border-gray-200 sm:rounded-lg'>
                    <table class='min-w-full divide-y divide-gray-200'>
                      <thead class='bg-gray-50'>
                        <tr>
                          <th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>
                            Имя
                          </th>
                          <th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>
                            Отзывы
                          </th>
                          <th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>
                          Статус
                        </th>
                         
                          <th scope='col' class='relative px-6 py-3'>
                            <span class='sr-only'>Edit</span>
                          </th>
                          <th scope='col' class='relative px-6 py-3'>
                          <span class='sr-only'>Edit</span>
                      </th>
                        </tr>
                       
                        </thead>
                        <tbody class='bg-white divide-y divide-gray-200'>";
        }else { // Когда пользователь гость
          echo "<div class='flex flex-col'>
              <div class='-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8'>
                <div class='py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8'>
                  <div class='shadow overflow-hidden border-b border-gray-200 sm:rounded-lg'>
                    <table class='min-w-full divide-y divide-gray-200'>
                      <thead class='bg-gray-50'>
                        <tr>
                          <th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>
                            Имя
                          </th>
                          <th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>
                            Отзывы
                          </th>
                          <th scope='col' class='px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'>
                            
                          </th>
                         
                          <th scope='col' class='relative px-6 py-3'>
                            <span class='sr-only'>Edit</span>
                          </th>
                          <th scope='col' class='relative px-6 py-3'>
                          <span class='sr-only'>Edit</span>
                      </th>
                        </tr>
                       
                        </thead>
                        <tbody class='bg-white divide-y divide-gray-200'>";
        }


        foreach($fetchData as $data){ 

          // Когда пользователь зашел
          if($_SESSION['login_user'] !== null){
            echo "  <tr id='tr".$data['id']."'>
                      <td class='px-6 py-4 whitespace-nowrap'>
                        <div class='flex items-center'>
                            <div class='flex-shrink-0 h-10 w-10'>
                            <img class='h-10 w-10 rounded-full' src='' alt=''>
                            </div>
                            <div class='ml-4'>
                            <div class='text-sm font-medium text-gray-900'>
                                ".$data['username']."
                            </div>
                            <div class='text-sm text-gray-500'>
                            ".$data['email']."
                            </div>
                            </div>
                        </div>
                      </td>
                      <td class='px-6 py-4 whitespace-nowrap'>
                          <div class='text-sm text-gray-900'>
                          ".$data['text']."
                          </div>
                          
                      </td>
                      <td class='px-6 py-4 whitespace-nowrap'>
                        <div class='text-sm text-gray-900'>
                        ".$data['status_otziva']."
                        </div>
                      </td>
                      <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>
                        
                      </td>
                      <td class='px-6 py-4 whitespace-nowrap text-right text-sm font-medium'>
                        <a href='#' class='text-indigo-600 hover:text-indigo-900' onclick='editFeedback(".$data['id'].")'>Edit</a>
                      </td>
                    </tr>";
          $sn++;
          }else {// Когда пользователь гость
            if($data['status_otziva'] == 1){
              echo "  <tr>
                        <td class='px-6 py-4 whitespace-nowrap'>
                        <div class='flex items-center'>
                            <div class='flex-shrink-0 h-10 w-10'>
                            <img class='h-10 w-10 rounded-full' src='' alt=''>
                            </div>
                            <div class='ml-4'>
                            <div class='text-sm font-medium text-gray-900'>
                                ".$data['username']."
                            </div>
                            <div class='text-sm text-gray-500'>
                            ".$data['email']."
                            </div>
                            </div>
                        </div>
                        </td>
                        <td class='px-6 py-4 whitespace-nowrap'>
                            <div class='text-sm text-gray-900'>
                            ".$data['text']."
                            </div>
                            
                        </td>
                        <td class='px-6 py-4 whitespace-nowrap'>
                       
                        </td>
                        
                        <td class='px-6 py-4 whitespace-nowrap text-right text-sm font-medium'>
                          <a href='#' class='text-indigo-600 hover:text-indigo-900' onclick='showMessage()'>Edit</a>
                            <?= if(".$data['changed_by']." == true) echo <span>изменен администратором</span>
                          </td>
                    </tr>
        
                    
                      ";
            
       
              $sn++;
            }
          }
             
        }
        echo "          </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>";
    }else{
        
    echo "<tr>
            <td colspan='7'>No Data Found</td>
        </tr>"; 
    }
    echo '</table>';
}

show_data($fetchData);
mysqli_close($db);



?>