<?php 
include_once 'models/alumno.php';
class ConsultaModel extends Model{
    public function __construct(){
        parent:: __construct();
    }

    public function get(){
      $items = [];
      try{

        $query = $this->db->connect()->query("SELECT*FROM alumnos");

            while($row = $query->fetch()){
                $item = new Alumno();
                $item->matricula = $row['matricula'];
                $item->nombre    = $row['nombre'];
                $item->apellidop  = $row['apellidop'];
                $item->apellidom  = $row['apellidom'];
                $item->telefono  = $row['telefono'];
                $item->email  = $row['email'];
                $item->img  = $row['img'];
                array_push($items, $item);
            }
            return $items;
      }catch(PDOException $e){
        return [];

      }
    }
    

    public function getById($id){
      $item = new Alumno();

      $query = $this->db->connect()->prepare("SELECT * FROM alumnos WHERE matricula = :matricula ");
      try{
          $query->execute(['matricula' => $id]);

          while($row = $query->fetch()){
            $item->matricula = $row['matricula'];
            $item->nombre    = $row['nombre'];
            $item->apellidop  = $row['apellidop'];
            $item->apellidom  = $row['apellidom'];
            $item->telefono  = $row['telefono'];
            $item->email  = $row['email'];
            $item->img  = $row['img'];
          }

        return $item;
      }catch(PDOException $e){
        return null;
      }
    }

    

    public function update($item){
     $query = $this->db->connect()->prepare("UPDATE alumnos SET nombre = :nombre, apellidop = :apellidop, apellidom = :apellidom, telefono = :telefono, email = :email, img = :img where matricula = :matricula ");

            try{
                $query->execute([
                  'matricula' => $item['matricula'],
                  'nombre'    => $item['nombre'],
                  'apellidop' => $item['apellidop'],
                  'apellidom'  => $item['apellidom'],
                  'telefono'  => $item['telefono'],
                  'email'     => $item['email'],
                  'img'     => $item['img']
                ]);

                  return true;
            }catch(PFOException $e){
              return false;
            }

    }

   


    public function delete($id){

      $query = $this->db->connect()->prepare("DELETE FROM alumnos  where matricula = :id");
            try{
                $query->execute([
                  'id' => $id,
                ]);

                  return true;
            }catch(PFOException $e){
              return false;
            }

    }

    


    
    public function search($palabra){
      $items = [];
      $otro=Null;
     ////$consulta_mysql= mysql_query ("SELECT * FROM usuarios WHERE nombre like '%$buscar%' or apellidos like '%$buscar%'");
     try{

      $query = $this->db->connect()->query("SELECT * FROM alumnos WHERE  matricula like '%$palabra%'  or nombre  like '%$palabra%' or  img  like '%$palabra%' or apellidop like '%$palabra%' or apellidom like '%$palabra%' or telefono like '%$palabra%' or email like '%$palabra%'");

          while($row = $query->fetch()){
              $item = new Alumno();
              $item->matricula = $row['matricula'];
              $item->nombre    = $row['nombre'];
              $item->apellidop  = $row['apellidop'];
              $item->apellidom  = $row['apellidom'];
              $item->telefono  = $row['telefono'];
              $item->email  = $row['email'];
              $item->img  = $row['img'];
             //$otro = $row['img'];
           array_push($items, $item);
          }
        

        // var_dump($item);
          return $items;
    }catch(PDOException $e){
      return [];

    }

    }


    public function vali($palabra){
      $items = [];
      $otro=Null;
     ////$consulta_mysql= mysql_query ("SELECT * FROM usuarios WHERE nombre like '%$buscar%' or apellidos like '%$buscar%'");
     try{

      $query = $this->db->connect()->query("SELECT * FROM alumnos WHERE  matricula = '%$palabra%'  or nombre  like '%$palabra%' or  img  like '%$palabra%' or apellidop like '%$palabra%' or apellidom like '%$palabra%' or telefono like '%$palabra%' or email like '%$palabra%'");

          while($row = $query->fetch()){
              $item = new Alumno();
              $item->matricula = $row['matricula'];
              $item->nombre    = $row['nombre'];
              $item->apellidop  = $row['apellidop'];
              $item->apellidom  = $row['apellidom'];
              $item->telefono  = $row['telefono'];
              $item->email  = $row['email'];
              $item->img  = $row['img'];
              $otro = $row['img'];
           array_push($items, $item);
          }
        // var_dump($otro);

         if($otro  == null){
          return false;
         
         }else{
          return true;
         }

        // var_dump($item);
         
    }catch(PDOException $e){
      return false;

    }

    }

    public function nom_img($palabra){
    
      $otro=Null;
      try{

      $query = $this->db->connect()->query("SELECT * FROM alumnos WHERE  matricula = '$palabra'");

          while($row = $query->fetch()){
             
              $otro = $row['img'];
          }
         //var_dump($otro);

         return $otro;
        // var_dump($item);
         
    }catch(PDOException $e){
      return "";

    }

    }

}
?>