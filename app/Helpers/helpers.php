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
