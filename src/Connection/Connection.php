<?php
namespace HAPBlog\Connection;

require 'vendor/autoload.php';

use HAPBlog\Database\Database;

class Connection
{
    public function __construct()
    {
      $this->database = new Database('localhost', 'root', 'root', 'harshal_blog');
    }
}
