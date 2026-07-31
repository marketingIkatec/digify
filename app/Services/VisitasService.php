<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog;
use App\Models\BlogCategoria;
use App\Models\BlogAutor;
use App\Models\Visitas;
use Illuminate\Support\Facades\DB;

class VisitasService
{
	public $ip = '';
	public $paginaId = '';
	public $pagina = '';
	public $location = [];
	
	public function __construct() {
		
	}

	public function registrar($request){
		$this->pagina   = $this->getPagina();
		$this->paginaId = $this->getPaginaId();
		$this->ip       = $this->getClientIp();
		$this->location = $this->getLocationFromIp();
		
		$this->saveVisita();
	}

	public function getPagina(){
		$pages = explode("/", request()->path());
		if(!empty($pages)){
			foreach($pages as $key => $page){
				if($page == ''){
					unset($pages[$key]);
				}
			}
		}
		
		return (!empty($pages) ? $pages : ['index']);
	}

	public function getPaginaId(){
		
		$slug  = str_replace("blog/", "", implode('/', $this->pagina));

		switch($slug){
			case 'index' : $this->pagina = ['index']; return 1; break;
		}
		
		$obj = getPageBySlug($slug);
		if ($obj) {
			return $obj->id;
		}	
		
		return '';
	}

	function saveVisita($id = ''){
		if(reset($this->pagina) != 'login'){
			//$pagina = (count($this->pagina) >1) ? implode('/', array_slice($this->pagina, 0, -1)) : reset($this->pagina);
			$pagina  = str_replace("blog/", "", implode('/', $this->pagina));
			
			$where = [];
			$where[] = "ip = '".$this->ip."'";
			$where[] = "pagina = '".$pagina."'";
			$where[] = "DATE_FORMAT(data, '%Y-%m-%d') = '".date('Y-m-d')."'";
			$where[] = (($this->paginaId) ? " pagina_id = '".$this->paginaId."'" : " isnull(pagina_id)");

			if($this->paginaId){
				$queryVisita = DB::select("SELECT id 
												FROM visitas 
												WHERE ".implode(" and ", $where));
				if(count($queryVisita) == 0){
					$dados = [];
					$dados['ip'] = $this->ip;
					if(!empty($this->location)){
						$dados['pais']      = $this->location['pais'];
						$dados['regiao']    = $this->location['regiao'];
						$dados['latitude']  = $this->location['latitude'];
						$dados['longitude'] = $this->location['longitude'];
						$dados['cidade']    = $this->location['cidade'];
					}
					if($this->paginaId){
						$dados['pagina_id'] = $this->paginaId;
					}
					$dados['pagina']    = substr($pagina, 0, 255);
					$dados['data']      = date('Y-m-d H:i:s');

					DB::table('visitas')->insert($dados);
				}  
			}  
		}  
	}


	function getClientIp() {
		$keys = [
			'HTTP_CLIENT_IP',
			'HTTP_X_FORWARDED_FOR',
			'HTTP_X_FORWARDED',
			'HTTP_X_CLUSTER_CLIENT_IP',
			'HTTP_FORWARDED_FOR',
			'HTTP_FORWARDED',
			'REMOTE_ADDR'
		];
		foreach ($keys as $key) {
			if (!empty($_SERVER[$key])) {
				$ipList = explode(',', $_SERVER[$key]);
				foreach ($ipList as $ip) {
					$ip = trim($ip);
					if (filter_var($ip, FILTER_VALIDATE_IP)) {
						return $ip;
					}
				}
			}
		}
		return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
	}

	function getLocationFromIp() {
		if($this->ip){

			$visita = Visitas::where('ip', $this->ip)
					->whereNotNull('pais')
					->where('pais', '!=', '')
					->inRandomOrder()
					->first();
		
			if(!empty($visita)){ 
				$data['ip']           = $this->ip;	
				$data['country_name'] = $visita->pais;	
				$data['region']       = $visita->regiao;	
				$data['city']         = $visita->cidade;	
				$data['latitude']     = $visita->latitude;	
				$data['longitude']    = $visita->longitude;	
			}else{ 
				$url = $this->ip ? "https://ipapi.co/{$this->ip}/json/" : "https://ipapi.co/json/";
				$opts = [
					"http" => [
						"header" => "User-Agent: PHP\r\n",
						"timeout" => 3
					]
				];
				$context = stream_context_create($opts);
				$json = @file_get_contents($url, false, $context);
				if ($json === false){
					return [];
				} 

				$data = json_decode($json, true);
				if (isset($data['error']) && $data['error']){
					return [];
				} 
			}
		}
		return [
				'ip'        => $data['ip']           ?? $this->ip,
				'pais'      => $data['country_name'] ?? null,
				'regiao'    => $data['region']       ?? null,
				'cidade'    => $data['city']         ?? null,
				'latitude'  => $data['latitude']     ?? null,
				'longitude' => $data['longitude']    ?? null
		];
	}

	function getGrafico(){
		$graficos = [];
		$graficos['graficoVisitaTotal'] = $this->getTotalVisitas();
		return $graficos;
	}

	public function getTotalVisitas(){
		global $_GET;

		$where = [];
		if(!empty($_GET['tipoPagina'])){
			$where[] = " pagina = '".$_GET['tipoPagina']."'";
		}

		if(!empty($_GET['dataInicial'])){
			$where[] = " data >= '".$_GET['dataInicial']."'";
		}

		if(!empty($_GET['dataFinal'])){
			$where[] = " data <= '".$_GET['dataFinal']." 23:59:59'";
		}

		$query = DB::select("SELECT COUNT(id) AS total, pagina, pagina_id 
								  FROM visitas
								  ".(!empty($where) ? " WHERE ".implode(" AND ", $where) : "")." 
								  GROUP BY pagina, pagina_id order by total desc LIMIT 10");
		$dadosGrafico = [];
		$i = $totalVisitas = 0;  
		foreach($query as $result){
			$totalVisitas += $result->total;
			$dadosGrafico[$i]['total']  = $result->total;

			if($result->pagina_id && $result->pagina){
				$campo = "";
				switch ($result->pagina) {
					case 'blog':           $tabela = 'blogs'; $tipo = "blog: "; $campo = 'titulo'; break;
					case 'blogsCategoria': $tabela = 'blogsCategoria'; $tipo = "categoria Blog: "; $campo = 'categoria'; break;
				}
				if($campo){
					$queryPagina = DB::select("SELECT ".$campo." FROM ".$tabela." WHERE id = ".$result->pagina_id);
					if(count($queryPagina) > 0){
						$result->pagina = $tipo.$queryPagina[0]->$campo;
					}
				}					
			}else{
				$result->pagina = "Tela inicial: ".$result->pagina;
			}

			$dadosGrafico[$i]['pagina'] = $result->pagina;
			$i++;
		} 
		return ['totalVisitas' => $totalVisitas, 'grafico' =>$dadosGrafico];
	}
}
