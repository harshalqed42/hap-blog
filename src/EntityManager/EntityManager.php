<?php
/**
 * EntityManager Implementation
 */
namespace HAPBlog\EntityManager;

use HAPBlog\Database\Database;

/**
 * Load, Create, Update or Delete Entity
 *  
 */

Class EntityManager
{    
      private $_table;
      public function __construct($conn, $type)
      { 
        // @todo: Create an Interface.
        //$type;@todo check how class name is defined
        //after that use $type passed in construct.
        $this->_table = $type;
        $this->database = $conn;
      }

      /**
       * Load Blog by id.
       *
       * @param int $id 
       *    Blog Id.
       *
       * @return object
       *  Blog Object.
       */
       public function load($id) {
           //@todo check if table is invoked
        return (obj) $this->database->selectQuery($this->table, '*', [
            'operator' => '=',
            'field' => 'id',
            'value'=> $id
            ]
        );
       }



      /**
       * Create Blog.
       *
       * @data 
       *   Blog Data.
       *
       * @return int
       *   Blog Id
       */
       public function create($data) {
         $this->database->insertQuery(
           self::TABLE,
           array_keys($data),
           array_values($data)
         );  
       }


       /**
        * Update Blog Object.
        *
        * @data 
        *   Blog Data.
        * @id
        *   Blog Id
        *
        * @return object
        *   Blog Object
        */
        public function update($data, $id) {
          $conditions = [
            'operator' => '=',
            'field' => 'id',
            'value' => $id
          ];
          $field_with_values = $data + ['id' => $id];
          $this->database->updateQuery(self::TABLE, $field_with_values, $conditions);  
        }

        /**
         * Builds a listing of aggregator feed items.
         *
         * @id 
         *   Blog Id.
         *
         * @return boolean
         *   true on deletion or false 
         */
         public function delete($id) {
            return $this->database->deleteQuery(self::TABLE, [
               'value' => $id,
               'operator' => '=',
               'field' => 'id',
              ]
            ); 
         }
}
