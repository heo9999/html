<?
	//단독실행 방지
	if(!defined('__E2MALL__')) exit();

	class database {

		private $mysqli = false;

		private $servers = array(
			"mall"=>array("host"=>"172.21.57.193","user"=>"e2web","pass"=>"1234","db"=>"e2web","port"=>"13306"),
		);


		private $resource = null;

		private $last_error = '';

		private $chk_query = false;

		function __construct($db_name='mall'){
			$this->mysqli = new mysqli($this->servers[$db_name]['host'], $this->servers[$db_name]['user'], $this->servers[$db_name]['pass'], $this->servers[$db_name]['db'], $this->servers[$db_name]['port']);
			$this->query("set names utf8");
		}

		function last_id(){
			return $this->mysqli->insert_id;
		}

		function query($sql){
            error_log("DB SQL :".$sql);
            try {
    			$this->resource = $this->mysqli->query($sql);
            } catch (mysqli_sql_exception $e) {
                error_log("DB ERROR :".$e->getMessage());
            }
			$this->debug($sql);
			return $this->resource;
		}

		function fetch($res=false){
			return $res ? $res->fetch_assoc() : $this->resource->fetch_assoc();
		}

		function rows(){
			return $this->resource->num_rows;
		}

		function affected_rows(){
			return $this->mysqli->affected_rows;
		}

		function fetch_one($sql){
			$this->query($sql);
			if(!$this->resource) return false;
			return $this->resource->fetch_assoc();
		}

		function fetch_array($sql){
			$this->query($sql);
			if(!$this->resource) return false;
			return $this->resource->fetch_all(MYSQLI_ASSOC);
		}

		function fetch_field($sql){
			$this->query($sql);
			if(!$this->resource) return false;
			$result = $this->resource->fetch_row();
			if(is_array($result)){
				return $result[0];
			}else{
				return $result;
			}
		}

		function first($res=false){
			$res ? $res->data_seek(0) : $this->resource->data_seek(0);
		}

		function close(){
			//if($this->resource !== true) $this->resource->close();
			$this->resource = null;
			//var_dump($this->resource);
			$this->mysqli->close();
		}

		function begin_transaction(){
			$this->mysqli->begin_transaction();
		}

		function commit(){
			$this->mysqli->commit();
		}

		function rollback(){
			$this->mysqli->rollback();
		}

		function debug($sql){
			$this->last_error = $this->mysqli->error;

			if($this->last_error){
                error_log("error ".$this->last_error);
				$filename = LOG_PATH."query_".date("Ymd", time()).".log";

				$msg = "[".date("Y-m-d H:i:s")."] ".$this->last_error.chr(13).chr(10);
				$msg.= $sql.chr(13).chr(10);

				file_put_contents($filename, $msg, FILE_APPEND);

				//if(@$_SERVER['REMOTE_ADDR'] == '61.37.188.148') echo $this->last_error;
			}
		}

		function last_error(){
			return $this->last_error;
		}

	}

?>
