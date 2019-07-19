
<?php
require "vendor/autoload.php";
use HAPBlog\Database\Database;

$database = new Database('localhost', 'root', 'root', 'harshal_blog');

 //@todo write a function to be invoked which will generate a form.
 echo "Select from existing Configurations.<br>";
    $data = $database->selectQuery('setup','*',[
      'field' => 'status',
      'value' => 1,
      'operator' => '='
     ]
    );
    echo "<ul>";
    foreach($data as $val) {
      echo '<li> <a href="/config.php?id=' . $val['id'] . '">' . $val['title'] . '</a></li>';   
    }
    echo "</ul>";

    echo "Create a New Configuration instead of existing configuration.";
    echo "<br>
      <ul>
        <li>
          <a href='/new-config.php'> 
            + NEW 
          </a>
        </li>
      </ul>";

