<?php function anti_sql_injection( $input ) {   

          // daftarkan perintah-perintah SQL yang tidak boleh ada

          // dalam query dimana SQL Injection mungkin dilakukan

          $aforbidden = array (

          "insert", "select", "update", "delete", "truncate",

          "replace", "drop", " or ", ";", "#", "--", "=" );

       

          // lakukan cek, input tidak mengandung perintah yang tidak boleh

          $breturn=true;   

          foreach($aforbidden as $cforbidden) {

              if(strripos($input, $cforbidden)) {

                  $breturn=false;

                  break;   

              }   

          }

          return $breturn;

      } ?>
