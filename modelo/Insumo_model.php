<?php

Class Insumo_model{

    private $db;
    private $insumos;



    public function __construct(){
        $this->db = Conectar::conexion();
    }

    public function get_insumos(){
        $consulta = "SELECT i.*
                            ,c.nombre AS 'categoria'
                            ,u.nombre AS 'ubicacion'
                            ,d.nombre AS 'departamento'
                            -- ,b.nombre AS 'box'
                        FROM insumo i
                        INNER JOIN categoria c ON i.id_categoria = c.id_categoria
                        INNER JOIN centro u ON i.id_centro = u.id_centro
                        INNER JOIN departamento d ON i.id_departamento = d.id_departamento
                        -- INNER JOIN box b ON b.id_departamento = i.id_box
                        GROUP BY i.num_serie";

                        $resultado = $this->db->query($consulta);
                    
                        while($row = $resultado->fetch_assoc()){
                            $this->insumos[] = $row;
                        }
                        
                        return $this->insumos;
    }
    public function get_insumo_id($id){
        $consulta = "SELECT i.*
                        ,c.nombre AS 'categoria'
                        ,u.nombre AS 'ubicacion'
                        ,d.nombre AS 'departamento'
                        ,b.nombre AS 'box'
                    FROM insumo i
                    INNER JOIN categoria c ON i.id_categoria = c.id_categoria
                    INNER JOIN centro u ON i.id_centro = u.id_centro
                    LEFT JOIN departamento d ON i.id_departamento = d.id_departamento
                    RIGHT JOIN box b ON b.id_box = i.id_box
                    WHERE i.id_insumo = '$id'";
                    
                     $resultado = $this->db->query($consulta);
                     $row = $resultado->fetch_assoc();
                     return $row;
    }
    public function get_insumo_serie($id){
        $consulta = "SELECT i.id_extras, c.id_categoria AS 'idcateextra', h.nombre AS 'categoria', (SELECT marca FROM insumo WHERE id_insumo = i.id_extras) AS 'marcaextra', (SELECT num_serie FROM insumo WHERE id_insumo = i.id_extras) AS 'numserieextra'
                        FROM insumo i
                        INNER JOIN insumo c ON i.id_extras = c.id_insumo
                        INNER JOIN categoria h ON h.id_categoria = c.id_categoria
                        WHERE i.num_serie = '$id'";
        $resultado = $this->db->query($consulta);
        while($row = $resultado->fetch_assoc()){
            $this->insumos[] = $row;
        }
        return $this->insumos;
    }
    public function get_insumos_encargado($id){
        $consulta = "SELECT i.*
                            ,c.nombre AS 'categoria'
                            ,u.nombre AS 'ubicacion'
                            ,d.nombre AS 'departamento'
                            ,b.nombre AS 'box'
                        FROM insumo i
                        INNER JOIN categoria c ON i.id_categoria = c.id_categoria
                        INNER JOIN centro u ON i.id_centro = u.id_centro
                        LEFT JOIN departamento d ON i.id_departamento = d.id_departamento
                        LEFT JOIN box b ON b.id_box = i.id_box
                        WHERE u.id_usuario = '$id'
                        GROUP BY i.num_serie";
        $resultado = $this->db->query($consulta);

        while($row = $resultado->fetch_assoc()){
            $this->insumos[] = $row;
        }
        return $this->insumos;
    }
        // funcion para obtener insumos mouse que no esten asignados y que esten activos
    public function get_insumo_mouse(){
        $consulta = "SELECT i.*
                        ,c.nombre AS 'categoria'
                        ,u.nombre AS 'ubicacion'
                        ,d.nombre AS 'departamento'
                    FROM insumo i
                    INNER JOIN categoria c ON i.id_categoria = c.id_categoria
                    INNER JOIN centro u ON i.id_centro = u.id_centro
                    INNER JOIN departamento d ON i.id_departamento = d.id_departamento
                    WHERE i.id_categoria = 4 AND i.asignado = 0 AND i.estado = 0";
                    $resultado = $this->db->query($consulta);

                    while($row = $resultado->fetch_assoc()){
                        $this->insumos[] = $row;
                    }
                    return $this->insumos;
    }
        // funcion para obtener insumos teclado que no esten asignados y que esten activos
    public function get_insumo_teclado(){
        $consulta = "SELECT i.*
                        ,c.nombre AS 'categoria'
                        ,u.nombre AS 'ubicacion'
                        ,d.nombre AS 'departamento'
                    FROM insumo i
                    INNER JOIN categoria c ON i.id_categoria = c.id_categoria
                    INNER JOIN centro u ON i.id_centro = u.id_centro
                    INNER JOIN departamento d ON i.id_departamento = d.id_departamento
                    WHERE i.id_categoria = 5 AND i.asignado = 0 AND i.estado = 0";
                    $resultado = $this->db->query($consulta);

                    while($row = $resultado->fetch_assoc()){
                        $this->insumos[] = $row;
                    }
                    return $this->insumos;
    }
    // funcion para obtener insumos pantalla que no esten asignados y que esten activos
    public function get_insumo_pantalla(){
        $consulta = "SELECT i.*
                        ,c.nombre AS 'categoria'
                        ,u.nombre AS 'ubicacion'
                        ,d.nombre AS 'departamento'
                    FROM insumo i
                    INNER JOIN categoria c ON i.id_categoria = c.id_categoria
                    INNER JOIN centro u ON i.id_centro = u.id_centro
                    INNER JOIN departamento d ON i.id_departamento = d.id_departamento
                    WHERE i.id_categoria = 3 AND i.asignado = 0 AND i.estado = 0";
                    $resultado = $this->db->query($consulta);

                    while($row = $resultado->fetch_assoc()){
                        $this->insumos[] = $row;
                    }
                    return $this->insumos;
    }
    // funcion para obtener insumos cpu que no esten asignados y que esten activos
    public function get_insumo_cpu(){
        $consulta = "SELECT i.*
                        ,c.nombre AS 'categoria'
                        ,u.nombre AS 'ubicacion'
                        ,d.nombre AS 'departamento'
                    FROM insumo i
                    INNER JOIN categoria c ON i.id_categoria = c.id_categoria
                    INNER JOIN centro u ON i.id_centro = u.id_centro
                    INNER JOIN departamento d ON i.id_departamento = d.id_departamento
                    WHERE i.id_categoria = 6 AND i.asignado = 0 AND i.estado = 0";
                    $resultado = $this->db->query($consulta);

                    while($row = $resultado->fetch_assoc()){
                        $this->insumos[] = $row;
                    }
                    return $this->insumos;
    }
    public function get_insumo_cpuedit($id){
        $consulta = "SELECT i.*
                        ,c.nombre AS 'categoria'
                        ,u.nombre AS 'ubicacion'
                        ,d.nombre AS 'departamento'
                    FROM insumo i
                    INNER JOIN categoria c ON i.id_categoria = c.id_categoria
                    INNER JOIN centro u ON i.id_centro = u.id_centro
                    INNER JOIN departamento d ON i.id_departamento = d.id_departamento
                    WHERE i.id_categoria = 6  AND i.id_insumo = '$id'";
                    $resultado = $this->db->query($consulta);

                    while($row = $resultado->fetch_assoc()){
                        $this->insumos[] = $row;
                    }
                    return $this->insumos;
    }
    // funcion para obtener insumos ram que no esten asignados y que esten activos
    public function get_insumo_ram(){
        $consulta = "SELECT i.*
                        ,c.nombre AS 'categoria'
                        ,u.nombre AS 'ubicacion'
                        ,d.nombre AS 'departamento'
                    FROM insumo i
                    INNER JOIN categoria c ON i.id_categoria = c.id_categoria
                    INNER JOIN centro u ON i.id_centro = u.id_centro
                    INNER JOIN departamento d ON i.id_departamento = d.id_departamento
                    WHERE i.id_categoria = 7 AND i.asignado = 0 AND i.estado = 0";
                    $resultado = $this->db->query($consulta);

                    while($row = $resultado->fetch_assoc()){
                        $this->insumos[] = $row;
                    }
                    return $this->insumos;
    }
    // funcion para obtener insumos almacenamiento que no esten asignados y que esten activos
    public function get_insumo_almacenamiento(){
        $consulta = "SELECT i.*
                        ,c.nombre AS 'categoria'
                        ,u.nombre AS 'ubicacion'
                        ,d.nombre AS 'departamento'
                    FROM insumo i
                    INNER JOIN categoria c ON i.id_categoria = c.id_categoria
                    INNER JOIN centro u ON i.id_centro = u.id_centro
                    INNER JOIN departamento d ON i.id_departamento = d.id_departamento
                    WHERE i.id_categoria = 8 AND i.asignado = 0 AND i.estado = 0";
                    $resultado = $this->db->query($consulta);

                    while($row = $resultado->fetch_assoc()){
                        $this->insumos[] = $row;
                    }
                    return $this->insumos;
    }
    public function insertarInsumo($id=null, $marca, $modelo, $serie, $descripcion,$asignado,$estado, $id_centro,$id_departamento, $id_box, $id_categoria,$id_extra,$usuario) {
        $consulta = $this->db->query("INSERT INTO insumo (id_insumo, marca, modelo , num_serie, descripcion,asignado,estado, id_centro,id_departamento, id_box, id_categoria,id_extras) VALUES (null, '$marca', '$modelo', '$serie', '$descripcion', '$asignado','$estado', '$id_centro','$id_departamento', '$id_box', '$id_categoria', '$id_extra' )");
        $lasid = mysqli_insert_id($this->db);
        $resultado1 = $this->db->query("UPDATE insumo SET id_centro = '$id_centro', id_departamento = '$id_departamento',id_box = '$id_box' WHERE id_insumo = '$id_extra'");
        $catego = $this->db->query("SELECT c.* 
                                    FROM insumo i
                                    INNER JOIN categoria c ON c.id_categoria = i.id_categoria
                                    WHERE i.id_insumo = '$id_extra'");
        $row = $catego->fetch_assoc();
        $rowe = $row['id_categoria'];
        
        return array($lasid,$rowe);
    }
    public function insertarInsumoo($id=null, $marca, $modelo, $serie, $descripcion,$asignado,$estado, $id_centro,$id_departamento, $id_box, $id_categoria,$id_extra=null,$usuario) {
        $consulta = $this->db->query("INSERT INTO insumo (id_insumo, marca, modelo , num_serie, descripcion,asignado,estado, id_centro,id_departamento, id_box, id_categoria,id_extras) VALUES (null, '$marca', '$modelo', '$serie', '$descripcion', '$asignado','$estado', '$id_centro','$id_departamento', '$id_box', '$id_categoria', null )");
        $lasid = mysqli_insert_id($this->db);
        return $lasid;
        // $resulta = $this->db->query("INSERT INTO historial (id_historial,fecha_accion,usuario_entrega,id_insumo,categoria,centro,departamento,box) VALUE (null, CURDATE( ),'$usuario', '$lasid', '$id_categoria', '$id_centro', '$id_departamento','$id_box')");
    }
    public function cambiarAsignadoInsumo($id){
        $resultado = $this->db->query("UPDATE insumo SET asignado = '1' WHERE id_insumo = '$id'");
    }
    public function cambiarAsignadoInsumolibre($id){
        $resultado = $this->db->query("UPDATE insumo SET asignado = '0' WHERE id_insumo = '$id'");
    }
    public function cambiarubicacion($id, $id_centro,$id_departamento,$id_box){
        $resultado = $this->db->query("UPDATE insumo SET id_centro = '$centro' id_departamento = '$departamento', id_box = 'id_box' WHERE id_insumo = '$id'");
    }
    public function modificarInsumo($id, $marca, $modelo, $descripcion){        
        $resultado = $this->db->query("UPDATE insumo SET  marca='$marca', modelo='$modelo', descripcion='$descripcion' WHERE id_insumo = $id");
    }
    public function modificarInsumoPeri($id, $marca, $modelo, $descripcion,$id_centro,$id_departamento,$id_box){        
        $resultado = $this->db->query("UPDATE insumo SET  marca='$marca', modelo='$modelo', descripcion='$descripcion' ,id_centro = '$id_centro', id_departamento = '$id_departamento' , id_box = '$id_box' WHERE id_insumo = $id");
    }
    public function modificarInsumoEncargado($id,$descripcion){
        $resultado = $this->db->query("UPDATE insumo SET   descripcion='$descripcion'  WHERE id_insumo = $id");
    }

}
?>