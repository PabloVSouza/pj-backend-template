<?php

use \Firebase\JWT\JWT;
use \app\classes\Parametros;


function ActiveRecordArray($resultset)
{

    $arrayFinal = [];

    if (is_array($resultset)) {
        foreach ($resultset as $result) {
            array_push($arrayFinal, $result->to_array());
        }
    } else {
        $arrayFinal = $resultset->to_array();
    }


    return $arrayFinal;
}

function ActiveRecordSimpleObject($resultset)
{

    $objTemp = [];

    if (is_array($resultset)) {

        $chaves = array_keys($resultset[0]->attributes());

        foreach ($resultset as $result) {


            $objResult = new stdClass;

            foreach ($chaves as $chave) {

                $objResult->{$chave} = $result->$chave;
            }

            array_push($objTemp, $objResult);
        }
    } else {
        $chaves = array_keys($resultset->attributes());

        $objResult = new stdClass;

        foreach ($chaves as $chave) {

            $objResult->{$chave} = $resultset->$chave;
        }

        $objTemp = $objResult;
    }

    return $objTemp;
}

function pegaRelacionamentos($resultset, $spRel = [])
{

    if (is_array($resultset)) {
        if (count($resultset) > 0) {
            $chaves = array_keys($resultset[0]->attributes());
        } else {
            return null;
        }
    } else {
        $chaves = array_keys($resultset->attributes());
    }

    $relacionamentos = [];
    foreach ($chaves as $chave) {
        if (strstr($chave, '_id')) {
            array_push($relacionamentos, substr($chave, 0, -3));
        }
    }

    $subRel = [];

    if (count($spRel) > 0) {
        foreach ($spRel as $key => $sp) {
            if (!is_array($sp)) {
                array_push($relacionamentos, $sp);
            } else {
                $subRel[$key] = $sp;
            }
        }
    }

    $objTemp = ActiveRecordSimpleObject($resultset);

    foreach ($objTemp as $key => $result) {

        foreach ($relacionamentos as $relacionamento) {

            try {

                foreach ($subRel as $chaveSub => $sub) {

                    if ($chaveSub == $relacionamento) {

                        $result->{$relacionamento} = pegaRelacionamentos([$resultset[$key]->{$relacionamento}], $sub);
                        continue 2;
                    }
                }

                $tmp = pegaRelacionamentos($resultset[$key]->{$relacionamento});
                if ($tmp != null) {
                    $result->{$relacionamento} = $tmp;
                }
            } catch (Exception $e) { }
        }
    }

    return $objTemp;
}

function validaToken($token)
{
    $jwt = isset($token) ? $token : "";
    $retorno = new stdClass;
    if ($jwt) {
        try {
            $decoded = JWT::decode($jwt, Parametros::$jwt_key, array('HS256'));
            $retorno->code = 200;
            $retorno->message = "Acesso Liberado";
            $retorno->data = $decoded->data;
        } catch (Exception $e) {

            $retorno->code = 401;
            $retorno->message = "Acesso Negado";
            $retorno->error = $e->getMessage();
        }
    } else {
        $retorno->code = 401;
        $retorno->message = "Acesso Negado";
    }
    return $retorno;
}
