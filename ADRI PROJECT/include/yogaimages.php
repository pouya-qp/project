<?php

    if(isset($_POST['upload'])){

       /* $newfilename = $_POST['img-title'];
            if(empty($_POST['img-title'])){
                $newfilename="Yoga";
            }
            else{
                $newfilename = strtolower(str_replace(" ","_",$newfilename));
            }*/

            $fileTitle = $_POST['img-title'];
            $filedes = $_POST['img-des'];
        
            $imageFile = $_FILES['img-file'];

            //print_r($imageFile);

            $fileName = $imageFile["name"];
            $fileType = $imageFile["type"];
            $fileTmpName = $imageFile["tmp_name"];
            $fileError = $imageFile["error"];
            $fileSize = $imageFile["size"];

            $fileExt = explode(".",$fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array("jpg","jpeg","png");

            if(in_array($fileActualExt,$allowed)){

                if($fileError === 0){
                    if($fileSize < 200000){

                        $imageFullName = $fileName .".". uniqid("",true) .".". $fileActualExt;
                        $fileDestination = "images/".$imageFullName;

                        include_once "connectToDB.php";
                        $sql = "SELECT * FROM yogaimages";

                        $stmt = mysqli_stmt_init($link);
                        if(!mysqli_stmt_prepare($stmt,$sql)){
                            echo 'SQL Statement Failed!';
                        }
                        else{
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            $rowCount = mysqli_num_rows($result);

                            $sql = "INSERT INTO yogaimages (titleImg,desImg,imgFullName) VALUES (?,?,?);";
                            if(!mysqli_stmt_prepare($stmt,$sql)){
                                echo 'SQL Statement Failed!';
                            }
                            else{
                                mysqli_stmt_bind_param($stmt, "sss", $$fileTitle,$filedes,$imageFullName);
                                mysqli_stmt_execute($stmt);

                                move_uploaded_file($fileTmpName,$fileDestination);

                                header("Location:../admin.php?upload=success");
                            }
                        }

                    }
                    else{
                        echo 'File size is too big!';
                        exit();
                    }
                }
                else{

                    echo 'Error';
                    exit();
                }
            }
            else{

                echo 'Wrong file type!';
                exit();
            }

    }

?>