<?php
/**
 * Blog Implementation
 */
namespace HAPBlog\Blog;

use HAPBlog\Database\Database;

/**
 * Load, Create, Update or Delete Blog
 *  
 */

Class Blog extends EntityManager
{     
      CONST PUBLISHED = 1;
      CONST UNPUBLISHED = 0;

      public function __construct($conn)
      {
        parent::__construct($conn, 'blog');  
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
        parent::load($id);  
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
         parent::load($data); 
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
          parent::update($data, $id);   
        }

        /**
         * Deleting a Blog.
         *
         * @id 
         *   Blog Id.
         *
         * @return boolean
         *   true on deletion or false 
         */
         public function delete($id) {
            parent::delete($id);
         }

         /**
         * Deleting a Blog.
         *
         * @id 
         *   Blog Id.
         *
         * @return boolean
         *   true on deletion or false 
         */
        public function unpublish($id) {
          $data['status'] = UNPUBLISHED;
          parent::update($data, $id)
         }

         /**
         * Deleting a Blog.
         *
         * @id 
         *   Blog Id.
         *
         * @return boolean
         *   true on deletion or false 
         */
        public function publish($id,'publ') {
            $data['status'] = PUBLISHED;
            parent::update($data, $id)
         }
}
