<?php

function callAPI($url)
{

    //inicio la función curl con la url de la petición a servidor
    $ch = curl_init($url);
    //establezco que quiero una respuesta
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    //ejecuto la petición curl y guardo la respuesa en resp
    $resp = curl_exec($ch);

    //compruebo que la función de ejecución ha terminado correctamente
    if (curl_errno($ch) == 0) {

        //recupero el código de respuesta del protocolo http (200, 404, 500, etc)
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        //compruebo que la petición del protocolo http ha sido correcta (200)
        if ($http_code == 200) {
            return $resp;
        } else {
            return -1;
        }
    } else {

        return -2;
    }

    //cierro curl	
    curl_close($ch);
}

class HeliosDB
{

	public $host;
	public $port;
	public $db;
	public $user;
	public $pass;
	public $pdo;

	public function __construct()
	{
		$this->host = "localhost";
		$this->port = "3306";
		$this->db = "helios";
		$this->user = "root";
		$this->pass = "";
		$this->pdo = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->db", $this->user, $this->pass);
	}

	/***********************************************************************************************************************/

	function comprobarUsuario($usuario)
	{
		$consulta = $this->pdo->prepare("SELECT nombreUsuario FROM users WHERE nombreUsuario=:usu");

		$array = [
			":usu" => $usuario
		];

		$consulta->execute($array);
		$res = $consulta->fetchAll(PDO::FETCH_ASSOC);

		return $res;
	}

	function comprobarContrasena($usuario, $contrasena)
	{
		$consulta = $this->pdo->prepare("SELECT contrasena FROM users WHERE nombreUsuario=:usu AND contrasena=:pass");

		$array = [
			":usu" => $usuario,
			":pass" => md5($contrasena)
		];

		$consulta->execute($array);
		$res = $consulta->fetchAll(PDO::FETCH_ASSOC);

		return $res;
	}

	function loginUsuario($usuarioIni, $contrasenaIni)
	{

		$consulta = $this->pdo->prepare("SELECT nombreUsuario,contrasena FROM users WHERE nombreUsuario=:usu AND contrasena=:pss");

		$array = [
			":usu" => $usuarioIni,
			":pss" => md5($contrasenaIni)
		];

		$consulta->execute($array);
		$res = $consulta->fetchAll(PDO::FETCH_ASSOC);

		return $res;
	}

	function idInstalacion($usuario){

		$consulta = $this->pdo->prepare("SELECT id_instalacion FROM posiciones WHERE nombreUsuario=:usu");

		$array = [
			":usu" => $usuario
		];

		$consulta->execute($array);
		$res = $consulta->fetchAll(PDO::FETCH_ASSOC);

		return $res;
	}

	function signInUsuario($nombreUsu, $contrasenaReg, $emailReg, $nombre, $apellidos, $provincia, $municipio, $fechaReg)
	{

		$consulta = $this->pdo->prepare("INSERT INTO users(nombreUsuario,contrasena,email,nombre,apellidos,provincia,municipio,fechaReg) 
		VALUES (:nomUsu, :contra, :em, :nomPer, :apePer, :prov, :munic, :fReg)");

		$array = [

			":nomPer" => $nombre,
			":apePer" => $apellidos,
			":nomUsu" => $nombreUsu,
			":em" => $emailReg,
			":prov" => $provincia,
			":munic" => $municipio,
			":contra" => md5($contrasenaReg),
			":fReg" => $fechaReg
		];

		$res = $consulta->execute($array);

		return $res;
	}

	function datosUsuario($usuario)
	{
		$consulta = $this->pdo->prepare("SELECT * FROM users WHERE nombreUsuario=:usu");

		$array = [
			":usu" => $usuario
		];

		$consulta->execute($array);
		$res = $consulta->fetchAll(PDO::FETCH_ASSOC);

		return $res;
	}

	function actualizarEmail($email, $usuario){

		$consulta = $this->pdo->prepare("UPDATE users SET email=:em WHERE nombreUsuario=:usu");
		
		$array = [
			":em" => $email,
			":usu" => $usuario
		];
		
		$res = $consulta->execute($array);

		return $res;
	}
	
	function actualizarContrasena($pass, $usuario){

		$consulta = $this->pdo->prepare("UPDATE users SET contrasena=:contra WHERE nombreUsuario=:usu");
		
		$array = [
			":contra" => md5($pass),
			":usu" => $usuario
		];
		
		$res = $consulta->execute($array);

		return $res;
	}

	function provinciasEspana()
	{

		$consulta = $this->pdo->prepare("SELECT * FROM provincias");

		$consulta->execute();

		$res = $consulta->fetchAll(PDO::FETCH_ASSOC);

		return $res;
	}

	function municipiosEspana($idProvincia)
	{

		$consulta = $this->pdo->prepare("SELECT * FROM municipios WHERE idProvincia=:idProv");

		$array = [
			":idProv" => $idProvincia
		];

		$consulta->execute($array);

		$res = $consulta->fetchAll(PDO::FETCH_ASSOC);

		return $res;
	}


	function consultarProvincia($usuario)
	{

		$consulta = $this->pdo->prepare("SELECT provincia FROM users WHERE nombreUsuario=:usu");

		$array = [
			":usu" => $usuario
		];

		$consulta->execute($array);
		$res = $consulta->fetchAll(PDO::FETCH_ASSOC);

		return $res;
	}

	function consultarMunicipio($usuario)
	{

		$consulta = $this->pdo->prepare("SELECT municipio FROM users WHERE nombreUsuario=:usu");

		$array = [
			":usu" => $usuario
		];

		$consulta->execute($array);
		$res = $consulta->fetchAll(PDO::FETCH_ASSOC);

		return $res;
	}

	function datosUsuarioPosicion($usuario)
	{

		$consulta = $this->pdo->prepare("SELECT * FROM users WHERE nombreUsuario=:usu");

		$array = [
			":usu" => $usuario
		];

		$consulta->execute($array);
		$res = $consulta->fetchAll(PDO::FETCH_ASSOC);

		return $res;
	}

	function siExiste($usuario)
	{

		$consulta = $this->pdo->prepare("SELECT registrado FROM posiciones WHERE nombreUsuario=:usu");

		$array = [
			":usu" => $usuario
		];

		$consulta->execute($array);
		$res = $consulta->fetchAll(PDO::FETCH_ASSOC);

		return $res;
	}

	function registrarPosicionUsu($idUsuario, $usuario, $provincia, $municipio, $latitud, $longitud, $reg)
	{

		$consulta = $this->pdo->prepare("INSERT INTO posiciones(idUsu,nombreUsuario,provincia,municipio,latitud,longitud,registrado) 
		VALUES (:identificadorUsu, :nombreUsuario, :prov, :muni, :latitud, :longitud, :registrado)");

		$array = [

			":identificadorUsu" => $idUsuario,
			":nombreUsuario" => $usuario,
			":prov" => $provincia,
			":muni" => $municipio,
			":latitud" => $latitud,
			":longitud" => $longitud,
			":registrado" => $reg
		];

		$res = $consulta->execute($array);

		return $res;
	}

	function registroParametroSolares($usuario, $parametros)
	{

		$query = $this->pdo->prepare("SELECT id_instalacion FROM posiciones WHERE nombreUsuario = :nombreUsuario");
		$query->execute(array(':nombreUsuario' => $usuario));

		$fila = $query->fetch(PDO::FETCH_ASSOC);
		$id_instalacion = $fila['id_instalacion'];

		$consulta = $this->pdo->prepare("INSERT INTO paramsol(id_instalacion,nombreUsuario,datosSolares)
		VALUES (:idInsta, :nombreUsuario, :dS)");

		$array = [

			":idInsta" => $id_instalacion,
			":nombreUsuario" => $usuario,
			":dS" => $parametros
		];

		$res = $consulta->execute($array);

		return $res;
	}

	function ultimoParametroRegistrado($usuario){

		$consulta = $this->pdo->prepare("SELECT fechaRegistro FROM paramsol WHERE nombreUsuario=:usu ORDER BY fechaRegistro DESC LIMIT 1");

		$array = [
			":usu" => $usuario
		];

		$consulta->execute($array);
		$res = $consulta->fetchAll(PDO::FETCH_ASSOC);

		return $res;
	}

	function ultimoRegistroSolar($usuario){

		$consulta = $this->pdo->prepare("SELECT datosSolares FROM paramsol WHERE nombreUsuario=:usu ORDER BY fechaRegistro DESC LIMIT 1");

		$array = [
			":usu" => $usuario
		];

		$consulta->execute($array);
		$resArray = $consulta->fetchAll(PDO::FETCH_ASSOC);
		$res = json_encode($resArray[0]['datosSolares']);

		return $res;
	}

	function existeInstalacion($idInstalacion){

		$consulta = $this->pdo->prepare("SELECT id_instalacion FROM instalaciones WHERE id_instalacion=:id");

		$array = [
			":id" => $idInstalacion
		];

		$consulta->execute($array);
		
		if($consulta->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}

	function registrarValoresInstalacion($id,$w75, $w160, $w200, $w300, $w450, $w600, $cantPlacas, $poTotal, $cantBaterias, $capBaterias, $reguldor, $inversor)
	{

		$consulta = $this->pdo->prepare("INSERT INTO instalaciones(id_instalacion,75W,160W,200W,300W,450W,600W,cantidadPlacas,potenciaTotal,cantidadBaterias,capacidadBaterias,regulador,inversor) 
		VALUES (:id, :7y5, :1y60, :2y0, :3y0, :4y5, :6y0, :cantPla, :poTot, :cantBat, :capBat, :reg, :inv)");

		$array = [
			":id" => $id,
			":7y5" => $w75,
			":1y60" => $w160,
			":2y0" => $w200,
			":3y0" => $w300,
			":4y5" => $w450,
			":6y0" => $w600,
			":cantPla" => $cantPlacas,
			":poTot" => $poTotal,
			":cantBat" => $cantBaterias,
			":capBat" => $capBaterias,
			":reg" => $reguldor,
			":inv" => $inversor
		];

		$res = $consulta->execute($array);

		return $res;
	}

	function datosInstalacion($idInstalacion){

		$consulta = $this->pdo->prepare("SELECT * FROM instalaciones WHERE id_instalacion=:id");

		$array = [
			":id" => $idInstalacion
		];

		$consulta->execute($array);
		$resArray = $consulta->fetchAll(PDO::FETCH_ASSOC);

		return $resArray;
	}

	function ultimoParametroProduccion($idInstalacion){

		$consulta = $this->pdo->prepare("SELECT fecha_registro FROM produccionsolar WHERE id_instalacion=:idInsta ORDER BY fecha_registro DESC LIMIT 1");

		$array = [
			":idInsta" => $idInstalacion
		];

		$consulta->execute($array);
		$res = $consulta->fetchAll(PDO::FETCH_ASSOC);

		return $res;
	}

	function posicionGeografica($idInstalacion){

		$query = $this->pdo->prepare("SELECT latitud,longitud FROM posiciones WHERE id_instalacion = :idInsta");

		$array = [
			":idInsta" => $idInstalacion
		];

		$query->execute($array);
		$res = $query->fetchAll(PDO::FETCH_ASSOC);

		return $res;

	}

	function registrarProduccioneSolares($idInstalacion,$produccioneSolares){


		$consulta = $this->pdo->prepare("INSERT INTO produccionsolar(id_instalacion,registros_produccion)
		VALUES (:idInsta, :registrosProd)");

		$array = [

			":idInsta" => $idInstalacion,
			":registrosProd" => $produccioneSolares
		];

		$res = $consulta->execute($array);

		return $res;

	}

	function ultimaProduccionSolar($idInstalacion){

		$consulta = $this->pdo->prepare("SELECT registros_produccion FROM produccionsolar WHERE id_instalacion=:idInsta ORDER BY fecha_registro DESC LIMIT 1");

		$array = [
			":idInsta" => $idInstalacion
		];

		$consulta->execute($array);
		$resArray = $consulta->fetchAll(PDO::FETCH_ASSOC);
		$res = json_encode($resArray[0]['registros_produccion']);

		return $res;
	}

	function eliminarInstalacion($idInstalacion){

		$consulta = $this->pdo->prepare("DELETE FROM instalaciones WHERE id_instalacion=:idInsta");

		$array = [
			":idInsta" => $idInstalacion
		];

		$res = $consulta->execute($array);

		return $res;
	}

	function eliminarCuentaHELIOS($usuario){

		$consulta = $this->pdo->prepare("DELETE FROM users WHERE nombreUsuario=:usu");

		$array = [
			":usu" => $usuario
		];

		$res = $consulta->execute($array);

		return $res;
	}

	function registrarValorAlerta($val,$idInstalacion){

		$consulta = $this->pdo->prepare("UPDATE instalaciones SET valoralerta=:val WHERE id_instalacion=:id");

		$array = [
			":val" => $val,
			":id" => $idInstalacion
		];

		$res = $consulta->execute($array);

		return $res;
	}

	function obtenerValorAlerta($idInstalacion){

		$consulta = $this->pdo->prepare("SELECT valoralerta FROM instalaciones WHERE id_instalacion=:id");

		$array = [
			":id" => $idInstalacion
		];

		$consulta->execute($array);
		$resArray = $consulta->fetchAll(PDO::FETCH_ASSOC);

		return $resArray;
	}

	function pdfRegistrosProduccion($idInstalacion){

		$consulta = $this->pdo->prepare("SELECT * FROM produccionsolar WHERE id_instalacion=:idInsta ORDER BY fecha_registro DESC LIMIT 1");

		$array = [
			":idInsta" => $idInstalacion
		];

		$consulta->execute($array);
		$res = $consulta->fetchAll(PDO::FETCH_ASSOC);

		return $res;
	}
}
