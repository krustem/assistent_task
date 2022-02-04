<?php session_start();?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Доска отзывов</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body> 
    <div class="container mx-auto px-4 flex justify-center grid grid-cols-1 gap-4">
        <div class="flex w-full" id='authBox'>
            <div class="w-1/3 inline-flex">
                <p class="p-2" style="cursor: pointer;" id="registerBoxLink">Register</p>
                <p class="p-2" style="cursor: pointer;" id="loginBoxLink">Login</p>
            </div>
            <?php
            // var_dump($_SESSION['login_user']);
            if($_SESSION['login_user'] !== null){
                echo"
                <div class='w-1/3 inline-flex' id='logedInBox'>
                    <p class='p-2' style='cursor: pointer;' id='usernameLink'>$_SESSION[login_user]</p>
                    <p class='p-2' style='cursor: pointer;' id='logoutLink'>Logout</p>
                </div>";    
            } 
            
            ?>
        </div>
        <div class="mt-10 p-5 shadow-md" id="registerBox" style="display: none; position:absolute; background: #fff">
            <form class="mt-10" method="post" action="/assistent_task/server_side/auth/register.php">
                <div class="col-span-3 sm:col-span-2">
                    <label for="username" class="block text-sm font-medium text-gray-700">
                    Логин:
                    </label>
                    <div class="mt-1 mb-2 flex rounded-md shadow-sm">
                        <input type="username" name="username" id="company-website" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="user1">
                    </div>
                </div>   
                <div class="form-group w-50">
                    <label for="password" class="col-sm-2 col-form-label">Пароль:</label>
                    <div class="mb-2 flex rounded-md shadow-sm">
                    <input type="password" name="password" id="password_login" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="**********">

                    </div>
                </div>
                <div class="form-group w-50">
                    <label for="passwordconfirm" class="col-sm-2 col-form-label">Повторить пароль:</label>
                    <div class="mb-2 flex rounded-md shadow-sm">
                    <input type="password" name="passwordconfirm" id="passwordconfirm" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="**********">

                    </div>
                </div>
                
                <div class="form-group w-50">
                    <div class="offset-sm-2 col-sm-10">
                    <input type="submit" value="Зарегистрироваться" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"/>
                    </div>
                </div>
            </form> 
        </div>

        <div class="mt-10 p-5 shadow-md" id="loginBox" style="display: none; position:absolute; background: #fff">
            <form class="mt-10" method="post" action="/assistent_task/server_side/auth/login.php">
                <div class="col-span-3 sm:col-span-2">
                    <label for="username" class="block text-sm font-medium text-gray-700">
                    Логин:
                    </label>
                    <div class="mt-1 mb-2 flex rounded-md shadow-sm">
                        <input type="username" name="username" id="username_login" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="user1">
                    </div>
                </div>   
                <div class="form-group w-50">
                    <label for="password" class="col-sm-2 col-form-label">Пароль:</label>
                    <div class="mb-2 flex rounded-md shadow-sm">
                    <input type="password" name="password" id="password" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="**********">

                    </div>
                </div>
                
                
                <div class="form-group w-50">
                    <div class="offset-sm-2 col-sm-10">
                    <input type="submit" value="Войти" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"/>
                    </div>
                </div>
            </form> 
        </div>

        
        <div class="w-1/2 mt-10 mb-5" id="otzivy"></div>

        <form class="w-1/4 mt-10 shadow-md p-5" method="post" action="/assistent_task/server_side/Inserting.php">
            <div class="col-span-3 sm:col-span-2">
                <label for="name" class="block text-sm font-medium text-gray-700">
                Имя
                </label>
                <div class="mt-1 mb-2 flex rounded-md shadow-sm">
                    <input type="name" name="name" id="name_otziv" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="User">
                </div>
            </div>   
            <div class="form-group w-50">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="mb-2 flex rounded-md shadow-sm">
                <input type="email" name="email" id="inputEmail" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="example@example.com">

                </div>
            </div>
            <div class="mb-2">
              <label for="text" class="block text-sm font-medium text-gray-700">
                Текст сообщение
              </label>
              <div class="mt-1">
                <textarea id="text" name="text" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Очень понравилось"></textarea>
              </div>
                <div>  
                    Select image to upload:
                    <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
            </div>
            <div class="form-group w-50">
                <div class="offset-sm-2 col-sm-10">
                <input type="submit" value="Отправить" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"/>
                </div>
            </div>
        </form> 
    </div>
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="/assistent_task/js/ajax-script.js"></script>
    <script type="text/javascript" src="/assistent_task/js/showBoxes.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->
</body>
</html>