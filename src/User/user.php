<?php 
class User {
        private $id;
        private $password;
        private $permission;
        public function setId($id="")
        {
            $this->id=$id;
        }
        public function getId()
        {
            return $this->id;
        }
        public function setName($name="")
        {
            $this->name=$name;
        }
        public function getName()
        {
            return $this->name;
        }   
        public function setPermission($id="")
        {
            $this->id=$id;
        }
        public function getPermission()
        {
            return $this->permission;
        }
    }
?>