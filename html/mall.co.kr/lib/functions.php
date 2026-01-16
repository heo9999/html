<?
	//단독실행 방지
	if(!defined('__E2MALL__')) exit();

    /**
     * 단일 변수의 정의 및 값 존재 여부 반환 함수
     *
     * @param array $param
     * @param string $key
     * @return boolean
     */
    function validSingleData($param, $key)
    {
        $result = false;
        if (isset($param[$key]) === true && empty($param[$key]) === false) {
            $result = true;
        }

        return $result;
    }

    /**
     * 쿼리 빌더
     *
     * @param string $baseQuery 기본 쿼리
     * @param array $params 쿼리 조건
     */
    function queryBuilder(string $table, array $params = ['where'=>'','join'=>[],'groupby'=>'','limit'=>''])
    {
        // select절
        if (validSingleData($params, 'select')) {
            $query = 'SELECT '.$params['select'].' FROM '.$table;
        } else {
            $query = 'SELECT * FROM '.$table;
        }

        // join절
        if (validSingleData($params, 'join')) {
            foreach ($params['join'] as $type => $joinQuery) {
                if ($type === 'left') {
                    $query .= ' LEFT JOIN '.$joinQuery;
                } elseif ($type === 'right') {
                    $query .= ' RIGHT JOIN '.$joinQuery;
                }
            }
        }

        // where절
        if (validSingleData($params, 'where')) {
            $query .= ' WHERE '.$params['where'];
        }

        // group by절
        if (validSingleData($params, 'groupby')) {
            $query .= ' GROUP BY '.$params['groupby'];
        }

        // having 절
        if (validSingleData($params, 'having')) {
            $query .= ' HAVING '.$params['having'];
        }

        // order by절
        if (validSingleData($params, 'orderby')) {
            $query .= ' ORDER BY '.$params['orderby'];
        }

        // limit 절
        if (validSingleData($params, 'limit')) {
            $query .= ' LIMIT '.$params['limit'];
        }

        if (validSingleData($params, 'debug')) {
            if ($params['debug'] === true) {
                dd($query);
            }
        }

        return $query;
    }

    /**
     * 문자열 자르기
     *
     * @description
     * - 주어진 문자열($str)을 전달 받은 길이 값($length)으로 잘라 반환
     * @param string $str
     * @param string $length
     */
    function cutStr(string $str, int $length)
    {
        // 반환 값 초기화
        $result = $msg = '';

        // 문자열 유효성 검증
        if (empty($str)) {
            $msg = '기준 문자열은 필수입니다.';
        } elseif (empty($length)) {
            $msg = '기준 길이값은 필수입니다.';
        }

        if ($msg) {
            commonAlert($msg);
        }

        $strLen = mb_strlen($str, 'UTF-8');
        if ($strLen > $length) {
            $result = mb_substr($str, 0, $length, 'UTF-8');
        } else {
            $result = $str;
        }

        return $result;
    }


    /**
     * 파일 삭제 함수
     *
     * @param string $folder 이미지 삭제 폴더명
     * @param array $params 이미지 정보
     */
    function delete_file(array $params)
    {
        // 반환값 초기화
        $response = [
            'result' => false,
            'path' => '',
            'msg' => '',
        ];

        try {
            // 파일 존재 검증
            $fileName = DOMAIN.$params['path'];
            error_log('x1');
            error_log($fileName);
            if(file_exists($fileName) === false){
                throw new Exception('존재하지 않는 파일이거나 경로가 올바르지 않습니다.',);
            }
            // 파일 삭제 - 성공 / 실패
            $response['result'] = unlink($fileName);
            if ($response['result'] === false) {
                throw new Exception('존재하지 않는 파일이거나 경로가 올바르지 않습니다.', );
            }
        } catch(Exception $e) {
            $response['msg'] = $e->getMessage();
        }

        return $response;
    }

    function goto_url($url){
		$url = str_replace("&amp;", "&", $url);
		//echo "<script> location.replace('$url'); </script>";

		if (!headers_sent())
			header('Location: '.$url);
		else {
			echo '<script>';
			echo 'location.replace("'.$url.'");';
			echo '</script>';
			echo '<noscript>';
			echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
			echo '</noscript>';
		}
		exit;
	}

	// 아이디로 사용 가능한 문자열인지 체크
	function check_id($user_id) {
		return preg_match('/^[0-9a-zA-Z]{1}[0-9a-zA-Z_-]{3,15}$/', $user_id);
	}

	/*-------------------- [ 값 체크후 맞으면 값을 리턴하고, 아니면 정지. ] --------------------*/
	function check_return($value, $msg) {
		return intval($value) ? intval($value) : alert('javascript:history.go(-1)',$msg);
	}

	/* 정수값 파라메터 체크 후, 비정상이면 default 값으로 리턴.. */
	function default_int($value, $default) {
		return intval($value) ? intval($value) : $default;
	}

	function default_float($value, $default) {
		return floatval($value) ? floatval($value) : $default;
	}

?>
