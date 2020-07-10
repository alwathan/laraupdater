<?php
 
namespace Alwathan\LaraUpdater;
 
/**
 * Basic Calculator.
 * 
 */
class Github
{
    /**
     * Menjumlahkan semua data dalam sebuah array.
     *
     * @param array $data
     * @return integer
     */
    public static function add(array $data)
    {
        $response = Http::withToken('0b797ec8d3eb9bd91cc45c69c4999f04211e6ed4')->get('https://api.github.com/repos/jazuligh/pilbup/releases');

        return var_dump($response->body());
        
        //Coba Edit dari github
        
    }
 
    /**
     * Mengalikan semua data dalam sebuah array.
     *
     * @param array $data
     * @return integer
     */
    public static function multiply(array $data)
    {
        return array_product($data);
    }
}