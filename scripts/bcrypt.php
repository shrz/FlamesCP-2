<?php
  //Bcrypt hashing for bash             
  echo password_hash($argv[1], PASSWORD_BCRYPT, [ 'cost' => $argv[2] ]);