<?php
<?php

namespace HAPBlog\User;
use HAPBlog\Database\Database;

Class User extends EntityManager{
    const TABLE = ''; 
    // self::TABLE = 'user'; //@todo should I write here or inside constructor
    public function __construct($conn)
      {
        self::TABLE = 'user';
        parent::__construct($conn, self::TABLE);  
      }

      /**
       * Load User by id.
       *
       * @param int $id 
       *    User Id.
       *
       * @return object
       *  User Object.
       */
       public function load($id) {
        parent::load($id);  
       }



      /**
       * Create User.
       *
       * @data 
       *   User Data.
       *
       * @return int
       *   User Id
       */
       public function create($data) {
         parent::load($data); 
       }


       /**
        * Update User Object.
        *
        * @data 
        *   User Data.
        * @id
        *   User Id
        *
        * @return object
        *   User Object
        */
        public function update($data, $id) {
          parent::update($data, $id);   
        }

        /**
         * Deleting a User.
         *
         * @id 
         *   User Id.
         *
         * @return boolean
         *   true on deletion or false 
         */
         public function delete($id) {
            parent::delete($id);
         }

        /**
         * Check if a User exists.
         *
         * @id 
         *   User Id.
         *
         * @return boolean
         *   true on deletion or false 
         */
        public function userExistsById($id) {
          if ($this->load($id)) {
            return true;  
          }
          return false;
        }

        /**
         * Check if a User exists.
         *
         * @id 
         *   User Id.
         *
         * @return boolean
         *   true on deletion or false 
         */
        public function userExistsByEmail($email) {
           $conditions = [
             'operator' => '=',
             'field' => 'email',
             'value' => $email
           ];
           $data = $this->database->selectQuery(self::TABLE, ['id'], $conditions);
           if (isset($data['id'])) {
             return TRUE;  
           }
        }
}