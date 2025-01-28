<?php 

namespace app\services;

class TranslateService
{

    private string $lang;

    public function __construct(string $lang)
    {
        $this->lang = $lang;
    }

    public function transform(string $value) {
        $segments = explode('.', $value);
        $fileName = $segments[0] ?? null;
        array_shift($segments);
        $filePath = __DIR__."/../../public/assets/i18n/$this->lang/$fileName.php";
    
        if(!file_exists($filePath)) {
            return $value;
        };
        require_once($filePath);
        
        if($segments) {      
            $data = $_list;
            foreach ($segments as $key) {
                if (isset($data[$key])) {
                    $data = $data[$key];
                } else {
                    return $value;
                }
            }

            return $data;
        }

        return $value;
    }
}