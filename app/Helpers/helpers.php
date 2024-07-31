<?php

if (!function_exists('formatCpfCnpj')) {
    function formatCpfCnpj($value): string
    {
        $CPFLangth = 11;
        $cpf_cnpj  = preg_replace('/\D/', '', $value);

        if (strlen($cpf_cnpj) == $CPFLangth) {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf_cnpj);
        }

        if (strlen($cpf_cnpj) == 14) {
            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $cpf_cnpj);
        }

        return $cpf_cnpj;
    }
}

if (!function_exists('formatCep')) {
    function formatCep($value): string
    {
        $cep = preg_replace('/\D/', '', $value);

        if (strlen($cep) == 8) {
            return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $cep);
        }

        return $cep;
    }
}

if (!function_exists('formatPhone')) {
    function formatPhone($value): string
    {
        $phone = preg_replace('/\D/', '', $value);

        if (strlen($phone) == 10) {
            return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $phone);
        }

        if (strlen($phone) == 11) {
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $phone);
        }

        return $phone;
    }
}
